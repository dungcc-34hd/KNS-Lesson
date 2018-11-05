@extends('admin::layouts.master')
@section('title')
    Detail Permission
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Permissions</li>
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
                                                {{$permission->id}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>
                                                {{$permission->name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Display Name</td>
                                            <td>
                                                {{$permission->display_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>
                                                {{$permission->description}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Created At</td>
                                            <td>
                                                {{$permission->created_at}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Updated At</td>
                                            <td>
                                                {{$permission->updated_at}}
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