@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('users.update',$user) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password"  value="{{ $user->password }}" class="form-control">
        </div>
        <div class="form-group">
            <label>状态</label>
            <input type="checkbox" name="status"  value="1" @if($user->status) checked="checked" @endif>
        </div>

        <div class="form-group">
            <label>所属商家</label>
            <select name="shop_id" class="form-control">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
        {{ method_field('put') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
