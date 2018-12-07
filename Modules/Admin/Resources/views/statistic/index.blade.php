@extends('admin::layouts.master')
@section('title')
    Thống kê
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('common/pagination.css')}}"
    >
@endpush
@section('content')
    <div class="content-wrapper" id="app">
        <!-- bank Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="">
                    <h4 class="pull-left uppercase">
                        Thống kê
                    </h4>            
                </div>
            </div>
               <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-inline">
                                <label for="">Khu vực:</label>
                                <select class="select-option form-control" id="selectArea" style="width: 200px;"  data-url="{{route('admin.statistic.changeArea',['areaId'=> count($areas) > 0 ? $areas[0]->id : 0])}}">
                                    @if(count($areas) > 0)       
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    @else
                                         <option>Không có dữ liệu</option>
                                    @endif
                                </select>
                            </div>                
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="form-inline">
                                <label for="">Tỉnh:</label>
                                <select class="select-option form-control" id="selectProvince" style="width: 200px;" data-url="">
                                    @if(count($provinces) > 0)       
                                        @foreach($provinces as $province)
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    @else
                                         <option>{{trans('system.noData')}}</option>
                                    @endif
                                </select>
                            </div>                
                        </div>
                        <div class="col-md-6 form-group ">
                            <div class="form-inline">
                                <label for="">Quận/Huyện:</label>
                                 <select name="" id="selectDistrict" style="width: 200px;" class="form-control"{{--  data-url="{{route('admin.statistic.changeDistrict',['districtId'=> count($districts) > 0 ? $districts[0]->id : 0])}}" --}}>
                                    @if(count($districts) > 0) 
                                        @foreach($districts as $district) 
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    @else
                                         <option>{{trans('system.noData')}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group ">
                            <div class="form-inline">
                                <label for="">Trường:</label>
                                 <select name="" id="selectSchool" style="width: 200px;" class="form-control"{{--  data-url="{{route('admin.statistic.changeDistrict',['districtId'=> count($districts) > 0 ? $districts[0]->id : 0])}}" --}}>
                                   @if(count($schools) > 0) 
                                        @foreach($schools as $school) 
                                            <option value="{{$school->id}}">{{$school->name}}</option>
                                        @endforeach
                                    @else
                                         <option>{{trans('system.noData')}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div> 
        </section>

        <!-- Main bank -->
        <section class="content">

            <div class="row">
                <div class="col-lg-12">
                    @include('common.message')
                    @include('common.hard_message')
                </div>
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-list"></i> {{trans('bank.lists')}}</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" id="nav-search-input" name="table_search"
                                           class="form-control pull-right" placeholder=" {{trans('crud.inputSearch')}}">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-hover table-bordered results-table"
                                   data-url="/admin/statistic/pagination/">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Giáo viên</th>
                                    <th>Khu vực</th>
                                    <th>Tỉnh</th>
                                    <th>Quận/huyện</th>
                                    <th>Trường</th>
                                    <th>Khối</th>
                                    <th>Lớp</th>
                                    <th>Sĩ số</th>  
                                </tr>
                                
                                </thead>
                                <tbody>
                                @if(!empty($users))
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->name_area}}</td>
                                            <td>{{$user->name_province}}</td>
                                            <td>{{$user->name_district}}</td>
                                            <td>{{$user->name_school}}</td>
                                            <td>{{$user->name_grade}}</td>
                                            <td>{{$user->name_class}}</td>
                                            <td>{{$user->quantity_student}}</td>
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
                                    @include('pagination.index',['current_page' => 1,'total_page' => $pages])
                                </div>
                                <div class="col-md-6 pull-right">
                                    <label class="view-by">
                                            View By
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
                    <!-- /.box -->
                </section>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.bank -->

    </div>
@endsection
@push('scripts')

    <script src="{{ asset('common/pagination-search.js') }}"></script>
    <script src="{{ asset('modules/admin/statistic/custom.js') }}"></script>
@endpush
