<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Events\newOrder;
use App\Lib\Tn\Result;
use App\Model\Additional_service;
use App\Model\Order;
use App\Model\OrderAdditionalService;
use App\Model\OrderStatus;
use App\Model\PriceItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class Booking extends Tuniu
{
    public function booking(Request $request)
    {
        try {
            $input = $this->getInput();
            $data['VehicleCode'] = $input->VehicleCode->__toString();
            $data['PickupDate'] = $input->PickupDate->__toString();
            $data['PickupStoreCode'] = $input->PickupStoreCode->__toString();
            $data['ReturnDate'] = $input->ReturnDate->__toString();
            $data['ReturnStoreCode'] = $input->ReturnStoreCode->__toString();
            $data['UserName'] = $input->UserName->__toString();
            $data['CardType'] = $input->CardType->__toString();
            $data['CardNo'] = $input->CardNo->__toString();
            $data['Mobile'] = $input->Mobile->__toString();
            $data['membershipGrade'] = $input->membershipGrade->__toString();
            $data['PaymentType'] = $input->PaymentType->__toString();
            $data['CouponCode'] = $input->CouponCode->__toString();
            $data['AdditionalServiceCodes'] = $input->AdditionalServiceCodes->string;
            $data['TourOrderNo'] = $input->TourOrderNo->__toString();
            $data['Extra'] = $input->Extra->__toString();

            $rules = [
                'VehicleCode' => 'required',
                'PickupDate' => 'required|date',
                'PickupStoreCode' => 'required|exists:store,id',
                'ReturnDate' => 'required|date',
                'ReturnStoreCode' => ' required|exists:store,id',
                'UserName' => 'required',
                'CardType' => 'required',
                'CardNo' => 'required',
                'Mobile' => 'required',
                'membershipGrade' => 'required',
                'PaymentType' => 'required',
                'TourOrderNo' => 'required',
                'Extra' => 'required'
            ];

            $v = Validator::make($data, $rules);


            $product = null;
            $v->after(function ($valudate) use ($data, &$product) {
                $seri = Redis::get($data['Extra']);
                if (!$seri) {
                    $valudate->errors()->add('Extra', '未找到Extra');
                    return;
                }

                $product = unserialize($seri);
            });

            if ($v->fails()) {
                //参数有错误
                $errors = $v->errors();
                $str = '';
                foreach ($errors->keys() as $key) {
                    $str .= implode(', ', $errors->get($key));
                }
                throw new \Exception($str);
            }

            $pickupStore = \App\Model\Store::getStore($data['PickupStoreCode']);
            if($pickupStore->type == 2){
                $pickupStore = \App\Model\Store::getStore($pickupStore->store);
            }
            $returnStore = \App\Model\Store::getStore($data['ReturnStoreCode']);

            if($returnStore->type == 2){
                $returnStore = \App\Model\Store::getStore($returnStore->store);
            }

            $canStore = Order::getAvailableStore($data['VehicleCode'], $pickupStore->id, $data['PickupDate'], $returnStore->id);

            if (empty($canStore)) {
                throw new \Exception('这段时间，车都预订出去了');
            }

            $orderData = [];
            $orderData['car_patt'] = $data['VehicleCode'];
            $orderData['pickup_time'] = $data['PickupDate'];
            $orderData['real_pickup_time'] = $orderData['pickup_time'];
            $orderData['pickup_store'] = $data['PickupStoreCode'];
            $orderData['return_time'] = $data['ReturnDate'];
            $orderData['real_return_time'] = $orderData['return_time'];
            $orderData['return_store'] = $data['ReturnStoreCode'];
            $orderData['use_name'] = $data['UserName'];
            $orderData['use_phone'] = $data['Mobile'];
            $orderData['card_type'] = $data['CardType'];
            $orderData['card_no'] = $data['CardNo'];
            $orderData['pay_method'] = $data['PaymentType'] == 'C' ? '现付' : '预付';
            $orderData['oth_order_id'] = $data['TourOrderNo'];
            $orderData['extra'] = $data['Extra'];
            $orderData['show'] = 1;

            $created_at = $request->input('timestamp');

            if (!$created_at) {
                $created_at = date('Y-m-d H:i:s');
            } else {
                $created_at /= 1000;
                $created_at = date('Y-m-d H:i:s', $created_at);
            }
            $orderData['created_at'] = $created_at;

            $order = Order::whereExtra($orderData['extra'])->where('use_phone', $orderData['use_phone'])->first();
            $order->update($orderData);

            $this->changeStatus($order, 1);

            if ($data['membershipGrade'] == 1) {
                $order->getTag()->attach(1);
            }

            if($data['AdditionalServiceCodes']){
                foreach ($data['AdditionalServiceCodes'] as $as) { //增值服务
                    $AdditionalService = Additional_service::find($as->toString());
                    if (!$AdditionalService) {
                        continue;
                    }
                    $orderAdditionalService = new OrderAdditionalService();
                    $orderAdditionalService->name = $AdditionalService->name;
                    $orderAdditionalService->price = $AdditionalService->price;
                    $orderAdditionalService->phpobj = serialize($orderAdditionalService);
                    $orderAdditionalService->order = $order->id;
                    $orderAdditionalService->save();
                }
            }

            $df = $product->getDetailFee();

            $priceList = $df->getList();

            foreach ($priceList as $priceItem) {
                $priceItemEntry = new PriceItem();
                $priceItemEntry->order = $order->id;
                $priceItemEntry->name = $priceItem->name;
                $priceItemEntry->price = $priceItem->getPrice();
                $priceItemEntry->phpobj = serialize($priceItem);
                $priceItemEntry->save();
            }

            event(new newOrder($order));

            $this->data = [
                'Result' => new Result(true),
                'OrderNo' => $order->id
            ];

            return $this->getResult();
        } catch (\Exception $e) {
            $this->data = [
                'Result' => new Result(false, $e->getMessage()),
                'OrderNo' => null
            ];
            return $this->getResult();
        }
    }
}
