<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class RoleController extends Controller
{
    //
    use HasRoles;

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
    public function create()
    {
        if(!Auth::user()->can('/role/create')){
            return "<h1>权限不够</h1>";
        }
        $permissions=Permission::all();
        return view('role.add',compact('permissions'));

    }

    public function store(Request $request)
    {
        //dd($request->permission_id);
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'权限名不能为空',
        ]);
        $role=Role::create([
            'name'=>$request->name,
        ]);
        if($request->permission_id){
            $permissions=[];
            $permissions_id=$request->permission_id;
            foreach ($permissions_id as $permission_id){
                $permission=Permission::find($permission_id);
                $permissions[]=$permission;
            }
            $role->syncPermissions($permissions);
        }

        return redirect('role')->with('success','添加成功');
    }
    //列表
    public function index()
    {
        if(!Auth::user()->can('/role')){
            return "<h1>权限不够</h1>";
        }
        $roles=Role::paginate(3);
        //dd($permissions);
        return view('role.index',compact('roles'));
    }
    //修改
    public function edit(role $role)
    {
        $permissions=Permission::all();
        $rolePermissions=$role->getAllPermissions();
        $permissions_id=[];
        foreach ($rolePermissions as $permission){
            $permissions_id[]=$permission->id;
        }
        return view('role.edit',compact('role','permissions','permissions_id'));

    }
    public function update(Request $request,role $role){
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'权限名不能为空',
        ]);
        $role->update([
            'name'=>$request->name,
        ]);
        /*$permissions=[];
        if($request->permission_id){

            $permissions_id=$request->permission_id;
            foreach ($permissions_id as $permission_id){
                $permission=Permission::find($permission_id);
                $permissions[]=$permission;
            }

        }else{
            $rolepermissions=$role->getAllPermissions();
            foreach ($rolepermissions as $permission){
                $role->revokePermissionTo($permission->name);
            }
        }*/
        $role->syncPermissions($request->permission_id);
        return redirect('role')->with('success','修改成功');

    }
    //删除
    public function destroy(role $role)
    {
        $role->delete();
        return redirect('role')->with('success','删除成功');
    }
}
