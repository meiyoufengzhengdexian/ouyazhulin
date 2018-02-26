<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Events\changeOrderStatus;
use App\Exceptions\OrderNotFoundException;
use App\Http\Controllers\Api\Xml;
use App\Model\Order;
use App\Model\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Tuniu extends Xml
{
    protected $basicUrl = 'http:DNS/price';
    protected $vendcode = '123456';
    protected $key = '888';

    public function sign($timestamp = null)
    {
        if(!$timestamp){
            $timestamp = time() . '000';
        }

        $arr = ['vendorCode'=>$this->vendcode, 'timestamp'=>$timestamp];
        $urlstr = http_build_query($arr).$this->key;
        $sign = strtolower(md5($urlstr));
        return $sign;
    }

    public function cksign($sign, $timestamp)
    {
        return $sign == $this->sign($timestamp);
    }

    public function getTheOrder($input)
    {
        $orderNo = $input->OrderNo->__toString();
        $order = Order::find($orderNo);
        if (!$order) {
            throw new OrderNotFoundException();
        }
        return $order;
    }

    public function changeStatus(Order $order, $status)
    {
        event(new changeOrderStatus($order, $status));
        $order->status = $status;
        $orderStauts = new OrderStatus();
        $orderStauts -> order = $order->id;
        $orderStauts -> status = $status;
        $orderStauts -> save();
        return $order;
    }
}
