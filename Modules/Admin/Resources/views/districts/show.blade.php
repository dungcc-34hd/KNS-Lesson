@extends('admin::layouts.master')
@section('title')
    Detail District
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Quận/Huyện</li>
        </ol>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-check-square-o text-black"></i>

                            <h3 class="box-title">Thông tin</h3>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="simple-table"
                                           class="table table-bordered table-hover table-striped">
                                        <tbody>
                                        <tr>
                                            <td>ID</td>
                                            <td>
                                                {{$district->id}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quận/Huyện</td>
                                            <td>
                                                {{$district->name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tỉnh/Thành phố</td>
                                            <td>
                                                {{!empty($district->provincial) ? $district->provincial->name : ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-info"
                                                       href="{{route('admin.district.edit',['id' => $district->id])}}"
                                                       title="Edit">
                                                        <i class="ace-icon fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger delete-object"
                                                       title="Delete"
                                                       object_id="{{$district->id}}"
                                                       object_name="{{$district->name}}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                                <a href="{{route('admin.district.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                        </div>  
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection