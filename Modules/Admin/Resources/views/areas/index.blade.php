@extends('admin::layouts.master')
@section('title')
   Area
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('common/pagination.css')}}" xmlns:v-on="http://www.w3.org/1999/xhtml"
          xmlns:v-on="http://www.w3.org/1999/xhtml">
@endpush
@section('content')

    <div class="content-wrapper" id="app">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Khu vực
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Khu vực</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.area.create')}}" class="btn btn-primary">Tạo khu vực</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('common.message')
                </div>
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách khu vực</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" id="nav-search-input" name="table_search" class="form-control pull-right" placeholder="Tìm kiếm">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover results-table">
                                <tbody>
                                <tr>
                                    <th class="order-number">Id.</th>
                                    <th>Tên khu vực</th>
                                    <th>Mô tả</th>
                                    <th class="item-action-3">Trạng thái</th>
                                </tr>
                                @if(!empty($areas))
                                    @foreach($areas as $key => $area)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td>{{$area->name}}</td>
                                            <td class="green">{{$area->description}}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-success"
                                                       href="{{route('admin.area.show',['id' => $area->id])}}"
                                                       title="Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-info"
                                                       href="{{route('admin.area.edit',['id' => $area->id])}}"
                                                       title="Edit">
                                                        <i class="ace-icon fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger delete-object"
                                                       title="Delete"
                                                       object_id="{{$area->id}}"
                                                       object_name="{{$area->name}}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No Records</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-6 pull-left widget-page">
{{--                                    @include('pagination.index',['current_page' => 1,'total_page' => $pages])--}}
                                </div>
                                <div class="col-md-6 pull-right">
                                    <div class="form-group pull-right">
                                        <label class="view-by">
                                            Xem theo
                                            <select id="show-records" class="form-control input-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->


    </div>
    <input type="hidden" id="url-ajax" value="/admin/area/pagination/">
@endsection

@push('scripts')
    {{--    <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}"></script>--}}
    <script src="{{ asset('common/pagination-search.js') }}"></script>
    <script src="{{ asset('modules/admin/area/area.js') }}"></script>
@endpush
