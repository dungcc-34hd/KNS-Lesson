@extends('admin::layouts.master')
@section('title')
    Detail Provincial
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Provincial</li>
        </ol>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-check-square-o text-black"></i>

                            <h3 class="box-title">Information</h3>
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
                                                {{$provincial->id}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>
                                                {{$provincial->name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Area</td>
                                            <td>
                                                {{!empty($provincial->area) ? $provincial->area->name : ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-info"
                                                       href="{{route('admin.provincial.edit',['id' => $provincial->id])}}"
                                                       title="Edit">
                                                        <i class="ace-icon fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger delete-object"
                                                       title="Delete"
                                                       object_id="{{$provincial->id}}"
                                                       object_name="{{$provincial->name}}">
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
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection