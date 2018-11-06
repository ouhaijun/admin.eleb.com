@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <h2>添加角色</h2>
    <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称(路由)</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>权限(路由)</label>
            @foreach($permissions as $permission)
            <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}">{{ $permission->name }}
            @endforeach
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
