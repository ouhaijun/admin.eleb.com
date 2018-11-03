<?php

namespace App\Http\Controllers;

use App\Models\Shop_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Shop_CategoryController extends Controller
{
    //
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
    //添加商品分类
    public function create()
    {
        return view('shop_category.add');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'img'=>'required',

        ],
            [//自定义错误提示
                'name.required'=>'分类名不能为空',
                'img.required'=>'分类图不能为空',

            ]);

        Shop_Category::create([
            'name'=>$request->name,
            'img'=>$request->img,
            'status'=>$request->status ?? 0,
        ]);
        return redirect('shop_categorys')->with('success','添加成功');
    }
    //列表
    public function index()
    {
        $shop_categorys=Shop_Category::paginate(3);
        return view('shop_category.index',compact('shop_categorys'));

    }
    //修改
    public function edit(shop_category $shop_category)
    {
        return view('shop_category.edit',compact('shop_category'));
    }

    public function update(shop_category $shop_category,Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'img'=>'required',

        ],
            [//自定义错误提示
                'name.required'=>'分类名不能为空',
                'img.required'=>'分类图不能为空',
            ]);

        $shop_category->update([
            'name'=>$request->name,
            'img'=>$request->img,
            'status'=>$request->status ?? 0,
        ]);
        return redirect('shop_categorys')->with('success','修改成功');

    }
    //删除
    public function destroy(shop_category $shop_category)
    {
        $shop_category->delete();
        return redirect('shop_categorys')->with('success','删除成功');
        
    }
    //上传图片
    public function upload(Request $request){
        $path=$request->file('file')->store('public/shop_category');
        return ['path'=>Storage::url($path)];
    }
        


}
