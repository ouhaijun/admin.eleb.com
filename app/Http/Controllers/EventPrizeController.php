<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    //添加抽奖活动奖品管理
    public function create()
    {
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
