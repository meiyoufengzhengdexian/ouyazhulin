<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;
use Overtrue\Pinyin\Pinyin;

class Car extends Model
{
    protected $table = 'car';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public static $status = [
        [
            'id'=> -1,
            'name'=>'不可用',
            'default'=>false
        ],
        [
            'id'=> 1,
            'name'=>'正常',
            'default'=>true
        ],
    ];

    use SoftDeletes;

    public function car_patt_name()
    {
        return $this->belongsTo('App\Model\Car_patt', 'car_patt', 'id');
    }

    public function getStore()
    {
        return $this->belongsTo(Store::class, 'store', 'id');
    }

    public static function getCount($store, $carPatt)
    {
        if(!is_object($store)){
            $store = Store::find($store);
        }

//        if(!$count = (int)Redis::get('Store::'.$store->id."::".$carPatt."count") or true){
//            $count = self::where('store', $store->id)->where('car_patt', $carPatt)->where('status', 1)->count();
//            Redis::set('Store::'.$store->id."::".$carPatt."count", $count);
//        }

        $count = self::where('store', $store->id)->where('car_patt', $carPatt)->where('status', 1)->count();
        return $count;
    }

    public static function createSearKey($data)
    {
        $p = new Pinyin();
        $key = '';
        isset($data['name']) && $key .= $data['name'];
        isset($data['phone']) && $key .= $data['phone'];
        isset($data['license_plate']) && $key .= $data['license_plate'];
        isset($data['car_pattern']) && $key .= $data['car_pattern'];
        isset($data['car_com']) && $key .= $data['car_com'];
        isset($data['car_id']) && $key .= $data['car_id'];
        isset($data['store']) && $key .= $data['store'];
        isset($data['color']) && $key .= $data['color'];
        return $key . join('', $p->convert($key)) . $p->abbr($key);
    }
}
