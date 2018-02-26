<?php

namespace App\Listeners;

use App\Events\returnCar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class returnCarListener
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
        //
    }
}
