
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动id</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家账号id</th>
            <th>操作</th>
        </tr>
        @foreach($eventprizes as $eventprize)
            <tr>
                <td>{{ $eventprize->id }}</td>
                <td>{{ $eventprize->events_id }}</td>
                <td>{{ $eventprize->name }}</td>
                <td>{{ $eventprize->description }}</td>
                <td>{{ $eventprize->member_id }}</td>
                <td>
                    <a href="{{ route('eventprize.edit',$eventprize) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('eventprize.destroy',$eventprize) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $eventprizes->links() }}

@endsection