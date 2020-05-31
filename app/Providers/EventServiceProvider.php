<?php

namespace App\Providers;

use App\Events\Order\OrderCreated;
use App\Listeners\Order\EmptyCart;
use App\Listeners\Order\SendConfirmationToCustomer;
use App\Listeners\Order\SendNotificationToManager;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use App\Services\SocialiteProviders\Mailru\MailruExtendSocialite;
use App\Services\SocialiteProviders\Vkontakte\VkontakteExtendSocialite;
use App\Services\SocialiteProviders\Yandex\YandexExtendSocialite;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
	    OrderCreated::class => [
	    	EmptyCart::class,
            SendConfirmationToCustomer::class,
            SendNotificationToManager::class,
	    ],
        SocialiteWasCalled::class => [
            VkontakteExtendSocialite::class,
            YandexExtendSocialite::class,
            MailruExtendSocialite::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
