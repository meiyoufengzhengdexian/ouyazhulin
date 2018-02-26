<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\newOrder' => [
            'App\Listeners\newOrderListener',
        ],
        'App\Events\despatch' => [
            'App\Listeners\despatchListener',
            'App\Listeners\despatchLogListener',
        ],
        'App\Events\changeOrderStatus' => [
            'App\Listeners\changeOrderStatusListener',
        ],
        'App\Events\editOrder' => [
            'App\Listeners\editOrderListener',
        ],
        'App\Events\pickupCar' => [
            'App\Listeners\pickupCarListener',
            'App\Listeners\pickupCarLogListener',
        ],
        'App\Events\returnCar' => [
            'App\Listeners\returnCarListener',
            'App\Listeners\returnCarLogListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
