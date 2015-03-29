<!DOCTYPE html>
<html>
<head>
    <title>Chongyi</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap-submenu.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/default-theme.css">
    <script type="text/javascript" src="/static/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap-submenu.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="xochost-brand">
                    <img src="/static/images/common/logo.png" class="xochost-brand-img">
                </div>
            </div>
        </div>
        <div id="navbar" class="row nav-container" style="margin-bottom: 10px;">
            <div class="col-md-12">         
                <ul class="nav nav-tabs" id="xochost-nav-collapse">
                    @foreach($navs as $nav)
                    <li><a href="">{{ $nav->title }}</a></li>
                    @endforeach
                </ul>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-container">
            @yield('body')
            </div>
        </div>
        <div id="footer" class="row default-footer">
            <div class="col-md-12">
                <p>Copyright © 2012 XOPNS·Studo.All rights reserved.</p>
                <p>Powered by XOPNS·Database - WebsiteDeveloper.</p>
            </div>
        </div>
    </div>
</body>
</html>