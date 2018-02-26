<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order', 'id');
    }

    public function getStatus()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }
}
