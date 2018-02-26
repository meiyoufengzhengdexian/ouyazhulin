<?php

namespace App\Listeners;

use App\Events\pickupCar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class pickupCarListener
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
     * @param  pickupCar  $event
     * @return void
     */
    public function handle(pickupCar $event)
    {

    }
}
