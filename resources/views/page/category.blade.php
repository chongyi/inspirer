@extends('common')
@section('title'){{ $category->display_name }} - @parent @stop
@section('meta')
<meta name="keywords" content="{{ $category->display_name }}">
<meta name="description" content="{{ $category->description }}">
<meta name="author" content="chongyi@xopns.com">
@stop

@section('body')
    <nav>
        <ol class="am-breadcrumb">
            <li><a title="首页" href="/">首页</a></li>
            <li class="am-active">{{ $category->display_name }}</li>
        </ol>
    </nav>
    <!-- 最新最热文章聚合展示区 -->
    <div class="am-g">
        <!-- 文章列表区 -->
        <div class="am-u-md-8">
            <section class="insp-d-article-list">
                <h1>文章列表</h1>
                <div class="insp-d-article-list-body">
                    @forelse($articles as $article)
                        <article>
                            <header>
                                <h1><a title="{{ $article->title }}" href="{{ route('show-article', ['name' => $article->name ?: $article->id]) }}">{{ $article->title }}</a></h1>
                                <div class="insp-d-article-info">
                                    <span class="insp-d-meta"><time class="am-icon-calendar" datetime="{{ date('Y-m-dTH:i', strtotime($article->created_at)) }}" pubdate> {{ date('Y-m-d H:i', strtotime($article->created_at)) }}</time></span>
                                    <span class="insp-d-meta">来自于分类 <a title="{{ $article->category->display_name }}" href="{{ route('show-category-article-list', ['name' => $article->category->name ?: $article->category->id]) }}">{{ $article->category->display_name }}</a></span>
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
                                {!! \App\Inspirer\ArticleProcess::getSummary($article->content) !!}
                            </div>
                            <footer class="am-text-right">
                                <a title="{{ $article->title }}" href="{{ route('show-article', ['name' => $article->name ?: $article->id]) }}#page-break-anchor" class="btn btn-primary">点击阅读全文</a>
                            </footer>
                        </article>
                    @empty
                    @endforelse
                </div>
                {!! $articles->render() !!}
            </section>
        </div>
        <!-- 左边栏 -->
        @include('widget', ['beforeColumn' => ['widget/category-introduce']])
    </div>
@stop