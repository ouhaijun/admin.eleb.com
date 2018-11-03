@extends('layout.default')
@section('contents')
    @include('layout._errors')

    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <form action="{{ route('shop_categorys.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="hidden" name="img" id="img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="pic" style="width: 100px;"/>
        </div>

        <div class="form-group">
            <label>状态</label>
            <input type="checkbox" name="status"  value="1" @if(old('status')) checked="checked" @endif>
        </div>
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