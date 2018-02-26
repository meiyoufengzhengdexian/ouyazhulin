<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Model\Car_model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Car_modelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
        'name' => 'required|max:100',
    ];

    public function index(Request $request)
    {
        $list = \App\Model\Car_model::all();

        if($request->ajax()){
            return [
                'result'=>new Result(true),
                'data'=>$list
            ];
        }
        return view('admin.car_model.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car_model.create');
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

        \App\Model\Car_model::create($data);
        if($request->ajax()){
            return response()->json([
                'result'=>new Result(true)
            ]);
        }
        return redirect('admin/car_model');
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
        $data = \App\Model\Car_model::findOrFail($id);
        return view('admin.car_model.edit', compact('data'));
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
        \App\Model\Car_model::findOrFail($id)->update($data);
        return redirect('admin/car_model');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Car_model::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
