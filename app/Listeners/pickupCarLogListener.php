<?php

namespace App\Listeners;

use App\Events\pickupCar;
use App\Model\Log;
use App\Model\Pickup_price;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class pickupCarLogListener
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
     * @param  pickupCar  $event
     * @return void
     */
    public function handle(pickupCar $event)
    {
        $order = $event->order;
        $p = $event->p;
        $admin = session('admin');
        $view = view('admin.log.pickupCar', compact('order', 'p', 'admin'))->__toString();
        Log::log($view, 'order', $order->id);
    }
}
