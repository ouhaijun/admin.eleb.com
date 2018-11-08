<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
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
    //添加菜单
    public function create()
    {
        if(!Auth::user()->can('/nav/create')){
            return "<h1>权限不够</h1>";
        }
        $urls=Permission::all();
        $navs=Nav::where('pid',0)->get();
        return view('nav.add',compact('navs','urls'));

    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required',
           'url'=>'required',
        ],[
            'name.required'=>'菜单名不能为空',
            'url.required'=>'地址不能为空',
        ]);

        $id=Permission::where('name',$request->url)->first();
            //dd($id);

        Nav::create([
            'name'=>$request->name,
            'url'=>$request->url ?? 0,
            'pid'=>$request->pid,
            'permission_id'=>$id->id ?? 0,
        ]);
        return redirect('nav')->with('success','添加成功');
    }
    //菜单列表
    public function index()
    {
        if(!Auth::user()->can('/nav')){
            return "<h1>权限不够</h1>";
        }
        $navs=Nav::paginate(50);
        return view('nav.index',compact('navs'));
    }
    //修改
    public function edit(nav $nav)
    {
        $urls=Permission::all();
        $naves=Nav::where('pid',0)->get();
        return view('nav.edit',compact('nav','urls','naves'));

    }

    public function update(Request $request,nav $nav)
    {
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
        ],[
            'name.required'=>'菜单名不能为空',
            'url.required'=>'地址不能为空',
        ]);
        $id=Permission::where('name',$request->url)->first();
        //dd($id->id);

        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url ?? 0,
            'pid'=>$request->pid,
            'permission_id'=>$id->id ?? 0,
        ]);
        return redirect('nav')->with('success','修改成功');

    }

    public function destroy(nav $nav)
    {
        $nav->delete();
        return redirect('nav')->with('success','删除成功');

    }


}
