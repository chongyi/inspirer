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
        <form method="post" action="{{ url(isset($cat) ? "admin/category/{$cat->id}" : 'admin/category') }}" id="category-edit">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(isset($cat))<input type="hidden" name="_method" value="PUT">@endif
            <div class="panel panel-default">
                <div class="panel-heading">文章</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>标题</label>
                                <input class="form-control" placeholder="输入分类标题" name="display_name" value="@if(old('display_name')){{old('display_name')}}@elseif(isset($cat)){{ $cat->display_name }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>名称</label>
                                <input class="form-control" placeholder="输入分类名，只允许英文、数字、-和_" name="name" value="@if(old('name')){{old('name')}}@elseif(isset($cat)){{ $cat->name }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>父分类</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">不选择父分类</option>
                                    @forelse($categories as $category)
                                        @if(isset($cat) && $category['id'] == $cat->id)<?php continue ?>@endif
                                    <option value="{{ $category['id'] }}" @if(isset($cat) && $cat->parent_id == $category['id']) selected @endif>{{ $category['display_name'] }}</option>
                                        @if(!empty($category['subset']))
                                            @include('admin.category.catsubset', ['space' => '&nbsp;&nbsp;&nbsp;&nbsp;', 'categories' => $category['subset'], 'cat' => isset($cat) ? $cat : null]);
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>      
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>描述</label>
                                <textarea name="description" class="form-control">@if(isset($cat)){{ $cat->description }}@endif</textarea>
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