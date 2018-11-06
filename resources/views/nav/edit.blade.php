@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <h2>添加菜单栏</h2>
    <form action="{{ route('nav.update',$nav) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ $nav->name }}">
        </div>
        <div class="form-group">
            <label>地址(路由)</label>
            <select class="form-control" name="url">
                <option value="无">请选择地址</option>
                @foreach($urls as $url)
                    <option value="{{ $url->name }}" @if($url->name==$nav->url) selected @endif>{{ $url->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>上级菜单</label>
            <select class="form-control" name="pid">
                <option value="0">请选择上级菜单</option>
                <option value="0">顶级菜单</option>
                @foreach($naves as $nave)
                    <option value="{{ $nave->id }}" @if($nave->id==$nav->pid) selected @endif>{{ $nave->name }}</option>
                @endforeach
            </select>
        </div>

        {{ csrf_field() }}
        {{ method_field('put') }}
        <button class="btn btn-primary btn-block">修改</button>
    </form>
@stop
