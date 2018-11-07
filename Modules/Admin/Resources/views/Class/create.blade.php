@extends('admin::layouts.master')
@section('title')
    Create School
@endsection
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">School</li>
        </ol>
        <form action="{{route('admin.class.store')}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">School</h3>
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
                                    <label>Grade Level @include('common.require')</label>
                                    <select  class="form-control" name="select-grade-level">
                                        <option value="">Select Grade Level</option>
                                        @foreach ($gradeLevels as $key => $gradeLevel)
                                            <option value="{{$gradeLevel->id}}">{{$gradeLevel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>School @include('common.require')</label>
                                    <select  class="form-control" name="select-school">
                                        <option value="">Select School</option>
                                        @foreach ($schools as $key => $school)
                                            <option value="{{$school->id}}">{{$school->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Quantity Student @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="number" class="form-control" name="quantity">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{route('admin.class.index')}}" type="button" class="btn btn-default">Go Back</a>
                    </div>
                </div>
            </section>
        </form>

    </div>
@endsection
