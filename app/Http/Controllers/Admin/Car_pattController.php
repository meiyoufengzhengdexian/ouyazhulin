<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Model\Car_com;
use App\Model\Car_patt;
use App\Model\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Car_pattController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
        'com' => 'required|max:100',
        'img' => 'required',
        'name' => 'required|max:100|unique:car_patt,name',
        'model' => 'required|exists:car_model,id',
        'car_type' => 'required|exists:car_type,id',
        'transmission' => 'required|exists:transmission,id',
    ];

    public function index()
    {
        $list = \App\Model\Car_patt::with('getComName')
            ->with('car_model_name')
            ->with('car_type_name')
            ->with('transmission_name')
            ->get();

        return view('admin.car_patt.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $car_model_names = \App\Model\Car_model::all();
        $car_type_names = \App\Model\Car_type::all();
        $car_transmission_names = \App\Model\Transmission::all();
        $car_com_names = Car_com::all();

        return view('admin.car_patt.create', compact('car_model_names', 'car_type_names', 'car_com_names', 'car_transmission_names'));
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

        $this->validate($request, $this->validateRoule);
         Car_patt::create($data);

         Session::flash('success', '保存成功');
        return redirect('admin/car_patt');
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
        $data = \App\Model\Car_patt::findOrFail($id);
        $car_model_names = \App\Model\Car_model::all();
        $car_type_names = \App\Model\Car_type::all();
        $car_transmission_names = \App\Model\Transmission::all();

        return view('admin.car_patt.edit', compact('data', 'car_model_names', 'car_type_names', 'car_transmission_names'));
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
        $this->validateRoule['name'] .= ','.$id;
        $this->validate($request, $this->validateRoule);
        $data = $request->all();


        Car_patt::findOrFail($id)->update($data);
        Session::flash('success', '保存成功');

        return redirect('admin/car_patt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Car_patt::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function searchByCom(Request $request)
    {
        $r=[
            'com'=>'required|exists:car_com,id'
        ];
        $m=[
            'com'=>'请输入正确的参数'
        ];
        $r = Validator::make($request->all(), $r, $m);
        $r->validate();

        $carPatts = Car_patt::where('com', $request->com)->get();
        return [
            'result'=>new Result(true),
            'carPatts'=>$carPatts
        ];
    }
}
