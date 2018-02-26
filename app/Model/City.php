<?php

namespace App\Model;

use App\Exceptions\CityNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class City extends Model
{
    protected $table = 'city';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public static function getCity($id)
    {
        $city = unserialize(Redis::get('city::' . $id));

        if (!$city) {
            $city = self::find($id);
            Redis::set('city::' . $id, serialize($city));
        }
        return $city;
    }

    public static function id2Code($id)
    {
        $city = self::getCity($id);

        if ($city) {
            return $city->code;
        } else {
            throw new CityNotFoundException('城市未找到' . $id);
        }
    }

    public function getStores()
    {
        return $this->hasMany(Store::class, 'city', 'id');
    }
}
