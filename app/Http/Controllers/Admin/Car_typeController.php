<?php

namespace App\Http\Controllers\Admin;

use App\Model\Car_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Car_typeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
                                                            'name'=> 'required|max:100',
                                'status'=> 'required|max:100',
                                                                                                ];
    public function index()
    {
        $list = \App\Model\Car_type::paginate(100);
        return view('admin.car_type.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
                                                                                                                                                        return view('admin.car_type.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $this->validate($request, $this->validateRoule);
        unset($data['uploadImg']);

        \App\Model\Car_type::create($data);
        return redirect('admin/car_type');
    }

    /**
     * Display the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = \App\Model\Car_type::findOrFail($id);
                                                                                                                                                        return view('admin.car_type.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, $this->validateRoule);
        $data = $request->all();

        unset($data['uploadImg']);
        \App\Model\Car_type::findOrFail($id)->update($data);
        return redirect('admin/car_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Car_type::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status'=>true
        ]);
    }
}
