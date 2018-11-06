@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('eventprize.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>活动id</label>
            <select name="events_id" class="form-control">
                @foreach($events as $event)
                <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>奖品名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>奖品详情</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label>中奖商家账号id</label>
            <input type="text" name="member_id"  value="{{ old('member_id') }}" class="form-control">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
