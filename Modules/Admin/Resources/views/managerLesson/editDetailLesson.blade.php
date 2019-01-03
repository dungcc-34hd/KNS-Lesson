<div class="modal-content">
    <form action="{{route('admin.managerLesson.updateLessonDetail',[$lessonDetail->id])}}"
          method="post" class="validation-form"
          enctype="multipart/form-data" id="formAddDetailLesson">
    {{csrf_field()}}
        @isset($lessonId)
            <input type="hidden" value="{{$lessonId}}" name="lesson-id" class="lesson-id"/>
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
                    <label>Tên thư mục chứa nội dung @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="detail-lesson" id="detail-lesson"
                               value="{{$lessonDetail->title}} ">
                        <input type="hidden" class="form-control" name="detail-lesson-id" id="detail-lesson-id"
                               value="{{$lessonDetail->id}}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Tiêu đề nội dung bài học @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{$lessonDetail->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Kiểu định dạng </label>
                    <div class="clearfix">
                        <select class="form-control" name="type" id="type">
                            <option value={{$types->type}}>{{$types->name}}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Outline </label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="outline" id="outline"
                               value=" {{$lessonDetail->outline}} ">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary create-detail-lesson" id="create-detail-lesson">
                    Sửa nội dung
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
</div>

</div>

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