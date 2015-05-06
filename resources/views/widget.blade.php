<div class="widget-container">
    <div class="widget category-view-widget">
        <h1>分类</h1>
        <ul>
            @forelse($categories as $category)
            <li><a title="{{ $category->display_name }}" href="@if(!empty($category->name)){{ url('category', $category->name) }}@else{{ url('category', $category->id) }}@endif">{{ $category->display_name }} ({{ $category->articles->count() }})</a></li>
            @empty
            @endforelse
        </ul>
    </div>
    <div class="widget category-view-widget">
        <h1>标签</h1>
        <ul>
            @forelse($tags as $tag)
            <li><a title="{{ $tag->display_name }}" href="@if(!empty($tag->name)){{ url('tag', $tag->name) }}@else{{ url('tag', $tag->id) }}@endif">{{ $tag->display_name }} ({{ $tag->articles->count() }})</a></li>
            @empty
            @endforelse
        </ul>
    </div>
</div>