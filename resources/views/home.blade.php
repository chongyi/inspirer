@extends('common')

@section('body')
	@forelse($articles as $article)
	<div class="article-container">
		<ul class="article-information">
			<li><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</li>
			<li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($article->created_at)) }}</li>
			<li><i class="fa fa-inbox"></i>{{ $article->category->display_name }}</li>
		</ul>
		<article>
            <a href="{{ url('article', $article->id) }}" class="article-title"><h1>{{ $article->title }}</h1></a>
			<div class="article-body">
				{!! \App\Inspirer\ArticleProcess::getSummary($article->content, $parse) !!}
			</div>
			<div class="article-control">
				<a href="{{ url('article', $article->id) }}#page-break-anchor" class="btn btn-primary">Read more</a>
			</div>
		</article>
	</div>
	@empty
	@endforelse
@stop