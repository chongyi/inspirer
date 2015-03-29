@foreach($categories as $category)
<option value="{{ $category['id'] }}" @if(isset($article) && $article->category_id == $category['id']) selected @endif>{{ $space }}{{ $category['display_name'] }}</option>
    @if(!empty($category['subset']))
        @include('admin.article.catsubset', ['space' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $space, 'categories' => $category['subset'], 'article' => isset($article) ? $article : null]);
    @endif
@endforeach