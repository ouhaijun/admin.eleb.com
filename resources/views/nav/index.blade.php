
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>地址</th>
            <th>上级id</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
            <tr>
                <td>{{ $nav->id }}</td>
                <td>{{ $nav->name }}</td>
                <td>{{ $nav->url }}</td>
                <td>{{ $nav->pid }}</td>
                <td>
                    <a href="{{ route('nav.edit',$nav) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('nav.destroy',$nav) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $navs ->links() }}

@endsection