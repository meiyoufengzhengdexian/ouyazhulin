<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Exceptions\ProductSummaryNotFoundException;
use App\Lib\Result;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PreBooking extends Tuniu
{
    public function preBooking(Request $request)
    {
        try {
            $input = $this->getInput();
            $extra = $input->Extra->__toString();

            $productSummary = unserialize(Redis::get($extra));

            if (!$productSummary) {
                throw new ProductSummaryNotFoundException();
            }
            $priceInfo = $productSummary->getPriceInfo();

            $vehicleCode = $input->VehicleCode->__toString();
            $pickupDate = $input->PickupDate->__toString();
            $returnDate = $input->ReturnDate->__toString();
            $pickupStoreCode = $input->PickupStoreCode->__toString();
            $returnStoreCode = $input->ReturnStoreCode->__toString();
            $use_phone = $input->Mobile->__toString();
            if ($priceInfo->getPickupTime() != $pickupDate
                || $priceInfo->getReturnTime() != $returnDate
            ) {
                throw new \Exception('预定时间与查询时间不符');
            }

            $pickupStore = \App\Model\Store::getStore($pickupStoreCode);
            if($pickupStore->type == 2){
                $pickupStore = \App\Model\Store::getStore($pickupStore->store);
            }
            $returnStore = \App\Model\Store::getStore($returnStoreCode);

            if($returnStore->type == 2){
                $returnStore = \App\Model\Store::getStore($returnStore->store);
            }

            $canStore = Order::getAvailableStore($vehicleCode, $pickupStore->id, $pickupDate, $returnStore->id);

            if (empty($canStore)) {
                throw new \Exception('这段时间，车都预订出去了');
            }

            $orderStore = \App\Model\Store::find($pickupStoreCode);
            if ($orderStore->type == 2) {
                //提车点
                $orderStore = \App\Model\Store::find($orderStore->store);
            }

            $order = [];
            $order['car_patt'] = $vehicleCode;
            $order['store'] = $orderStore->id;
            $order['city'] = $orderStore->getCity->code;
            $order['price'] = $productSummary->getPrice();
            $order['pickup_time'] = $pickupDate;
            $order['real_pickup_time'] = $order['pickup_time'];
            $order['return_time'] = $returnDate;
            $order['real_return_time'] = $order['return_time'];
            $order['show'] = 0;
            $order['use_phone'] = $use_phone;
            $order['platform'] = 1;

            $order = Order::firstOrCreate([
                'extra' => $extra,
                'use_phone'=> $use_phone
            ], $order);

            $priceInfo =$productSummary->priceExt;
            $priceInfo->order = $order->id;
            $priceInfo->save();

            $this->data = [
                'Result'=>new \App\Lib\Tn\Result(true),
                'TotalPrice'=>$order->price
            ];

            return $this->getResult();

        } catch (\Exception $e) {
            $this->data = [
                'Result'=>new \App\Lib\Tn\Result(false, $e->getMessage()),
                'TotalPrice'=>'10000'
            ];
            return $this->getResult();
        }
    }
}