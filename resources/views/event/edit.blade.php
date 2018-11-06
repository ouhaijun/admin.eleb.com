@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('event.update',$event) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label>详情</label>
            <textarea name="content">{{ $event->content }}</textarea>
        </div>
        <div class="form-group">
            <label>报名开始时间</label>
            <input type="date" name="signup_start"  value="{{ date('Y-m-d',$event->signup_start) }}" class="form-control">
        </div>
        <div class="form-group">
            <label>报名结束时间</label>
            <input type="date" name="signup_end"  value="{{ date('Y-m-d',$event->signup_end) }}" class="form-control">
        </div>
        <div class="form-group">
            <label>开奖日期</label>
            <input type="date" name="prize_date"  value="{{ $event->prize_date }}" class="form-control">
        </div>
        <div class="form-group">
            <label>报名人数限制</label>
            <input type="text" name="signup_num"  value="{{ $event->signup_num }}" class="form-control">
        </div>
        {{--<div class="form-group">
            <label>是否已开奖</label>
            <input type="checkbox" name="is_prize"  value="1" @if(old('is_prize'))checked="checked" @endif class="form-control">
        </div>--}}
        {{ csrf_field() }}
        {{ method_field('put') }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
