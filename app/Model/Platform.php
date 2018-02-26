<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    protected $table = 'platform';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

                                                                
}
