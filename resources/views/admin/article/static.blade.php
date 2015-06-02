@extends('admin.base')
@section('header')
<script type="text/javascript" src="/static/js/dialog-plus-min.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/ui-dialog.css">
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <form action="{{ url('admin/static') }}" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">生成静态页面</div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="panel-footer">
               <button class="btn btn-primary"><i class="fa fa-pagelines"></i> 开始</button>
            </div>
        </div>
    </div>
    </form>
</div>
@stop