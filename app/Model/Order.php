<?php

namespace App\Model;

use App\Lib\AvailableStore;
use App\Lib\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Overtrue\Pinyin\Pinyin;

class Order extends Model
{
    protected $table = 'order';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    static public $status = [
        1=>'收到订单',
        2=>'已配车辆',
        3=>'已取车',
        4=>'已还车',
        666=>'已完成',
        10001=>'收到支付结果',
        -1=>'订单已取消'
    ];
    use SoftDeletes;

    public function car_patt_name()
    {
        return $this->belongsTo(Car_patt::class, 'car_patt', 'id');
    }
    public function car_license_plate()
    {
        return $this->belongsTo('App\Model\Car', 'car', 'id');
    }

    public function card_name()
    {
        return $this->belongsTo('App\Model\Card', 'card_type', 'id');
    }

    public function status_name()
    {
        return $this->belongsTo('App\Model\Status', 'pay_status', 'id');
    }

    public function getStatus()
    {
        return $this->hasMany(OrderStatus::class, 'order', 'id');
    }

    public function status_ref_created_at()
    {
        return $this->belongsTo('App\Model\Status_ref', 'status_ref', 'id');
    }

    public function getStore()
    {
        return $this->belongsTo(Store::class, 'store', 'id');
    }


    public function getTag()
    {
        return $this->belongsToMany(Tag::class, 'order_tag', 'order', 'tag');
    }

    public function getAdditionalAervice()
    {
        return $this->hasMany(OrderAdditionalService::class, 'order', 'id');
    }

    public function getPriceItem()
    {
        return $this->hasMany(PriceItem::class, 'order', 'id');
    }

    public function getPrice()
    {
        return $this->hasOne(PriceInfo::class, 'order', 'id');
    }

    public function getPlatform()
    {
        return $this->belongsTo(Platform::class, 'platform', 'id');
    }

    public function getCityByCode()
    {
        return $this->belongsTo(City::class, 'city', 'code');
    }

    public function getPickupStore()
    {
        return $this->belongsTo(Store::class, 'pickup_store', 'id');
    }

    public function getReturnStore()
    {
        return $this->belongsTo(Store::class, 'return_store', 'id');
    }

    public function getPickupPrice()
    {
        return $this->hasOne(Pickup_price::class, 'order','id');
    }

    public function getReturnPrice()
    {
        return $this->hasOne(Return_price::class, 'order', 'id');
    }

    public function getLog()
    {
        return $this->hasMany(Log::class, 'order', 'id')->where('log_group', 'order');
    }

    /**
     * @param $pickupTime string 取车时间
     * @param $carPatt int 车辆型号
     * @param $store int 门店
     */
    public static function CheckInventory($pickupTime, Car_patt $carPatt, Store $store)
    {
        if(!$carPatt || !$store){
            return false;
        }

        $allCount = Order::whereHas('getStore', function ($query) use ($store) {
            $query->where('id', $store->id)->where('status', 1);
        })
            ->whereHas('car_patt_name', function ($query) use ($carPatt) {
                $query->where('id', $carPatt->id)->where('status', 1);
            })
            ->where('pickup_time', '<=', $pickupTime)
            ->whereNull('cancel_time')
            ->groupBy('car_patt')
            ->groupBy('store')
            ->count();

        $returnCount = Order::whereHas('getStore', function ($query) use ($store) {
            $query->where('id', $store->id)->where('status', 1);
        })
            ->whereHas('car_patt_name', function ($query) use ($carPatt) {
                $query->where('id', $carPatt->id)->where('status', 1);
            })
            ->where('return_time', '<=', $pickupTime)
            ->whereNull('cancel_time')
            ->groupBy('car_patt')
            ->groupBy('store')
            ->count();

        $count = Car::getCount($store->id, $carPatt->id);
        $useCount = $allCount - $returnCount;

        return $count - $useCount > 0;
    }

    public static function getUse($carPatt, $store, $time, $ignore=[])
    {
        /*
         * !!! 过滤时间为实际的取车和还车时间 !!!
         * */
        $allCounts = DB::table('car_patt')
            ->select(
                'store.id as store',
                'car_patt.id as car_patt',
                DB::raw('count(`pickup_order`.`car_patt`) as count')
            )
            ->where(function ($query) use ($carPatt) {
                if(!$carPatt){
                    return ;
                }
                if (is_array($carPatt)) {
                    $query->whereIn('car_patt.id', $carPatt);
                } else {
                    $query->where('car_patt.id', $carPatt);
                }
            })
            ->leftJoin('order', function ($join) use ($store, $carPatt, $time, $ignore) {
                $join->on('order.car_patt', '=', 'car_patt.id')
                    ->where(function ($query) use ($store) {
                        if (is_array($store)) {
                            $query->whereIn('order.store', $store);
                        } else {
                            $query->where('order.store', $store);
                        }
                    })
                    ->where('real_pickup_time', '<=', $time)
                    ->whereNull('cancel_time')
                    ->whereNotIn('order.id', $ignore);
            })
            ->leftJoin('store', function ($join) {
                $join->on('order.store', '=', 'store.id')
                    ->where('store.status', '1');
            })
            ->groupBy('store.id')
            ->groupBy('car_patt.id')
            ->get();
        $returnCounts = DB::table('car_patt')
            ->select(
                'store.id as store',
                'car_patt.id as car_patt',
                DB::raw('count(`pickup_order`.`car_patt`) as count')
            )
            ->where(function ($query) use ($carPatt) {
                $query->where('car_patt.status', 1);
                if(!$carPatt){
                    return ;
                }
                if (is_array($carPatt)) {
                    $query->whereIn('car_patt.id', $carPatt);
                } else {
                    $query->where('car_patt.id', $carPatt);
                }
            })
            ->leftJoin('order', function ($join) use ($store, $carPatt, $time, $ignore) {
                $join->on('order.car_patt', '=', 'car_patt.id')
                    ->where(function ($query) use ($store) {
                        if (is_array($store)) {
                            $query->whereIn('order.store', $store);
                        } else {
                            $query->where('order.store', $store);
                        }
                    })
                    ->where('real_return_time', '<=', $time)
                    ->whereNull('cancel_time')
                    ->whereNotIn('order.id', $ignore);
            })
            ->leftJoin('store', function ($join) {
                $join->on('order.store', '=', 'store.id')
                    ->where('store.status', '1');
            })
            ->groupBy('store.id')
            ->groupBy('car_patt.id')
            ->get();

        return [
            'allCounts'=>$allCounts,
            'returnCounts'=>$returnCounts
        ];
    }
    /**
     * 根据车辆型号，门店列表，取车时间，筛选可用的门店列表
     * ignore 过滤时间时忽略ignore中的订单id
     */
    public static function getAvailableStore($carPatt, $stores, $pickupTime, $returnTime, $ignore=[])
    {
        $pickupCanList = [];
        $returnCanList = [];
        if (!is_array($stores)){
            $stores = [$stores];
        }
        foreach ($stores as $key=>$store){
            $storeEntry = Store::find($store);

            if($storeEntry && $storeEntry->type == 2){
                $stores[$key] = $storeEntry->store;
            }
        }
        $stores = array_unique($stores);
        $stores = Store::whereIn('id', $stores)->where('type', 1)->get();
        $storeIds = Tool::getIds($stores);
        $getUseResult = self::getUse($carPatt, $storeIds, $pickupTime, $ignore); //取车

        $allPickupCounts = $getUseResult['allCounts'];
        $returnPickupCounts = $getUseResult['returnCounts'];

        $getUseResultReturn = self::getUse($carPatt, $storeIds, $returnTime, $ignore); //还车
        $allPickupCountsReturn = $getUseResultReturn['allCounts'];
        $returnPickupCountsReturn = $getUseResultReturn['returnCounts'];

        foreach ($allPickupCounts as $key => $allCount) {
            if (!$allCount->store) {
                //没有该车型的租赁记录， 肯定就没有还车记录
                $allCount->match = true;
                foreach ($stores as $store) {
                    if (Car::getCount($store, $allCount->car_patt) > 0) {
                        $pickupCanList[] = new AvailableStore($store->id, $allCount->car_patt);
                    }
                }

            } else {
                //有租赁记录, 寻找还车记录
                foreach ($returnPickupCounts as $returnCount) {
                    if ($returnCount->store == $allCount->store) {
                        //匹配到对应的
                        $allCount->match = true;
                        if (Car::getCount($returnCount->store, $returnCount->car_patt) - $allCount->count + $returnCount->count > 0) {
                            $pickupCanList[] = new AvailableStore($returnCount->store, $returnCount->car_patt);
                        }
                    }
                }
            }
        }

        foreach ($allPickupCounts as $allCount) {
            if (!isset($allCount->match) || !$allCount->match) {
                foreach ($stores as $store) {
                    if (Car::getCount($store, $allCount->car_patt) - $allCount->count > 0) {
                        $pickupCanList[] = new AvailableStore($store->id, $allCount->car_patt);
                    }
                }
            }
        }

        ///////////////////////////////还车时间段判断

        foreach ($allPickupCountsReturn as $key => $allCount) {
            if (!$allCount->store) {
                //没有该车型的租赁记录， 肯定就没有还车记录
                $allCount->match = true;
                foreach ($stores as $store) {
                    if (Car::getCount($store, $allCount->car_patt) > 0) {
                        $returnCanList[] = new AvailableStore($store->id, $allCount->car_patt);
                    }
                }
            } else {
                //有租赁记录, 寻找还车记录
                foreach ($returnPickupCountsReturn as $returnCount) {
                    if ($returnCount->store == $allCount->store) {
                        //匹配到对应的
                        $allCount->match = true;
                        if (Car::getCount($returnCount->store, $returnCount->car_patt) - $allCount->count + $returnCount->count > 0) {
                            $returnCanList[] = new AvailableStore($returnCount->store, $returnCount->car_patt);
                        }
                    }
                }
            }
        }

        foreach ($allPickupCountsReturn as $allCount) {
            if (!isset($allCount->match) || !$allCount->match) {
                foreach ($stores as $store) {
                    $diff = Car::getCount($store, $allCount->car_patt) - $allCount->count > 0;
                    if ($diff > 0) {
                        $returnCanList[] = new AvailableStore($store->id, $allCount->car_patt);
                    }
                }
            }
        }

        $canUse = [];
        foreach($pickupCanList as $pickup){
            foreach($returnCanList as $return){
                if($pickup->store == $return->store && $pickup->carPatt == $return->carPatt){
                    $canUse[] = $pickup;
                }
            }
        }

        return $canUse;
    }

    public static function createSearKey($data)
    {
        $p = new Pinyin();
        $key = '';
        if(isset($data['card_no'])){
            $key .= $data['card_no'];
        }
        if(isset($data['car_pattern'])){
            $key .= $data['car_pattern'];
        }
        if(isset($data['use_name'])){
            $key .= $data['use_name'];
            $key .= $p->abbr($data['use_name']);
            $key .= join('', $p->convert($data['use_name']));
        }
        if(isset($data['use_phone'])){
            $key .= $data['use_phone'];
        }

        if(isset($data['id'])){
            $key .= $data['id'];
        }
        if( isset($data['oth_order_id']) ){
            $key .= $data['oth_order_id'];
        }

        if(isset($data['pickup_store'])){
            $key .= $data['pickup_store'];
            $key .= $p->abbr($data['pickup_store']);
            $key .= join('', $p->convert($data['pickup_store']));
        }
        if(isset($data['return_store'])){
            $key .= $data['return_store'];
            $key .= $p->abbr($data['return_store']);
            $key .= join('', $p->convert($data['return_store']));
        }
        if(isset($data['store'])){
            $key .= $data['store'];
            $key .= $p->abbr($data['store']);
            $key .= join('', $p->convert($data['store']));
        }
        if(isset($data['license_plate'])){
            $key .= $data['license_plate'];
            $key .= $p->abbr($data['license_plate']);
            $key .= join('', $p->convert($data['license_plate']));
        }
        if(isset($data['city'])){
            $key .= $data['city'];
            $key .= $p->abbr($data['city']);
            $key .= join('', $p->convert($data['city']));
        }

        return $key;
    }
}
