
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>店铺分类ID</th>
            <th>名称</th>
            <th>店铺图片</th>
            <th>评分</th>
            <th>是否是品牌</th>
            <th>是否准时送达</th>
            <th>是否蜂鸟配送</th>
            <th>是否保标记</th>
            <th>是否票标记</th>
            <th>是否准标记</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>店公告</th>
            <th>优惠信息</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{ $shop->id }}</td>
                <td>{{ $shop->category->name }}</td>
                <td>{{ $shop->shop_name }}</td>
                <td><img src="{{ $shop->shop_img }}" width="100px"></td>
                <td>{{ $shop->shop_rating }}</td>
                <td>@if($shop->brand)是@else否@endif</td>
                <td>@if($shop->on_time)是@else否@endif</td>
                <td>@if($shop->fengniao)是@else否@endif</td>
                <td>@if($shop->bao)是@else否@endif</td>
                <td>@if($shop->piao)是@else否@endif</td>
                <td>@if($shop->zhun)是@else否@endif</td>
                <td>{{ $shop->start_send }}</td>
                <td>{{ $shop->send_cost }}</td>
                <td>{{ $shop->notice }}</td>
                <td>{{ $shop->discount }}</td>
                <td>@if($shop->status)显示@else隐藏@endif</td>
                <td>
                    <a href="{{ route('shops.edit',$shop) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('shops.destroy',$shop) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shops->links() }}

@endsection