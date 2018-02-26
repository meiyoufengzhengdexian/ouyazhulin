<?php

namespace App\Http\Controllers\Admin;

use App\Events\changeOrderStatus;
use App\Events\despatch;
use App\Events\editOrder;
use App\Events\pickupCar;
use App\Events\returnCar;
use App\Lib\PriceInfo;
use App\Lib\Result;
use App\Lib\Tool;
use App\Model\Admin;
use App\Model\Car;
use App\Model\Car_com;
use App\Model\Car_patt;
use App\Model\City;
use App\Model\Log;
use App\Model\Order;
use App\Model\OrderStatus;
use App\Model\Pickup_price;
use App\Model\Platform;
use App\Model\Price;
use App\Model\PriceItem;
use App\Model\Return_price;
use App\Model\Store;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Overtrue\Pinyin\Pinyin;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
        'oth_order_id' => 'required|max:100',
        'platform' => 'required|max:100',
        'car' => 'required|exists:car,id',
        'license_plate' => 'required|max:100',
        'store' => 'required|max:100',
        'city' => 'required|max:100',
        'pickup_store' => 'required|max:100',
        'return_store' => 'required|max:100',
        'coupon_code' => 'required|max:100',
        'use_name' => 'required|max:100',
        'use_phone' => 'required|max:100',
        'card_type' => 'required|exists:card,id',
        'card_no' => 'required|max:100',
        'price_mark' => 'required|max:100',
        'cancel_time' => 'required|max:100',
        'cancel_price' => 'required|max:100',
        'pay_status' => 'required|exists:status,id',
        'status' => 'required|max:100',
        'status_ref' => 'required|exists:status_ref,id'];

    public function index(Request $request)
    {
        $order = Order::with('getPlatform')
            ->with('car_patt_name.getComName')
            ->with('getStore')
            ->with('getCityByCode')
            ->with('getPickupStore')
            ->with('getReturnStore')
            ->with('card_name')
            ->with('getTag')
            ->where('show', 1);

        $key = $request->get('key', false);
        $status = $request->get('status', false);
        $start_time = $request->get('start_time', false);
        $end_time = $request->get('end_time', false);
        $use_start_time = $request->get('use_start_time', false);
        $use_end_time = $request->get('use_end_time', false);
        $city = $request->get('city', false);
        $store = $request->get('store', false);
        $platform = $request->get('platform', false);

        $platform && $order = $order->where('platform', $platform);
        $city && $order = $order->where('city', $city);
        $start_time && $order = $order->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$start_time]);
        $end_time && $order = $order->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') <= ?", [$end_time]);
        $use_start_time && $order = $order->whereRaw("DATE_FORMAT(`pickup_time`, '%Y-%m-%d') >= ?", [$use_start_time]);
        $use_end_time && $order = $order->whereRaw("DATE_FORMAT(`pickup_time`, '%Y-%m-%d') <= ?", [$use_end_time]);
        $store && $order = $order->where('store', $store);
        $status && $order = $order->where('status', $status);
        $key && $order = $order->where('search_key', 'like', "%$key%");

        if ($request->ajax()) {
            $list = $order->get();
            return ['result' => new Result(true), 'list' => $list];
        } else {
            $citys = City::all();
            $admin = Admin::getAdmin();
            if ($admin->is_supper_admin) {
                $stores = Store::all();
            } else {
                $stores = $admin->getStores;
                $ids = Tool::getIds($stores);
                $order = $order->whereIn('store', $ids);
            }
            $list = $order->paginate(100);
            $card_names = \App\Model\Card::all();
            $carComments = Car_com::all();
            $carPatts = Car_patt::all();
            $platforms = Platform::all();

            return view('admin.order.index', compact('list', 'request', 'stores', 'citys', 'card_names', 'carComments', 'carPatts', 'platforms'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $car_license_plates = \App\Model\Car::all();
        $card_names = \App\Model\Card::all();
        $status_names = \App\Model\Status::all();
        $status_ref_created_ats = \App\Model\Status_ref::all();
        return view('admin.order.create', compact('car_license_plates', 'card_names', 'status_names', 'status_ref_created_ats'));
    }

    /**
     *  1.查询价格 price
     *  2.插入订单表 order
     *  3.插入价格子项priceItem
     *  4.插入价格详情priceInfo
     */
    public function store(Request $request)
    {
        $r = [
            'use_name' => 'required',
            'use_phone' => 'required',
            'car_patt' => 'required|exists:car_patt,id',
            'card_type' => 'required|exists:card_type,id',
            'card_id' => 'required',
            'pickup_time' => 'required|Date',
            'return_time' => 'required|Date',
            'pickup_store' => 'required|exists:store,id',
            'return_store' => 'required|exists:store,id',
        ];
        $m = [
            'use_name' => '请填写正确的姓名',
            'use_phone' => '请填写正确的电话号码',
            'car_patt' => '请填写正确的车辆型号',
            'card_type' => '请填写正确证件类型',
            'card_id' => '请填写正确的证件号',
            'pickup_time' => '请填写正确的取车时间',
            'return_time' => '请填写正确的还车时间',
            'pickup_store' => '请填写正确的取车门店',
            'return_store' => '请填写正确的还车门店',
        ];
        $v = Validator::make($request->all(), $r, $m);

        $v->validate();
        try {

            $priceInfo = new PriceInfo($request->pickup_store, $request->return_store, $request->pickup_time, $request->return_time, $request->car_patt);

            $priceRes = Price::calculate($priceInfo);


            if (empty($priceRes[0])) {
                throw new \Exception('价格未设置或时间错误，或无库存 Price not set or time error, or no inventory.');
            }


            $priceRes = $priceRes[0];
            $order = new Order();
            $order->platform = 666;

            $order->price = $priceRes->getPrice();
            $order->paid = 0;

            $pickupStore = Store::find($request->pickup_store);
            if ($pickupStore->type == 2) {
                $realPickupStore = Store::find($pickupStore->store);
            } else {
                $realPickupStore = $pickupStore;
            }

            $city = $pickupStore->getCity;
            $order->city = $city->code;
            $order->store = $realPickupStore->id;
            $order->pickup_store = $request->pickup_store;
            $order->return_store = $request->return_store;
            $order->pickup_time = $request->pickup_time;
            $order->real_pickup_time = $order->pickup_time;
            $order->return_time = $request->return_time;
            $order->real_return_time = $order->return_time;
            $order->use_name = $request->use_name;
            $order->use_phone = $request->use_phone;
            $order->card_type = $request->card_type;
            $order->card_no = $request->card_id;
            $order->car_patt = $request->car_patt;
//        $order->price_mark = $priceRes->getExtra();
            $order->pay_method = '现付';//支付方式
            $order->status = 1;//订单状态
            $order->show = 1;
            $order->extra = $priceRes->getExtra();
            $order->search_key = Order::createSearKey($request->all());
            $order->save();

            $feeInfo = $priceRes->getDetailFee();
            $feeList = $feeInfo->getList();

            //价格项
            foreach ($feeList as $item) {
                if ($item->getPrice() == 0) {
                    continue;
                }
                $priceItem = new PriceItem();
                $priceItem->price = $item->getPrice();
                $priceItem->name = $item->name;
                $priceItem->order = $order->id;
                $priceItem->phpobj = serialize($item);
                $priceItem->save();
            }

            $price = $feeInfo->getPriceEntry();
            $priceInfo = new \App\Model\PriceInfo();
            $priceInfo->order = $order->id;
            $priceInfo->price = $order->price;
            $priceInfo->basic_service_fee = $price->basic_service_fee;
            $priceInfo->service_fee = $price->service_fee;
            $priceInfo->ultra_hour_fee = $price->ultra_hour_fee;
            $priceInfo->ultra_km_fee = $price->ultra_km_fee;
            $priceInfo->pre_authorization_fee = $price->pre_authorization_fee;
            $priceInfo->Illegal_deposit = $price->Illegal_deposit;
            $priceInfo->off_site_fee = $price->off_site_fee;
            $priceInfo->night_give_fee = $price->night_give_fee;
            $priceInfo->night_return_fee = $price->night_return_fee;
            $priceInfo->night_start_time = $price->night_start_time;
            $priceInfo->night_end_time = $price->night_end_time;
            $priceInfo->platform = 666;
            $priceInfo->save();

            $order->load('getPlatform');
            $order->load('car_patt_name.getComName');
            $order->load('getStore');
            $order->load('getCityByCode');
            $order->load('getPickupStore');
            $order->load('getReturnStore');
            $order->load('card_name');
            $order->load('getTag');

            return [
                'result' => new Result(true),
                'order' => $order
            ];
        } catch (\Exception $e) {
            return [
                'result' => new Result(false, $e->getMessage()),
            ];
        }
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
        $data = \App\Model\Order::findOrFail($id);
        $car_license_plates = \App\Model\Car::all();
        $card_names = \App\Model\Card::all();
        $status_names = \App\Model\Status::all();
        $status_ref_created_ats = \App\Model\Status_ref::all();
        return view('admin.order.edit', compact('data', 'car_license_plates', 'card_names', 'status_names', 'status_ref_created_ats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $r = [
            'order' => 'required|exists:order,id',
            'use_name' => 'required',
            'use_phone' => 'required',
            'car_patt' => 'required|exists:car_patt,id',
            'card_type' => 'required|exists:card_type,id',
            'card_id' => 'required',
            'pickup_time' => 'required|Date',
            'return_time' => 'required|Date',
            'pickup_store' => 'required|exists:store,id',
            'return_store' => 'required|exists:store,id',
        ];
        $m = [
            'order' => '请输入正确的订单号',
            'use_name' => '请填写正确的姓名',
            'use_phone' => '请填写正确的电话号码',
            'car_patt' => '请填写正确的车辆型号',
            'card_type' => '请填写正确证件类型',
            'card_id' => '请填写正确的证件号',
            'pickup_time' => '请填写正确的取车时间',
            'return_time' => '请填写正确的还车时间',
            'pickup_store' => '请填写正确的取车门店',
            'return_store' => '请填写正确的还车门店',
        ];
        $v = Validator::make($request->all(), $r, $m);


        $v->validate();

        try {
            $order = Order::find($request->order);
            $oldOrder = clone $order;

            if ($request->return_time != $order->return_time || $request->pickup_time != $order->pickup_time || $request->car_patt != $order->car_patt) {
                $priceInfo = new PriceInfo($request->pickup_store, $request->return_store, $request->pickup_time, $request->return_time, $request->car_patt);
                $priceRes = Price::calculate($priceInfo, [$order->id]);

                if (empty($priceRes[0])) {
                    throw new \Exception('价格未设置或时间错误，或无库存 Price not set or time error, or no inventory.');
                }
            }

            if ($order->status == 2 && $order->car_patt != $request->car_patt) {
                throw new \Exception('此订单已经分配车辆。不可修改用车信息');
            }

            if ($order->status == 3 &&
                ($order->pickup_time != $request->pickup_time
                    || $order->pickup_store != $request->pickup_store
                )
            ) {
                throw new \Exception('此订单已经取车，不可修改取车信息');
            }

            if ($order->status > 3 &&
                (
                    $order->return_time != $request->return_time
                    || $order->return_store != $request->return_store
                    || $order->pickup_time != $request->pickup_time
                    || $order->pickup_store != $request->pickup_store
                )
            ) {
                throw new \Exception('此订单已经还车，不可修改取车信息');
            }

            if ($order->status == -1) {
                throw new \Exception('此订单已取消');
            }

            $order->paid = $request->paid;
            if ($order->status < 3 && $order->status != -1) {
                $pickupStore = Store::find($request->pickup_store);
                if ($pickupStore->type == 2) {
                    $realPickupStore = Store::find($pickupStore->store);
                } else {
                    $realPickupStore = $pickupStore;
                }
                $city = $pickupStore->getCity;
                $order->city = $city->code;
                $order->store = $realPickupStore->id;
                $order->pickup_store = $request->pickup_store;
                $order->pickup_time = $request->pickup_time;
                $order->real_pickup_time = $order->pickup_time;
                $order->car_patt = $request->car_patt;
            }

            if ($order->status < 4 && $order->status != -1) {
                $order->return_store = $request->return_store;
                $order->return_time = $request->return_time;
                $order->real_return_time = $order->return_time;
            }

            $order->use_name = $request->use_name;
            $order->use_phone = $request->use_phone;
            $order->card_type = $request->card_type;
            $order->card_no = $request->card_id;

            $order->search_key = Order::createSearKey($request->all());
            $order->save();

            $order->load('getPlatform');
            $order->load('car_patt_name.getComName');
            $order->load('getStore');
            $order->load('getCityByCode');
            $order->load('getPickupStore');
            $order->load('getReturnStore');
            $order->load('card_name');
            $order->load('getTag');
            event(new editOrder($oldOrder, $order));

            return [
                'result' => new Result(true),
                'order' => $order
            ];

        } catch (\Exception $e) {
            return [
                'result' => new Result(false, $e->getMessage())
            ];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */

    /**
     * 分配车辆
     */
    public function dispath(Request $request)
    {
        if (!$request->ajax()) {
            return back()->withErrors('错误的请求');
        }
        $rules = [
            'order' => 'required|exists:order,id',
            'car' => 'required|exists:car,id'
        ];
        $message = [
            'order.required' => '请输入订单号',
            'order.exists' => '订单不存在： ' . $request->input('order'),
            'car.required' => '请输入车辆id',
            'car.exists' => '车辆id不存在： ' . $request->input('order'),
        ];

        $v = Validator::make($request->all(), $rules, $message);

        $order = Order::find($request->input('order'));
        $v->after(function ($validate) use ($request, $order) {

            if ($order->status == -1) {
                $validate->errors()->add('order', '此订单已在' . $order->cancel_time . ' 取消');
                return;
            }

            if ($order->status == 666) {
                $validate->errors()->add('order', '此订单已完成');
                return;
            }

            if ($order->car == $request->car) {
                $validate->errors()->add('ar', '此订单已经分配给这个车辆了,请勿重复分配');
                return;
            }

            $orders = Order::where('car', $request->input('car'))
                ->where('pickup_time', '<=', $order->pickup_time)
                ->where('return_time', '>=', $order->return_time)
                ->get(['id']);

            $ids = Tool::getIds($orders)->toArray();
            if ($orders->count()) {
                $validate->errors()->add('car', '此车辆已分配到其他订单: ' . implode(', ', $ids));
                return;
            }
        });

        $v->validate();
        $car = Car::find($request->input('car'));
        $order->car = $car->id;
        $order->car_patt = $car->car_patt;
        $order->license_plate = $car->license_plate;
        $order->search_key .= $car->license_plate;
        $pn = new Pinyin();
        $order->search_key .= implode('', $pn->convert($car->license_plate));
        event(new changeOrderStatus($order, 2)); //此事件需要在改变状态之前调用
        $order->status = 2;
        $order->save();
        event(new despatch($order, $car));

        return [
            'result' => new Result(true)
        ];
    }

    public function orderPickupInfo(Request $request)
    {
        if (!$request->ajax()) {
            return back()->withErrors('请求错误');
        }
        $rule = [
            'order' => 'required|exists:order,id',
        ];

        $message = [
            'order.required' => '请输入订单号',
            'order.exists' => '订单不存在： ' . $request->input('order'),
        ];

        $v = Validator::make($request->all(), $rule, $message);

        $order = Order::find($request->input('order'));
        $v->after(function ($validate) use ($order) {
            if (!$order->license_plate) {
                $validate->errors()->add('order', '请先分配车辆');
                return;
            }
        });
        $v->validate();

        $order->load('getPriceItem');
        $order->load('getAdditionalAervice');
        $order->load('getPrice');
        $order->load('getPickupPrice');
        $order->load('getReturnPrice');
        $order->load('car_patt_name');
        $order->load('car_patt_name.getComName');
        $order->load('getTag');
        $priceInfo = new PriceInfo($order->pickup_store, $order->return_store, $order->pickup_time, $order->return_time, $order->car_patt);
        $order->day = $priceInfo->getDiff()->day;
        $order->dayKm = 300;

        return [
            'result' => new Result(true),
            'order' => $order
        ];
    }

    public function orderInfo(Request $request)
    {
        if (!$request->ajax()) {
            return back()->withErrors('请求错误');
        }
        $rule = [
            'order' => 'required|exists:order,id',
        ];

        $message = [
            'order.required' => '请输入订单号',
            'order.exists' => '订单不存在： ' . $request->input('order'),
        ];

        $v = Validator::make($request->all(), $rule, $message);

        $order = Order::find($request->input('order'));

        $v->validate();

        $order->load('getPriceItem');
        $order->load('getAdditionalAervice');
        $order->load('getPrice');
        $order->load('getPickupPrice');
        $order->load('getReturnPrice');
        $order->load('car_patt_name');
        $order->load('car_patt_name.getComName');
        $order->load('getPlatform');
        $order->load('getStore');
        $order->load('card_name');
        $order->load('getPickupStore');
        $order->load('getReturnStore');
        $order->load('getTag');
        $order->status = Order::$status[$order->status];

        $priceInfo = new PriceInfo($order->pickup_store, $order->return_store, $order->pickup_time, $order->return_time, $order->car_patt);
        $order->day = $priceInfo->getDiff()->day;
        $order->dayKm = 100;

        return [
            'result' => new Result(true),
            'order' => $order
        ];
    }

    public function pickupCar(Request $request)
    {
        $ruls = [
            'order' => 'required|exists:order,id',
            'oil' => 'required|numeric',
            'km' => 'required|numeric',
            'paid' => 'required|numeric',
            'oth_fee' => 'numeric',
            'pickup_time' => 'required|Date'
        ];
        $message = [
            'order.required' => '订单号必须输入',
            'order.exists' => '订单必须存在',
            'oil.required' => '请输入当前油量(L)',
            'oil.numeric' => '油量必须是数值',
            'km.required' => '请输入当前公里数',
            'km.numeric' => '公里数必须是数值',
            'paid.required' => '请输入当前收款金额',
            'paid.numeric' => '收款金额必须是数值',
            'oth_fee' => '其他金额必须是数值',
            'pickup_time.required' => '请严格按照实际情况填写取车时间,否则会出现库存错乱问题，后果自负！！！',
            'pickup_time.Date' => '请严格按照实际情况填写取车时间,否则会出现库存错乱问题，后果自负！！！'
        ];

        $order = Order::find($request->input('order'));
        $v = Validator::make($request->all(), $ruls, $message);
        $v->after(function ($validate) use ($order) {
            if ($order->status == 666) {
                //订单完成,不可再次取车
                $validate->errors()->add('order', '此订单已完成');
                return;
            }
            if($order->status == -1){
                $validate->errors()->add('order', '此订单已取消');
                return;
            }
        });
        $v->validate();

        $pickup_price = Pickup_price::where('order', $request->input('order'))->first();

        if (!$pickup_price) {
            $pickup_price = new Pickup_price();
        }

        $pickup_price->pickup_time = $request->input('pickup_time');
        $pickup_price->order = $request->input('order');
        $pickup_price->oil = $request->input('oil');
        $pickup_price->km = $request->input('km');
        $pickup_price->paid = $request->input('paid');
        $pickup_price->oth_fee = $request->input('oth_fee');
        $pickup_price->desc = $request->input('desc');
        $admin = session('admin');
        $pickup_price->admin = $admin->name;
        $pickup_price->save();

        $order = Order::find($request->input('order'));

        event(new changeOrderStatus($order, 3));

        $order->real_pickup_time = $pickup_price->pickup_time;
        $order->status = 3;
        $order->save();

        event(new pickupCar($order, $pickup_price));
        return [
            'result' => new Result(true)
        ];
    }

    public function orderDesc(Request $request)
    {
        $rule = [
            'order' => 'required|exists:order,id',
        ];
        $message = [
            'order.required' => '订单号必须输入',
            'order.exists' => '订单不存在',
        ];
        $v = Validator::make($request->all(), $rule, $message);

        $v->validate();

        $order = Order::find($request->input('order'));
        $order->desc = $request->input('desc');
        $order->save();
        return [
            'result' => new Result(true)
        ];
    }

    public function returnCar(Request $request)
    {
        $rule = [
            'order' => 'required|exists:order,id',
            'ultra_km' => 'required|numeric',
            'return_km' => 'required|numeric',
            'ultra_hour' => 'required|numeric',
            'diff_oil' => 'required|numeric',
            'return_time' => 'required|Date',
            'ultra_hour_fee' => 'required|numeric',
            'ultra_km_fee' => 'required|numeric',
            'oil_fee' => 'required|numeric',
            'oth_fee' => 'required|numeric',
            'Illegal_deposit' => 'required|numeric',
            'paid' => 'required|numeric',
            'need_pay' => 'required|numeric',
        ];
        $message = [
            'order' => '未找到该订单.id:' . $request->input('order'),
            'ultra_km' => '请填写正确的超公里数',
            'return_km' => '请填写正确的公里数',
            'ultra_hour' => '请填写正确的超小时数',
            'diff_oil' => '请填写正确燃油差',
            'return_time' => '请严格按照实际情况填写还车时间,否则会出现库存错乱问题，这种锅我不背!',
            'ultra_hour_fee' => '请填写正确的超小时单价',
            'ultra_km_fee' => '请填写正确的超公里数单价',
            'oil_fee' => '请填写正确的燃油费 ¥/L',
            'oth_fee' => '请填写正确的其他费用',
            'Illegal_deposit' => '请填写正确的违章费用',
            'paid' => '请填写正确的已支付费用',
            'need_pay' => '请填写正确的仍需支付费用',
        ];

        $v = Validator::make($request->all(), $rule, $message);
        $v->validate();

        $order = Order::find($request->order);
        if($order->status == -1){
            return [
                'result' => new Result(false, '此订单已取消')
            ];
        }
        event(new changeOrderStatus($order, 666));

        $order->status = 666;
        $order->real_return_time = $request->return_time;
        $order->save();
        $data = $request->all();
        $admin = session('admin');
        $data['admin'] = $admin->name;

        $returnPrice = Return_price::whereOrder($request->order)->first();
        if (!$returnPrice) {
            $returnPrice = new Return_price();
        }
        $returnPrice->update($data);

        event(new returnCar($order, $returnPrice));
        return [
            'result' => new Result(true)
        ];
    }

    public function getLog(Request $request)
    {
        $rule = [
            'order' => 'required|exists:order,id',
        ];
        $message = [
            'order.required' => '订单号必须输入',
            'order.exists' => '订单不存在',
        ];
        $v = Validator::make($request->all(), $rule, $message);
        $v->validate();

        $order = Order::find($request->order);
        $log = $order->getLog;

        return [
            'result' => new Result(true),
            'log' => $log
        ];
    }

    public function cancel(Request $request)
    {
        $rule = [
            'order' => 'required|exists:order,id',
        ];
        $message = [
            'order.required' => '订单号必须输入',
            'order.exists' => '订单不存在',
        ];
        $v = Validator::make($request->all(), $rule, $message);
        $v->validate();

        try {

            $order = Order::find($request->order);

            $cancel_time = time();
            $use_time = strtotime($order->pickup_time);

            if ($use_time - $cancel_time < 3600) {
                $fee = 0;
            } else {
                $fee = $order->price;
            }

            event(new changeOrderStatus($order, -1));

            $orderStauts = new OrderStatus();
            $orderStauts->order = $order->id;
            $orderStauts->status = -1;
            $orderStauts->save();

            $order->status = -1;
            $order->cancel_time = date('Y-m-d H:i:s', $cancel_time);
            $order->cancel_price = $fee;
            $order->save();

            $admin = session('admin');
            Log::log($admin->name.': 订单取消!', 'order', $order->id);

            $order->load('getPlatform');
            $order->load('car_patt_name.getComName');
            $order->load('getStore');
            $order->load('getCityByCode');
            $order->load('getPickupStore');
            $order->load('getReturnStore');
            $order->load('card_name');
            $order->load('getTag');

            return [
                'result' => new Result(true),
                'order' => $order
            ];

        } catch (\Exception $e) {
            return [
                'result' => new Result(false, $e->getMessage()),
            ];
        }
    }


}
