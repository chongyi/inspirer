<!DOCTYPE html>
<html lang="zh-hans">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@section('title') 灵感 - 来自生活的馈赠@show</title>
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="/assets/amazeui/dist/css/amazeui.min.css">
    <link rel="stylesheet" href="/assets/theme/dark/theme.css">
    <link rel="stylesheet" href="/assets/theme/dark/prettify-theme.css">
    @yield('meta')
</head>
<body>
<header class="am-topbar am-topbar-inverse am-topbar-fixed-top am-kai">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="/">Inspirer</a>
        </h1>
        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
        <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                @foreach($navs as $nav)
                    <li><a title="{{ $nav->title }}" href="{{ $nav->link }}">{{ $nav->title }}</a></li>
                @endforeach
            </ul>

            <form class="am-topbar-form am-topbar-right am-form-inline" id="search-form" role="search" action="{{ url('search') }}" method="GET">
                <div class="am-form-group">
                    <input type="text" id="search-keyword" class="am-form-field am-input-sm" placeholder="搜索">
                </div>
                <button id="search-active" class="am-btn am-btn-sm  am-btn-success am-topbar-btn">search</button>
            </form>
        </div>
    </div>
</header>
<div class="am-container insp-d-body am-kai">
    <!-- 主容器 -->
    @yield('body')
</div>
<footer class="am-kai insp-d-footer">
    <div class="am-g am-g-fixed">
        <p>灵感，来自生活的馈赠</p>
        <p>Recorded from life's inspirations</p>
        <p>Powered by XOPNS·Database - WebsiteDeveloper</p>
        @if(isset($staticMode))<p>This is a static page. Created at {{ $staticCreateTime }}</p>@endif
        <p id="record-number"><a href="http://www.miitbeian.gov.cn/">渝ICP备15005301号</a></p>
        <p><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254751551'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1254751551' type='text/javascript'%3E%3C/script%3E"));</script></p>
    </div>
</footer>

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/assets/jquery/dist/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/assets/amazeui/dist/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="/assets/amazeui/dist/js/amazeui.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.emoji.js"></script>
<script src="/assets/google-code-prettify/bin/prettify.min.js"></script>
<script>
    $(document).ready(function() {
        $('pre').text(function(i, v) {
            $(this).attr('class', 'prettyprint linenums');
            return $(this).children('code').text();
        });
        prettyPrint();
        $('table').addClass('am-table am-table-hover');
        $('.insp-d-article-body').each(function(index, val) {
            $(val).emoji();
        });

        $('#search-active').click(function (event) {
            event.preventDefault();
            var keyword = $('#search-keyword').val();
            if ($.trim(keyword) == '') {
                return false;
            }

            var host = $('#search-form').attr('action');
            window.location.href = host + '/' + keyword;
        });
    });
</script>
</body>
</html>