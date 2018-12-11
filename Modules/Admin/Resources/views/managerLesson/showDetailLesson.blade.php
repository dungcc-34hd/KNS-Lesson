@extends('admin::layouts.master')
@section('title')
    Detail School
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trạng thái</a></li>
            <li class="breadcrumb-item active">Lớp</li>
        </ol>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-check-square-o text-black"></i>

                            <h3 class="box-title">Thông tin</h3>
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
                                                {{$lessonDetail->id}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tên tiêu đề</td>
                                            <td>
                                                {{$lessonDetail->title}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kiểu</td>
                                            <td>
                                                {{\App\Models\LessonDetail::TYPE[$lessonDetail->type]}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tên bài học</td>
                                            <td>
                                                {{$lessonDetail->lesson->name}}
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
@push('scripts')

    <script src="{{ asset('modules/admin/class/class.js') }}"></script>
@endpush