@foreach($categories as $category)
<tr>
    <td>{{ $category['id'] }}</td>
    <td>{{ $space }}{{ $category['display_name'] }}</td>
    <td>{{ $category['name'] }}</td>
    <td>{{ $category['description'] }}</td>
    <td>{{ $category['created_at'] }}</td>
    <td>{{ $category['updated_at'] }}</td>
    <td>
        <a href="{{ url("admin/category/{$category['id']}") }}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> 查看</a>
        <a href="{{ url("admin/category/{$category['id']}/edit") }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> 编辑</a>
        <button type="button" class="btn btn-danger btn-xs op-delete" data-target="{{ url("admin/category/{$category['id']}") }}"><i class="fa fa-trash-o"></i> 删除</button>
    </td>
</tr>
    @if(!empty($category['subset']))
        @include('admin.category.subset', ['space' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $space, 'categories' => $category['subset']])
    @endif
@endforeach