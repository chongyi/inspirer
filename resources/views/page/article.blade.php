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
            <li><a title="{{ $article->category->display_name }}" href="{{ route('show-category-article-list', ['name' => $article->category->name ?: $article->category->id]) }}">{{ $article->category->display_name }}</a></li>
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
                        <span class="insp-d-meta"><time class="am-icon-calendar" datetime="{{ date('Y-m-dTH:i', strtotime($article->created_at)) }}" pubdate> {{ date('Y-m-d H:i', strtotime($article->created_at)) }}</time></span>
                        <span class="insp-d-meta">来自于分类 <a title="{{ $article->category->display_name }}" href={{ route('show-category-article-list', ['name' => $article->category->name ?: $article->category->id]) }}">{{ $article->category->display_name }}</a></span>
                        @if($article->sort > 0)<span class="insp-d-meta"><i class="fa fa-arrow-up"></i>TOP</span>@endif
                        <span class="insp-d-meta"><i class="fa fa-tags"></i>
                            @if(count($article->tags))
                                @foreach($article->tags as $tag)
                                    <a href="{{ route('show-tag-article-list', ['name' => $tag->name ?: $tag->id]) }}"><span class="am-badge am-badge-default">{{ $tag->display_name }}</span></a>
                                @endforeach
                            @endif
                        </span>
                    </div>
                </header>
                <div class="insp-d-article-body">
                    {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
                </div>
                <footer>
                    <div class="insp-d-article-footer-notice-list">
                        <div class="insp-d-article-notice">
                            <p><strong>声明</strong></p>
                            <p>在转载或修改本文后发布的文章中注明原文来源信息的前提下，允许进行转载该篇文章或经修改后发布且不用告知本文作者。</p>
                        </div>
                    </div>
                    <ul class="am-pagination">
                    </ul>
                    <!-- 多说评论框 start -->
                    <div class="ds-thread" data-thread-key="{{ $article->id }}" data-title="{{ $article->title  }}" data-url="{{ route('show-article', ['name' => $article->id])  }}"></div>
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
                </footer>
            </article>
        </div>

        @include('widget')
    </div>
@stop