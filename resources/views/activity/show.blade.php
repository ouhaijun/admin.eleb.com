
@extends('layout.default')
@section('contents')
<h3>{{ $activity->title }}</h3>
<div>
    {!!$activity->content!!}
</div>
@endsection