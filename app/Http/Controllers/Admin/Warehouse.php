<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Lib\Tool;
use App\Model\Car;
use App\Model\Car_com;
use App\Model\Car_patt;
use App\Model\City;
use App\Model\Order;
use App\Model\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Warehouse extends Controller
{
    public function index(Request $request)
    {
        $admin = session('admin');
        $sstore = $request->input('store', false);
        $scity = $request->input('city', false);

        $carComments = Car_com::all();
        $carPatts = Car_patt::all();
        if ($admin->is_supper_admin) {
            $citys = City::all();
            $stores = Store::all();
        } else {
            $store = $admin->getStores;
            $ids = Tool::getIds($store);
            $cids = Tool::getIds($store, 'city');
            $citys = City::whereIn('id', $cids)->get();
            $stores = $store;
        }

        return view('admin.warehouse.index', compact('citys', 'stores', 'request', 'carComments', 'carPatts'));
    }

    public function search(Request $request)
    {
        $rule = [
            'store'=>'required|exists:store,id',
            'car_patt'=>'required|exists:car_patt,id',
            'start_time'=>'required|Date',
            'end_time'=>'required|Date'
        ];
        $message = [
            'store'=>'请输入正确的门店',
            'car_patt'=>'请输入正确的车辆类型',
            'end_time'=>'请输入正确结束时间',
            'start_time'=>'请输入正确开始时间',
        ];

        $v = Validator::make($request->all(), $rule, $message);

        $v->validate();

        $start_time = strtotime($request->start_time);
        $end_time = strtotime($request->end_time);

        $lastTime = $start_time;

        $list = [];
        while ($lastTime <= $end_time + 3600 * 23){
            $list[date('Y-m-d', $lastTime)][] = Order::getUse($request->car_patt, $request->store, date('Y-m-d H:i:s', $lastTime));
            $lastTime += 3600;
        }

        $returnList = [];
        foreach($list as $key=>$day){
            $sub=[];
            $sub['date'] = $key;
            $sub['count'] = Car::getCount($request->store, $request->car_patt);
            foreach ($day as $hour) {
                $sub['sub'][] = $hour['allCounts'][0]->count - $hour['returnCounts'][0]->count;
            }
            $returnList[] = $sub;
        }

        return [
            'result'=>new Result(true),
            'list'=>$returnList
        ];
    }
}
