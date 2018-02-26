<?php

namespace App\Listeners;

use App\Events\returnCar;
use App\Model\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class returnCarLogListener
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
     * Handle the event.
     *
     * @param  returnCar  $event
     * @return void
     */
    public function handle(returnCar $event)
    {
        $order = $event->order;
        $p = $event->p;

        $admin = session('admin');
        $view = view('admin.log.returnCar', compact('order', 'p', 'admin'))->__toString();
        Log::log($view, 'order', $order->id);
    }
}
