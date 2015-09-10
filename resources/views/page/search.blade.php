@extends('common')
@section('title'){{ $category->display_name }} - @parent @stop
@section('meta')
    <meta name="keywords" content="{{ $category->display_name }}">
    <meta name="description" content="{{ $category->description }}">
    <meta name="author" content="chongyi@xopns.com">
    <style>
        em { color: #d41c30; }
    </style>
@stop

@section('body')
    <nav>
        <ol class="am-breadcrumb">
            <li><a title="首页" href="/">首页</a></li>
            <li class="am-active">搜索：{{ $searchKeyword }}</li>
        </ol>
    </nav>
    <!-- 最新最热文章聚合展示区 -->
    <div class="am-g">
        <!-- 文章列表区 -->
        <div class="am-u-md-8">
            <section class="insp-d-article-list">
                <h1>搜索结果</h1>
                <div class="insp-d-article-list-body">
                    @forelse($articles as $article)
                        <article>
                            <header>
                                <h1><a title="{{ $article->originalTitle }}" href="{{ route('show-article', ['name' => $article->name ?: $article->id]) }}">{!! $article->title !!}</a></h1>
                            </header>
                            <div class="insp-d-article-body">
                                <p>{!! $article->content !!}</p>
                            </div>
                        </article>
                    @empty
                    @endforelse
                </div>
                <ul class="am-pagination">
                    <li @if(is_null($prev)) class="am-disabled" @endif><a @if(!is_null($prev)) href="{{ $prev }}" @endif>&laquo; Prev</a></li>
                    <li @if(is_null($next)) class="am-disabled" @endif><a @if(!is_null($next)) href="{{ $next }}" @endif>Next &raquo;</a></li>
                </ul>
            </section>
        </div>
        <!-- 左边栏 -->
        @include('widget')
    </div>
@stop