@extends('admin::layouts.master')
@section('title')
    Quản lí chung
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
                Quản lí chung
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Quản lí chung</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary modal-show"
                            data-url="/admin/manager-area/create-area">Tạo khu vực
                    </button>
                    <button type="button" class="btn btn-primary modal-show"
                            data-url="/admin/manager-area/create-province">Tạo tỉnh
                    </button>
                    <button type="button" class="btn btn-primary modal-show"
                            data-url="/admin/manager-area/create-district">Tạo quận/huyện
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('common.message')
                </div>
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="col-md-6 col-sm-6">
                            <ul id="tree2" style="font-size: 20px">
                                @foreach($areas as $area)
                                    <li>
                                        <a href="#">{{$area->name}}</a>
                                        <div class="action pull-right">
                                            <a class="modal-show custom-edit" data-url="/admin/manager-area/edit-area/{{$area->id}}">
                                                <i class="ace-icon fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="delete-area custom-delete"
                                               title="Delete"
                                               object_id="{{$area->id}}"
                                               object_name="{{$area->name}}">
                                                <i class="fa fa-trash fa-sm"></i>
                                            </a>
                                        </div>
                                        

                                        @foreach($area->province as $key=>$province)
                                            <ul>
                                                <li>
                                                    <a href="#">{{$province->name}}</a>
                                                    <div class="action pull-right">
                                                        <a class="modal-show custom-edit"
                                                            data-url="/admin/manager-area/edit-province/{{$province->id}}"><i class="ace-icon fa fa-pencil"></i>
                                                        </a>
                                                        <a href="#" class="delete-province custom-delete"
                                                           title="Delete"
                                                           object_id="{{$province->id}}"
                                                           object_name="{{$province->name}}">
                                                            <i class="fa fa-trash fa-sm"></i>
                                                        </a>
                                                    </div>
                                                    
                                                    @foreach($province->district as $key=>$district)
                                                        <ul>
                                                            <li>
                                                                <a href="#">{{$district->name}}</a>
                                                                <div class="action pull-right">
                                                                    <a  class="modal-show custom-edit"
                                                                        data-url="/admin/manager-area/edit-district/{{$district->id}}"><i class="ace-icon fa fa-pencil"></i>
                                                                    </a>
                                                                    <a href="#" class="delete-district custom-delete"
                                                                       title="Delete"
                                                                       object_id="{{$district->id}}"
                                                                       object_name="{{$district->name}}">
                                                                        <i class="fa fa-trash fa-sm"></i>
                                                                    </a>
                                                                </div>
                                                                
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        @endforeach
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
    <script>
         activeMenu('data','managerArea', true);
    </script>
    <script src="{{ asset('common/pagination-search.js') }}"></script>
    <script src="{{ asset('modules/admin/managerArea/manager.js') }}"></script>
    <script src="{{ asset('modules/admin/managerArea/managerArea-delete.js') }}"></script>
  
@endpush
