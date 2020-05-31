<?php

namespace App\Services\Social;

use Exception;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialUserResolver implements SocialUserResolverInterface
{
    /**
     * Resolve user by provider credentials.
     *
     * @param string $provider
     * @param string $accessToken
     *
     * @return Authenticatable|null
     */
    public function resolveUserByProviderCredentials(string $provider, string $accessToken): ?Authenticatable
    {
        $providerUser = null;

        try {
            $providerUser = Socialite::driver($provider)->userFromToken($accessToken);
        } catch (Exception $e) {
            Log::error('[resolveUserByProviderCredentials] Failed', [
                'exception' => get_class($e),
                'message'   => $e->getMessage(),
                'line'      => $e->getLine(),
            ]);
        }

        if ($providerUser) {
            return (new UserSocialAccountService())->find($providerUser, $provider);
        }

        return null;
    }
}
