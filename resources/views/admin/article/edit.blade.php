@extends('admin.base')
@section('header')
<link rel="stylesheet" type="text/css" href="/static/plugins/editor-md/css/editormd.min.css">
<script type="text/javascript" src="/static/plugins/editor-md/editormd.min.js"></script>
<script type="text/javascript" src="/static/js/dialog-plus-min.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/ui-dialog.css">
@stop
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
    <div class="col-md-12">
        <form method="post" action="{{ url(isset($article) ? "admin/article/{$article->id}" : 'admin/article') }}" id="article-edit">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(isset($article))<input type="hidden" name="_method" value="PUT">@endif
            <div class="panel panel-default">
                <div class="panel-heading">文章</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>标题</label>
                                <input class="form-control" placeholder="输入文章标题" name="title" value="@if(old('title')){{ old('title') }}@elseif(isset($article)){{ $article->title }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>名称</label>
                                <input class="form-control" placeholder="输入文章名称" name="name" value="@if(old('name')){{ old('name') }}@elseif(isset($article)){{ $article->name }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>分类</label>
                                <select class="form-control" name="category_id">
                                    <option value="0" @if(old('category_id') === 0) selected @elseif(isset($article) && $article->category_id == 0) selected @endif>独立页面</option>
                                    @forelse($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @elseif(isset($article) && $article->category_id == $category->id) selected @endif>{{ $category->display_name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label>内容</label>
                        <div id="content">
                            <textarea>@if(old('content')){{ old('content') }}@elseif(isset($article)){{ \App\Inspirer\ArticleProcess::recallArticle($article->content) }}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>标签</label>
                        <div class="row">
                            <div class="col-md-12">
                                @forelse($tags as $tag)
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="tag[]" value="{{ $tag->id }}" @if(isset($article) && in_array($tag->id, $tagSelect)) checked="checked" @endif> {{ $tag->display_name }}
                                </label>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>关键字</label>
                                <input class="form-control" placeholder="输入文章关键字，每个关键字用“,”（半角逗号）隔开" name="keywords" value="@if(isset($article)){{ $article->keywords }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>描述</label>
                                <textarea name="description" class="form-control">@if(old('description')){{ old('description') }}@elseif(isset($article)){{ $article->description }}@endif</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-1">
                                <label>置顶</label>
                                <input name="sort" type="number" class="form-control" value="@if(isset($article)){{ $article->sort }}@else{{ '0' }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>可视</label>
                                <select class="form-control" name="display">
                                    <option value="1" @if(isset($article) && $article->display) selected @endif>可视</option>
                                    <option value="0" @if(isset($article) && !$article->display) selected @endif>不可视</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>选择关联文章</label>
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#select-relate-window">选择关联文章</button>
                                <div class="modal fade" id="select-relate-window" role="dialog" aria-labelledby="select-relate-window-l">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p>请选择</p>
                                                        <div id="relate-articles-container">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>已选择</p>
                                                        <div>
                                                            <ul class="list-group" id="relate-select-articles">

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var editor;
    $(function() {
        editor = editormd('content', {
            width: '100%',
            height: 400,
            path: '/static/plugins/editor-md/lib/',
            emoji: true,
            flowChart : true,
            tex  : true,
            htmlDecode : true,
            htmlDecode : "style,script,iframe,sub,sup",
            imageUpload : true,
            imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadToken : '{{ csrf_token() }}',
            imageUploadURL : "/admin/upload",
        });
    });
</script>
<script type="text/javascript" src="/assets/mustache/mustache.js"></script>
<script type="text/x-template" id="relate-article-item">
<ul class="list-group">
    @{{#list}}
    <li class="list-group-item" data-article-id="@{{ id }}">@{{title}}</li>
    @{{/list}}
</ul>
</script>
<script>
    $(document).ready(function () {
        $.getJSON('{{ route('admin.dataset.articles') }}', function(result) {
            $('#relate-articles-container').html(Mustache.render($('#relate-article-item').text(), result));
        });

        $(document).on('click', '#relate-articles-container li', function () {
            $('#relate-select-articles').append(this);
        });

        $(document).on('click', '#relate-select-articles li', function () {
            $('#relate-articles-container ul').append(this);
        });


    });
</script>
@stop