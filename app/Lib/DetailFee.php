<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 15:33
 */

namespace App\Lib;


use App\Model\Price;

class DetailFee extends priceService
{
    public $priceEntry = null;
    protected $list = [];


    public function __construct(Price $priceEntry)
    {
        $this->priceEntry = $priceEntry;
    }

    public function getPriceEntry()
    {
        return $this->priceEntry;
    }
    public function getPrice()
    {
        $sum = 0;
        foreach($this->list as $item){
            $sum+= $item->getPrice();
        }
        return $sum;
    }

    public function addOne(priceService $ps)
    {
        $this->list[] = $ps;
    }

    public function getList()
    {
        return $this->list;
    }

    public function __get($name)
    {
        foreach($this->list as $instance){
            $r = new \ReflectionClass($instance);
            if(basename($r->getName()) == $name){
                return $instance;
            }
        }
        return null;
    }

    public function rend()
    {
        // TODO: Implement rend() method.
    }

}