<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 15:39
 */

namespace App\Lib;


use App\Model\Price;

class basicServiceFee extends priceService
{
    public $price;
    public $name = '基础服务费';
    protected $now_price = 0;
    public $add;
    public $code = '基础服务费';
    public $show = false;

    public function __construct(Price $price)
    {
        $this->price = $price;
    }
    public function getPrice()
    {
        $this->add = $this->price->basic_service_fee;
        return $this->add;
    }

    public function rend()
    {
        // TODO: Implement rend() method.
    }

}