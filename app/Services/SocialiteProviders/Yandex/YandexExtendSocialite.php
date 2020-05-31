<?php

namespace App\Services\SocialiteProviders\Yandex;

use SocialiteProviders\Manager\SocialiteWasCalled;

class YandexExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'yandex', __NAMESPACE__ . '\Provider'
        );
    }
}
