<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendConfirmationToCustomer
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param OrderCreated $event
     */
    public function handle(OrderCreated $event)
    {
        Mail::to($event->user->email)
            ->queue(new \App\Mail\NewOrder($event->order));
    }
}
