<!DOCTYPE html>
<html>
<head>
    <title>@section('title')灵感 - 来自生活的馈赠@show</title>
    @yield('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap-submenu.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/default-theme.css">
    <script type="text/javascript" src="/static/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap-submenu.min.js"></script>
    
    <script type="text/javascript" src="/static/js/jquery.emoji.js"></script>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/prettify/r298/prettify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/prettify-theme.css">
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
                    <li><a href="{{ $nav->link }}">{{ $nav->title }}</a></li>
                    @endforeach
                </ul>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @yield('head')
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
                <p>{!! isset($options['statistics']) ? $options['statistics'] : '' !!}</p>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('pre').text(function(i, v) {
            var attr = $(this).children('code').attr('class').replace(/language-(\w+)/, 'prettyprint linenums');
            $(this).attr('class', attr);
            return $(this).children('code').text();
        });

        prettyPrint();

        $('.content-container').each(function(index, val) {
             $(val).emoji();
        });
    });
    
</script>
</html>