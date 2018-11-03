@extends('layout.default')
@section('contents')
    @include('layout._errors')
    @include('vendor.ueditor.assets')
    <form action="{{ route('activitys.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>活动名称</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        {{--<div class="form-group">
            <label>活动详情</label>
            <input type="" name="content">
        </div>--}}

        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain"></script>

        <div class="form-group">
            <label>活动开始时间</label>
            <input type="date" name="start_time" class="form-control" value="{{ old('start_time') }}">
        </div>
        <div class="form-group">
            <label>活动结束时间</label>
            <input type="date" name="end_time" class="form-control" value="{{ old('end_time') }}">
        </div>

        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
