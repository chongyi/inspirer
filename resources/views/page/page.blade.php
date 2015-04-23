@extends('common')
@section('title'){{ $article->title }} - @parent @stop
@section('meta')
<meta name="keywords" content="{{ $article->keywords }}">
<meta name="description" content="{{ $article->description }}">
<meta name="author" content="chongyi@xopns.com">
@stop
@section('body')
<ol class="breadcrumb">
    <li><a title="首页" href="/">首页</a></li>
    <li class="active">{{ $article->title }}</li>
</ol>
<article class="c-post-container">
    <div class="page-information">
        <h1>{{ $article->title }}</h1>
        <div>
            {!! \App\Inspirer\ArticleProcess::getContent($article->description) !!}
        </div>
    </div>
    <div class="c-post c-page-post">
        <h1 class="c-post-title"><a title="{{ $article->title }}">{{ $article->title }}</a></h1>
        <div class="c-post-content">
            {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
        </div>
    </div>
    
</article>

@stop