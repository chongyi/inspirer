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
    <div class="col-md-12">
        <form method="post" action="{{ url(isset($tag) ? "admin/tag/{$tag->id}" : 'admin/tag') }}" id="article-edit">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(isset($tag))<input type="hidden" name="_method" value="PUT">@endif
            <div class="panel panel-default">
                <div class="panel-heading">标签</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>标题</label>
                                <input class="form-control" placeholder="标签显示的标题" name="display_name" value="@if(old('display_name')){{ old('display_name') }}@elseif(isset($tag)){{ $tag->display_name }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>名称</label>
                                <input class="form-control" placeholder="用于在地址栏快速访问" name="name" value="@if(old('name')){{ old('name') }}@elseif(isset($tag)){{ $tag->name }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>描述</label>
                                <textarea name="description" class="form-control">@if(old('description')){{ old('description') }}@elseif(isset($tag)){{ $tag->description }}@endif</textarea>
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
@stop