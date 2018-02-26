<?php

namespace App\Http\Controllers\Admin;

use App\Model\Pickup_price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Pickup_priceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
                                                                                            'order'=> 'required|exists:order,id'                                                                                                                                                                                                                                                                ];
    public function index()
    {
        $list = \App\Model\Pickup_price::paginate(100);
        return view('admin.pickup_price.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
                                                                                    $order_ids = \App\Model\Order::all();
                                                                                                                                                                                                                    return view('admin.pickup_price.create' , compact('order_ids'));
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

        \App\Model\Pickup_price::create($data);
        return redirect('admin/pickup_price');
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
        $data = \App\Model\Pickup_price::findOrFail($id);
                                                                                    $order_ids = \App\Model\Order::all();
                                                                                                                                                                                                                    return view('admin.pickup_price.edit', compact('data','order_ids'));
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
        \App\Model\Pickup_price::findOrFail($id)->update($data);
        return redirect('admin/pickup_price');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Pickup_price::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status'=>true
        ]);
    }
}
