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


        <!-- Main content -->
        <section class="content">
            <div role="tabpanel" class="tab-pane active" id="district">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-inline">
                                <label for="">Khu vực:</label>
                                <select class="select-option form-control" id="selectProvince" style="width: 200px;" data-url="">
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
                                   {{--  @if(count($provinces) > 0)       
                                        @foreach($provinces as $province)
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    @else
                                         <option>{{trans('system.noData')}}</option>
                                    @endif --}}
                                </select>
                            </div>                
                        </div>
                        <div class="col-md-6 form-group ">
                            <div class="form-inline">
                                <label for="">Quận/Huyện:</label>
                                 <select name="" id="selectDistrict" style="width: 200px;" class="form-control"{{--  data-url="{{route('admin.statistic.changeDistrict',['districtId'=> count($districts) > 0 ? $districts[0]->id : 0])}}" --}}>
                                   {{--  @foreach($districts as $district) 
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group ">
                            <div class="form-inline">
                                <label for="">Trường:</label>
                                 <select name="" id="selectDistrict" style="width: 200px;" class="form-control"{{--  data-url="{{route('admin.statistic.changeDistrict',['districtId'=> count($districts) > 0 ? $districts[0]->id : 0])}}" --}}>
                                   {{--  @foreach($districts as $district) 
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach --}}
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
                                        <tbody id="tSchool">
                                        
                                           <tr>
                                              {{--  <td>{{$sum_teacher}}</td>
                                               <td>{{$sum_student}}</td> --}}
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
