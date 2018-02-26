<?php

namespace App\Listeners;

use App\Events\editOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class editOrderListener
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
     * @param  editOrder  $event
     * @return void
     */
    public function handle(editOrder $event)
    {
        //
    }
}
