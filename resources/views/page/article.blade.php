@extends('common')

@section('body')
    <div class="article-container">
        <ul class="article-information">
            <li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
            <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
            <li><i class="fa fa-inbox"></i>{{ $article->category->display_name }}</li>
        </ul>
        <article>
            <a href="" class="article-title"><h1>{{ $article->title }}</h1></a>
            <div class="article-body">
                {!! \App\Inspirer\ArticleProcess::getContent($article->content) !!}
            </div>
        </article>
    </div>
@stop