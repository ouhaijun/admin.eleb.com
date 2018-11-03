@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('login') }}" method="post">

        <div class="form-group">
            <label>姓名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password" value="{{ old('password') }}" class="form-control">
        </div>

        <div class="checkbox">
            <lable>
                <input type="checkbox" name="remember" value="1" @if(old('remember'))checked="checked" @endif>记住我
            </lable>
        </div>
        <div>
            <p>验证码</p>
            <input id="captcha" class="form-control" name="captcha" >

            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}"
                 onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            {{ csrf_field() }}
            <button class="btn btn-success btn-block">登录</button>
        </div>


    </form>

@endsection