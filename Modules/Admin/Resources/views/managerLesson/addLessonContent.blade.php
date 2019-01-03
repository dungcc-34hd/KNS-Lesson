<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tạo nội dung chi tiết</h4>

    </div>

    <form id="add-lesson-content" @if(isset($lessonContent))
    action="{{route('admin.managerLesson.updateLessonContent',$lessonContent->id)}}"
          @else
          action="{{route('admin.managerLesson.storeLessonContent')}}"
          @endif
          method="post"
          enctype="multipart/form-data">

        {{csrf_field()}}
        @isset($typeId)
            <input type="hidden" value="{{$typeId}}" name="type">
        @endisset
        @isset($lessonDetail)
            <input type="hidden" value="{{$lessonDetail}}" name="lesson-detail">
        @endisset
        @isset($id)
            <input type="hidden" value="{{$id}}" name="lesson-detail-id">
        @endisset
        @isset($lesson)
            <input type="hidden" value="{{$lesson}}" name="lesson">
        @endisset

        <div class="modal-body">
            <div class="form-group">
                <label>Tiêu đề hướng dẫn giáo viên @include('common.require')</label>
                <div class="clearfix">
                    <input type="text" id="title" class="form-control" name="title"
                           value="@isset($lessonContent){{$lessonContent->title}}@endisset">
                </div>
            </div>

            <div class="form-group field_wrapper" id="form-content">
                <div class="form-group">
                    <label>Nội dung hướng dẫn giáo viên @include('common.require')</label>
                    <div class="clearfix">
                            <textarea type="text" class="md-textarea form-control " rows="2"
                                      name="content[]"></textarea>
                    </div>
                    <div style="margin-top: 1em ; display:none" id="content">
                        <label>Nội dung hướng dẫn giáo viên @include('common.require')</label>
                        <textarea type="text" class="md-textarea form-control " rows="2"
                                  name="content[]" style="margin-top: 15px;"></textarea>
                        <a href="javascript:void(0);" style="margin-top: 1em"
                           class="btn btn-danger remove_content">Xóa</a>
                    </div>
                </div>

                <a href="javascript:void(0);" class="add_content btn btn-primary" title="Add field">Thêm</a>
            </div>

            <div class="form-group">
                <label>Nhạc nền</label>
                <div class="clearfix">
                    @isset($lessonContent){{$lessonContent->background_music}}@endisset
                    <input type="file" class="form-control background-music" name="background-music"
                           value="">
                </div>
            </div>
            @if($typeId != 3)
                <div class="col-md-12">
                    <div id="field">
                        <div id="field0">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="control-label label-name"
                                       for="action_id">{{\App\Models\LessonDetail::TYPE[$typeId]}}</label>
                                <h6>(Chọn nhiều {{\App\Models\LessonDetail::TYPE[$typeId]}})</h6><br>
                                <div class="col-md-12 clearfix">
                                    @if($lessonType->type == 1)
                                        <input type="file" accept="image/*" class="add_field_button form-control "
                                               name="background-image[]"
                                               id="background-image" multiple>
                                    @elseif($lessonType->type == 2)
                                        <input type="file" accept="video/*" class="add_field_button form-control "
                                               name="background-image[]"
                                               id="background-image" multiple>
                                    @endif
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($typeId == 3)
                <div class="show-request-answer">
                    <div class="form-group">
                        <label>Câu hỏi @include('common.require')</label>
                        <div class="clearfix">
                            <input type="text" id="question" class="form-control"
                                   name="question"
                                   value="">
                        </div>
                    </div>
                    <div class="answer-wrapper form-group">
                        <label>Câu trả lời đúng @include('common.require') </label>
                        <input type="text" id="answer" class="form-control"
                               placeholder="Nhập câu trả lời đúng"
                               name="answer[]"
                               value="">
                        <input type="checkbox" class=" answer_last" name="answer_last"
                               value="5"><label>Câu trả lời đúng ở cuối</label>
                    </div>
                    <br/>
                    <div class="answer-wrapper form-group">
                        <label>Câu trả lời Sai @include('common.require') </label>
                        <div class="input-group control-group after-add-more" style="width: 100%">
                            <input type="text" name="answer[]" class="form-control" 
                                   placeholder="Nhập câu trả lời sai">
                        </div>
                        <div id="form_answer_false">
                            <div style="display:none" id="answer_false">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="text" name="answer[]" class="form-control"
                                           placeholder="Nhập câu trả lời sai">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger remove" type="button"><i
                                                    class="glyphicon glyphicon-remove"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-success add-more" type="button"><i
                                        class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <br/>
            <div class="modal-footer" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary create-content-lesson " id="create-content-lesson">
                    Tạo nội dung
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
</div>
  <script src="{{asset('modules/admin/managerContent/addLessonContent-validation.js')}}"></script>
<script>
    $(document).ready(function () {

        $('.answer_last').click(function () {
            $(this).attr('value',0);
            if ($(this).is(':checked')){
                $(this).attr('value', 1);
            }
        });

        function changeAnswerCorrect(correct) {
            axios.get('/admin/manager-lesson/get-value-correct/' + correct).then(function (response) {
                var data = response.data;
            });
        }


        //add content
        $(".add_content").click(function () {
            var content = $('#content').clone().removeAttr("style");
            $('#form-content').append(content);
        });

        $('.field_wrapper').on("click", ".remove_content", function () {
            $(this).parent('div').remove();
        });

        //add answer
        $(".add-more").click(function () {
            var answer = $('#answer_false').clone().removeAttr("style");
            $('#form_answer_false').append(answer);
        });

        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });

    });
</script>




