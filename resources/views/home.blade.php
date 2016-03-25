@extends('common')
@section('meta')
<meta name="keywords" content="灵感,inspirer,php,开发,学习,博客,blog,xopns">
<meta name="description" content="生活，感之粼粼，问之潢潢。">
<meta property="qc:admins" content="30723573677616306470" />
@stop
@section('body')
    @if(!is_null($recommends))
    <!-- 首页推荐文章展示区 -->
    <div class="am-g insp-d-recommend">
        <article class="am-u-md-8 insp-d-top-line">
            <header>
                <small>推荐阅读</small>
                <h1><a title="{{ $firstRecommend->title }}" href="{{ route('show-article', ['name' => $firstRecommend->name ?: $firstRecommend->id]) }}">{{ $firstRecommend->title }}</a></h1>
                <div class="insp-d-top-line-info">
                    <span class="insp-d-meta"><time class="am-icon-calendar" datetime="{{ date('Y-m-dTH:i', strtotime($firstRecommend->created_at)) }}" pubdate> {{ date('Y-m-d H:i', strtotime($firstRecommend->created_at)) }}</time></span>
                    <span class="insp-d-meta">来自于分类 <a title="{{ route('show-category-article-list', ['name' => $firstRecommend->category->name ?: $firstRecommend->category->id]) }}">{{ $firstRecommend->category->display_name }}</a></span>
                </div>
            </header>
            <div class="insp-d-top-line-body">
                {!! \App\Inspirer\ArticleProcess::getSummary($firstRecommend->description, $parse) !!}
                <a title="{{ $firstRecommend->title }}" href="{{ route('show-article', ['name' => $firstRecommend->name ?: $firstRecommend->id]) }}">【阅读全文】</a>
            </div>
        </article>
        <div class="am-u-md-4">
            <ul class="insp-d-recommend-list">
                @foreach($recommends as $recommend)
                <li>
                    <strong><a href="{{ route('show-article', ['name' => $recommend->name ?: $recommend->id]) }}" title="{{ $recommend->title }}">{{ $recommend->title }}</a></strong>
                    <div class="insp-d-recommend-item-info">
                        <span class="insp-d-meta"><time class="am-icon-calendar" datetime="{{ date('Y-m-dTH:i', strtotime($recommend->created_at)) }}" pubdate> {{ date('Y-m-d H:i', strtotime($recommend->created_at)) }}</time></span>
                        <span class="insp-d-meta">来自于分类 <a title="{{ $recommend->category->display_name }}" href="{{ route('show-category-article-list', ['name' => $recommend->category->name ?: $recommend->category->id]) }}">{{ $recommend->category->display_name }}</a></span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- 最新最热文章聚合展示区 -->
    <div class="am-g">
        <!-- 文章列表区 -->
        <div class="am-u-md-8">
            <section class="insp-d-article-list">
                <h1>最新文章</h1>
                <div class="insp-d-article-list-body">
                    @forelse($articles as $article)
                        <article>
                            <header>
                                <h1><a title="{{ $article->title }}" href="{{ route('show-article', ['name' => $article->name ?: $article->id]) }}">{{ $article->title }}</a></h1>
                                <div class="insp-d-article-info">
                                    <span class="insp-d-meta"><time class="am-icon-calendar" datetime="{{ date('Y-m-dTH:i', strtotime($article->created_at)) }}" pubdate> {{ date('Y-m-d H:i', strtotime($article->created_at)) }}</time></span>
                                    <span class="insp-d-meta">来自于分类 <a title="{{ route('show-category-article-list', ['name' => $article->category->name ?: $article->category->id]) }}">{{ $article->category->display_name }}</a></span>
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
                                {!! \App\Inspirer\ArticleProcess::getSummary($article->content, $parse) !!}
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
        @include('widget')
    </div>
@stop