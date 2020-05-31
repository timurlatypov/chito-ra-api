<?php

namespace App\Events\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class OrderCreated
{
    use Dispatchable, SerializesModels;

    public $order;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param User  $user
     */
    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }
}
