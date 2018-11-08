
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    @can('/admins/edit')
                    <a href="{{ route('admins.edit',$admin) }}" class="btn-warning btn-sm">修改</a>
                    @endcan
                        @can('/admins/destroy')
                    <form action="{{ route('admins.destroy',$admin) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                        @endcan
                    {{--<a href="{{ route('admin.pwd',$admin) }}" class="btn-warning btn-sm">修改密码</a>--}}
                </td>
            </tr>
        @endforeach
    </table>
    {{ $admins ->links() }}

@endsection