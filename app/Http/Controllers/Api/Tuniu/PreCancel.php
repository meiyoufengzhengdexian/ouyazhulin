<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Exceptions\OrderNotFoundException;
use App\Lib\Tn\Result;
use App\Model\Order;
use App\Model\PriceItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreCancel extends Tuniu
{
    /**
     *
     */
    public function preCancel(Request $request)
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

            if ($use_time - $cancel_time < 3600) {
                $fee = 0;
            } else {
//                $orderItem = PriceItem::where('order', $order->id)->where('name', '服务费')->first();
//                $fee = $orderItem ? $orderItem->price :$use_time->price;
                $fee = $order->price;
            }

            $this->data = [
                'Result' => new Result(true),
                'DeductAmount' => $fee
            ];

            return $this->getResult('ValidateCancelResponse');

        } catch (\Exception $e) {
            $this->data = [
                'Result' => new Result(false),
                'DeductAmount' => 99999
            ];
            return $this->getResult('ValidateCancelResponse');
        }
    }
}
