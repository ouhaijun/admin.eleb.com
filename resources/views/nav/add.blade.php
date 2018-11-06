@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <h2>添加菜单栏</h2>
    <form action="{{ route('nav.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>地址(路由)</label>
            <select class="form-control" name="url">
                <option value="无">请选择地址</option>
                @foreach($urls as $url)
                    <option value="{{ $url->name }}">{{ $url->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>上级菜单</label>
            <select class="form-control" name="pid">
                <option value="0">请选择上级菜单</option>
                <option value="0">顶级菜单</option>
                @foreach($navs as $nav)
                    <option value="{{ $nav->id }}">{{ $nav->name }}</option>
                @endforeach
            </select>
        </div>

        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>
@stop
