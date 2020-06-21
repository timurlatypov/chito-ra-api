<?php

namespace App\Traits;

use App\Exceptions\OAuth\OAuthTokenExpiredException;
use App\Exceptions\OAuth\OAuthTokenNotVerifiedException;
use App\Exceptions\OAuth\OAuthTokenRevokedException;
use App\Models\UserSocialAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Laravel\Socialite\Facades\Socialite;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\ValidationData;
use League\OAuth2\Server\Exception\OAuthServerException;

trait OAuthTrait
{
    /**
     * Забираем email из данных от соц. сети
     *
     * @param $providerUser
     *
     * @return mixed|string
     */
    protected function getProviderUserEmail($providerUser)
    {
        $email = $providerUser->getEmail();

        if (isset($email)) {
            return $email;
        }

        if (isset($providerUser->accessTokenResponseBody['email'])) {
            return $providerUser->accessTokenResponseBody['email'];
        }

        return $this->makeFakeEmail();
    }

    /**
     * Vk не всегда возвращает email, делаем фейковый
     *
     * @return string
     */
    protected function makeFakeEmail()
    {
        return 'user-' . md5(now()) . '@chito-ra.ru';
    }

    /**
     * Генерируем callback-ссылку для провайдера
     *
     * @param $provider
     *
     * @return mixed
     */
    protected function getSocialiteUrl(string $provider)
    {
        return Socialite::driver($provider)
            ->with(['redirect_uri' => config('app.url') . '/oauth/callback/' . $provider])
            ->stateless()
            ->scopes(config('social.providers.' . $provider . '.scopes'))
            ->redirect()
            ->getTargetUrl();
    }

    /**
     * Получаем пользователя из нашей БД
     *
     * @param $providerUser
     * @param $provider
     *
     * @return mixed
     */
    protected function getPassportUser($providerUser, string $provider)
    {
        return User::where('email', $this->getProviderUserEmail($providerUser))
            ->orWhereHas('linkedSocialAccounts', function ($query) use ($providerUser, $provider) {
                $query->where('provider_id', $providerUser->getId())->where('provider_name', $provider);
            })->first();
    }

    /**
     * Авторизуем пользователя, выдаём токены
     *
     * @param $oauth_client
     * @param $providerUser
     * @param $provider
     *
     * @return mixed
     */
    protected function authenticatePassportUser($oauth_client, $providerUser, string $provider)
    {
        $authUser = $this->client->post(config('app.url') . '/oauth/token', [
            'form_params' => [
                'grant_type'    => 'social',
                'client_id'     => $oauth_client->id,
                'client_secret' => $oauth_client->secret,
                'provider'      => $provider,
                'access_token'  => $providerUser->token,
                'scope'         => '',
            ],
        ]);

        return json_decode($authUser->getBody()->getContents());
    }

    /**
     * Обновляем токены на основе refresh_token
     *
     * @param string $refreshToken
     * @param string $clientId
     * @param string $clientSecret
     *
     * @return mixed
     */
    protected function refreshPassportToken($refreshToken, $clientId, $clientSecret)
    {
        $authUser = $this->client->post(config('app.url') . '/oauth/token', [
            'form_params' => [
                'grant_type'    => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'scope'         => '',
            ],
        ]);

        return json_decode($authUser->getBody()->getContents());
    }

    /**
     * Создаём нового пользователя
     *
     * @param $providerUser
     *
     * @return mixed
     */
    protected function createNewUser($providerUser)
    {
        return User::create([
            'name'     => $providerUser->getName(),
            'email'    => $this->getProviderUserEmail($providerUser),
            'password' => Hash::make(Str::random(40)),
        ]);
    }

    /**
     * Связываем данные соц.сети с пользователем
     *
     * @param User $user
     * @param      $providerUser
     * @param      $provider
     *
     * @return Model
     */
    protected function linkSocialToUser(User $user, $providerUser, $provider)
    {
        return $user->linkedSocialAccounts()->create([
            'user_id'       => $user->id,
            'provider_id'   => $providerUser->getId(),
            'provider_name' => $provider,
            'avatar'        => $providerUser->getAvatar(),
        ]);
    }

    /**
     * Проверяем надо ли линковать полученные данные с пользователем
     *
     * @param User   $user
     * @param string $provider
     *
     * @return bool
     */
    protected function needsToLinkSocial(User $user, string $provider): bool
    {
        return !$user->hasSocialAccounts($provider);
    }

    /**
     * @param User   $user
     * @param string $provider
     */
    protected function updateLastLoginAt(User $user, string $provider): void
    {
        UserSocialAccount::where([
            ['user_id', '=', $user->id],
            ['provider_name', '=', $provider],
        ])->update([
            'last_login_at' => now(),
        ]);
    }

    /**
     * Пытаемся получить userId из токена
     *
     * @param string $accessToken
     *
     * @return mixed
     * @throws OAuthServerException
     */
    protected function parseUserIdFromToken(string $accessToken)
    {
        $key_path      = Passport::keyPath('oauth-public.key');
        $parseTokenKey = file_get_contents($key_path);
        $token         = (new Parser())->parse($accessToken);
        $signer        = new Sha256();

        if (!$token->verify($signer, $parseTokenKey)) {
            throw OAuthTokenNotVerifiedException::accessDenied('Access token could not be verified');
        }

        // Ensure access token hasn't expired
        $data = new ValidationData();
        $data->setCurrentTime(time());

        if ($token->validate($data) === false) {
            throw OAuthTokenExpiredException::accessDenied('Access token is invalid');
        }

        // Check if token has been revoked
        if ($this->isAccessTokenRevoked($token->getClaim('jti'))) {
            throw OAuthTokenRevokedException::accessDenied('Access token has been revoked');
        }

        return $token->getClaim('sub');
    }

    protected function isAccessTokenRevoked($tokenId)
    {
        return DB::table('oauth_access_tokens')
            ->where('id', $tokenId)
            ->where('revoked', 1)
            ->exists();
    }
}
