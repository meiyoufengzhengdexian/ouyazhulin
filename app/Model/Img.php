<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Img extends Model
{
    protected $table = 'img';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

}
