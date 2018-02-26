<?php

namespace App\Model;

use App\Lib\basicServiceFee;
use App\Lib\DetailFee;
use App\Lib\DiffStoreFee;
use App\Lib\Gaode;
use App\Lib\nightPickupPrice;
use App\Lib\nightReturnPrice;
use App\Lib\OverTimeFee;
use App\Lib\priceFloat;
use App\Lib\PriceInfo;
use App\Lib\PriceResult;
use App\Lib\priceService;
use App\Lib\ProductSummary;
use App\Lib\serviceFee;
use App\Lib\StoreFee;
use App\Lib\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Price extends Model
{
    protected $table = 'price';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static $status = [
        '可用',
        '不可用',
    ];
    use SoftDeletes;

    public function car_patt_name()
    {
        return $this->belongsTo('App\Model\Car_patt', 'car_patt', 'id');
    }

    public function platform_name()
    {
        return $this->belongsTo('App\Model\Platform', 'platform', 'id');
    }


    public function getStore()
    {
        return $this->belongsTo(Store::class, 'store', 'id');
    }

    //增值服务
    public function getAdditional()
    {
        return $this->belongsToMany(Additional_service::class, 'additional_service_price', 'price', 'additional_service');
    }

    /**
     * @param PriceInfo $priceinfo
     * @return array
     *
     * $priceinfo -> pickup_store // 传入门店
     * $priceinfo -> return_store // 传入门店 + 换车点
     * ignore 过滤时间时忽略ignore中的订单id
     *  计算价格， 并缓存价格 缓存1小时
     */
    public static function calculate(PriceInfo $priceinfo, $ignore=[])
    {
        $canPickup = Order::getAvailableStore($priceinfo->getCarPatt(), $priceinfo->getPickupStore(), $priceinfo->getPickupTime(), $priceinfo->getReturnTime(), $ignore); //筛选出这个时间段可以定的门店和车型

        $store = Tool::getIds(collect($canPickup), 'store')->unique();
        $car_patt = Tool::getIds(collect($canPickup), 'carPatt')->unique();

        $p1 = Price::where('status', 1)
            ->whereIn('car_patt', $car_patt)
            ->whereIn('store', $store)
            ->whereHas('getStore', function ($query) use ($priceinfo) {
                $query->whereRaw("timediff(?, now()) >= `minimal_advance_booking_time`", $priceinfo->getPickupTime())
                    ->whereRaw("timediff(?, now()) <= `the_larges_advance_scheduled_time`", $priceinfo->getPickupTime());
            })
            ->get();//所有可以取车的门店

        $can_store_returns = StoreReturn::whereIn('store', $store)
            ->whereHas('getStore', function($query){
                $query->where('status', 1);
            })
            ->whereHas('getReturnStore', function($query){
                $query->where('status', 1);
            })
            ->get();

        $priceArr = [];

        foreach($store as $storeId){
            foreach($can_store_returns as $store_return){
                foreach($p1 as $price){
                    if($store_return->store == $storeId && $storeId == $price->store){
                        $temp = [];
                        $temp[] = $price;
                        $temp[] = $price->store;
                        $temp[] = $store_return->return_store;
                        $priceArr[] = $temp;

                        if($store_return->store != $store_return->return_store){
                            $temp = [];
                            $temp[] = $price;
                            $temp[] = $store_return->return_store;
                            $temp[] = $price->store;
                            $priceArr[] = $temp;
                        }
                    }
                }
            }
        }

        $list = [];

        foreach ($priceArr as $priceList) {
            $price = $priceList[0];

            $priceinfo->setCarPatt([$price->car_patt]);
            $df = new DetailFee($price);
            $df->addOne(new serviceFee($price, $priceinfo));

            $df->addOne(new OverTimeFee($price, $priceinfo));
            $df->addOne(new basicServiceFee($price));
            $df->addOne(new nightPickupPrice($price, $priceinfo));
            $df->addOne(new nightReturnPrice($price, $priceinfo));
            $df->addOne(new priceFloat($price, $priceinfo, $df->getPrice()));

            if ($priceList[1] != $priceList[2]) {
                //不是同一个门店
                //计算距离 -> 跨店价格
                $km = Gaode::getStoreKm($priceList[1], $priceList[2]); //公里数 有1小时缓存

                $df->addOne(new DiffStoreFee($km, $price));
                $df->addOne(new StoreFee($priceList[2], $df->getPrice(), $df));
            }

            $product = new ProductSummary(
                $price->car_patt,
                $df->getPrice(),
                $df->getPrice(),
                $priceinfo->getDay(),
                $priceList[1],
                $priceList[2],
                $priceinfo->createMark($priceList[1], $priceList[2]),
                $df,
                $priceinfo
            );


            Redis::SETEX($product->getExtra(), 3600, serialize($product)); //redis 保存4小时
            $list[] = $product;
        }

        return $list;
    }

}
