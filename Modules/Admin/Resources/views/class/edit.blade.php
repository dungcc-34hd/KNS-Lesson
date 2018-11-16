@extends('admin::layouts.master')
@section('title')
    Edit School
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">School</li>
        </ol>
        <form action="{{route('admin.class.update', $class->id)}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Provincial</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">

                            <div class="form-group">
                                <label>Name @include('common.require')</label>
                                <div class="clearfix">
                                    <input type="text" class="form-control" name="name"
                                           value="@isset($class){{$class->name}}@endisset">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Grade level @include('common.require')</label>
                                <select  class="form-control" name="select-grade-level">
                                    @foreach ($gradeLevels as $key => $gradeLevel)
                                        <option value="{{$gradeLevel->id}}" {{ $gradeLevel->id == $class->grade_level_id ? "selected" : '' }}>{{$gradeLevel->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>School @include('common.require')</label>
                                <select  class="form-control" name="select-school">
                                    @foreach ($schools as $key => $school)
                                        <option value="{{$school->id}}" {{ $school->id == $class->school_id ? "selected" : '' }}>{{$school->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Name @include('common.require')</label>
                                <div class="clearfix">
                                    <input type="text" class="form-control" name="quantity"
                                           value="@isset($class){{$class->quantity_student}}@endisset">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{route('admin.school.index')}}" type="button" class="btn btn-default">Go Back</a>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection
@push('scripts')

@endpush
