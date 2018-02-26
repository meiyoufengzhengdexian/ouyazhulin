<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class Store extends Model
{
    protected $table = 'store';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function pay_method_name()
    {
        return $this->belongsTo('App\Model\Pay_method', 'payment_method', 'id');
    }

    public static function createStore($data)
    {
        unset($data['city_name']);
        $store = self::create($data);
        return $store;
    }

    public function getCity()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    public function getCarPoints()
    {
        return $this->hasMany(Store::class, 'store', 'id');
    }

    public function getAdmins()
    {
        return $this->belongsToMany(Admin::class, 'admin_store', 'store', 'admin');
    }

    public function getCars()
    {
        return $this->hasMany(Car::class, 'id', 'store');
    }

    public function getReturnStore()
    {
        return $this->belongsToMany($this, 'store_return', 'store', 'return_store');
    }

    public static function getStore($id)
    {
        /*$store = unserialize(Redis::get('store::'.$id));
        if(!$store){
            $store = self::find($id);
            Redis::set('store::'.$store->id, serialize($store));
        }*/

        return self::find($id);
    }

    public static function Time2Double($time)
    {
        list($h, $i, $s) = explode(':', \App\Model\Store::find(1)->the_larges_advance_scheduled_time);
        return round(($h * 3600+ $i * 60 +  $s) / 3600, 1);
    }

}
