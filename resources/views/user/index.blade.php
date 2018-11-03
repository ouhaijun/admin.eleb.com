
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>所属商家</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>@if($user->status)显示@else隐藏@endif</td>
                <td>{{ $user->shop->shop_name }}</td>
                <td>
                    <a href="{{ route('users.edit',$user) }}" class="btn-warning btn-sm">修改</a>
                    <a href="{{ route('user.pwd',$user) }}" class="btn-warning btn-sm">修改密码</a>
                    <form action="{{ route('users.destroy',$user) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}

@endsection