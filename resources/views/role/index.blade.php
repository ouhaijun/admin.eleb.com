
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{ route('role.edit',$role) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('role.destroy',$role) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $roles ->links() }}

@endsection