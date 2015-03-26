@extends('admin.base')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">文章列表</div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th width="50">ID</th>
                        <th width="220">标题</th>
                        <th width="100">分类</th>
                        <th>摘要</th>
                        <th width="160">创建时间</th>
                        <th width="160">修改时间</th>
                        <th width="180">操作</th>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->category->display_name }}</td>
                            <td>{{ $article->description }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td>{{ $article->updated_at }}</td>
                            <td>
                                <a href="{{ url("admin/article/{$article->id}") }}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> 查看</a>
                                <a href="{{ url("admin/article/{$article->id}/edit") }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> 编辑</a>
                                <button type="button" class="btn btn-danger btn-xs op-delete" data-target="{{ url("admin/article/{$article->id}") }}"><i class="fa fa-trash-o"></i> 删除</button>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="panel-footer">
                <a class="btn btn-primary" href="{{ url('admin/article/create') }}"><i class="fa fa-plus"></i> 添加文章</a>
            </div>
        </div>
        {!! $articles->render() !!}
    </div>
</div>

@stop