<?php

namespace App\Services\Social;

use App\Models\User;
use App\Models\UserSocialAccount;
use Laravel\Socialite\Two\User as ProviderUser;

class UserSocialAccountService
{
    /**
     * Find or create user instance by provider user instance and provider name.
     *
     * @param ProviderUser $providerUser
     * @param string       $provider
     *
     * @return User
     */
    public function find(ProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = UserSocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        return $linkedSocialAccount->user;
    }
}
