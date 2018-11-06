
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{ route('permission.edit',$permission) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('permission.destroy',$permission) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $permissions ->links() }}

@endsection