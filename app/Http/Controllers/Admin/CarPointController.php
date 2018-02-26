<?php

namespace App\Http\Controllers\Admin;

use App\Model\Car;
use App\Model\Car_com;
use App\Model\Car_patt;
use App\Model\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CarPointController extends Controller
{
    public function index(Request $request)
    {
        $rules = [
            'store'=>'required'
        ];
        $message = [
            'store.required'=>'门店错误'
        ];

        $v = Validator::make($request->all(), $rules, $message);

        $store = null;
        $admin = session('admin');

        $v->after(function($validate) use($request, &$store, $admin) {
            $store = Store::find($request->input('store'));
            if(!$store){
                $validate->errors()->add('store', '门店不存在');
            }

            if($admin->is_supper_admin == 1){
                return;
            }
            $allStore = $admin->getStores;

            if(!$allStore->contains($store)){
                $validate->errors()->add('store', '此门店不属于此管理员!');
            }

        });

        $v->validate();

        $carPoints = $store->getCarPoints;

        $carPatts = Car_patt::all();
        $carComs = Car_com::all();
        $carStatus = Car::$status;

        return view('admin.carPoint.index', compact('carPoints', 'request', 'carPatts', 'carComs', 'carStatus', 'store'));

    }
}
