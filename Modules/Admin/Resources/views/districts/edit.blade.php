@extends('admin::layouts.master')
@section('title')
    Edit District
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Provincial</li>
        </ol>
        <form action="{{route('admin.provincial.update', $district->id)}}" method="post" class="validation-form">
            {{csrf_field()}}
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Provincial</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <label>Name @include('common.require')</label>
                                <div class="clearfix">
                                    <input type="text" class="form-control" name="name"
                                           value="@isset($district){{$district->name}}@endisset">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Area @include('common.require')</label>
                                <select  class="form-control" name="select-provincial">
                                    @foreach ($provincials as $key => $provincial)
                                        <option value="{{$provincial->id}}" {{ $district->provincial_id == $provincial->id ? "selected" : '' }}>{{$provincial->name}}</option>
                                    @endforeach
                                    mnipj1`

                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{route('admin.provincial.index')}}" type="button" class="btn btn-default">Go Back</a>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection
@push('scripts')

@endpush
