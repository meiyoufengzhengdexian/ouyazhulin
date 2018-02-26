<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Lib\Tool;
use App\Model\Admin;
use App\Model\Car;
use App\Model\Car_com;
use App\Model\Car_patt;
use App\Model\Price;
use App\Model\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    protected $validateRoule = [
        'car_patt' => 'required|exists:car_patt,id',
        'license_plate' => 'required|max:100|unique:car,license_plate',
        'color' => 'required|max:100',
        'status' => 'required|max:100',
        'store' => 'required|max:100',
    ];

    public function index(Request $request)
    {
        $admin = Admin::getAdmin();
        $key = $request->input('key', false);
        $store = $request->input('store', false);

        $car = Car::orderBy('created_at', 'desc');
        if($admin->is_supper_admin){
            $key && $car = $car->where('search_key', 'like', "%{$key}%");
            $store && $car = $car->where('store', $store);
        }else{
            $key && $car = $car->where('search_key', 'like', "%{$key}%");
            $store && $car = $car->where('store', $store);
            $stores = $admin->getStores;
            $storeids = Tool::getIds($stores);
            $car = $car->whereIn('store', $storeids);
        }

        $list = $car->get();
        $carPatts = Car_patt::all();
        $carComs = Car_com::all();
        $carStatus = Car::$status;

        return view('admin.car.index', compact('list', 'carPatts', 'carComs', 'carStatus', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $car_patt_names = \App\Model\Car_patt::all();
        return view('admin.car.create', compact('car_patt_names'));
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

        $car = \App\Model\Car::create($data);
        $price = Price::where('car_patt', $car->car_patt)->where('store', $car->store)->first();

        if(!$price){
            $price = new Price();
            $price->car_patt = $car->car_patt;
            $price->store = $car->store;
            $price->status = 0;
            $price->save();
        }

        $data = $car->toArray();
        $data['car_pattern'] = $car->car_patt_name->name;
        $data['car_com'] = $car->car_patt_name->getComName->name;
        $data['store'] = Store::find($data['store'])->name;

        $car->search_key = Car::createSearKey($data);
        $car->save();

        if ($request->ajax()) {
            return response()->json([
                'result' => new Result(true),
                'car' => $car
            ]);
        }

        return redirect('admin/car');
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
        $data = \App\Model\Car::findOrFail($id);
        $car_patt_names = \App\Model\Car_patt::all();
        $stores = Store::where('type', 1)->get();
        return view('admin.car.edit', compact('data', 'car_patt_names', 'stores'));
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
        $this->validateRoule['license_plate'] .= ','.$id;

        $this->validate($request, $this->validateRoule);
        $data = $request->all();
        $car_patt = Car_patt::find($data['car_patt']);

        $car = Car::findOrFail($id);
        $search = $data;
        $search['car_pattern'] = $car_patt->name;
        $search['car_com'] = $car_patt->getComName->name;
        $search['store'] = Store::find($data['store'])->name;
        $data['search_key'] = Car::createSearKey($search);
        $car->update($data);

        return redirect('admin/car');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = \App\Model\Car::findOrFail($id);
        $cate->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function getCarByStore(Request $request)
    {
        if(!$request->ajax()){
            return back()->withErrors('错误的请求');
        }
        $store = $request->input('store');

        $cars = Car::where('store', $store)
            ->with('car_patt_name.getComName')
            ->where('status', 1)
            ->where(function ($query) use ($request){
                $request->input('key', false) && $query->where('search_key', 'like', "%{$request->input('key')}%");
            })
            ->paginate( 30 );

        return [
            'result'=>new Result(true),
            'cars'=>$cars
        ];
    }
}
