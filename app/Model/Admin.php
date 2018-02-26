<?php

namespace App\Model;

use App\Http\Controllers\Admin\AdminLogin;
use App\Lib\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    protected $table = 'admin';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function getStores()
    {
        return $this->belongsToMany(Store::class, 'admin_store', 'admin', 'store');
    }

    public static function getAdmin()
    {
        return AdminLogin::getAdmin();
    }

    public function getCars()
    {
        $stores = $this->getStores;
        $storeIds = Tool::getIds($stores);
        return Car::whereIn('store', $storeIds)->get();
    }
}
