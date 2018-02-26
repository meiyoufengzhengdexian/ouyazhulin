<?php

namespace App\Model;

use App\Exceptions\PayMethodNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pay_method extends Model
{
    protected $table = 'pay_method';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public static function Id2Code($id)
    {
        $list = [
            1=>'P',
            2=>'C',
            3=>'N'
        ];
        if(isset($list[$id])){
            return $list[$id];
        }else{
            throw new PayMethodNotFound($id);
        }
    }
}