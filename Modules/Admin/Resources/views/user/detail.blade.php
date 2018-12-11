@extends('admin::layouts.master')
@section('title')
    Detail User
@endsection
@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        
        <section class="content">
            <div class="row">
                
                    <div class="col-lg-7">
                       
                            
                    </div>
                <div class="col-md-6">
                    <div>
                            @include('common.message')
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-check-square-o text-black"></i>

                            <h3 class="box-title">Information</h3>
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
                                                {{$user->id}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tên</td>
                                            <td>
                                                {{$user->name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SĐT</td>
                                            <td>
                                                {{$user->tel}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Khu vực</td>
                                            <td>
                                                {{$user->name_area}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tỉnh</td>
                                            <td>
                                                {{$user->name_province}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quận/huyện</td>
                                            <td>
                                                {{$user->name_district}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Trường</td>
                                            <td>
                                                {{$user->name_school}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Khối</td>
                                            <td>
                                                {{$user->name_grade}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lớp</td>
                                            <td>
                                                {{$user->name_class}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sĩ số</td>
                                            <td>
                                                {{$user->quantity_student}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quyền</td>
                                            <td>
                                                {{$user->name_role}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>IP</td>
                                            <td>
                                                {{$user->IP}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lượt tải</td>
                                            <td>
                                                {{$user->download}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Created At</td>
                                            <td>
                                                {{$user->created_at}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Updated At</td>
                                            <td>
                                                {{$user->updated_at}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{route('admin.user.index')}}" type="button" class="btn btn-default">Quay lại</a>
                        </div>
                    </div>
                    
                        
                    <form action="{{route('admin.user.updatePassword', ['id' => $user->id])}}" method="post"  class="validation-form">
                        {{csrf_field()}}
                    
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            {{-- <i class="fa fa-check-square-o text-black"></i> --}}

                            <h3 class="box-title">Đổi mật khẩu</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                   
                                <div class="form-group">
                                    <label>Mật khẩu mới @include('common.require')</label>
                                    <div class="clearfix">
                                        <input type="text" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <!-- /.form-group -->
                               
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Thay đổi</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    {{-- <script src="{{ asset('common/pagination-search.js') }}"></script> --}}
    <script src="{{ asset('modules/admin/user/user.js') }}"></script>
    <script src="{{ asset('modules/admin/user/user-validation.js') }}"></script>
@endpush