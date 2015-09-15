<!doctype html>
<html>
<head>
    <title>博客管理</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap-submenu.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome.min.css">
    <script type="text/javascript" src="/static/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap-submenu.min.js"></script>
    @yield('header')
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin-navbar">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="#" class="navbar-brand">Blog</a>
            </div>
            <div class="collapse navbar-collapse" id="admin-navbar">
                @if($active != 'login')
                <ul class="nav navbar-nav">
                    <li @if($active == 'dashboard') class="active" @endif><a href="{{ url('admin') }}">仪表盘</a></li>
                    <li @if($active == 'article') class="active" @endif><a href="{{ url('admin/article') }}">文章</a></li>
                    <li @if($active == 'recommend') class="active" @endif><a href="{{ url('admin/recommend') }}">推荐</a></li>
                    <li @if($active == 'category') class="active" @endif><a href="{{ url('admin/category') }}">分类</a></li>
                    <li @if($active == 'tag') class="active" @endif><a href="{{ url('admin/tag') }}">标签</a></li>
                    <li @if($active == 'nav') class="active" @endif><a href="{{ url('admin/nav') }}">导航</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/" target="_blank">回到博客</a></li>
                    <li><a href="{{ url('admin/logout') }}">注销</a></li>
                </ul>
                @endif
            </div>
        </div>
    </nav>
    <div class="container-fluid" style="margin-top: 70px">
        @yield('content')
    </div>
</body>
</html>