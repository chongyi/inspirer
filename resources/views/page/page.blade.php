@extends('common')
@section('title'){{ $article->title }} - @parent @stop
@section('meta')
<meta name="keywords" content="{{ $article->keywords }}">
<meta name="description" content="{{ $article->description }}">
<meta name="author" content="chongyi@xopns.com">
@stop
@section('head')
<ol class="breadcrumb">
    <li><a title="首页" href="/">首页</a></li>
    <li class="active">{{ $article->title }}</li>
</ol>
@stop
@section('body')
<div class="article-container">
    <article>
        <ul class="page-information">
            <h1>{{ $article->title }}</h1>
            <div>
                {!! \App\Inspirer\ArticleProcess::getContent($article->description) !!}
            </div>
        </ul>
        <div class="article-body">
            {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
        </div>
    </article>
    
</div>

@stop