@extends('admin.base')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        站点信息
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>文章数</td>
                                <td>{{ $total['article'] }}</td>
                            </tr>
                            <tr>
                                <td>页面数</td>
                                <td>{{ $total['page'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        站点设置
                    </div>
                    <div class="panel-body">
                        <form>
                            <div class="form-group">
                                <label>站点关键字</label>
                                <input class="form-control" name="site-keywords" type="text">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop