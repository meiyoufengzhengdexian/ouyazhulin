<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    protected $table = 'status';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

                                                                            
}
