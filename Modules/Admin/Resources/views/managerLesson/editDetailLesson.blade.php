<div class="modal-content">
    <form action="{{route('admin.managerLesson.updateLessonDetail',[$lessonDetail->id])}}"
          method="post" class="validation-form"
          enctype="multipart/form-data" id="formAddDetailLesson">
<<<<<<< HEAD
    {{csrf_field()}}
        @isset($lessonId)
            <input type="hidden" value="{{$lessonId}}" name="lesson-id" class="lesson-id"/>
        @endisset
        @isset($lessonName)
            <input type="hidden" value="{{$lessonName}}" name="lesson-detail"/>
    @endisset
=======
        {{csrf_field()}}
>>>>>>> develop
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
                               value="{{$lessonDetail->title}} ">
<<<<<<< HEAD
                        <input type="hidden" class="form-control" name="detail-lesson-id" id="detail-lesson-id"
                               value="{{$lessonDetail->id}}">
=======
>>>>>>> develop
                    </div>
                </div>

                <div class="form-group">
                    <label>Tên tiêu đề bài học @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{$lessonDetail->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Kiểu định dạng </label>
                    <div class="clearfix">
                        <select class="form-control" name="type" id="type">
<<<<<<< HEAD
                            <option value={{$types->type}}>{{$types->name}}</option>
=======
                                <option value={{$types->type}}>{{$types->name}}</option>
>>>>>>> develop
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Outline @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="outline" id="outline"
                               value=" {{$lessonDetail->outline}} ">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary create-detail-lesson" id="create-detail-lesson">
<<<<<<< HEAD
                    Sửa nội dung
=======
                        Sửa nội dung
>>>>>>> develop
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
</div>

</div>
<<<<<<< HEAD

=======
</div>
>>>>>>> develop
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