@extends('admin::layouts.master')
@section('title')
    Create Type Lesson
@endsection
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý dạng nội dung</li>
        </ol>
        <form action="{{route('admin.typeLesson.store')}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quản lý dạng nội dung</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('admin::typeLesson._form')
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Tạo dạng nội dung</button>
                        <a href="{{route('admin.typeLesson.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                    </div>
                </div>
            </section>
        </form>

    </div>
@endsection
