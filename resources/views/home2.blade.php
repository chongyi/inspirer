@extends('common')
@section('meta')
<meta name="keywords" content="灵感,inspirer,php,开发,学习,博客,blog,xopns">
<meta name="description" content="生活，感之粼粼，问之潢潢。">
@stop
@section('body')
<div class="article-list">
	@forelse($articles as $article)
	<div class="article-container">
		<ul class="article-information">
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
		<article>
            <a title="{{ $article->title }}" href="{{ url('article', $article->id) }}" class="article-title"><h1>{{ $article->title }}</h1></a>
			<div class="article-body">
				{!! \App\Inspirer\ArticleProcess::getSummary($article->content, $parse) !!}
			</div>
			<div class="article-control">
				<a title="{{ $article->title }}" href="{{ url('article', $article->id) }}#page-break-anchor" class="btn btn-primary">Read more</a>
			</div>
		</article>
	</div>
	@empty
	@endforelse

	{!! $articles->render() !!}
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