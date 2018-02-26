<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price_info extends Model
{
    protected $table = 'price_info';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

                                                                                                                                                                                                                
}
