@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label>详情</label>
            <textarea name="content" class="form-control">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label>报名开始时间</label>
            <input type="date" name="signup_start"  value="{{ old('signup_start') }}" class="form-control">
        </div>
        <div class="form-group">
            <label>报名结束时间</label>
            <input type="date" name="signup_end"  value="{{ old('signup_end') }}" class="form-control">
        </div>
        <div class="form-group">
            <label>开奖日期</label>
            <input type="date" name="prize_date"  value="{{ old('prize_date') }}" class="form-control">
        </div>
        <div class="form-group">
            <label>报名人数限制</label>
            <input type="text" name="signup_num"  value="{{ old('signup_num') }}" class="form-control">
        </div>
        {{--<div class="form-group">
            <label>是否已开奖</label>
            <input type="checkbox" name="is_prize"  value="1" @if(old('is_prize'))checked="checked" @endif class="form-control">
        </div>--}}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
