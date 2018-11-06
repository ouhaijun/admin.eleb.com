<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {!! \App\Models\Nav::getNavs() !!}

                {{--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('users.create') }}">添加用户</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('users.index') }}">用户列表</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">添加用户</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">用户列表</a></li>
                    </ul>
                </li>--}}
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{ route('login') }}">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>{{ auth()->user()->name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">个人中心</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('admin.pwd') }}">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}">退出</a></li>
                    </ul>
                </li>
                    @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>