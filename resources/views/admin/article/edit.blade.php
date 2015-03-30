@extends('admin.base')
@section('header')
<link rel="stylesheet" type="text/css" href="/static/plugins/editor-md/css/editormd.min.css">
<script type="text/javascript" src="/static/plugins/editor-md/editormd.min.js"></script>
@stop
@section('content')
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
                                <input class="form-control" placeholder="输入文章标题" name="title" value="@if(isset($article)){{ $article->title }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>分类</label>
                                <select class="form-control" name="category_id">
                                    <option value="0" @if(isset($article) && $article->category_id == 0) selected @endif>独立页面</option>
                                    @forelse($categories as $category)
                                    <option value="{{ $category->id }}" @if(isset($article) && $article->category_id == $category->id) selected @endif>{{ $category->display_name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label>内容</label>
                        <div id="content">
                            <textarea>@if(isset($article)){{ \App\Inspirer\ArticleProcess::recallArticle($article->content) }}@endif</textarea>
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
                                <textarea name="description" class="form-control">@if(isset($article)){{ $article->description }}@endif</textarea>
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
@stop