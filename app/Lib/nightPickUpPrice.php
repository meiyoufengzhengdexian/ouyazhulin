<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 15:51
 */

namespace App\Lib;


use App\Model\Price;

class nightPickupPrice extends priceService
{
    protected $price;
    protected $priceInfo;
    public $name='夜间取车费';
    public $add;
    public $code = '夜间取车费';

    public function __construct(Price $p, PriceInfo $pr)
    {
        $this->priceInfo = $pr;
        $this->price = $p;
    }
    public function getPrice()
    {
        $nightStartTime = strtotime(date('Y-m-d '. $this->price->night_start_time, strtotime($this->priceInfo->getPickupTime())));
        $nightEndTime = strtotime(date('Y-m-d '. $this->price->night_end_time, strtotime($this->priceInfo->getPickupTime())));

        if(strtotime($this->priceInfo->getPickupTime()) >= $nightStartTime || strtotime($this->priceInfo->getPickupTime()) <= $nightEndTime ){
            $this->add = $this->price->night_give_fee;
        } else {
            $this->add = 0;
        }
        return $this->add;
    }

    public function rend()
    {
        // TODO: Implement rend() method.
    }

}