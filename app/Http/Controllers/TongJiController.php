<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TongJiController extends Controller
{
    //
    public function week()
    {
        $time_start=date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end=date('Y-m-d 23:59:59');
        $sql="select date(created_at) as date,count(*) as total from orders where 
created_at >='{$time_start}' and created_at<='{$time_end}' group by date(created_at)";
        $rows=DB::select($sql);
        //dd($rows);
        $result=[];
        //构造7天统计格式
        for($i=6;$i>=0;$i--){
            $result[date('Y-m-d',strtotime("-$i day"))]=0;
        }
        //dd($result);
        foreach ($rows as $row){
            $result[$row->date]=$row->total;
        }
        //dd($result);
        return view('tong.week',compact('result'));

    }

    //商户端最近一周菜品销量统计
    public function look()
    {
        $time_start=date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end=date('Y-m-d 23:59:59');
        $sql="select date(orders.created_at) as date,order_details.goods_id,sum(order_details.amount) as total from order_details join orders on order_details.order_id=orders.id where orders.created_at>='{$time_start}' and orders.created_at<='{$time_end}' group by date(orders.created_at),order_details.goods_id";
        $rows=DB::select($sql);
        //dd($rows);
        //构造7天统计格式
        $result = [];
        //获取当前商家的菜品列表
        $menus=Menu::select(['id','goods_name'])->get();
        //dd($menus);
        $keyed=$menus->mapWithKeys(function ($item){
            return [$item['id']=>$item['goods_name']];
        });
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => 0];
        });
        $menus=$keyed->all();
        $week=[];
        for($i=6;$i>=0;$i--){
            $week[]=date('Y-m-d',strtotime("-{$i} day"));
        }
        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $result[$id][$day]=0;
            }
        }
        foreach($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }
        $series=[];
        foreach ($result as $id=>$data){
            $serie=[
                'name'=>$menus[$id],
                'type'=>'line',
                'stack'=>'销量',
                'data'=>array_values($data),
            ];
            $series[]=$serie;
        }
        return view('tong.look',compact('result','menus','week','series'));

    }

    //商户端最近三个月的订单统计
    public function month()
    {
        $time_start=date('Y-m-d 00:00:00',strtotime('-2 month'));
        $time_end=date('Y-m-d 23:59:59');
        $sql="SELECT
	DATE_FORMAT(created_at,'%Y-%m') AS date,
	count(*) AS total
FROM
	orders
WHERE
	created_at >= '{$time_start}'
AND created_at <= '{$time_end}'
GROUP BY
	date";
        $rows=DB::select($sql);
        //dd($rows);
        //构造3月统计格式
        $result=[];
        for ($i=2;$i>=0;$i--){
            //$result[date('Y-m-d',strtotime("-$i day"))]=0;
            $result[date('Y-m',strtotime("-$i month"))]=0;
        }
        foreach ($rows as $row){
            //$result[$row->date]=$row->total;
            $result[$row->date]=$row->total;
        }
        //dd($result);
        return view('tong.month',compact('result'));

    }
    //商户端最近三月菜品销量统计
    public function monthes()
    {
        $time_start=date('Y-m-d 00:00:00',strtotime('-2 month'));
        $time_end=date('Y-m-d 23:59:59');
        $sql="SELECT
	DATE_FORMAT(orders.created_at,'%Y-%m') AS date,
	order_details.goods_id,
	sum(order_details.amount) AS total
FROM
	order_details
JOIN orders ON order_details.order_id = orders.id
WHERE
	orders.created_at >= '{$time_start}'
AND orders.created_at <= '{$time_end}'
GROUP BY
	date,
	order_details.goods_id";
        $rows=DB::select($sql);
        //dd($rows);
        //获取当前商家的菜品列表
        $menus=Menu::select(['id','goods_name'])->get();
        //构造3月统计格式
        $keyed=$menus->mapWithKeys(function ($item){
            return [$item['id']=>$item['goods_name']];
        });
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => 0];
        });
        $result=[];
        $menus=$keyed->all();
        $week=[];
        for($i=2;$i>=0;$i--){
            $week[]=date('Y-m',strtotime("-{$i} month"));
        }
        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $result[$id][$day]=0;
            }
        }
        foreach($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }
        $series=[];
        foreach ($result as $id=>$data){
            $serie=[
                'name'=>$menus[$id],
                'type'=>'line',
                'stack'=>'销量',
                'data'=>array_values($data),
            ];
            $series[]=$serie;
        }
        //dd($series);
        return view('tong.monthes',compact('result','menus','week','series'));

    }


}
