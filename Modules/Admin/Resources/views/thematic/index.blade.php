@extends('admin::layouts.master')
@section('title')
   Thematic
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
                Chuyên đề
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Chuyên đề</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.thematic.create')}}" class="btn btn-primary">Tạo chuyên đề</a>
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
                            <h3 class="box-title">Danh sách chuyên đề</h3>

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
                                    <th class="order-number">STT</th>
                                    <th>Tên chuyên đề</th>
                                    <th>Mô tả</th>
                                    <th class="item-action-3">Trạng thái</th>
                                </tr>
                                @if(!empty($thematics))
                                    @foreach($thematics as $key => $thematic)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td>{{$thematic->name}}</td>
                                            <td class="green">{{$thematic->description}}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                   
                                                    <a class="btn btn-info"
                                                       href="{{route('admin.thematic.edit',['id' => $thematic->id])}}"
                                                       title="Edit">
                                                        <i class="ace-icon fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger delete-object"
                                                       title="Delete"
                                                       object_id="{{$thematic->id}}"
                                                       object_name="{{$thematic->name}}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Không có bản ghi nào</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-6 pull-left widget-page">
                                    @include('pagination.index',['current_page' => 1,'total_page' => $pages])
                                </div>
                                <div class="col-md-6 pull-right">
                                    <div class="form-group pull-right">
                                        <label class="view-by">
                                            Xem với
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
    <input type="hidden" id="url-ajax" value="/admin/thematic/pagination/">
@endsection

@push('scripts')
    <script>
         activeMenu('lesson','thematic', true);
    </script>
    <script src="{{ asset('common/pagination-search.js') }}"></script>
    <script src="{{ asset('modules/admin/thematic/thematic.js') }}"></script>
    
@endpush
