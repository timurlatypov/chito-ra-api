<?php

namespace App\Services\SocialiteProviders\Mailru;

use SocialiteProviders\Manager\SocialiteWasCalled;

class MailruExtendSocialite
{
    /**
     * Execute the provider.
     *
     * @param SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'mailru', __NAMESPACE__.'\Provider');
    }
}
