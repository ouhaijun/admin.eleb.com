<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class PermissionController extends Controller
{
    //添加权限
    use HasRoles;
    public function create()
    {
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
