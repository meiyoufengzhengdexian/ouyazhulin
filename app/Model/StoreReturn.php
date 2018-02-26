<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreReturn extends Model
{
    protected $table = 'store_return';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function getStore()
    {
        return $this->belongsTo(Store::class, 'store', 'id');
    }

    public function getReturnStore()
    {
        return $this->belongsTo(Store::class, 'return_store', 'id');
    }
}
