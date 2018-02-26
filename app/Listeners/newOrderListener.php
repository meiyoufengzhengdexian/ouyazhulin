<?php

namespace App\Listeners;

use App\Events\newOrder;
use App\Model\Order;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class newOrderListener
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
     * @param  newOrder  $event
     * @return void
     */
    public function handle(newOrder $event)
    {
        //create search_key

        $order =$event->order;

        $data = $order->toArray();
        $data['car_pattern'] = $order->car_patt_name->getComName->name.$order->car_patt_name->name;
        $data['use_name'] = $order->use_name;
        $data['use_phone'] = $order->use_phone;
        $data['pickup_store'] = $order->getPickupStore->name;
        $data['return_store'] = $order->getReturnStore->name;
        $data['store'] = $order->getStore->name;
        $data['city'] = $order->getStore->getCity->name;
        $order->search_key = Order::createSearKey($data);
        $order->save();

    }
}
