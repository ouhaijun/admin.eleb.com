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
                <li class="dropdown">
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
                </li>
            </ul>
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商品分类 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('shop_categorys.create') }}">添加分类</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('shop_categorys.index') }}">分类列表</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('shops.index') }}">商品详情列表</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('shops.create') }}">添加商品</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('shop.list') }}">商品列表</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admins.create') }}">添加会员</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('admins.index') }}">会员列表</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">添加商品</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">商品列表</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('activitys.create') }}">添加活动</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('activitys.index') }}">活动列表</a></li>
                        <li role="separator" class="divider"></li>

                    </ul>
                </li>
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