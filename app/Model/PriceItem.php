<?php

namespace App\Model;

use App\Lib\Rend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceItem extends Model
{
    protected $table = 'price_item';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

}
