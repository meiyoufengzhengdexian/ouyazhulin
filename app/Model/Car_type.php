<?php

namespace App\Model;

use App\Exceptions\CarTypeNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class Car_type extends Model
{
    protected $table = 'car_type';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public static function getCarType($id)
    {
        $carType = unserialize(Redis::get('cartype::' . $id));

        if (!$carType) {
            $carType = self::find($id);
            Redis::set('cartype::' . $id, serialize($carType));
        }
        return $carType;
    }

    public static function id2Code($id)
    {
        $carType = self::getCarType($id);

        if ($carType) {
            return $carType->name;
        } else {
            throw new CarTypeNotFoundException('车组未找到' . $id);
        }
    }
}
