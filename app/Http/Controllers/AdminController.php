<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use function Sodium\compare;
use Spatie\Permission\Models\Role;
//use Spatie\Permission\Traits\HasRoles;

class AdminController extends Controller
{
    //use HasRoles;
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
    //添加
    public function create()
    {
        $roles=Role::all();
        return view('admin.add',compact('roles'));

    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
        ],[
            'name.required'=>'用户名不能为空',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能少于4位数',
        ]);
        $admin=Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'remember_token'=>str_random(50),
        ]);

        //dd($request->role_id);
        if($request->role_id){
            $admin->assignRole($request->role_id);
        }

        return redirect('admins')->with('success','添加成功');

    }
    //列表
    public function index()
    {
        $admins=Admin::paginate(3);
        return view('admin.index',compact('admins'));

    }
    //修改
    public function edit(admin $admin)

    {
        $roles=Role::all();
        //dd($roles);

        return view('admin.edit',compact('admin','roles'));

    }

    public function update(admin $admin,Request $request)
    {


        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
        ],[
            'name.required'=>'用户名不能为空',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能少于4位数',
        ]);
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'remember_token'=>str_random(50),
        ]);
        //dd($admin->getRoleNames());
        $rolenames=$admin->getRoleNames();
        foreach ($rolenames as $rolename){
            //dd($rolename);
            $admin->removeRole($rolename);
        }
        $admin->assignRole($request->role_id);
        return redirect('admins')->with('success','修改成功');


    }
    //删除
    public function destroy(admin $admin)
    {
        $admin->delete();
        return redirect('admins')->with('success','删除成功');


    }
   /* //修改密码
    public function pwd(admin $admin)
    {

        return view('admin.pwd',compact('admin'));

    }

    public function save(admin $admin,Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'olpwd'=>'required',
            'pwd'=>'required|min:4',


        ],[
                'olpwd.required'=>'旧密码不能为空',
                'pwd.required'=>'密码不能为空',
                'pwd.min'=>'密码不能少于4位数',


            ]

        );
        //dd($request->olpwd);
        //dd($admin->password);

        if($request->olpwd!=$admin->password){

            return redirect('admins')->with('warning','请输入正确的密码');

        }
        $admin->update([
            'password'=>bcrypt($request->pwd),
        ]
    );
        return redirect('admins')->with('success','修改密码成功');

    }*/

    //修改密码
    public function pwd()
    {

        return view('admin.pwd',compact('admin'));

    }
    public function save(Request $request)
    {
        //dd(111);
        $this->validate($request,[
            'olpwd'=>'required',
            'pwd'=>'required|min:4',
        ],[
            'olpwd.required'=>'旧密码不能为空',
            'pwd.required'=>'新密码不能为空',
            'pwd.min'=>'密码不能少于4位数',
        ]);
        //验证原密码
        if(!Hash::check($request->olpwd,Auth::user()->getAuthPassword())){
            return back()->with('danger','原密码错误,请重新输入')->withInput();
        }
        if($request->repwd!=$request->pwd){
            return back()->with('danger','新密码和确认密码必需一样')->withInput();
        }

        //更新数据导数据库
        Auth::user()->update([
            'password'=>bcrypt($request->pwd)
        ]);
        session()->flash('success','修个密码成功');
        return redirect('shops');


    }



}
