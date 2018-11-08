<?php

namespace App\Http\Controllers;

use App\Models\Shop_Category;
use App\Models\Shops;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    //添加
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
        if(!Auth::user()->can('/shops/create')){
            return "<h1>权限不够</h1>";
        }
        $shops=Shop_Category::all();
        return view('shop.add',compact('shops'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'shop_category_id' => 'required',
            'shop_name' => 'required',
            'shop_img' => 'required',
            'shop_rating' => 'required',
            'start_send' => 'required',
            'send_cost' => 'required',
            'notice' => 'required',
            'discount' => 'required',
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
        ],
            [//自定义错误提示
                'shop_category_id.required' => '店铺分类ID不能为空',
                'shop_name.required' => '名称不能为空',
                'shop_img.required' => '店铺图片不能为空',
                'shop_rating.required' => '评分不能为空',
                'start_send.required' => '起送金额不能为空',
                'send_cost.required' => '配送费不能为空',
                'notice.required' => '店公告不能为空',
                'discount.required' => '优惠信息不能为空',
                'name.required'=>'名称不可以是空哦',
                'email.required'=>'邮箱不可以是空哦',
                'email.email'=>'邮箱格式不对',
                'password.required'=>'密码不可以是空哦',
                'password.min'=>'密码不可以少于4位数',
            ]);


        DB::beginTransaction();
        try {
            $shop = Shops::create([
                'shop_category_id' => $request->shop_category_id,
                'shop_name' => $request->shop_name,
                'shop_img' => $request->shop_img,
                'shop_rating' => $request->shop_rating,
                'brand' => $request->brand ?? 0,
                'on_time' => $request->on_time ?? 0,
                'fengniao' => $request->fengniao ?? 0,
                'bao' => $request->bao ?? 0,
                'piao' => $request->piao ?? 0,
                'zhun' => $request->zhun ?? 0,
                'start_send' => $request->start_send,
                'send_cost' => $request->send_cost,
                'notice' => $request->notice,
                'discount' => $request->discount,
                'status' => 1,
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'remember_token' => str_random(50),
                'status' => 1,
                'shop_id' => $shop->id,

            ]);
            //dd($shop);
            DB::commit();//提交事务
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e);
            //事务回滚
            //dd($shop);

        }
        return redirect('shops')->with('success', '添加成功');
    }
    //列表
    public function index()
    {
        if(!Auth::user()->can('/shops')){
            return "<h1>权限不够</h1>";
        }
        $shops=Shops::paginate(3);
        return view('shop.index',compact('shops'));

    }
    //修改
    public function edit(shops $shop)
    {
        $shop_categorys=Shop_Category::all();
        return view('shop.edit',compact('shop','shop_categorys'));

    }

    public function update(shops $shop,Request $request)
    {
        $this->validate($request, [
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'shop_img'=>'required',
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',
        ],
            [//自定义错误提示
                'shop_category_id.required'=>'店铺分类ID不能为空',
                'shop_name.required'=>'名称不能为空',
                'shop_img.required'=>'店铺图片不能为空',
                'shop_rating.required'=>'评分不能为空',
                'start_send.required'=>'起送金额不能为空',
                'send_cost.required'=>'配送费不能为空',
                'notice.required'=>'店公告不能为空',
                'discount.required'=>'优惠信息不能为空',
            ]);
        $shop->update([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$request->shop_img,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand ?? 0,
            'on_time'=>$request->on_time ?? 0,
            'fengniao'=>$request->fengniao ?? 0,
            'bao'=>$request->bao ?? 0,
            'piao'=>$request->piao ?? 0,
            'zhun'=>$request->zhun ?? 0,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status ?? 0,
        ]);
        return redirect('shops')->with('success','添加成功');

    }
    //删除
    public function destroy(shops $shop)
    {
        $shop->delete();
        return redirect('shops')->with('success','删除成功');

    }
    //审核
    public function check()
    {
        $rows=Shops::where('status','=',0)->paginate(3);
        dd($rows);
        return view('shop.list',compact('rows'));
    }
    //显示一些
    public function list()
    {
        $shops=Shops::paginate(3);
        return view('shop.list',compact('shops'));

    }


    //审核(启用)
    public function upcreate(shops $shop)
    {
        //启用事务

        DB::beginTransaction();
        try{
            $shop->update([
                'status'=>1,
            ]);
            DB::table('users')->where('shop_id',$shop->id)->update([
                'status'=>1,
            ]);
        DB::commit();
        }catch (\Exception $e){
            dd($e);
            DB::rollBack();
        }
        $shop_mail=User::select('email')->where('shop_id',$shop->id)->first();
        $mail=$shop_mail->email;
        $this->mail($shop->shop_name, $mail,'审核通过');
        return redirect('shop/list')->with('success','启用成功');
    }
    //审核(禁用)
    public function upstore(shops $shop)
    {
        $shop->update([
            'status'=>-1,
        ]);
        return redirect('shop/list')->with('success','禁用成功');
    }
    //解除禁用
    public function upsave(shops $shop)
    {
        DB::beginTransaction();
        try{
            $shop->update([
                'status'=>1,
            ]);
            DB::table('users')->where('shop_id',$shop->id)->update([
                'status'=>1,
            ]);
            DB::commit();
        }catch (\Exception $e){
            dd($e);
            DB::rollBack();
        }

        $shop_mail=User::select('email')->where('shop_id',$shop->id)->first();
        $mail=$shop_mail->email;
        $this->mail($shop->shop_name, $mail,'审核通过');
        return redirect('shop/list')->with('success','解除禁止成功');

    }

    //上传图片
    public function upload(Request $request){
        $path=$request->file('file')->store('public/shop');
        return ['path'=>Storage::url($path)];
    }

    //发邮件
    public function mail($name,$mail,$content){
        \Illuminate\Support\Facades\Mail::send('mail',['name'=>$name],function($message)use($mail,$content){
            $message->to($mail)->subject($content);
        });
    }
}
