@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('user.save',$user) }}" method="post">
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="pwd"  value="{{ old('pwd') }}" class="form-control">
        </div>
        <div class="form-group">
            <label>确认密码</label>
            <input type="password" name="repwd"  value="{{ old('repwd') }}" class="form-control">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">立即修改</button>
    </form>

@stop
