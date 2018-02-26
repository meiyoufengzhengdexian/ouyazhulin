<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Return_price extends Model
{
    protected $table = 'return_price';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

                                                                                                                                                                                        
}
