<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
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
    //添加活动
    public function create()
    {
        if(!Auth::user()->can('/event/create')){
            return "<h1>权限不够</h1>";
        }
        return view('event.add');

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
        ],[
            'title.required'=>'名称不能为空',
            'content.required'=>'详情不能为空',
            'signup_start.required'=>'报名开始时间不能为空',
            'signup_end.required'=>'报名结束时间不能为空',
            'prize_date.required'=>'开奖日期不能为空',
            'signup_num.required'=>'报名人数不能为空',
        ]);
        Event::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize ?? 0,
        ]);
        return redirect('event')->with('success','添加成功');

    }
    //列表
    public function index()
    {
        if(!Auth::user()->can('/event')){
            return "<h1>权限不够</h1>";
        }
        $events=Event::paginate(10);
        return view('event.index',compact('events'));

    }
    //修改
    public function edit(event $event)
    {
        return view('event.edit',compact('event'));

    }

    public function update(Request $request,event $event)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
        ],[
            'title.required'=>'名称不能为空',
            'content.required'=>'详情不能为空',
            'signup_start.required'=>'报名开始时间不能为空',
            'signup_end.required'=>'报名结束时间不能为空',
            'prize_date.required'=>'开奖日期不能为空',
            'signup_num.required'=>'报名人数不能为空',
        ]);
        $event->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize ?? 0,
        ]);
        return redirect('event')->with('success','修改成功');

    }
    //删除
    public function destroy(event $event)
    {
        $event->delete();
        return redirect('event')->with('success','删除成功');

    }


}
