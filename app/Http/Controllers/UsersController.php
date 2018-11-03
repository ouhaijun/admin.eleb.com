<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use App\User;
use Illuminate\Http\Request;
use function Sodium\compare;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        //做权限验证
        $this->middleware('auth',[
            //除了那些方法生效
            'except'=>['index'],

            //只对那些方法生效
            //'only'=>[]
        ]);

    }
    //添加商家账号
    public function create()
    {
        $users=Shops::all();
        return view('user.add',compact('users'));

    }

    public function store(Request $request)
    {
        //dd($_POST);
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
            'shop_id'=>'required',
        ],[
            'name.required'=>'名称不可以是空哦',
            'email.required'=>'邮箱不可以是空哦',
            'password.required'=>'密码不可以是空哦',
            'password.min'=>'密码不可以少于4位数',
            'shop_id'=>'所属商家不能为空',
        ]);

        User::create([

            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'remember_token'=>str_random(50),
            'status'=>1,
            'shop_id'=>$request->shop_id,

        ]);
        return redirect('users')->with('success','添加成功');
    }
    //列表
    public function index()
    {
        $users=User::paginate();
        return view('user.index',compact('users'));
    }
    //修改
    public function edit(user $user)
    {
        $shops=Shops::all();
        return view('user.edit',compact('user','shops'));


    }

    public function update(user $user,Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
            'shop_id'=>'required',
        ],[
            'name.required'=>'名称不可以是空哦',
            'email.required'=>'邮箱不可以是空哦',
            'password.required'=>'密码不可以是空哦',
            'password.min'=>'密码不可以少于4位数',
            'shop_id'=>'所属商家不能为空',
        ]);

        $user->update([

            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'remember_token'=>str_random(50),
            'status'=>$request->status,
            'shop_id'=>$request->shop_id,

        ]);
        return redirect('users')->with('success','修改成功');

    }
    //删除
    public function destroy(user $user)
    {
        $user->delete();
        return redirect('users')->with('success','删除成功');

    }
    //重置密码
    public function pwd(user $user)
    {
        return view('user.pwd',compact('user'));

    }

    public function save(user $user,Request $request)
    {
        $this->validate($request,[
            'pwd'=>'required|min:4',


        ],[
                'pwd.required'=>'密码不能为空',
                'pwd.min'=>'密码不能少于4位数',
            ]

        );
        if($request->pwd!=$request->repwd){
            return redirect('users')->with('warning','两次密码不一致');
        }
        $user->update([
            'password'=>$request->pwd,
        ]);
        return redirect('users')->with('success','修改密码成功');

    }
}
