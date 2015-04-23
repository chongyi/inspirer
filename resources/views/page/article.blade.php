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
    <li><a title="{{ $article->category->display_name }}" href="{{ url('category', $article->category_id) }}">{{ $article->category->display_name }}</a></li>
    <li class="active">{{ $article->title }}</li>
</ol>
@stop
@section('body')

<div class="c-main">
    
    <div class="c-post-list">
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
                    {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
                </div>
            </div>
            
        </article>
        <!-- 多说评论框 start -->
        <div class="ds-thread" data-thread-key="{{ $article->id }}" data-title="{{ $article->title  }}" data-url="{{ url('article', [$article->id])  }}"></div>
        <!-- 多说评论框 end -->
        <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
        <script type="text/javascript">
        var duoshuoQuery = {short_name:"insp"};
            (function() {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                 || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
        </script>
        <!-- 多说公共JS代码 end -->
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