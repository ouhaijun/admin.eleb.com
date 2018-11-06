@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('admins.update',$admin) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="email" name="email" class="form-control" value="{{ $admin->email }}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password"  value="{{ $admin->password }}" class="form-control">
        </div>
        <div class="form-group">
            <label>角色</label>
            @foreach($roles as $role)
                <input type="checkbox" name="role_id[]"  value="{{ $role->id }}" @if($admin->hasRole($role->name))checked="checked"@endif>{{ $role->name }}
            @endforeach
        </div>
        {{ method_field('put') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">修改</button>
    </form>

@stop
