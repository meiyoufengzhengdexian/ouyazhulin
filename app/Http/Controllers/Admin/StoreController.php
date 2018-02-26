<?php

namespace App\Http\Controllers\Admin;

use App\Lib\MyFormatter;
use App\Lib\Result;
use App\Lib\Test;
use App\Model\City;
use App\Model\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SoapBox\Formatter\Formatter;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
        'name' => 'required|max:100',
        'person' => 'required|max:100',
        'phone' => 'required|max:100',
        'location_poi' => 'required|max:100',
        'location_name' => 'required|max:100',
        'city' => 'required|max:100',
        'type' => 'required|max:100',
        'payment_method' => 'required|exists:pay_method,id',
        'diff_store_rank' => 'required|max:100',
        'status' => 'required|max:100',
    ];

    public function index(Request $request)
    {
        $admin = AdminLogin::getAdmin($request);

        $store = Store::orderBy('created_at', 'desc');
        $store = $store->where('type', 1);

        if($admin->is_supper_admin){
            //超级管理员， 能够查看所有门店
            $list = $store->paginate(100);
        }else{
            $list = $admin->getStores;
        }
        return view('admin.store.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $pay_method_names = \App\Model\Pay_method::all();

        $stores = Store::where('type', 1)->get();

        return view('admin.store.create', compact('pay_method_names', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $data['status'] = isset($data['status']) ? 1 : 0;

        $this->validate($request, $this->validateRoule);
        $returnStore = $request->input('return_store');

        if(!is_array($returnStore) && $returnStore){
            return back()->withErrors('还车门店必须是数组');
        }
        unset($data['return_store']);

        $minimal_advance_booking_time = '00:00:00';
        $d = $request->input('m_d', '00');
        $h = $request->input('m_i', '00');
        $m = $request->input('m_m', '00');
        $hour = $d * 24 + $h;

        $minimal_advance_booking_time = $hour. ':'.$m. ':00';

        $the_larges_advance_scheduled_time = '00:00:00';
        $d = $request->input('t_d');
        $h = $request->input('t_i');
        $m = $request->input('t_m');
        $hour = $d * 24 + $h;
        $the_larges_advance_scheduled_time = $hour. ':'.$m. ':00';

        unset($data['m_d']);
        unset($data['m_i']);
        unset($data['m_m']);
        unset($data['t_d']);
        unset($data['t_i']);
        unset($data['t_m']);

        $data['minimal_advance_booking_time'] = $minimal_advance_booking_time;
        $data['the_larges_advance_scheduled_time'] = $the_larges_advance_scheduled_time;


        //城市code -> id

        $city = City::where('code', $data['city'])->first();


        if(!$city){
            $city = new City();
            $city->name = $data['city_name'];
            $city->code = $data['city'];
            $city->save();
        }

        $data['city'] = $city->id;
        $store = Store::createStore($data);
        if($store->type == 1){
            $return_store =[$store->id];
            if($returnStore){
                $return_store = array_merge($return_store, $returnStore);
            }
            $store->getReturnStore()->attach($return_store);
        }else{
            $store->getReturnStore()->attach([$store->store]);
        }

        return redirect('admin/store');
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = \App\Model\Store::findOrFail($id);
        $pay_method_names = \App\Model\Pay_method::all();
        $admin = session('admin');

        if($admin->is_supper_admin){
            $stores = Store::where('type', 1)->get();
        }else{
            $stores = $admin->getStores()->where('type', 1)->get();
        }

        return view('admin.store.edit', compact('data', 'pay_method_names', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request $request
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        unset($this->validateRoule['type']);
        unset($this->validateRoule['diff_store_rank']);
        unset($this->validateRoule['status']);
        $this->validate($request, $this->validateRoule);
        $data = $request->all();
        if($request->input('minimal_advance_booking_time_change') == 1){
            $minimal_advance_booking_time = '00:00:00';
            $d = $request->input('m_d', '0');
            $h = $request->input('m_i', '0');
            $m = $request->input('m_m', '0');
            $hour = $d * 24 + $h;

            $minimal_advance_booking_time = $hour. ':'.$m. ':00';
            $data['minimal_advance_booking_time'] = $minimal_advance_booking_time;


        }
        if($request->input('the_larges_advance_scheduled_time_change') == 1){
            $the_larges_advance_scheduled_time = '00:00:00';
            $d = $request->input('t_d');
            $h = $request->input('t_i');
            $m = $request->input('t_m');
            $hour = $d * 24 + $h;
            $the_larges_advance_scheduled_time = $hour. ':'.$m. ':00';
            $data['the_larges_advance_scheduled_time'] = $the_larges_advance_scheduled_time;
        }

        unset($data['m_d']);
        unset($data['m_i']);
        unset($data['m_m']);
        unset($data['t_d']);
        unset($data['t_i']);
        unset($data['t_m']);
        unset($data['minimal_advance_booking_time_change']);
        unset($data['the_larges_advance_scheduled_time_change']);
        //城市code -> id
        $city = City::firstOrCreate([
            'code'=>$data['city']
        ], [
            'name'=>$data['city_name'],
            'code'=>$data['city']
        ]);
        $data['city'] = $city->id;
        unset($data['city_name']);

        \App\Model\Store::findOrFail($id)->update($data);
        return redirect('admin/store');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Store::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function status(Request $request)
    {
        if(!$request->ajax()){
            return back()->withErrors('操作失败');
        }
        $Store = Store::find($request->input('id'));
        if(!$Store){
            return back()->withErrors('操作失败');
        }

        $Store->status = 0;
        $Store->save();
        return [
            'result'=>new Result(true)
        ];
    }

    public function storeByCityCode(Request $request)
    {
        $code = $request->input('code');
        $city = City::whereCode($code)->first();

        if(!$city){
            return [
                'result'=>new Result(false)
            ];
        }

        $stores = Store::whereCity($city->id)->where('type', 1)->get();

        return [
            'result'=>new Result(true),
            'stores'=>$stores
        ];
    }

    public function byCity(Request $request)
    {
        $r = [
            'city'=>'required'
        ];
        $m = [
            'city'=>'请输入正确的城市'
        ];
        $v = Validator::make($request->all(), $r, $m);
        $v->validate();
        $city = City::where('id', $request->city)->get();
        return [
            'result'=>new Result(true),
            'citys'=>$city->getStores
        ];
    }

    public function searchReturnStore(Request $request)
    {
        $r = [
            'pickup_store'=>'required|exists:store,id'
        ];
        $m = [
            'pickup_store'=>'请输入正确的取车门店'
        ];
        $v = Validator::make($request->all(), $r, $m);
        $v->validate();

        $store = Store::find($request->pickup_store);
        return [
            'result'=>new Result(true),
            'list'=>$store->getReturnStore
        ];
    }
}
