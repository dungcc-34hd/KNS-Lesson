<div class="modal fade" id="modalAddGrade" role="dialog">
    <div class="modal-dialog">
        <form action="{{route('admin.managerLesson.storeLesson')}}" method="post" class="validation-form">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tạo bài học</h4>
                </div>
                <div class="modal-body">
                    <label>Chọn khối @include('common.require')</label>
                    <select class="form-control" name="grade" id="grade">
                        <option value="">Chọn khối</option>
                        @foreach ($grades as $key => $grade)
                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-body">
                    <label>Tên bài học @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                {{--<div class="modal-body">--}}
                    {{--<label>Nhạc nền @include('common.require')</label>--}}
                    {{--<div class="clearfix">--}}
                        {{--<input type="file" class="form-control" name="background-audio" id="background-audio">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<label>Ảnh nền @include('common.require')</label>--}}
                    {{--<div class="clearfix">--}}
                        {{--<input type="file" class="form-control" name="background-image" id="background-image">--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="create-grade">Tạo bài học
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
    </div>

</div>
</div>