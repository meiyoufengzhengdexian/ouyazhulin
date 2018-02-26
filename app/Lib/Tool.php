<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/3
 * Time: 11:33
 */

namespace App\Lib;


use App\Model\Log;
use Illuminate\Support\Collection;

class Tool
{
    public static function getIds( Collection $list ,$field='id')
    {
        $ids = [];
        foreach($list as $item){
            $ids[] = $item->$field;
        }
        return new Collection($ids);
    }

    public static function log($msg, $group, $order_id = "", $city = 0)
    {
        $log = new Log();
        $log->order_id = $order_id;
        $log->operate = date('Y-m-d H:i:s :') . $msg;
        $log->log_group = $group;
        $log->city = $city;
        $log->save();
    }

}