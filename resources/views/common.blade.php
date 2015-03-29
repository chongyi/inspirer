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
    <script type="text/javascript" src="/static/plugins/syntaxhighlighter/scripts/shCore.js"></script>
    <script type="text/javascript" src="/static/plugins/syntaxhighlighter/scripts/shAutoloader.js"></script>
    <link type="text/css" rel="stylesheet" href="/static/plugins/syntaxhighlighter/styles/shCore.css">
    <link type="text/css" rel="stylesheet" href="/static/plugins/syntaxhighlighter/styles/shThemeRDark.css">
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
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        function path()
        {
            var args = arguments,
            result = [];

            for(var i = 0; i < args.length; i++)
                result.push(args[i].replace('@', '/static/plugins/syntaxhighlighter/scripts/'));

            return result
        };

        $('pre').text(function(i, v) {
            var attr = $(this).children('code').attr('class').replace(/language-(\w+)/, 'brush: $1;');
            $(this).attr('class', attr);
            return $(this).children('code').text();
        });

        SyntaxHighlighter.autoloader.apply(null, path(
            'applescript            @shBrushAppleScript.js',
            'actionscript3 as3      @shBrushAS3.js',
            'bash shell             @shBrushBash.js',
            'coldfusion cf          @shBrushColdFusion.js',
            'cpp c                  @shBrushCpp.js',
            'c# c-sharp csharp      @shBrushCSharp.js',
            'css                    @shBrushCss.js',
            'delphi pascal          @shBrushDelphi.js',
            'diff patch pas         @shBrushDiff.js',
            'erl erlang             @shBrushErlang.js',
            'groovy                 @shBrushGroovy.js',
            'java                   @shBrushJava.js',
            'jfx javafx             @shBrushJavaFX.js',
            'js jscript javascript  @shBrushJScript.js',
            'perl pl                @shBrushPerl.js',
            'php                    @shBrushPhp.js',
            'text plain             @shBrushPlain.js',
            'py python              @shBrushPython.js',
            'ruby rails ror rb      @shBrushRuby.js',
            'sass scss              @shBrushSass.js',
            'scala                  @shBrushScala.js',
            'sql                    @shBrushSql.js',
            'vb vbnet               @shBrushVb.js',
            'xml xhtml xslt html    @shBrushXml.js'
            ));
        SyntaxHighlighter.defaults['toolbar'] = false;
        SyntaxHighlighter.all();
    });
    
</script>
</html>