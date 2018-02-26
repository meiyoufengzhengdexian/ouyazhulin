<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Lib\Tool;
use App\Model\Admin;
use App\Model\AdminStore;
use App\Model\Store;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $admin = Admin::getAdmin();
        if($admin->is_supper_admin){
            $list = Admin::all();
        }else{
            $list = collect([$admin]);
        }
        return view('admin.user.index', compact('list'));
    }

    public function edit(Request $request)
    {
        $user = Admin::find($request->id);
        return view('admin.user.edit_password', compact('user'));
    }

    public function edit_passwd(Request $request)
    {
        $rule = [
            'id'=>'required|exists:admin,id',
            'new_passwd'=>'required|min:6|confirmed'
        ];
        $message = [
            'new_passwd.required' => '新密码必须填写',
            'new_passwd.min' => '密码长度必须大于6位',
            'new_passwd.confirmed' => '两次密码不一致,请重新录入',
        ];
        $admin = Admin::getAdmin();
        $v = Validator::make($request->all(), $rule, $message);
        $user = Admin::find($request->id);

        if(!$admin->is_supper_admin || $user->is_supper_admin || $admin->id == $user->id){
            //需要验证原密码
            $v->after(function ($validate) use($request, $user){
                if(decrypt($user->password)!= $request->input('old_passwd')){
                    $validate->errors()->add('old_passwd', '原密码错误,请重试');
                    return;
                }
            });
        }

        $v->validate();

        $user->password = encrypt($request->input('new_passwd'));
        $user->save();

        if($admin->id == $user->id){
            return redirect('admin/logout');
        }else{
            Session::flash('success', '修改成功');
            return redirect('admin/user');
        }
    }

    public function status(Request $request, $status)
    {
        $rule = [
            'id'=>'required|exists:admin,id',
        ];
        $v = Validator::make($request->all(), $rule);
        $admin = Admin::getAdmin();

        if(!$admin->is_supper_admin){
            $v->after(function ($validate) use($request){
                $validate->errors()->add('id', '您没有权限');
            });
        }

        $v->validate();
        $user = Admin::find($request->id);
        $user->status = $status;
        $user->save();

        return [
            'result'=>new Result(true)
        ];
    }

    public function addStore(Request $request, $id)
    {
        $user = Admin::find($id);
        $exists_stores = $user->getStores;
        $store = Store::where('type', 1)->get();
        return view('admin.user.store', compact('exists_stores', 'store', 'id'));
    }

    public function postAddStore(Request $request)
    {
        $rule = [
            'id'=>'required|exists:admin,id'
        ];
        $v = Validator::make($request->all(), $rule);
        $v->after(function ($validate) use($request){
            $admin = session('admin');
            if(!$admin->is_supper_admin){
                $validate->errors()->add('id', '您没有权限');
            }
        });

        $v->validate();
        $user = Admin::find($request->id);
        $user->getStores()->detach();
        $user->getStores()->attach($request->stores);

        Session::flash('success', '修改成功');
        return back();
    }
}
