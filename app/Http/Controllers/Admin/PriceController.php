<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Tool;
use App\Model\City;
use App\Model\Price;
use App\Model\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
        'car_patt' => 'required|exists:car_patt,id',
        'platform' => 'required|exists:platform,id',
        'status' => 'required|max:100',
    ];

    public function index(Request $request)
    {
        $admin = session('admin');
        $sstore = $request->input('store', false);
        $scity = $request->input('city', false);
        if ($admin->is_supper_admin) {
            $list = \App\Model\Price::orderBy('created_at', 'desc');
            $citys = City::all();
            $stores = Store::all();
        } else {
            $store = $admin->getStores;
            $ids = Tool::getIds($store);
            $cids = Tool::getIds($store, 'city');
            $citys = City::whereIn('id', $cids)->get();
            $list = Price::whereIn('store', $ids)->orderBy('created_at', 'desc');
            $stores = $store;
        }

        if($scity){
            $city = City::whereCode($scity)->first();
            $ssstores = $city->getStores;
            $ids = Tool::getIds($ssstores);
            $list = $list->whereIn('store', $ids);
        }
        $sstore && $list = $list->where('store', $sstore);

        $list = $list->with('getStore')
            ->with('car_patt_name')
            ->with('platform_name')
            ->paginate(100);

        return view('admin.price.index', compact('list', 'request', 'citys', 'stores', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $car_patt_names = \App\Model\Car_patt::all();
        $platform_names = \App\Model\Platform::all();
        return view('admin.price.create', compact('car_patt_names', 'platform_names'));
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

        \App\Model\Price::create($data);
        return redirect('admin/price');
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
        $data = \App\Model\Price::findOrFail($id);
        $car_patt_names = \App\Model\Car_patt::all();
        $platform_names = \App\Model\Platform::all();
        return view('admin.price.edit', compact('data', 'car_patt_names', 'platform_names'));
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

        $additional_service = $request->input('additional_service');
        unset($data['additional_service']);

        $price = Price::findOrFail($id);

        $price->update($data);
        $price->getAdditional()->sync($additional_service);
        return redirect('admin/price');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Price::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
