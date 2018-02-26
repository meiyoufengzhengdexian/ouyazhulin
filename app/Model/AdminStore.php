<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminStore extends Model
{
    protected $table = 'admin_store';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

}
