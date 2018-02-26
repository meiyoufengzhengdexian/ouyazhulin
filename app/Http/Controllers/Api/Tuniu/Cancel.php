<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Exceptions\OrderNotFoundException;
use App\Lib\Tn\Result;
use App\Model\Order;
use App\Model\OrderStatus;
use App\Model\PriceItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Cancel extends Tuniu
{
    public function cancel(Request $request)
    {
        try {

            $input = $this->getInput();
            $order = $this->getTheOrder($input);

            $cancel_time = $request->input('timestamp');
            if (!$cancel_time) {
                $cancel_time = time();
            } else {
                $cancel_time /= 1000;
            }

            $use_time = strtotime($order->pickup_time);

            if ($use_time - $cancel_time > 3600) {
                $fee = 0;
            } else {
//                $orderItem = PriceItem::where('order', $order->id)->where('name', '服务费')->first();
//                $fee = $orderItem ? $orderItem->price : $use_time->price;
                $fee = $order->price;
            }

            $order = $this->changeStatus($order, -1);
            $order->cancel_time = date('Y-m-d H:i:s', $cancel_time);
            $order->cancel_price = $fee;
            $order->save();

            $this->data = [
                'Result' => new Result(true),
                'DeductAmount' => $fee
            ];

            return $this->getResult('CancelResponse');
        } catch (\Exception $e) {
            $this->data = [
                'Result' => new Result(false),
                'DeductAmount' => 99999
            ];
            return $this->getResult('CancelResponse');
        }
    }
}
