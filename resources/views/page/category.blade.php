@extends('common')
@section('title'){{ $category->display_name }} - @parent @stop
@section('meta')
<meta name="keywords" content="{{ $category->display_name }}">
<meta name="description" content="{{ $category->description }}">
<meta name="author" content="chongyi@xopns.com">
@stop

@section('body')
<ol class="breadcrumb">
    <li><a title="首页" href="/">首页</a></li>
    <li class="active">{{ $category->display_name }}</li>
</ol>
    <div class="category-data">
        <div class="category-information">
            <h1>{{ $category->display_name }}</h1>
            <div>
                {!! \App\Inspirer\ArticleProcess::getContent($category->description) !!}
            </div>
        </div>
        <ul class="list">
            @forelse($articles as $article)
            <li>
                <a href="@if(!empty($article->name)){{ url($article->name) }}@else{{ url('article', $article->id) }}@endif" title="{{ $article->title }}"><h1>{{ $article->title }}</h1></a>
                <ul class="article-information">
                    <li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
                    <li><i class="fa fa-inbox"></i>{{ $article->category->display_name }}</li>
                    @if(count($article->tags))
                    <li><i class="fa fa-tags"></i>
                        @foreach($article->tags as $tag)
                        <span class="label label-default"><a href="@if(!empty($tag->name)){{ url('tag', $tag->name) }}@else{{ url('tag', $tag->id) }}@endif">{{ $tag->display_name }}</a></span>
                        @endforeach
                    </li>
                    @endif
                </ul>
            </li>
            @empty
            @endforelse
        </ul>

        <div  class="c-post-list-footer">
            {!! $articles->render() !!}
        </div>
    </div>

@include('widget')
@stop