@extends('admin.base')
@section('header')
<script type="text/javascript" src="/static/js/dialog-plus-min.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/ui-dialog.css">
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">标签列表</div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th width="50">ID</th>
                        <th width="220">标题</th>
                        <th width="100">名称</th>
                        <th>摘要</th>
                        <th width="160">创建时间</th>
                        <th width="160">修改时间</th>
                        <th width="180">操作</th>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->display_name }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->description }}</td>
                            <td>{{ $tag->created_at }}</td>
                            <td>{{ $tag->updated_at }}</td>
                            <td>
                                <a href="{{ url("admin/tag/{$tag->id}") }}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> 查看</a>
                                <a href="{{ url("admin/tag/{$tag->id}/edit") }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> 编辑</a>
                                <button type="button" class="btn btn-danger btn-xs op-delete" data-target="{{ url("admin/tag/{$tag->id}") }}"><i class="fa fa-trash-o"></i> 删除</button>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="panel-footer">
                <a class="btn btn-primary" href="{{ url('admin/tag/create') }}"><i class="fa fa-plus"></i> 添加新标签</a>
            </div>
        </div>
        {!! $tags->render() !!}
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