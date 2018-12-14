@extends('admin::layouts.master')
@section('title')
    User
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
                User
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">User</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
                <div class="row">
                        <div class="col-md-4 form-group">
                            <div class="form-inline">
                                <div class="col-md-3">
                                        <label for="">Khu vực:</label>
                                </div>
                                <div class="col-md-9">
                                        <select class="select-option form-control"  name="areas" id="areas"style="width: 200px;"
                                        >
                                        <option value="">Chọn Khu Vực</option>
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
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="form-inline">
                                <div class="col-md-2">
                                        <label for="">Tỉnh:</label>
                                </div>
                                <div class="col-md-9">
                                        <select class="select-option form-control"  name="provinces" id="provinces"
                                        style="width: 200px;" data-url="">
                                        <option value="">Chọn Tỉnh</option>
                                           {{-- @if(count($provinces) > 0)       
       
                                               @foreach($provinces as $province)
                                                   <option value="{{$province->id}}">{{$province->name}}</option>
                                               @endforeach
                                           @else
                                                <option>{{trans('system.noData')}}</option>
       
                                           @endif --}}
       
                                       </select>
                                </div>
                                

                                
                            </div>                
                        </div>
                        <div class="col-md-4 form-group ">
                            <div class="form-inline">
                                <div class="col-md-3">
                                        <label for="">Quận/Huyện:</label>
                                </div>
                                <div class="col-md-9">
                                        <select name="" name="districts" id="districts" 
                                        style="width: 200px;" class="form-control"
                               
                                        {{--  data-url="{{route('admin.statistic.changeDistrict',['districtId'=> count($districts) > 0 ? $districts[0]->id : 0])}}" --}}>
                                        <option value="">Chọn Quận/Huyện</option>  
                                        {{-- @if(count($districts) > 0) 
       
                                               @foreach($districts as $district) 
                                                   <option value="{{$district->id}}">{{$district->name}}</option>
                                               @endforeach
                                           @else
                                                <option>{{trans('system.noData')}}</option>
       
                                           @endif --}}
       
                                       </select>
                                </div>
                                

                               
                            </div>
                        </div>
                        <div class="col-md-6 form-group ">
                            <div class="form-inline">
                                <div class="col-md-2">
                                        <label for="">Trường:</label>
                                </div>
                                <div class="col-md-10">
                                        <select name="" name="schools" id="schools"
                                        style="width: 200px;" class="form-control"
                                        >
                                         <option >Chọn Trường</option> 
                                         {{-- @if(count($schools) > 0) 
                                              @foreach($schools as $school) 
                                                  <option value="{{$school->id}}"
                                                      >{{$school->name}}</option>
                                              @endforeach
                                          @else
                                               <option>{{trans('system.noData')}}</option>
                                          @endif --}}
      
                                      </select>
                                    </div>
                              

                                
                            </div>
                        </div>
                    </div> 
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.user.create')}}" class="btn btn-primary">Tạo User</a>
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
                            <h3 class="box-title">User Lists</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" id="nav-search-input" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover results-table">
                                <thead>
                                <tr>
                                    <th class="order-number">STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Trường</th>
                                    <th>Khối</th>
                                    <th>Lớp</th>
                                    <th>Sĩ số</th>
                                    <th>Quyền</th>
                                    <th>IP</th>
                                    <th>Lượt tải về</th>
                                    <th class="item-action-3"></th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                @if(!empty($users))
                                    @foreach($users as $key => $user)
                                        <tr>
                                                <td >{{$key+1}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->school['name']}}</td>
                                                <td>{{$user->grade['name']}}</td>
                                                <td>{{$user->lsClass['name']}}</td>
                                                <td>{{$user->quantity_student}}</td>
                                                <td>{{$user->role->name}}</td>
                                                <td>{{$user->IP}}</td>
                                                <td>{{$user->download}}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-success"
                                                       href="{{route('admin.user.show',['id' => $user->id])}}"
                                                       title="Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-info"
                                                       href="{{route('admin.user.edit',['id' => $user->id])}}"
                                                       title="Edit">
                                                        <i class="ace-icon fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger delete-object" 
                                                       title="Delete"
                                                       object_id="{{$user->id}}"
                                                       object_name="{{$user->name}}">
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
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->


    </div>
    <input type="hidden" id="url-ajax" value="/admin/user/pagination/">
@endsection

@push('scripts')
    <script src="{{ asset('common/pagination-search.js') }}"></script>
    <script src="{{ asset('modules/admin/user/user.js') }}"></script>

@endpush
