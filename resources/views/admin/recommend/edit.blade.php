@extends('admin.base')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    添加关联文章
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.recommend.put-article') }}" method="post">
                        <div class="form-group">
                            <label>选择文章 ID</label>
                            <select class="form-control" name="article_id">
                                @forelse($articleList as $article)
                                    <option value="{{ $article->id }}">{{ $article->title }}</option>
                                @empty
                                    <option>没有可选项</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>排序</label>
                            <input class="form-control" type="number" value="0" name="sort">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary">保存</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    关联文章列表
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->article_id }}</td>
                                <td>{{ $article->article->title }}</td>
                                <td><button type="button" class="btn btn-danger btn-xs op-delete" data-recommend-id="{{ $article->id }}">移除</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">没有记录</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.op-delete', function () {
            var id = $(this).attr('data-recommend-id');

            $.ajax({
                url: '{{ route('admin.recommend.delete-article') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {id: id},
                type: 'DELETE',
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        window.location.reload();
                    }
                }
            });
        });
    </script>
@stop