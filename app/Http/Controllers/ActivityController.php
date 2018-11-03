<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

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
        return view('activity.add');

    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'title'=>'required',
            'content'=>'required',
           'start_time'=>'required',
           'end_time'=>'required',
        ],[
            'title.required'=>'活动名称不能为空',
            'content.required'=>'活动详情不能为空',
            'start_time.required'=>'活动开始时间不能为空',
            'end_time.required'=>'活动结束时间不能为空',
        ]);
        Activity::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>strtotime($request->start_time),
            'end_time'=>strtotime($request->end_time),
        ]);
        return redirect('activitys')->with('success','添加成功');

    }
    //列表
    public function index()
    {
        //dd($_GET);
        $begin=$_GET['begin'] ?? null;
        $hand=$_GET['hand'] ?? null;
        $finis=$_GET['finis'] ?? null;
        if($hand==null&&$begin==null&&$finis==null){
            $activitys=Activity::paginate(3);
        }elseif($begin==null&&$finis==null){
            $activitys=Activity::where([['start_time','<=',time()],['end_time','>=',time()]])->paginate(3);
        }elseif($hand==null&&$finis==null){
            $activitys=Activity::where('start_time','>',time())->paginate(3);
        }elseif($hand==null&&$begin==null){
            $activitys=Activity::where('end_time','<',time())->paginate(3);
        }


        return view('activity.index',compact('activitys'));


    }
    //修改
    public function edit(activity $activity)
    {
        return view('activity.edit',compact('activity'));


    }

    public function update(activity $activity,Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'活动名称不能为空',
            'content.required'=>'活动详情不能为空',
            'start_time.required'=>'活动开始时间不能为空',
            'end_time.required'=>'活动结束时间不能为空',
        ]);
        $activity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>strtotime($request->start_time),
            'end_time'=>strtotime($request->end_time),
        ]);
        return redirect('activitys')->with('success','修改成功');

    }
    //删除
    public function destroy(activity $activity)
    {
        $activity->delete();
        return redirect('activitys')->with('success','删除成功');

    }
    //查看详情
    public function show(activity $activity)
    {
        return view('activity.show',compact('activity'));

    }
    /*//筛选
    public function list(activity $activity)
    {


    }*/
}
