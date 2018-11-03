
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>店铺分类ID</th>
            <th>名称</th>
            <th>店铺图片</th>
            <th>评分</th>
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
                <td>{{ $shop->start_send }}</td>
                <td>{{ $shop->send_cost }}</td>
                <td>{{ $shop->notice }}</td>
                <td>{{ $shop->discount }}</td>
                <td>@if($shop->status==1)启用@elseif($shop->status==0)未审核@else禁用@endif</td>
                <td>
                    @if($shop->status==1)
                    <a href="{{ route('shops.edit',$shop) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('shops.destroy',$shop) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                    @elseif($shop->status==0)
                        <a href="{{ route('shop.upcreate',$shop) }}" class="btn btn-primary">启用</a>
                        <a href="{{ route('shop.upstore',$shop) }}" class="btn btn-primary">禁用</a>
                    @else
                        <a href="{{ route('shop.upsave',$shop) }}" class="btn btn-danger">解除禁止</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shops->links() }}

@endsection