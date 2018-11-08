<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
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
    //会员列表
    public function index(Request $request)
    {
        if(!Auth::user()->can('/member/index')){
            return "<h1>权限不够</h1>";
        }
        if($request->like){
            $members=Member::where('username','like',"%$request->like%")->paginate(3);
        }
        if($request->like==null){
            $members=Member::paginate(3);
        }
        return view('member.index',compact('members'));

    }
    //查看会员信息
    public function show(member $member)
    {
        //dd($member->id);
        return view('member.show',compact('member'));

    }
    //禁用会员账号
    public function update(member $member)
    {
        $member->update([
            'status'=>0,
        ]);
    return redirect('member/index')->with('success','禁用成功');
    }
    //启用会员账号
    public function edit(member $member)
    {
        $member->update([
            'status'=>1,
        ]);
        return redirect('member/index')->with('success','启用成功');
    }
}
