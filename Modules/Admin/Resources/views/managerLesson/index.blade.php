@extends('admin::layouts.master')
@section('title')
    Create Title Lesson
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('/modules/admin/managerContent/managerContent.css')}}">
@endpush
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý bài học</li>
        </ol>
        <section class="content">
            <div class="clearfix">
                <button type="button" class="btn btn-primary  modal-show"
                        data-url="/admin/manager-lesson/add-lesson"
                        >Tạo bài học</button>
            </div>
            <br>
            <div class="col-md-12">
                    <div class="col-md-7">
                        <h4>Danh sách bài học</h4>
                    </div>
                    <div class="col-md-3">
                        <select  class="form-control" name="grade_id" style="margin-left: 8em;">
                            <option value="">Chọn khối</option>
                            @foreach ($grades as $key => $grades)
                                <option value="{{$grades->id}}">{{$grades->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="box-tools" style="margin-left: 8em;">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="nav-search-input" name="table_search" class="form-control pull-right"
                                       placeholder="Tìm kiếm">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div><div style="clear: both"></div>


            @foreach($lessons as $lesson)
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h5 class="box-title"> Bài học {{$lesson->name}}
                            <button type="button" class="btn btn-info modalDetailLesson modal-show"
                                    data-url="/admin/manager-lesson/get-value-lesson-detail/{{$lesson->id}}"
                                    data-value="{{$lesson->id}}" data-text="{{$lesson->name}}">Thêm nội dung {{$lesson->name}}</button>

                        </h5>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>

                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary  modal-show"
                                        data-url="/admin/manager-lesson/edit-lesson/{{$lesson->id}}"
                                ><i class="ace-icon fa fa-pencil"></i></button>

                                <a href="#" class="btn btn-danger delete-object"
                                   title="Delete"
                                   object_id="{{$lesson->id}}"
                                   object_name="{{$lesson->name}}">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <table class="table table-hover results-table">
                            <tbody>
                            <tr>
                                <th class="order-number">Id.</th>
                                <th>Nội dung</th>
                                <th class="item-action-3 pull-right">Status</th>
                            </tr>
                            @if(!empty($lesson->lessonDetail))
                                @foreach($lesson->lessonDetail as $key=>$item)
                                    <tr>
                                        <td class="">{{$key + 1}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary modalLessonContent modal-show"
                                                    data-url="/admin/manager-lesson/get-value-type/{{$item->id}}"
                                                    value="{{$item->id}}"> {{$item->title}}</button>

                                        </td>
                                        <td class="pull-right">
                                            <div class="btn-group btn-group-sm">
                                                {{--<a class="btn btn-success"--}}
                                                   {{--href="{{route('admin.managerLesson.showDetailLesson',['id' => $item->id])}}"--}}
                                                   {{--title="Detail">--}}
                                                    {{--<i class="fa fa-eye"></i>--}}
                                                {{--</a>--}}
                                                <button type="button" class="btn btn-primary  modal-show"
                                                        data-url="/admin/manager-lesson/edit-lesson-detail/{{$item->id}}"
                                                >Sửa nội dung</button>
                                                <button type="button" class="btn btn-success  modal-show"
                                                data-url="/admin/manager-lesson/edit-lesson-content/{{$item->id}}">Sửa nội dung chi tiết</button>
                                                <a href="#" class="btn btn-danger delete-object"
                                                   title="Delete"
                                                   object_id="{{$item->id}}"
                                                   object_name="{{$item->name}}">
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
                </div>
            @endforeach
        </section>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/admin/managerContent/managerContent.js') }}"></script>
@endpush

