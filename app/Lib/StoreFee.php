<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10
 * Time: 8:35
 */

namespace App\Lib;


use App\Exceptions\StoreException;
use App\Model\Store;
use Illuminate\Support\Facades\Redis;

class StoreFee extends priceService
{
    public $store = null;
    public $price;
    public $df;
    public $name='异地还车店铺加价';
    public $add;
    public $code = '异地还车店铺加价';

    public function __construct($store, $price, DetailFee $df)
    {
        $this->store = Store::getStore($store);
        $this->price = $price;
        $this->df = $df;
    }

    public function getPrice()
    {
        if(!$this->store){
            throw new StoreException('门店不存在');
        }

        if($this->store->type != 1){
            $serviceFeeInstance = $this->df->serviceFee;
            $basiceFeeInstance = $this->df->basicServiceFee;
            $num = 0;

            if($serviceFeeInstance){
                $num += $serviceFeeInstance->getPrice() * ($this->store->rent_pre + 100 ) / 100;
            }
            if($basiceFeeInstance){
                $num += $basiceFeeInstance->getPrice() * ($this->store->fee / 100);
            }
            $this->add = $num;
        }else{
            return $this->add = 0;
        }
        return $this->add;
    }

    public function rend()
    {

    }

}