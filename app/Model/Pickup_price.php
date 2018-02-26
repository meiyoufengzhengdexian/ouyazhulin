<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pickup_price extends Model
{
    protected $table = 'pickup_price';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

                                        public function order_id()
    {
        return $this->belongsTo('App\Model\Order', 'order', 'id');
    }
                                                                                                                
}
