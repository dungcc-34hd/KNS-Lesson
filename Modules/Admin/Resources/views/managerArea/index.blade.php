@extends('admin::layouts.master')
@section('title')
    Lesson
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('common/pagination.css')}}" xmlns:v-on="http://www.w3.org/1999/xhtml"
          xmlns:v-on="http://www.w3.org/1999/xhtml">
    <link rel="stylesheet" href="{{asset('modules/admin/managerArea/managerStyle.css')}}">
@endpush
@section('content')

    <div class="content-wrapper" id="app">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Lesson
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Lesson</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.lesson.create')}}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('common.message')
                </div>
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                                <div class="col-md-4">
                                    <ul id="tree2">
                                        @foreach($areas as $area)
                                        <li>
                                            <a href="#">{{$area->name}}</a>

                                            <ul>
                                                <li>Hà Nội
                                                    <ul>
                                                        <li>Cầu Giấy</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                            @endforeach
                                    </ul>
                                </div>
                            </div>

                    <!-- /.box -->
                </section>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->


    </div>
    <input type="hidden" id="url-ajax" value="/admin/school/pagination/">
@endsection

@push('scripts')
    {{--    <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}"></script>--}}
    <script src="{{ asset('common/pagination-search.js') }}"></script>
    <script src="{{ asset('modules/admin/managerArea/manager.js') }}"></script>
@endpush
