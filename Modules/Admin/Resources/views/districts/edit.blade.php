@extends('admin::layouts.master')
@section('title')
    Edit District
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Quận/Huyện</li>
        </ol>
        <form action="{{route('admin.district.update', $district->id)}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quận/Huyện</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quận/Huyện @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="name"
                                               value="@isset($district){{$district->name}}@endisset">
                                        @if($errors)
                                            <span style="color: #dd4b39;" >{{$errors->first('name')}}</span> 
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Khu vực @include('common.require')</label>
                                    <select  class="form-control" name="area_id" id="selectArea">
                                        <option value="">Chọn khu vực</option>
                                        @foreach ($areas as $key => $area)
                                            <option value="{{$area->id}}" {{ $area_current->area_id == $area->id ? "selected" : '' }}>{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors)
                                            <span style="color: #dd4b39;" >{{$errors->first('area_id')}}</span> 
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label>Tỉnh/Thành phố @include('common.require')</label>
                                    <select class="form-control" name="province_id" id="selectProvince">
                                        @foreach ($provincials as $key => $provincial)
                                            <option value="{{$provincial->id}}" {{ $district->province_id == $provincial->id ? "selected" : '' }}>{{$provincial->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors)
                                            <span style="color: #dd4b39;" >{{$errors->first('province_id')}}</span> 
                                        @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{route('admin.district.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/admin/district/district.js') }}"></script>
@endpush
