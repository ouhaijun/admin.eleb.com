
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>分类图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shop_categorys as $shop_category)
            <tr>
                <td>{{ $shop_category->id }}</td>
                <td>{{ $shop_category->name }}</td>
                <td><img src="{{ $shop_category->img }}" width="100px"></td>
                <td>@if($shop_category->status)显示@else隐藏@endif</td>
                <td>
                    <a href="{{ route('shop_categorys.edit',$shop_category) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('shop_categorys.destroy',$shop_category) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shop_categorys->links() }}

@endsection