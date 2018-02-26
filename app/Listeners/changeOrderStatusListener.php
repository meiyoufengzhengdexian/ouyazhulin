<?php

namespace App\Listeners;

use App\Events\changeOrderStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class changeOrderStatusListener
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
     * @param  changeOrderStatus  $event
     * @return void
     */
    public function handle(changeOrderStatus $event)
    {
        $order = $event->order;
    }
}
