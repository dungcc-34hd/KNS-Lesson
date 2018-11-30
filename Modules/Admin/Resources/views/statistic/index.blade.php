@extends('admin::layouts.master')
@section('title')
    Thống kê
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
                Thống kê
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thống kê</li>
            </ol>
        </section>

{{-- @foreach($as as $a)
    <p>{{$a->name_class}}</p>
@endforeach --}}
        <!-- Main content -->
        <section class="content">
            <div class="group-tabs">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#district" aria-controls="district" role="tab" data-toggle="tab">Giáo viên/Sĩ số</a></li>
                <li role="presentation"><a href="#school" aria-controls="school" role="tab" data-toggle="tab">Tài khoản</a></li>
                <li role="presentation"><a href="#dowload" aria-controls="dowload" role="tab" data-toggle="tab">Lượt tải</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="district">
                    <div class="row">
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
                                 <select name="" id="selectDistrict" style="width: 200px;" class="form-control" data-url="{{route('admin.statistic.changeDistrict',['districtId'=> count($districts) > 0 ? $districts[0]->id : 0])}}">
                                    @foreach($districts as $district) 
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                    <h3 class="box-title">Thống kê theo tỉnh/huyện</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table id="table" class="table table-hover results-table">
                                        <thead>
                                            <tr>
                                                <th>Giáo viên</th>
                                                <th>Sĩ số</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody id="tSchool">
                                        
                                           <tr>
                                               <td>{{$sum_teacher}}</td>
                                               <td>{{$sum_student}}</td>
                                           </tr>
                                       
                                         
                                       
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body --> 
                            </div>
                            <!-- /.box -->
                        </section>
                        <!-- /.col -->
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="school">
                    <div class="row">
                        <div class="col-md-6 form-group ">
                            <div class="form-inline">
                                <label for="">Trường học:</label>
                                 <select name="" id="selectSchool" style="width: 200px;" class="form-control" data-url="{{route('admin.statistic.changeSchool',['schoolId'=> count($schools) > 0 ? $schools[0]->id : 0])}}">
                                    @foreach($schools as $school) 
                                        <option value="{{$school->id}}">{{$school->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                    <h3 class="box-title">Thống kê số account của trường </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table id="table" class="table table-hover results-table">
                                        <thead>
                                            <tr>
                                                <th>Số account</th>                                   
                                            </tr>
                                        </thead>
                                        <tbody>                                       
                                           <tr>                                             
                                               <td>{{$accounts}}</td>
                                           </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-6 pull-left widget-page">
                                            {{-- @include('pagination.index',['current_page' => 1,'total_page' => $pages]) --}}
                                        </div>
                                        <div class="col-md-6 pull-right">
                                           {{--  <div class="form-group pull-right">
                                                <label class="view-by">
                                                    View By
                                                    <select id="show-records" class="form-control input-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </label>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->
                        </section>
                        <!-- /.col -->
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="dowload">
                    <div class="row">
                        <div class="col-md-6 form-group ">
                            <div class="form-inline">
                                <label for="">Bài học:</label>
                                 <select name="" id="selectSchool" style="width: 200px;" class="form-control" data-url="">
                                    {{-- @foreach($schools as $school)  --}}
                                        <option value="">Bài 1</option>
                                        <option value="">Bài 2</option>
                                        <option value="">Bài 3</option>
                                    {{-- @endforeach --}}
                                </select>
                            </div>
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
                                    <h3 class="box-title">Thống kê lượt tải</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table id="table" class="table table-hover results-table">
                                        <thead>
                                            <tr>
                                                <th>Tài khoản</th>
                                                <th>Lượt tải</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                           <tr>
                                              <td>admin</td>
                                              <td>5</td>
                                           </tr> <tr>
                                              <td>admin1</td>
                                              <td>2</td>
                                           </tr> <tr>
                                              <td>admin2</td>
                                              <td>1</td>
                                           </tr> <tr>
                                              <td>admin3</td>
                                              <td>1</td>
                                           </tr>
                                       
                                         
                                       
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-6 pull-left widget-page">
                                            {{-- @include('pagination.index',['current_page' => 1,'total_page' => $pages]) --}}
                                        </div>
                                        <div class="col-md-6 pull-right">
                                           {{--  <div class="form-group pull-right">
                                                <label class="view-by">
                                                    View By
                                                    <select id="show-records" class="form-control input-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </label>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->
                        </section>
                        <!-- /.col -->
                    </div>                   
                </div>
                
              </div>
            </div>
 
        </section>
        <!-- /.content -->


    </div>
    {{-- <input type="hidden" id="url-ajax" value="/admin/statistic/pagination/"> --}}
@endsection

@push('scripts')
{{--    <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}"></script>--}}
    <script src="{{ asset('common/pagination-search.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('modules/admin/statistic/custom.js') }}"></script>
@endpush
