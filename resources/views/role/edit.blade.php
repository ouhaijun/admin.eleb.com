@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <h2>修改角色</h2>
    <form action="{{ route('role.update',$role) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称(路由)</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}">
        </div>
        <div class="form-group">
            <label>权限</label>
            @foreach($permissions as $permission)
                <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}" @if(in_array($permission->id,$permissions_id))checked="checked"@endif>{{ $permission->name }}
            @endforeach
        </div>
        {{ csrf_field() }}
        {{ method_field('put') }}
        <button class="btn btn-primary btn-block">修改</button>
    </form>

@stop
