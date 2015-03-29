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
        <form method="post" action="{{ url(isset($nav) ? "admin/nav/{$nav->id}" : 'admin/nav') }}" id="nav-edit">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(isset($nav))<input type="hidden" name="_method" value="PUT">@endif
            <div class="panel panel-default">
                <div class="panel-heading">导航</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>标题</label>
                                <input class="form-control" placeholder="输入分类标题" name="title" value="@if(old('title')){{old('title')}}@elseif(isset($nav)){{ $nav->title }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>链接</label>
                                <input class="form-control" placeholder="输入合法的URL地址" name="link" value="@if(old('link')){{old('link')}}@elseif(isset($nav)){{ $nav->link }}@endif">
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