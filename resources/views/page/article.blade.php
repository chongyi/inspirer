@extends('common')
@section('title'){{ $article->title }} - @parent @stop
@section('head')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li><a href="{{ url('category', $article->category_id) }}">{{ $article->category->display_name }}</a></li>
    <li class="active">{{ $article->title }}</li>
</ol>
@stop
@section('body')
<div class="article-container">
    <ul class="article-information">
        <li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
        <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
        <li><i class="fa fa-inbox"></i>{{ $article->category->display_name }}</li>
    </ul>
    <article>
        <a href="" class="article-title"><h1>{{ $article->title }}</h1></a>
        <div class="article-body">
            {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
        </div>
    </article>
</div>
<div class="widget-container">
    <div class="widget category-view-widget">
        <h1>分类</h1>
        <ul>
            @forelse($categories as $category)
            <li><a href="{{ url('category', $category->id) }}">{{ $category->display_name }} ({{ $category->articles->count() }})</a></li>
            @empty
            @endforelse
        </ul>
    </div>
</div>
@stop