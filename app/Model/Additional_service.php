<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional_service extends Model
{
    protected $table = 'additional_service';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public static $status = [
        '全部',
        '可选'
    ];
    use SoftDeletes;

}
