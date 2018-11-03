@extends('layout.default')
@section('contents')
    @include('layout._errors')

    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>


    <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>店铺分类ID</label>
            <select name="shop_category_id">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="shop_name" class="form-control" value="{{ old('shop_name') }}">
        </div>
        <div class="form-group">
            <label>店铺图片</label>
            <input type="hidden" name="shop_img" id="img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="pic" style="width: 100px;"/>
        </div>
        <div class="form-group">
            <label>评分</label>
            <input type="number" name="shop_rating" class="form-control" value="{{ old('shop_rating') }}">
        </div>
        <div class="form-group">
            <label>是否是品牌</label>
            <input type="checkbox" name="brand" value="1" @if(old('brand')) checked="checked" @endif>
        </div>
        <div class="form-group">
            <label>是否准时送达</label>
            <input type="checkbox" name="on_time" value="1" @if(old('on_time')) checked="checked" @endif>
        </div>
        <div class="form-group">
            <label>是否蜂鸟配送</label>
            <input type="checkbox" name="fengniao" value="1" @if(old('fengniao')) checked="checked" @endif>
        </div>
        <div class="form-group">
            <label>是否保标记</label>
            <input type="checkbox" name="bao" value="1" @if(old('bao')) checked="checked" @endif>
        </div>
        <div class="form-group">
            <label>是否票标记</label>
            <input type="checkbox" name="piao" value="1" @if(old('piao')) checked="checked" @endif>
        </div>
        <div class="form-group">
            <label>是否准标记</label>
            <input type="checkbox" name="zhun" value="1" @if(old('zhun')) checked="checked" @endif>
        </div>
        <div class="form-group">
            <label>起送金额</label>
            <input type="number" name="start_send" class="form-control" value="{{ old('start_send') }}">
        </div>
        <div class="form-group">
            <label>配送费</label>
            <input type="number" name="send_cost" class="form-control" value="{{ old('send_cost') }}">
        </div>
        <div class="form-group">
            <label>店公告</label>
            <input type="text" name="notice" class="form-control" value="{{ old('notice') }}">
        </div>
        <div class="form-group">
            <label>优惠信息</label>
            <input type="text" name="discount" class="form-control" value="{{ old('discount') }}">
        </div>
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password"  value="{{ old('password') }}" class="form-control">
        </div>

        {{--<div class="form-group">
            <label>状态</label>
            <input type="checkbox" name="status"  value="1" @if(old('status')) checked="checked" @endif>
        </div>--}}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
@section('javascript')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',
            // 文件接收服务端。
            server: '{{route('upload')}}',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },

            formData:{
                _token:"{{csrf_token()}}"
            }
        });

        uploader.on('uploadSuccess',function (file,response) {
            $("#pic").attr('src',response.path);
            $("#img").val(response.path);
        });

    </script>
@stop