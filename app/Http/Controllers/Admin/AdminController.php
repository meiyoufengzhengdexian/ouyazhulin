<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $validateRoule = [
        'name' => 'required',
        'account' => 'required|max:30',
        'password' => 'required|max:20|confirmed',
        'store'=>'required|exists:store,id'
    ];
    protected $validateMessage = [
        'name.required' => '管理员姓名必须填写',
        'account.required' => '管理员登录账号必须填写',
        'account.max' => '登录名过长，最多30位',
        'password.required' => '管理员密码必须填写',
        'password.max' => '密码过长，最多20位',
        'password.confirmed' => '两次密码不一致',
        'store.required'=>'所属门店必须存在',
        'store.exists'=>'所属门店必须存在'
    ];

    public function index()
    {
        return view('admin.index.index');
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), $this->validateRoule, $this->validateMessage);
        $v->validate();

        $admin = Admin::where('account', $request->account)->first();
        if(!$admin){
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->account = $request->input('account');
            $admin->password = encrypt($request->input('password'));
            $admin->is_supper_admin = 0;
            $admin->status = 1;
            $admin->save();
        }else if(!$request->input('yes_i_do', false)){
            return [
                'result'=>new Result(false, 'confirm')
            ];
        }

        $admin->getStores()->syncWithoutDetaching($request->input('store'));

        if ($request->ajax()) {
            return response()->json([
                'result' => new Result(true),
                'admin' => $admin
            ]);
        }

        //暂无 view
        return view('admin');
    }
}
