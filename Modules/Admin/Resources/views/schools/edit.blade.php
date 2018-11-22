@extends('admin::layouts.master')
@section('title')
    Edit School
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Trường học</li>
        </ol>
        <form action="{{route('admin.school.update', $school->id)}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Trường học</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên trường @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="name"
                                               value="@isset($school){{$school->name}}@endisset">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cấp @include('common.require')</label>
                                    <select class="form-control" name="select-school-level">
                                        @foreach ($schoolLevels as $key => $schoolLevel)
                                            <option value="{{$schoolLevel->id}}" {{ $schoolLevel->id == $school->school_id ? "selected" : '' }}>{{$schoolLevel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Quận/Huyện/Thành phố @include('common.require')</label>
                                    <select class="form-control" name="select-district">
                                        @foreach ($districts as $key => $district)
                                            <option value="{{$district->id}}" {{ $district->id == $school->district_id ? "selected" : '' }}>{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Số lượng học sinh @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="quantity"
                                               value="@isset($school){{$school->quantity_student}}@endisset">
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

@endpush
