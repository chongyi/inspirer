@extends('common')
@section('title'){{ $article->title }} - @parent @stop
@section('meta')
    <meta name="keywords" content="{{ $article->keywords }}">
    <meta name="description" content="{{ $article->description }}">
    <meta name="author" content="chongyi@xopns.com">
@stop

@section('body')
    <!--  面包屑导航 -->
    <nav>
        <ul class="am-breadcrumb">
            <li><a title="首页" href="/">首页</a></li>
            <li class="am-active">{{ $article->title }}</li>
        </ul>
    </nav>

    <!-- 最新最热文章聚合展示区 -->
    <div class="am-g">
        <!-- 文章列表区 -->
        <div class="am-u-md-8">
            <article class="insp-d-article">
                <header>
                    <h1 class="insp-d-title">{{ $article->title }}</h1>
                    <div class="insp-d-article-info">
                    </div>
                </header>
                <div class="insp-d-article-body">
                    {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
                </div>
                <footer>
                    <div class="insp-d-article-footer-notice-list">

                    </div>
                </footer>
            </article>
        </div>

        @include('widget')
    </div>
@stop