@extends('admin.base')
@section('header')
<script type="text/javascript" src="/static/js/dialog-plus-min.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/ui-dialog.css">
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">分类列表</div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th width="50">ID</th>
                        <th width="220">标题</th>
                        <th width="220">名称</th>
                        <th>摘要</th>
                        <th width="160">创建时间</th>
                        <th width="160">修改时间</th>
                        <th width="180">操作</th>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->display_name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <a href="{{ url("admin/category/{$category->id}") }}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> 查看</a>
                                <a href="{{ url("admin/category/{$category->id}/edit") }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> 编辑</a>
                                <button type="button" class="btn btn-danger btn-xs op-delete" data-target="{{ url("admin/category/{$category->id}") }}"><i class="fa fa-trash-o"></i> 删除</button>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a class="btn btn-primary" href="{{ url('admin/category/create') }}"><i class="fa fa-plus"></i> 添加分类</a>
            </div>
        </div>
    </div>
</div>
<form id="_delete" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="DELETE">
</form>
<script type="text/javascript">
    $(document).on('click', '.op-delete', function(event) {
        event.preventDefault();
        var href = $(this).attr('data-target');

        dialog({
            title: '请再次确认',
            content: '你确认要删除该项？',
            okValue: '确定',
            ok: function() {
                $('#_delete').attr('action', href);
                $('#_delete').submit();
            },
            cancel: function() {},
            cancelValue: '取消'
        }).showModal();
    });
</script>
@stop