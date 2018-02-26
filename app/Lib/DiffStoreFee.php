<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/8
 * Time: 10:12
 */

namespace App\Lib;


use App\Model\Price;

class DiffStoreFee extends priceService
{
    /**
     * @var int 公里数
     */
    public $km;
    public $price;
    public $name = '异地还车费用';
    public $add;
    public $code = '异地还车费用';

    public function __construct($km,Price $price)
    {
        $this->km = $km;
        $this->price = $price;
    }
    public function getPrice()
    {
        $this->add =$this->price->off_site_fee * $this->km;
        return $this->add;
    }

    public function rend()
    {
        // TODO: Implement rend() method.
    }

}