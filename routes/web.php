<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//商品分类
Route::post('upload','Shop_CategoryController@upload')->name('upload');
Route::resource('shop_categorys','Shop_CategoryController');

//商品信息
Route::resource('shops','ShopsController');
Route::get('shop/check','ShopsController@check')->name('shop.check');
Route::get('shop/upcreate/{shop}','ShopsController@upcreate')->name('shop.upcreate');
Route::get('shop/upstore/{shop}','ShopsController@upstore')->name('shop.upstore');
Route::get('shop/upsave/{shop}','ShopsController@upsave')->name('shop.upsave');
Route::get('shop/list','ShopsController@list')->name('shop.list');
Route::post('upload','ShopsController@upload')->name('upload');



//店家
Route::resource('users','UsersController');
Route::get('user/pwd/{user}','UsersController@pwd')->name('user.pwd');
Route::post('user/save/{user}','UsersController@save')->name('user.save');

//管理员
Route::resource('admins','AdminController');
Route::get('admin/pwd','AdminController@pwd')->name('admin.pwd');
Route::post('admin/save','AdminController@save')->name('admin.save');

//登录
Route::get('login','SessionController@create')->name('login');
Route::post('login','SessionController@store')->name('login');
Route::get('logout','SessionController@destroy')->name('logout');

//活动
//Route::get('activity/list','ActivityController@list')->name('list');
Route::resource('activitys','ActivityController');

//会员
Route::get('member/index','MemberController@index')->name('member.index');
Route::get('member/show/{member}','MemberController@show')->name('member.show');
Route::post('member/update/{member}','MemberController@update')->name('member.update');
Route::post('member/edit/{member}','MemberController@edit')->name('member.edit');


/*//添加
Route::get('articles/create','Day3\ArticleController@create')->name('articles.create');
Route::post('articles','Day3\ArticleController@store')->name('articles.store');
//修改
Route::get('articles/{article}/edit','Day3\ArticleController@edit')->name('articles.edit');
Route::put('articles/{article}','Day3\ArticleController@update')->name('articles.update');
//获取所有文章
Route::get('articles','Day3\ArticleController@index')->name('articles.index');
//查看一篇文章
Route::get('articles/{article}','Day3\ArticleController@show')->name('articles.show');
//删除文章
Route::delete('articles/{article}','Day3\ArticleController@destroy')->name('articles.destroy');*/
//Route::get('shop/delete{shop}','ShopController@delete')->name('shop.delete');

//统计
//平台端
//平台端最近一周订单销量统计
Route::get('tong/week','TongJiController@week')->name('tong.week');
//平台端最近三个月的订单统计
Route::get('tong/month','TongJiController@month')->name('tong.month');
//平台端最近一周菜品销量统计
Route::get('tong/look','TongJiController@look')->name('tong.look');
//平台端最近三月菜品销量统计
Route::get('tong/monthes','TongJiController@monthes')->name('tong.monthes');

//权限
Route::resource('permission','PermissionController');
Route::resource('role','RoleController');

//菜单
Route::resource('nav','NavController');

//抽奖活动
Route::resource('event','EventController');
//抽奖活动奖品管理
Route::resource('eventprize','EventPrizeController');
