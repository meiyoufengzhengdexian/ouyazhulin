<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 15:34
 */

namespace App\Lib;


use App\Model\Price;

class serviceFee extends priceService
{
    protected $hour;
    protected $price;
    protected $priceInfo;
    public $name = '服务费';
    public $unitPrice = '项';
    public $code = '服务费';
    public $add;
    public $day;
    public $d;
    public $h;

    /**
     * serviceFee constructor.
     * @param Price $price
     * @param PriceInfo $pi
     */

    public function __construct(Price $price, PriceInfo $pi)
    {
//        $this->hour = $pi->getHours();
        $this->day = $pi->getDay();

        $this->d = $pi->getDiff()->day;
        $this->h = $pi->getDiff()->h;
        $this->price = $price;
        $this->priceInfo = $pi;
    }

    /**
     * 价格计算
     * (1)　不足4小时（含）的，按超时服务费计费；
     * (2)　4小时以上的，按1天计费。
     *  @return float
     */
    public function getPrice()
    {
        $this->add = $this->price->service_fee * $this->d;
        return $this->add;
    }

    public function rend()
    {

    }

}