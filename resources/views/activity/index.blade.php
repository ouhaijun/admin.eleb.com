
@extends('layout.default')
@section('contents')
        <a href="activitys?hand=hand" class="btn btn-warning" name="hand">进行中</a>
        <a href="activitys?begin=begin" class="btn btn-warning" name="begin">未开始</a>
        <a href="activitys?finis=finis" class="btn btn-warning" name="finis">已结束</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{date('Y-m-d',$activity->start_time)}}</td>
                <td>{{date('Y-m-d',$activity->end_time)}}</td>
                <td style="color: red">@if(time()>$activity->end_time)已结束@elseif(time()>$activity->start_time&&time()<$activity->end_time)进行中@else未开始@endif</td>
                <td>
                    <a href="{{ route('activitys.show',$activity) }}" class="btn-primary btn-sm" style="float: left;">查看</a>
                    <a href="{{ route('activitys.edit',$activity) }}" class="btn-warning btn-sm" style="float: left;">修改</a>
                    <form action="{{ route('activitys.destroy',$activity) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm" style="float: left;">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $activitys->links() }}

@endsection