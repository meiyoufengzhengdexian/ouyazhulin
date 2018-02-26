<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAdditionalService extends Model
{
    protected $table = 'order_additional_service';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;
}
