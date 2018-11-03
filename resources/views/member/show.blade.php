
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>会员ID</th>
            <th>用户名</th>
            <th>电话号码</th>
            <th>状态</th>
        </tr>
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>@if($member->status)正常@else禁用@endif</td>
            </tr>
    </table>

@endsection