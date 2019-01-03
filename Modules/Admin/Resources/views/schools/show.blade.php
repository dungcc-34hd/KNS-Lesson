@extends('admin::layouts.master')
@section('title')
    Detail School
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Trường học</li>
        </ol>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-check-square-o text-black"></i>

                            <h3 class="box-title">Thông tin</h3>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="simple-table"
                                           class="table table-bordered table-hover table-striped">
                                        <tbody>
                                        <tr>
                                            <td>ID</td>
                                            <td>
                                                {{$school->id}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tên trường</td>
                                            <td>
                                                {{$school->name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>
                                                {{$school->email}}
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td>
                                                {{$school->phone}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cấp trường</td>
                                            <td>
                                                {{!empty($school->schoolLevel) ? $school->schoolLevel->name : ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Khu vực</td>
                                            <td>
                                                {{!empty($school->area) ? $school->area->name: ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tỉnh/thành phố</td>
                                            <td>
                                                {{!empty($school->province) ? $school->province->name: ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quận/Huyện</td>
                                            <td>
                                                {{!empty($school->district) ? $school->district->name : ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Key</td>
                                            <td>
                                                {{$school->license_key}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-info"
                                                       href="{{route('admin.school.edit',['id' => $school->id])}}"
                                                       title="Edit">
                                                        <i class="ace-icon fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger delete-object"
                                                    title="Delete"
                                                    object_id="{{$school->id}}"
                                                    object_name="{{$school->name}}">
                                                     <i class="fa fa-trash-o"></i>
                                                 </a>

                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                                <a href="{{route('admin.school.index')}}" type="button" class="btn btn-default">Quay trở lại</a>
                        </div>  
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    {{--    <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}"></script>--}}
    {{-- <script src="{{ asset('common/pagination-search.js') }}"></script> --}}
    <script src="{{ asset('modules/admin/school/school.js') }}"></script>
@endpush