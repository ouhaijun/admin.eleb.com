<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    //只允许游客访问
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>['create','store']
        ]);
        $this->middleware('auth',[
            'only'=>['destroy']
        ]);

    }
    //登录
    public function create()
    {
        return view('session.create');

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',

        ],[
                'name.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',

            ]

        );
        //验证账号密码是否正确
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            //登陆成功
            return redirect()->intended(route('shops.index'))->with('success','登录成功');
//            return redirect()->route('users.index')->with('success','登陆成功');

        }else{
            return back()->with('danger','用户名或密码错误,请重新登录')->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','你以成功退出登录');

    }


}
