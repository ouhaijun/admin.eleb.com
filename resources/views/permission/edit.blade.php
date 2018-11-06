@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <h2>修改权限</h2>
    <form action="{{ route('permission.update',$permission) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称(路由)</label>
            <input type="text" name="name" class="form-control" value="{{ $permission->name }}">
        </div>
        {{ csrf_field() }}
        {{ method_field('put') }}
        <button class="btn btn-primary btn-block">修改</button>
    </form>

@stop
