<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional_service_price extends Model
{
    protected $table = 'additional_service_price';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

}
