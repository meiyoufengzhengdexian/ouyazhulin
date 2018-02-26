<?php

namespace App\Http\Controllers\Admin;

use App\Lib\priceFloat;
use App\Lib\Result;
use App\Model\Price_float;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Price_floatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
        'float_type' => 'required|max:100',
        'week' => 'required|max:100',
    ];

    public function index(Request $request)
    {
        if($request->ajax()){
            return [
                'result'=>new Result(true),
                'list'=>Price_float::where('price', $request->price)->get()
            ];
        }else{
            $list = \App\Model\Price_float::paginate(100);
            return view('admin.price_float.index', compact('list'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.price_float.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //数据校验
        $rules = [
            'num' => 'required',
            'num_type' => 'required',
            'float_type' => 'required',
            'price'=>'required|exists:price,id'
        ];
        $message = [
            'num.required' => '浮动值必须填写',
            'num_type.required' => '浮动值类型必须填写',
            'float_type.required' => '请选择浮动类型(星期浮动，日期浮动，时间浮动)',
            'price.required'=>'数据错误 price: '.$request->input('price'),
            'price.exists'=>'数据错误 price: '.$request->input('price')
        ];

        $v = Validator::make($request->all(), $rules, $message);

        $v->after(function ($validate) use ($request) {
            switch ($request->input('float_type')) {
                case "date_range":
                    if (!$request->input('start_date') || !strtotime($request->input('start_date'))) {
                        $validate->errors()->add('start_date', '请填写开始日期');
                        return;
                    }
                    if (!$request->input('end_date') || !strtotime($request->input('end_date'))) {
                        $validate->errors()->add('end_date', '请填写开始日期');
                        return;
                    }
                    if (strtotime($request->input('end_date')) < strtotime($request->input('start_date'))) {
                        $validate->errors()->add('end_date', '开始日期比结束日期还大？!');
                        return;
                    }
                    break;
                case "time_range":
                    if (!$request->input('start_time')) {
                        $validate->errors()->add('start_time', '请填写开始时间');
                        return;
                    }
                    if (!$request->input('end_time')) {
                        $validate->errors()->add('end_time', '请填写开始日期');
                        return;
                    }
                    if (strtotime('2000-01-01 ' . $request->input('end_time')) < strtotime('2000-01-01 ' . $request->input('start_time'))) {
                        $validate->errors()->add('end_time', '开始时间比结束日期还大, 不支持跨天设置， 比如 23:00:00 ~ 次日 03:00:00。 这种可以分开设置。或者推荐使用夜间价格设置');
                        return;
                    }
                    break;
                case "week_range":
                    if (!$request->input('week')) {
                        $validate->errors()->add('week', '请填写开始日期');
                        return;
                    }
                    if (intval($request->input('week')) < 1 || intval($request->input('week')) > 7) {
                        $validate->errors()->add('week', '请填写正确的星期');
                        return;
                    }
                    break;
                default:
                    $validate->errors()->add('float_type', '请选择正确的浮动类型');
                    return;
                    break;

            }
            $list = Price_float::where('price', $request->input('price'))->get();

            switch ($request->input('float_type')) {
                case "date_range":
                    $input_start_date = strtotime($request->input('start_date'));
                    $input_end_date = strtotime($request->input('end_date'));
                    foreach ($list->where('float_type', 'date_range') as $priceFloat) {
                        if ($input_start_date >= strtotime($priceFloat->start_date)
                            && $input_start_date <= strtotime($priceFloat->end_date)
                        ) {
                            $validate->errors()->add('start_date', '开始日期重叠， 已有重复的价格浮动.<br>'.
                                $priceFloat->start_date. ' ~ '.$priceFloat->end_date. '浮动: '. $priceFloat->num);
                            return;
                        }

                        if ($input_end_date >= strtotime($priceFloat->start_date)
                            && $input_end_date <= strtotime($priceFloat->end_date)
                        ) {
                            $validate->errors()->add('start_date', '结束日期重叠， 已有重复的价格浮动<br>'.
                                $priceFloat->start_date. ' ~ '.$priceFloat->end_date. '浮动: '. $priceFloat->num);
                            return;
                        }
                    }
                    break;
                case "time_range":
                    $start_time = strtotime('2000-01-01 ' . $request->input('start_time'));
                    $end_time = strtotime('2000-01-01 ' . $request->input('end_time'));

                    foreach ($list->where('float_type', 'time_range') as $priceFloat) {
                        if ($start_time >= strtotime('2000-01-01 ' . $priceFloat->start_time)
                            && $start_time <= strtotime('2000-01-01 ' . $priceFloat->end_time)
                        ) {
                            $validate->errors()->add('start_time', '开始时间重叠， 已有重复的价格浮动<br>'.
                                $priceFloat->start_time. ' ~ '.$priceFloat->end_time. '浮动: '. $priceFloat->num);
                            return;
                        }
                        if ($end_time >= strtotime('2000-01-01 ' . $priceFloat->start_time)
                            && $end_time <= strtotime('2000-01-01 ' . $priceFloat->end_time)
                        ) {
                            $validate->errors()->add('start_date', '结束时间重叠， 已有重复的价格浮动<br>'.
                                $priceFloat->start_time. ' ~ '.$priceFloat->end_time. '浮动: '. $priceFloat->num);
                            return;
                        }
                    }
                    break;
                case "week_range":
                    if (!in_array($request->input('week'), [1, 2, 3, 4, 5, 6, 7])) {
                        $validate->errors()->add('week', '请选择正确的星期数');
                        return;
                    }
                    if($list->where('float_type', 'week_range')->where('week', $request->input('week'))->count()){
                        $validate->errors()->add('week', '已有相同的星期数, 请勿重复添加');
                        return;
                    }
                    break;
            }

        });
        $v->validate();

        //数据校验结束

        $data = $request->all();

        $priceFloat = new Price_float();
        $priceFloat->price = $data['price'];
        $priceFloat->num = $data['num'];
        $priceFloat->num_type = $data['num_type'];
        $priceFloat->float_type = $data['float_type'];
        switch ($data['float_type']){
            case "date_range":
                $priceFloat->start_date = $data['start_date'];
                $priceFloat->end_date = $data['end_date'];
                break;
            case "time_range":
                $priceFloat->start_time = $data['start_time'];
                $priceFloat->end_time = $data['end_time'];
                break;
            case "week_range":
                $priceFloat->week = $data['week'];
        }
        $priceFloat->save();

        return [
            'result' => new Result(true),
            'data' => $request->all()
        ];
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
        $data = \App\Model\Price_float::findOrFail($id);
        return view('admin.price_float.edit', compact('data'));
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

        $this->validate($request, $this->validateRoule);
        $data = $request->all();

        unset($data['uploadImg']);
        \App\Model\Price_float::findOrFail($id)->update($data);
        return redirect('admin/price_float');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priceFloat = \App\Model\Price_float::findOrFail($id);
        $priceFloat->forceDelete();

        return response()->json([
            'result' => new Result(true)
        ]);
    }
}
