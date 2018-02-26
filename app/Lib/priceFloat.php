<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/8
 * Time: 10:27
 */

namespace App\Lib;


use App\Model\Price;
use App\Model\Price_float;
use Carbon\Carbon;

class priceFloat extends priceService
{
    public $price;
    public $priceInfo;
    public $nowPrice;
    public $name = '价格浮动';
    public $add = 0;
    public $code = '价格浮动';
    public $show = false;
    public function __construct(Price $price, PriceInfo $pi, $nowPrice)
    {

        $this->price = $price;
        $this->priceInfo = $pi;
        $this->nowPrice = $nowPrice;
    }

    public function getPrice()
    {
        if (!$this->nowPrice) {
            return 0;
        }

        $priceFloats = Price_float::where('price', $this->price->id)
            ->get();

        $isDateRange = false;
        $isWeekRange = false;
        $isTimeRange = false;

        //节假日》 小时 》 周

        $pickupTimeStamp = strtotime(date('Y-m-d',strtotime($this->priceInfo->getPickupTime())));
        $usePriceFloat = null;
        foreach ($priceFloats->where('float_type', 'date_range') as $priceFloat) {
            if ($pickupTimeStamp <= strtotime($priceFloat->end_date)
                && $pickupTimeStamp >= strtotime($priceFloat->start_date)
            ) {
                $isDateRange = true;
                $usePriceFloat = $priceFloat;
                break;
            }
        }

        $timestamp = strtotime($this->priceInfo->getPickupTime());
        $hour = date('H', $timestamp);
        $minutes = date("i", $timestamp);
        $seconds = date('s', $timestamp);
        $DayTimestamp = $hour * 3600 + $minutes * 60 + $seconds;

        foreach ($priceFloats->where('float_type', 'time_range') as $priceFloat) {
            if($usePriceFloat){
                break;
            }

            list($hour, $minutes, $seconds) = explode('::', $priceFloat->start_time);
            $start_time = $hour * 3600 + $minutes * 60 + $seconds;
            list($hour, $minutes, $seconds) = explode('::', $priceFloat->end_time);
            $end_time = $hour * 3600 + $minutes * 60 + $seconds;
            if ($DayTimestamp >= $start_time && $DayTimestamp <= $end_time) {
                $isTimeRange = true;
                $usePriceFloat = $priceFloat;
                break;
            }
        }

        $week = date('N', strtotime($this->priceInfo->getPickupTime()));
        foreach ($priceFloats->where('float_type', 'week_range') as $priceFloat) {
            if($usePriceFloat){
                break;
            }
            if ($week == $priceFloat->week) {
                $isWeekRange = true;
                $usePriceFloat = $priceFloat;
                break;
            }
        }

        $all = $this->nowPrice;

        if ($usePriceFloat) {
            $this->add = $usePriceFloat->num_type == 1
                ? $all * (100 + $usePriceFloat->num) / 100 //1 百分比 2 固定值
                : $all + $usePriceFloat->num;
        }else{
            $this->add = 0;
        }
        return $this->add;
    }

    public function rend()
    {
        // TODO: Implement rend() method.
    }

}