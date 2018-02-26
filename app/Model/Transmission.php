<?php

namespace App\Model;

use App\Exceptions\TransmissionNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class Transmission extends Model
{
    protected $table = 'transmission';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public static function getTransmission($id)
    {
        $Transmission = unserialize(Redis::get('Transmission::' . $id));

        if (!$Transmission) {
            $Transmission = self::find($id);
            Redis::set('Transmission::' . $id, serialize($Transmission));
        }
        return $Transmission;
    }

    public static function id2Code($id)
    {
        $Transmission = self::getTransmission($id);

        if ($Transmission) {
            return $Transmission->name;
        } else {
            throw new TransmissionNotFoundException('变速箱信息未找到' . $id);
        }
    }
}
