@foreach($categories as $category)
    @if(isset($cat) && $category['id'] == $cat->id)<?php continue ?>@endif
<option value="{{ $category['id'] }}" @if(isset($cat) && $cat->parent_id == $category['id']) selected @endif>{{ $space }}{{ $category['display_name'] }}</option>
    @if(!empty($category['subset']))
        @include('admin.category.catsubset', ['space' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $space, 'categories' => $category['subset'], 'cat' => isset($cat) ? $cat : null]);
    @endif
@endforeach