@extends('admin::layouts.master')
@section('title')
    Create Title Lesson
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('/modules/admin/managerContent/managerContent.css')}}">
@endpush
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Tỉnh/Thành phố</li>
        </ol>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tạo khối</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="clearfix">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modalAddGrade"> Tạo bài học
                                    </button>
                                </div>
                                @include('admin::titleLesson.addLesson')
                            </div>

                            <div class="form-group">
                                @foreach($lessons as $lesson)
                                    <button type="button" class="btn btn-primary modalDetailLesson" data-toggle="modal"
                                            data-target="#modalAddDetailLesson" id="modalDetailLesson"
                                            data-value="{{$lesson->id}}">{{$lesson->name}}</button>
                                @endforeach
                            </div>
                            @include('admin::titleLesson.addDetailLesson')

                            <div class="form-group">
                                @foreach($lessonDetails as $lessonDetail)
                                    <button type="button" class="btn btn-primary modalLessonContent" data-toggle="modal"
                                            data-target="#modalAddLessonContent" id="modalLessonContent"
                                            value="{{$lessonDetail->id}}">{{$lessonDetail->name}}</button>
                                @endforeach
                            </div>
                            @include('admin::titleLesson.addLessonContent')
                            <ul id="tree2">
                                @foreach($lessons as $lesson)
                                <li><a href="#">{{$lesson->name}}</a>
                                    <ul>
                                        <li>{{!empty($lesson->lessonDetail) ? $lesson->lessonDetail:''}}</li>
                                        <li>Employees
                                            <ul>
                                                <li>Reports
                                                    <ul>
                                                        <li>Report1</li>
                                                        <li>Report2</li>
                                                        <li>Report3</li>
                                                    </ul>
                                                </li>
                                                <li>Employee Maint.</li>
                                            </ul>
                                        </li>
                                        <li>Human Resources</li>
                                    </ul>
                                </li>
                                    @endforeach
                            </ul>
                        </div>

                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/admin/managerContent/managerContent.js') }}"></script>
@endpush

