<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 14:07
 */

namespace App\Lib;


use App\Model\Price;
use App\Model\Setting;

class OverTimeFee extends priceService
{
    public $price;
    public $priceInfo;
    public $h;

    public $name = '超小时费';
    public $unitPrice = 'h';
    public $code = '';
    protected $add;
    public $show = true;

    public function __construct(Price $price, PriceInfo $pi)
    {
        $this->price = $price;
        $this->pi = $pi;
        $this->h = $pi->getDiff()->h;
        $this->code = '一天按照'.Setting::getOne('h').'计算,超出半天部分按照超小时费用计算';
    }
    public function rend()
    {

    }

    public function getPrice()
    {
        $this->add = $this->price->ultra_hour_fee * $this->h;
        $this->num = $this->h;
        return $this->add;
    }

}