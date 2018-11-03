
@extends('layout.default')
@section('contents')

    <form action="{{ route('member.index') }}" method="get" class="form-group">
  {{--      <input type="hidden" name="id" value="{{ $id }}">--}}
        <input type="text" name="like" size="15" />
        <input type="submit" value="搜索" class="btn btn-warning" />
    </form>
    
    <table class="table table-bordered">
        <tr>
            <th>会员ID</th>
            <th>用户名</th>
            <th>电话号码</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>@if($member->status)正常@else禁用@endif</td>
                <td>
                    <a href="{{ route('member.show',$member) }}" class="btn btn-primary">查看</a>
                    @if($member->status)
                    <form action="{{ route('member.update',$member) }}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-warning">禁用会员</button>
                    </form>
                       @else
                        <form action="{{ route('member.edit',$member) }}" method="post">
                            {{ csrf_field() }}
                            <button class="btn btn-warning">启用</button>
                        </form>
                        @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $members->links() }}

@endsection