@extends('admin::layouts.master')
@section('title')
    Edit Area
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Khu vực</li>
        </ol>
        <form action="{{route('admin.area.update', $area->id)}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Khu vực</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên khu vực @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="name"
                                               value="@isset($area){{$area->name}}@endisset">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="description"
                                               value="@isset($area){{$area->description}}@endisset">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{route('admin.area.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection
@push('scripts')
    {{--<script src="{{ asset('modules/js/backend/role/role-vailidate.js') }}"></script>--}}
    {{--<script src="{{ asset('modules/js/backend/role/role.js') }}"></script>--}}
@endpush
