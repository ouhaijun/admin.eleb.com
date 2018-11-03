@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('admin.save') }}" method="post">
        <div class="form-group">
            <label>请输入旧密码</label>
            <input type="password" name="olpwd" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>请输入新密码</label>
            <input type="password" name="pwd" class="form-control" value="{{ old('pwd') }}">
        </div>
        <div class="form-group">
            <label>确认密码</label>
            <input type="password" name="repwd"  value="{{ old('repwd') }}" class="form-control">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">立即修改</button>
    </form>

@stop
