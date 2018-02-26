<?php

namespace App\Listeners;

use App\Events\despatch;
use App\Model\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class despatchListener
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
     * @param  despatch  $event
     * @return void
     */
    public function handle(despatch $event)
    {

    }
}
