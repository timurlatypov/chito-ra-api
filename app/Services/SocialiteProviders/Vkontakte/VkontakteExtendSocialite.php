<?php

namespace App\Services\SocialiteProviders\Vkontakte;

use SocialiteProviders\Manager\SocialiteWasCalled;

class VkontakteExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'vkontakte', __NAMESPACE__ . '\Provider'
        );
    }
}
