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
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tỉnh/Thành phố @include('common.require')</label>
                                    <select class="form-control" name="province_id">
                                        @foreach ($provincials as $key => $provincial)
                                            <option value="{{$provincial->id}}" {{ $district->provincial_id == $provincial->id ? "selected" : '' }}>{{$provincial->name}}</option>
                                        @endforeach
                                    </select>
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

@endpush
