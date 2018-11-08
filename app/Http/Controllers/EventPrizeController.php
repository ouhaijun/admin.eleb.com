<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventPrizeController extends Controller
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
    //添加抽奖活动奖品管理
    public function create()
    {
        if(!Auth::user()->can('/eventprize/create')){
            return "<h1>权限不够</h1>";
        }
        $events=Event::all();
        return view('eventprize.add',compact('events'));

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'events_id'=>'required',
            'name'=>'required',
            'description'=>'required',
            'member_id'=>'required',
        ],[
            'events_id.required'=>'活动id不能为空',
            'name.required'=>'奖品名称不能为空',
            'description.required'=>'奖品详情不能为空',
            'member_id.required'=>'中奖商家账号id不能为空',
        ]);
        EventPrize::create([
            'events_id'=>$request->events_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'member_id'=>$request->member_id,
        ]);
        return redirect('eventprize')->with('success','添加成功');
    }
    //列表
    public function index()
    {
        if(!Auth::user()->can('/eventprize')){
            return "<h1>权限不够</h1>";
        }
        $eventprizes=EventPrize::paginate(10);
        return view('eventprize.index',compact('eventprizes'));

    }
    //修改
    public function edit(eventprize $eventprize)
    {
        $events=Event::all();
        return view('eventprize.edit',compact('eventprize','events'));

    }

    public function update(Request $request,eventprize $eventprize)
    {
        $this->validate($request,[
            'events_id'=>'required',
            'name'=>'required',
            'description'=>'required',
            'member_id'=>'required',
        ],[
            'events_id.required'=>'活动id不能为空',
            'name.required'=>'奖品名称不能为空',
            'description.required'=>'奖品详情不能为空',
            'member_id.required'=>'中奖商家账号id不能为空',
        ]);
        $eventprize->update([
            'events_id'=>$request->events_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'member_id'=>$request->member_id,
        ]);
        return redirect('eventprize')->with('success','修改成功');
    }
    //删除
    public function destroy(eventprize $eventprize)
    {
        $eventprize->delete();
        return redirect('eventprize')->with('success','删除成功');

    }
}
