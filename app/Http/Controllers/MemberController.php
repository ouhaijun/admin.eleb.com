<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //会员列表
    public function index(Request $request)
    {
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
