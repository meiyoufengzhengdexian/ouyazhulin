<?php

namespace App\Http\Controllers\Time;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderLock extends Controller
{
    //处理锁定的订单 超过30分钟 + 200秒 未支付未下单。删除此订单。
    public function index()
    {
        $lock = fopen('orderlock.lock', 'w');
        if(flock($lock, LOCK_EX|LOCK_EX)){
            $time = date('Y-m-d H:i:s', time() - 2000);
            Order::where('created_at', '<=', $time)
                ->where('show', 0)
                ->forceDelete();
        }
    }
}
