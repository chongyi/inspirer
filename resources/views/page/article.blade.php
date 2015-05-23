@extends('common')
@section('title'){{ $article->title }} - @parent @stop
@section('meta')
<meta name="keywords" content="{{ $article->keywords }}">
<meta name="description" content="{{ $article->description }}">
<meta name="author" content="chongyi@xopns.com">
@stop

@section('body')

<div class="c-main">
    <ol class="breadcrumb">
    <li><a title="首页" href="/">首页</a></li>
    <li><a title="{{ $article->category->display_name }}" href="{{ url('category', $article->category_id) }}">{{ $article->category->display_name }}</a></li>
    <li class="active">{{ $article->title }}</li>
</ol>
    <div class="c-post-list">
        <article class="c-post-container">
            <div class="c-post-info">
                <ul class="c-post-meta">
                    <li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-inbox"></i><a title="{{ $article->category->display_name }}" href="@if(!empty($article->category->name)){{ url('category', $article->category->name) }}@else{{ url('category', $article->category->id) }}@endif">{{ $article->category->display_name }}</a></li>
                    @if($article->sort > 0)<li><i class="fa fa-arrow-up"></i>TOP</li>@endif
                    @if(count($article->tags))
                    <li><i class="fa fa-tags"></i>
                        @foreach($article->tags as $tag)
                        <span class="label label-default"><a href="@if(!empty($tag->name)){{ url('tag', $tag->name) }}@else{{ url('tag', $tag->id) }}@endif">{{ $tag->display_name }}</a></span>
                        @endforeach
                    </li>
                    @endif
                </ul>
            </div>
            <div class="c-post">
                <h1 class="c-post-title"><a title="{{ $article->title }}" href="@if(!empty($article->name)){{ url($article->name) }}@else{{ url('article', $article->id) }}@endif">{{ $article->title }}</a></h1>
                <div class="c-post-content">
                    {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
                </div>
                <div class="c-post-footer">
                    <nav class="c-post-navigation">
                        <div>上一篇：@if($article->prev() != null) <a title="{{ $article->prev()->title }}" href="@if(!empty($article->prev()->name)){{ url($article->prev()->name) }}@else{{ url('article', $article->prev()->id) }}@endif">{{ $article->prev()->title }}</a> @else 没有咯 @endif</div>
                        <div>下一篇：@if($article->next() != null) <a title="{{ $article->next()->title }}" href="@if(!empty($article->next()->name)){{ url($article->next()->name) }}@else{{ url('article', $article->next()->id) }}@endif">{{ $article->next()->title }}</a> @else 没有咯 @endif</div>
                    </nav>
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
@include('widget')
@stop