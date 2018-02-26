<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Exceptions\OrderNotFoundException;
use App\Lib\Tn\Result;
use App\Model\Order;
use Illuminate\Http\Request;

class GetOrderStatus extends Tuniu
{
    public function getOrderStatus(Request $request)
    {
        try {

            $input = $this->getInput();
            $order = $this->getTheOrder($input);

            switch ($order->status) {
                case -1 :
                    $status = 'Canceled';
                    break;
                case 7:
                    $status = 'Dealed';
                    break;
                default:
                    $status = 'Confirmed';
            }
            $this->data = [
                'result' => new Result(true),
                'OrderStatus' => $status
            ];
            return $this->getResult();
        } catch (\Exception $e) {
            $this->data = [
                'result' => new Result(false, $e->getMessage()),
                'OrderStatus' => null,
            ];

            return $this->getResult();
        }
    }
}
