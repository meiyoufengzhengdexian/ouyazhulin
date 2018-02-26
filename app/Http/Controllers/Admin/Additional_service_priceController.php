<?php

namespace App\Http\Controllers\Admin;

use App\Model\Additional_service_price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Additional_service_priceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
                                                            'additional_service'=> 'required|max:100',
                                                                                                                                ];
    public function index()
    {
        $list = \App\Model\Additional_service_price::paginate(100);
        return view('admin.additional_service_price.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
                                                                                                                                                        return view('admin.additional_service_price.create' );
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

        \App\Model\Additional_service_price::create($data);
        return redirect('admin/additional_service_price');
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
        $data = \App\Model\Additional_service_price::findOrFail($id);
                                                                                                                                                        return view('admin.additional_service_price.edit', compact('data'));
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
        \App\Model\Additional_service_price::findOrFail($id)->update($data);
        return redirect('admin/additional_service_price');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Additional_service_price::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status'=>true
        ]);
    }
}
