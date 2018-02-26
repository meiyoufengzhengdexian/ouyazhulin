<?php

namespace App\Events;

use App\Model\Order;
use App\Model\Pickup_price;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class pickupCar
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;
    public $p;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, Pickup_price $p)
    {
        $this->order = $order;
        $this->p = $p;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
