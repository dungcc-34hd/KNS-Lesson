<div class="modal-content">
<form action="{{route('admin.managerLesson.storeLessonDetail')}}" method="post" class="validation-form"
              enctype="multipart/form-data" id="formAddDetailLesson">
            {{csrf_field()}}
            @isset($lessonId)
            <input type="hidden" value="{{$lessonId}}" name="lesson-id"/>
            @endisset
            @isset($lessonName)
                <input type="hidden" value="{{$lessonName}}" name="lesson-detail"/>
             @endisset
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tạo tiêu đề nội dung</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên bài học @include('common.require')</label>
                        <div class="clearfix">
                            <input type="text" class="form-control" name="detail-lesson" id="detail-lesson" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kiểu định dạng @include('common.require')</label>
                        <div class="clearfix">
                            <select class="form-control" name="type" id="type" required>
                                <option value="1">PhotoSlide</option>
                                <option value="2">Video</option>
                                <option value="3">Quiz_1DapAn</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Outline @include('common.require')</label>
                        <div class="clearfix">
                            <input type="text" class="form-control" name="outline" id="outline">
                        </div>
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
                    <button type="submit" class="btn btn-primary create-detail-lesson" id="create-detail-lesson">Tạo
                        tiêu đề
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
    </div>

</div>
</div>
@push('scripts')
    <script src="{{ asset('modules/admin/managerContent/lessonDetail-validation.js')}}"></script>
    <script>
        $('.modalDetailLesson').on('click', function () {
            var id = $(this).data('value');
            var text = $(this).data('text');
            $.ajax({
                type: "GET",
                url: '/admin/manager-lesson/get-value-lesson-detail/' + id + '/' + text,
                data: {'lesson-id': id, 'lesson-name': text},
                success: function (msg) {

                }
            });
        });
    </script>
@endpush