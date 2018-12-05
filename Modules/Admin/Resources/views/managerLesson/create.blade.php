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
            <div class="clearfix">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalAddGrade"> Tạo bài học
                </button>
            </div>
            @foreach($lessons as $lesson)
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h5 class="box-title"> Tạo tiêu đề bài học
                            <button type="button" class="btn btn-info modalDetailLesson" data-toggle="modal"
                                    data-target="#modalAddDetailLesson" id="modalDetailLesson"
                                    data-value="{{$lesson->id}}">{{$lesson->name}}</button>
                        </h5>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        @foreach($lesson->lessonDetail as $item)
                            <div class="row">
                                <div class="col-md-2" style="margin-bottom: 1em">
                                    <button type="button" class="btn btn-primary modalLessonContent modal-show"
                                            data-url="/admin/manager-lesson/get-value-type/{{$item->id}}"
                                            value="{{$item->id}}">{{$item->title}}</button>
                                    <br/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            @include('admin::managerLesson.addLesson')
            @include('admin::managerLesson.addDetailLesson')
        </section>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/admin/managerContent/managerContent.js') }}"></script>
@endpush

