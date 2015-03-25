@extends('common')

@section('body')
<div class="row">
	<div class="col-md-offset-2 col-md-8">
		@forelse($articles as $article)
		<article>
			<div class="default-content-brand">
	            <h1>{{ $article->title }}</h1>
	        </div>
			<div>
				{{ $article->description }}
			</div>
		</article>
		@empty
		@endforelse
	</div>
</div>
@stop