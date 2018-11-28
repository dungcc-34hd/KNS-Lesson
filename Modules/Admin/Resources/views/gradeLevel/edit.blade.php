@extends('admin::layouts.master')
@section('title')
    Edit School
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Lớp</li>
        </ol>
        <form action="{{route('admin.class.update', $class->id)}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lớp</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên lớp @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="name"
                                               value="@isset($class){{$class->name}}@endisset">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label>User @include('common.require')</label>
                                        <div class="clearfix">
                                            <select  class="form-control" name="select-user">
                                                {{-- <option value="">Chọn User </option> --}}
                                                @foreach ($users as $key => $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>

                                <div class="form-group">
                                    <label>Khối @include('common.require')</label>
                                    <div class="clearfix">
                                            <select class="form-control" name="select-grade-level">
                                                    @foreach ($gradeLevels as $key => $gradeLevel)
                                                        <option value="{{$gradeLevel->id}}" {{ $gradeLevel->id == $class->grade_level_id ? "selected" : '' }}>{{$gradeLevel->name}}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label>Tên trường @include('common.require')</label>
                                    <div class="clearfix">
                                        <select class="form-control" name="select-school">
                                        @foreach ($schools as $key => $school)
                                            <option value="{{$school->id}}" {{ $school->id == $class->school_id ? "selected" : '' }}>{{$school->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group">

                                    <label>Số lượng học sinh @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="quantity"
                                               value="@isset($class){{$class->quantity_student}}@endisset">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{route('admin.school.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection

@push('scripts')
    {{--    <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}"></script>--}}
    {{-- <script src="{{ asset('modules/admin/class/class-validation.js')}}"></script> --}}
    <script src="{{ asset('modules/admin/gradeLevel/gradeLevel.js') }}"></script>
@endpush
