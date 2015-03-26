@extends('admin.base')
@section('header')
<link rel="stylesheet" type="text/css" href="/static/plugins/editor-md/css/editormd.min.css">
<script type="text/javascript" src="/static/plugins/editor-md/editormd.min.js"></script>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ url('admin/article') }}">
            <div class="panel panel-default">
                <div class="panel-heading">文章</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>内容</label>
                        <div id="editor">
                            <textarea style="display:none"></textarea>
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
        editor = editormd('editor', {
            width: '100%',
            height: 400,
            path: '/static/plugins/editor-md/lib/'
        });
    })
</script>
@stop