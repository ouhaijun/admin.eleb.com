@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <h2>添加权限</h2>
    <form action="{{ route('permission.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称(路由)</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
