<!DOCTYPE html>
<html>
<head>
    <title>@section('title') 灵感 - 来自生活的馈赠@show</title>
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
    <div class="c-container">
        <div class="c-header">
            <div class="c-logo">
                <a href="/" title="灵感 - 来自生活的馈赠"><img src="/static/images/common/logo.png"></a>
            </div>
            <ul class="nav nav-tabs">
                @foreach($navs as $nav)
                <li><a title="{{ $nav->title }}" href="{{ $nav->link }}">{{ $nav->title }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="c-body">
            @yield('body')
        </div>
    </div>
    <div class="c-footer">
        <p>Copyright © 2012 XOPNS·Studo.All rights reserved.</p>
        <p>Powered by XOPNS·Database - WebsiteDeveloper.</p>
        <p>{!! isset($options['statistics']) ? $options['statistics'] : '' !!}</p>
        <ul class="link">
            <li>友情链接</li>
            <li><a href="http://www.biner.me/">宾呐·之谜</a></li>
        </ul>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('pre').text(function(i, v) {
            // var attr = $(this).children('code').attr('class').replace(/language-(\w+)/, 'prettyprint linenums');
            $(this).attr('class', 'prettyprint linenums');
            return $(this).children('code').text();
        });

        $('table').addClass('table');

        prettyPrint();

        $('.content-container').each(function(index, val) {
             $(val).emoji();
        });
    });
    
</script>
</html>