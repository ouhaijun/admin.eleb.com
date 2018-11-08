<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class PermissionController extends Controller
{
    public function __construct()
    {
        //做权限验证
        $this->middleware('auth',[
            //除了那些方法生效
            'except'=>[''],

            //只对那些方法生效
            //'only'=>[]
        ]);

    }
    //添加权限
    use HasRoles;
    public function create()
    {
        if(!Auth::user()->can('/permission/create')){
            return "<h1>权限不够</h1>";
        }
        return view('permission.add');

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'权限名不能为空',
        ]);
        Permission::create([
            'name'=>$request->name,
        ]);
        return redirect('permission')->with('success','添加成功');
    }
    //列表
    public function index()
    {
        if(!Auth::user()->can('/permission')){
            return "<h1>权限不够</h1>";
        }
        $permissions=Permission::paginate(20);
        //dd($permissions);
        return view('permission.index',compact('permissions'));
    }
    //修改
    public function edit(permission $permission)
    {
        return view('permission.edit',compact('permission'));

    }
    public function update(Request $request,permission $permission){
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'权限名不能为空',
        ]);
        $permission->update([
            'name'=>$request->name,
        ]);
        return redirect('permission')->with('success','修改成功');

    }
    //删除
    public function destroy(permission $permission)
    {
        $permission->delete();
        return redirect('permission')->with('success','删除成功');

    }

}
