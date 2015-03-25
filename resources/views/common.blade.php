<!DOCTYPE html>
<html>
<head>
    <title>Chongyi</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap-submenu.min.css">
    <link rel="stylesheet" type="text/css" href="static/css/default-theme.css">
    <script type="text/javascript" src="static/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="static/js/bootstrap-submenu.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="xochost-brand">
                    <img src="static/images/common/logo.png" class="xochost-brand-img">
                </div>
            </div>
        </div>
        <div id="navbar" class="row" style="margin-bottom: 10px;">
            <div class="col-md-4 col-md-offset-4">
                <button type="button" class="btn btn-block btn-default btn-primary" id="xochost-nav-control">导航 <span class="caret"></span>
                </button>           
                <ul class="nav nav-justified nav-marktab" id="xochost-nav-collapse">
                    <li class="active"><a href="{{url('/')}}">主页</a></li>
                    @foreach($categorys as $category)
                    @if(is_object($category))
                    <li><a href="">{{ $category->display_name }}</a></li>
                    @else
                    <li><a href="">{{ $category[0]->display_name }}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
        @yield('body')
        <div id="footer" class="row default-footer">
            <div class="col-md-4 col-md-offset-4">
                <p>Copyright © 2012 XOPNS·Studo.All rights reserved.</p>
                <p>Powered by XOPNS·Database - WebsiteDeveloper.</p>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).on('click', function(event) {
    if (event.target.id == 'xochost-nav-control') {
        $('#xochost-nav-collapse').slideToggle('fast');
    } else {
        if ($(window).width() < 768) {
            $('#xochost-nav-collapse').slideUp('fast');
        }
    }
});

$(window).resize(function(event) {
    if ($(window).width() >= 768) {
        $('#xochost-nav-collapse').removeAttr('style');
    } 
});

$('.dropdown-submenu > a').submenupicker();
</script>
</html>