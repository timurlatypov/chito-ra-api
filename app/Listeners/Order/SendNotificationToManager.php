<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationToManager
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param OrderCreated $event
     *
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        Mail::to(env('NOTIFY_PRIMARY_EMAIL'))
            ->bcc(env('NOTIFY_SECONDARY_EMAIL'))
            ->queue(new \App\Mail\NotifyManagers($event->order));
    }
}
