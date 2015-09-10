<div class="insp-d-column">
    <div class="insp-d-header">
        <div class="insp-d-title insp-d-title-orange">{{ $category->display_name }}</div>
    </div>
    <div class="insp-d-body">
        {!! \App\Inspirer\ArticleProcess::getContent($category->description) !!}
    </div>
</div>