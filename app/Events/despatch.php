<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class despatch
{
    /**
     * 分配车辆事件
     */
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $car;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $car)
    {
        $this->order = $order;
        $this->car = $car;
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
