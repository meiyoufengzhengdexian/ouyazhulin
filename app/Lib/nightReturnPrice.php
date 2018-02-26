<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 15:53
 */

namespace App\Lib;


use App\Model\Price;

class nightReturnPrice extends priceService
{
    protected $price;
    protected $priceInfo;
    public $name='夜间还车费';
    public $add;
    public $code = '夜间还车费';

    public function __construct(Price $p, PriceInfo $pf)
    {
        $this->price = $p;
        $this->priceInfo = $pf;
    }

    public function getPrice()
    {
        $returnTime = strtotime($this->priceInfo->getReturnTime());

        $nightEndTime = strtotime(date('Y-m-d '. $this->price->night_end_time, $returnTime));
        $nightStartTime = strtotime(date('Y-m-d '. $this->price->night_start_time, $returnTime));

        if($returnTime >= $nightStartTime || $returnTime <= $nightEndTime){
            $this->add = $this->price->night_return_fee;
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