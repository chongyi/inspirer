@extends('common')
@section('meta')
<meta name="keywords" content="灵感,inspirer,php,开发,学习,博客,blog,xopns">
<meta name="description" content="生活，感之粼粼，问之潢潢。">
@stop
@section('body')
<div class="c-main">
    
    <div class="c-post-list">
        @forelse($articles as $article)
        <article class="c-post-container">
            <div class="c-post-info">
                <ul class="c-post-meta">
                    <li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-inbox"></i><a title="{{ $article->category->display_name }}" href="{{ url('category', $article->category_id) }}">{{ $article->category->display_name }}</a></li>
                    @if($article->sort > 0)<li><i class="fa fa-arrow-up"></i>TOP</li>@endif
                    @if(count($article->tags))
                    <li><i class="fa fa-tags"></i>
                        @foreach($article->tags as $tag)
                        <span class="label label-default"><a href="{{ url('tag', $tag->id) }}">{{ $tag->display_name }}</a></span>
                        @endforeach
                    </li>
                    @endif
                </ul>
            </div>
            <div class="c-post">
                <h1 class="c-post-title"><a title="{{ $article->title }}" href="{{ url('article', $article->id) }}">{{ $article->title }}</a></h1>
                <div class="c-post-content">
                    {!! \App\Inspirer\ArticleProcess::getSummary($article->content, $parse) !!}

                    <div class="post-control">
                        <a title="{{ $article->title }}" href="{{ url('article', $article->id) }}#page-break-anchor" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            
        </article>
        @empty
        @endforelse
    </div>
    <div  class="c-post-list-footer">
        {!! $articles->render() !!}
    </div>
    
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