@extends('common')
@section('meta')
<meta name="keywords" content="灵感,inspirer,php,开发,学习,博客,blog,xopns">
<meta name="description" content="生活，感之粼粼，问之潢潢。">
@stop
@section('body')
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
                                    <span class="insp-d-meta"><time class="am-icon-calendar" datetime="{{ date('Y-m-dTH:s', strtotime($article->created_at)) }}" pubdate> {{ date('Y-m-d H:i', strtotime($article->created_at)) }}</time></span>
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