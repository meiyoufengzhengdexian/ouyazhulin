<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car_patt extends Model
{
    protected $table = 'car_patt';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function car_model_name()
    {
        return $this->belongsTo('App\Model\Car_model', 'model', 'id');
    }

    public function car_type_name()
    {
        return $this->belongsTo('App\Model\Car_type', 'car_type', 'id');
    }

    public function transmission_name()
    {
        return $this->belongsTo(Transmission::class, 'transmission', 'id');
    }

    public function getComName()
    {
        return $this->belongsTo(Car_com::class, 'com', 'id');
    }
}
