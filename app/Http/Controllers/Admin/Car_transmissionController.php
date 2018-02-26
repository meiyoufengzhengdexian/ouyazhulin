<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Model\Car_transmission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Car_transmissionController extends Controller
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
        $list = Car_transmission::all();

        if ($request->ajax()) {
            return [
                'result' => new Result(true),
                'data' => $list
            ];
        }
        return view('admin.car_transmission.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car_transmission.create');
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

        $transmission = \App\Model\Car_transmission::create($data);

        if ($request->ajax()) {
            return response()->json([
                'result' => new Result(true),
                'transmission' => $transmission
            ]);
        }

        return redirect('admin/car_transmission');
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
        $data = \App\Model\Car_transmission::findOrFail($id);
        return view('admin.car_transmission.edit', compact('data'));
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
        \App\Model\Car_transmission::findOrFail($id)->update($data);
        return redirect('admin/car_transmission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Car_transmission::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
