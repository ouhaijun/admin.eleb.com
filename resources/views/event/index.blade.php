
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->content }}</td>
                <td>{{ date('Y-m-d',$event->signup_start) }}</td>
                <td>{{ date('Y-m-d',$event->signup_end) }}</td>
                <td>{{ $event->prize_date }}</td>
                <td>{{ $event->signup_num }}</td>
                <td>@if($event->is_prize)是@else没有@endif</td>
                <td>
                    <a href="{{ route('event.edit',$event) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('event.destroy',$event) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $events->links() }}

@endsection