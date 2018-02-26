<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminLogin extends Controller
{
    public static $url = '/admin/login';

    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'account'=> 'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ];
        $message = [
            'account.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码错误',
        ];

        $v = Validator::make($request->all(), $rules, $message);

        $admin = null;

        $v->after(function($validate) use($request, &$admin){
            if($validate->errors()->count()){
                return;
            }
            $admin = Admin::whereAccount($request->input('account'))->first();
            if(!$admin){
                $validate->errors()->add('account', '用户名或密码错误');
                return;
            }

            if(decrypt($admin->password)!= $request->input('password')){
                $validate->errors()->add('account', '用户名或密码错误');
            }

            if($admin->status == 0){
                $validate->errors()->add('account', '此账户已禁止登录');
            }
        });

        $v->validate();

        session(['admin'=>$admin]);

        return redirect('admin/store');
    }

    public function logout(Request $request)
    {
        session(['admin'=>null]);
        return redirect('admin');
    }

    /**
     * 依赖： 调用前，必须在登录状态， 否则跳转到登录界面
     */
    public static function getAdmin(Request $request = null)
    {
        $admin = session('admin');
        return Admin::find($admin->id);
    }
}
