<?php

namespace App\Model;

use App\Exceptions\CarModelNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class Car_model extends Model
{
    protected $table = 'car_model';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public static function getCarModel($id)
    {
        $CarModel = unserialize(Redis::get('CarModel::' . $id));

        if (!$CarModel) {
            $CarModel = self::find($id);
            Redis::set('CarModel::' . $id, serialize($CarModel));
        }
        return $CarModel;
    }

    public static function id2Code($id)
    {
        $CarModel = self::getCarModel($id);

        if ($CarModel) {
            return $CarModel->name;
        } else {
            throw new CarModelNotFoundException('车型信息未找到' . $id);
        }
    }
}
