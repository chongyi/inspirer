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
<div class="article-container">
    <ul class="article-information">
        <li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
        <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
        <li><i class="fa fa-inbox"></i><a href="{{ url('category', $article->category->id) }}">{{ $article->category->display_name }}</a></li>
        @if(count($article->tags))
        <li><i class="fa fa-tags"></i>
            @foreach($article->tags as $tag)
            <span class="label label-default"><a href="{{ url('tag', $tag->id) }}">{{ $tag->display_name }}</a></span>
            @endforeach
        </li>
        @endif
    </ul>
    <article>
        <a href="#" title="{{ $article->title }}" class="article-title"><h1>{{ $article->title }}</h1></a>
        <div class="article-body">
            {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
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