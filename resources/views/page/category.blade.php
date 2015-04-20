@extends('common')
@section('title'){{ $category->display_name }} - @parent @stop
@section('meta')
<meta name="keywords" content="{{ $category->display_name }}">
<meta name="description" content="{{ $category->description }}">
<meta name="author" content="chongyi@xopns.com">
@stop
@section('head')
<ol class="breadcrumb">
    <li><a title="首页" href="/">首页</a></li>
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
        <ul class="list">
            @forelse($articles as $article)
            <li>
                <a href="{{ url('article', $article->id) }}" title="{{ $article->title }}"><h1>{{ $article->title }}</h1></a>
                <ul class="article-information">
                    <li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-inbox"></i>{{ $article->category->display_name }}</li>
                    @if(count($article->tags))
                    <li><i class="fa fa-tags"></i>
                        @foreach($article->tags as $tag)
                        <span class="label label-default"><a href="{{ url('tag', $tag->id) }}">{{ $tag->display_name }}</a></span>
                        @endforeach
                    </li>
                    @endif
                </ul>
            </li>
            @empty
            @endforelse
        </ul>

        {!! $articles->render() !!}
    </div>

<div class="widget-container">
    <div class="widget category-view-widget">
        <h1>分类</h1>
        <ul>
            @forelse($categories as $category)
            <li><a title="{{ $category->display_name }}" href="{{ url('category', $category->id) }}">{{ $category->display_name }} ({{ $category->articles->count() }})</a></li>
            @empty
            @endforelse
        </ul>
    </div>
    <div class="widget category-view-widget">
        <h1>标签</h1>
        <ul>
            @forelse($tags as $tag)
            <li><a title="{{ $tag->display_name }}" href="{{ url('tag', $tag->id) }}">{{ $tag->display_name }} ({{ $tag->articles->count() }})</a></li>
            @empty
            @endforelse
        </ul>
    </div>
</div>
@stop