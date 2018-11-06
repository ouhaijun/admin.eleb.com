<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nav extends Model
{
    //
    protected $fillable=[
        'name','url','permission_id','pid'
    ];

    //获取导航条
    public static function getNavs()
    {
        if(!Auth::user()){
            return '';
        }
        $html='';
        $nav_html='';
        //生成导航菜单组

        //获取所有一级菜单
        $navs=Nav::where('pid',0)->get();

        //遍历一级菜单,生成HTML
        foreach($navs as $nav){

            //获取这一级菜单的子菜单
            $children=Nav::where('pid',$nav['id'])->get();
            $children_html='';
            foreach ($children as $child){
                if(Auth::user()->can($child['url'])){
                    $children_html.='<li><a href='.$child['url'].'>'.$child['name'].'</a></li>';
                }
            }

            if($children_html){
                $nav_html.= '<li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav['name'].'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                $nav_html.=$children_html;
                $nav_html.= '</ul></li>';
            }
        }
        $html.=$nav_html;

        return $html;

    }
}
