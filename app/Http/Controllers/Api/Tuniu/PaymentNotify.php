<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 8:49
 */

namespace App\Http\Controllers\Api\Tuniu;


use App\Exceptions\OrderNotFoundException;
use App\Lib\Tn\Result;
use App\Model\Order;
use App\Model\OrderStatus;
use Symfony\Component\HttpFoundation\Request;

class PaymentNotify extends Tuniu
{
    public function paymentNotify(Request $request)
    {
        $input = $this->getInput();
        $PaymentType = $input->PaymentType->toString();
        $Amount = doubleval($input->Amount->toString());
        $order = $this->getTheOrder($input);


        $order->pay_method = $PaymentType;
        $order->paid =$Amount;
        $order->save();

        $orderStatus = new OrderStatus();
        $orderStatus->order = $order->id;
        $orderStatus->status = 2;
        $orderStatus->save();

        $this->data = [
            'Result' => new Result(true),
            'orderNo' => $order->id
        ];
        return $this->getResult();
    }
}