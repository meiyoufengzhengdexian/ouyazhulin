<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    protected $table = 'card_type';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

                                                                
}
