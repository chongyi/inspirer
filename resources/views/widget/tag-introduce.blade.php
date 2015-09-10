<div class="insp-d-column">
    <div class="insp-d-header">
        <div class="insp-d-title insp-d-title-orange">{{ $tag->display_name }}</div>
    </div>
    <div class="insp-d-body">
        {!! \App\Inspirer\ArticleProcess::getContent($tag->description) !!}
    </div>
</div>