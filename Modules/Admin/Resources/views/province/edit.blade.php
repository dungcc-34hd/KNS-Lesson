@extends('admin::layouts.master')
@section('title')
    Edit Provincial
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Tỉnh/Thành phố</li>
        </ol>
        <form action="{{route('admin.province.update', $provincial->id)}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tỉnh/Thành phố</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tỉnh/Thành phố @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" name="name"
                                               value="@isset($provincial){{$provincial->name}}@endisset">
                                        @if($errors)
                                            <span style="color: #dd4b39;" >{{$errors->first('name')}}</span> 
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Khu vực @include('common.require')</label>
                                    <select class="form-control" name="area_id">
                                        @foreach ($areas as $key => $area)
                                            <option value="{{$area->id}}" {{ $provincial->area_id == $area->id ? "selected" : '' }}>{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                     @if($errors)
                                        <span style="color: #dd4b39;" >{{$errors->first('area_id')}}</span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{route('admin.province.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection
@push('scripts')

@endpush
