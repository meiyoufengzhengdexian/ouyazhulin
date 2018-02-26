<?php

namespace App\Listeners;

use App\Events\despatch;
use App\Model\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class despatchLogListener
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
     * @param  despatch  $event
     * @return void
     */
    public function handle(despatch $event)
    {
        $order = $event->order;
        $car = $event->car;
        $admin = session('admin');

        $view = view('admin.log.despatch', compact('order', 'car', 'admin'))->__toString();
        Log::log($view, 'order', $order->id);
    }
}
