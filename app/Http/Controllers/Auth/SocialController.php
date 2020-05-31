<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\OAuthTrait;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    use OAuthTrait;

    private $client;

    /**
     * Create a new controller instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Генерируем ссылку для редиректа
     *
     * @param $provider
     *
     * @return JsonResponse
     */
    public function redirect($provider)
    {
        return response()->json([
            'url' => $this->getSocialiteUrl($provider),
        ], Response::HTTP_OK);
    }

    /**
     * Obtain the user information.
     *
     * @param         $provider
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function callback($provider, Request $request)
    {
        /**
         * Запрашиваем Client_Secret на основании Client_ID
         */
        $oauth_client = DB::table('oauth_clients')
            ->where('id', config('passport.oauth_client_id'))
            ->first();

        /**
         * Получаем данные о пользователе из его аккаунта соц.сети
         */
        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            Log::error('[ SocialController@callback Failed ]', [
                'File'     => $e->getFile(),
                'Line'     => $e->getLine(),
                'message'  => $e->getMessage(),
                'provider' => $provider,
            ]);

            return response()->json([
                'message' => 'Ошибка авторизации через провайдера',
            ], Response::HTTP_BAD_REQUEST);
        }

        /**
         * Проверяем, есть ли этот пользователь в нашей БД
         */
        $user = $this->getPassportUser($providerUser, $provider);

        /**
         * Если пользователя нет в нашей БД - создаем в Паспорте нового пользователя
         * на основании данных из соц.сети
         */
        if (!$user) {
            $user = $this->createNewUser($providerUser);
        }

        /**
         * Проверяем, есть ли у нашего пользователя запись о соц. сети
         * через которую он осуществляет сейчас аутентификацию
         *
         * Кейс: Если пользователь зарегистрировался ранее по email, а сейчас пробует
         * логиниться через соц.сеть с таким же email, то надо прикрепить соц.сеть к пользователю
         */
        if ($this->needsToLinkSocial($user, $provider)) {
            $this->linkSocialToUser($user, $providerUser, $provider);
        }

        $this->updateLastLoginAt($user, $provider);

        /**
         * Аутентифицируем пользователя и получаем AccessToken
         */
        $tokens = $this->authenticatePassportUser($oauth_client, $providerUser, $provider);

        Log::info('[ authenticatePassportUser ]', [
            'tokens' => $tokens,
        ]);

        return response()->json([
            'access_token'  => $tokens->access_token,
            'refresh_token' => $tokens->refresh_token,
        ], Response::HTTP_OK);
    }
}
