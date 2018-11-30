@extends('admin::layouts.master')
@section('title')
    Create School
@endsection
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">School</li>
        </ol>
        <form action="{{route('admin.school.store')}}" method="post" class="validation-form">
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
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cấp @include('common.require')</label>
                                    <div class="clearfix">
                                        <select  class="form-control" name="select-school-level">
                                            <option value="">Select School</option>
                                            @foreach ($schoolLevels as $key => $schoolLevel)
                                                <option value="{{$schoolLevel->id}}">{{$schoolLevel->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label>Quận/Huyện/Thành phố @include('common.require')</label>
                                    <div class="clearfix">
                                        <select  class="form-control" name="select-district">
                                            <option value="">Select District</option>
                                            @foreach ($districts as $key => $district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
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
@push('scripts')
    <script src="{{ asset('modules/admin/school/school-validation.js')}}"></script>
    <script src="{{ asset('modules/admin/school/school.js') }}"></script>
@endpush
