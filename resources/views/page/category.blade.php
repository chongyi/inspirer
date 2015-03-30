@extends('common')
@section('title'){{ $category->display_name }} - @parent @stop
@section('head')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">{{ $category->display_name }}</li>
</ol>
@stop

@section('body')
    <div class="category-data">
        <div class="category-information">
            <h1>{{ $category->display_name }}</h1>
            <div>
                {!! \App\Inspirer\ArticleProcess::getContent($category->description) !!}
            </div>
        </div>
        <ul>
            @forelse($category->articles as $article)
            <li>
                <a href="{{ url('article', $article->id) }}"><h1>{{ $article->title }}</h1></a>
                <ul class="article-information">
                    <li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-inbox"></i>{{ $article->category->display_name }}</li>
                </ul>
            </li>
            @empty
            @endforelse
        </ul>
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