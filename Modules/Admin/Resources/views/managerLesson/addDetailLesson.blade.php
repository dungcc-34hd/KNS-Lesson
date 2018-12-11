<div class="modal-content">
    <form @if(isset($lessonDetail))
          action="{{route('admin.managerLesson.updateLessonDetail',[$lessonDetail->id])}}"
          @else
          action="{{route('admin.managerLesson.storeLessonDetail')}}"
          @endif
          method="post" class="validation-form"
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
                        <input type="text" class="form-control" name="detail-lesson" id="detail-lesson"
                               value="@isset($lessonDetail) {{$lessonDetail->title}} @endisset" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Kiểu định dạng @include('common.require')</label>
                    <div class="clearfix">
                        <select class="form-control" name="type" id="type" required>
                            @if(isset($lessonDetail))
                                <option value="{{$lessonDetail->type}}" {{\App\Models\LessonDetail::TYPE[$lessonDetail->type] ? "selected" : ''}}>{{\App\Models\LessonDetail::TYPE[$lessonDetail->type]}}</option>
                            @else
                                <option value="1">PhotoSlide</option>
                                <option value="2">Video</option>
                                <option value="3">Quiz_1DapAn</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Outline @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="outline" id="outline"
                               value="@isset($lessonDetail) {{$lessonDetail->outline}} @endisset">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary create-detail-lesson" id="create-detail-lesson">
                    @if(isset($lessonDetail))
                        Sửa nội dung
                    @else
                        Tạo bài học
                    @endif
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