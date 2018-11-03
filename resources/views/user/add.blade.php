@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password"  value="{{ old('password') }}" class="form-control">
        </div>
        {{--<div class="form-group">
            <label>状态</label>
            <input type="checkbox" name="status"  value="1" @if(old('status')) checked="checked" @endif>
        </div>--}}

        <div class="form-group">
            <label>所属商家</label>
            <select name="shop_id" class="form-control">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->shop_name }}</option>
                @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
