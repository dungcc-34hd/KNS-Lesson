@extends('admin::layouts.master')
@section('title')
    Create School
@endsection
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">School</li>
        </ol>
        <form action="{{route('admin.school.store')}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Trường học</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label>Tên trường @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="name" id="names">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Email @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="email" id="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Số điện thoại @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="phone" id="phone">
                                    </div>
                                </div>


                                
                             
                                <div class="form-group">
                                    <label>Cấp @include('common.require')</label>
                                    <div class="clearfix">
                                        <select  class="form-control" name="school_level_id">
                                            <option value="">Chọn Cấp</option>
                                            @foreach ($schoolLevels as $key => $schoolLevel)
                                                <option value="{{$schoolLevel->id}}">{{$schoolLevel->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label>Khu vực @include('common.require')</label>
                                    <div class="clearfix">
                                        <select  class="form-control" name="area_id" id="selectArea" >
                                            <option value="">Chọn khu vực</option>
                                            @foreach ($areas as $key => $area)
                                                <option value="{{$area->id}}">{{$area->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>     
                                </div>

                                <div class="form-group">
                                    <label>Tỉnh/thành phố @include('common.require')</label>
                                    <div class="clearfix">
                                        <select  class="form-control" name="province_id" id="selectProvince">
                                            <option value="">Chọn tỉnh</option>
                                            @if(count($provinces) > 0 )
                                                @foreach ($provinces as $key => $province)
                                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>     
                                </div>
                                
                                <div class="form-group">
                                    <label>Quận/Huyện @include('common.require')</label>
                                    <div class="clearfix">
                                        <select  class="form-control" name="district_id" id="selectDistrict">
                                            <option value="">Chọn quận/huyện</option>
                                            @foreach ($districts as $key => $district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>     
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="bt">Tạo trường</button>
                        <a href="{{route('admin.school.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                    </div>
                </div>
            </section>
        </form>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/admin/school/school-validation.js')}}"></script>
    <script src="{{ asset('modules/admin/school/custom.js') }}"></script>
@endpush
