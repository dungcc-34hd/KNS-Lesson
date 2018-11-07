@extends('admin::layouts.master')
@section('title')
    Create Area
@endsection
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Area</li>
        </ol>
        <form action="{{route('admin.area.store')}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Area</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="description">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{route('admin.area.index')}}" type="button" class="btn btn-default">Go Back</a>
                    </div>
                </div>
            </section>
        </form>

    </div>
@endsection
