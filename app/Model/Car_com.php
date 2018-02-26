<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\Pinyin\Pinyin;

class Car_com extends Model
{
    protected $table = 'car_com';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public static function createCarCom($data)
    {
        $pinyin = new Pinyin();
        $firstPinyin = $pinyin->abbr($data['name']);
        $data['sort'] = $firstPinyin;

        $com = self::firstOrCreate($data, $data);

        return $com;
    }

    public function getSortAttribute($value)
    {
        return str_pad(strtoupper($value), 10, '_');
    }
}
