<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tạo nội dung chi tiết</h4>

    </div>

    <form id="add-lesson-content" action="{{route('admin.managerLesson.updateLessonContent',$lessonContent->id)}}"
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
                <label>Tiêu đề@include('common.require')</label>
                <div class="clearfix">
                    <input type="text" id="title" class="form-control" name="title"
                           value="@isset($lessonContent){{$lessonContent->title}}@endisset">
                </div>
            </div>

            <div class="form-group field_wrapper">
                @if(isset($contents))
                    @foreach($contents as  $content)
                        <label>Nội dung @include('common.require')</label>
                        <div class="clearfix">
                            <textarea type="text" id="content" class="md-textarea form-control " rows="2"
                                      name="content[]"
                                      value="{{$content}}">{{$content}}</textarea></div>
                    @endforeach
                @else
                    <label>Nội dung @include('common.require')</label>
                    <div class="clearfix">
                            <textarea type="text" id="content" class="md-textarea form-control " rows="2"
                                      name="content[]"
                            ></textarea></div>
                @endif

                <br/>
                <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">Thêm</a>
            </div>

            <div class="form-group">
                <label>Nhạc nền</label>
                <div class="clearfix">
                    @isset($lessonContent){{$lessonContent->background_music}}@endisset
                    <input type="file" accept="audio/*" class="form-control background-music" name="background-music"
                           value="">
                </div>
            </div>
            @if($lessonType->type != 3)
                <div class="col-md-12">
                    <div id="field">
                        <div id="field0">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="control-label label-name"
                                       for="action_id">{{\App\Models\LessonType::TYPE[$lessonType->type]}}</label>
                                <h6>(Chọn nhiều {{\App\Models\LessonType::TYPE[$lessonType->type]}})</h6><br>
                                <div class="col-md-12 clearfix">
                                    @if(isset($audios))
                                        @foreach($audios as $audio)
                                            {{$audio}}
                                        @endforeach
                                        @if($lessonType->type == 1)
                                            <input type="file" accept="image/*" class="add_field_button form-control "
                                                   name="background-image[]"
                                                   id="background-image" multiple>
                                        @elseif($lessonType->type == 2)
                                            <input type="file" accept="video/*" class="add_field_button form-control "
                                                   name="background-image[]"
                                                   id="background-image" multiple>
                                        @endif
                                    @else
                                        @if($lessonType->type == 1)
                                            <input type="file" accept="image/*" class="add_field_button form-control "
                                                   name="background-image[]"
                                                   id="background-image" multiple>
                                        @elseif($lessonType->type == 2)
                                            <input type="file" accept="video/*" class="add_field_button form-control "
                                                   name="background-image[]"
                                                   id="background-image" multiple>
                                        @endif
                                    @endif
                                </div>
                                <br><br>
                            </div>
                        </div>
                        {{--<button id="add-more" name="add-more" class="btn btn-primary">Thêm</button>--}}
                    </div>
                </div>
            @endif
            @if($lessonType->type == 3)
                <div class="show-request-answer">
                    <div class="form-group">
                        <label>Câu hỏi @include('common.require')</label>
                        <div class="clearfix">
                            <input type="text" id="question" class="form-control"
                                   name="question"
                                   value="@isset($lessonContent){{$lessonContent->question}}@endisset">
                        </div>
                    </div>
                    <div class="answer-wrapper">
                        <label>Câu trả lời đúng @include('common.require') </label>
                        <input type="text" id="answer" class="form-control"
                               placeholder="Nhập câu trả lời đúng"
                               name="answer[]"
                               value="@isset($lessonAnswer)@foreach($lessonAnswer as $answer)@if($answer->is_correct == 1){{$answer->answer}}@endif @endforeach @endisset">
                        <input type="checkbox" class=" answer_last" name="answer_last"
                               @if($lessonIscorrect)
                               {{($lessonIscorrect->answer_last == 1) ? 'checked' :''}}
                               value="{{$lessonIscorrect->answer_last}}"><label>Câu trả lời đúng ở cuối</label>
                        @endif
                    </div>
                    <br/>

                    <div class="answer-wrapper">
                        <label>Câu trả lời Sai @include('common.require') </label>
                        <div class="input-group control-group after-add-more" style="width: 100%">
                            @if(isset($lessonAnswer))
                                @foreach($lessonAnswer as $key => $answer)
                                    @if($answer->is_correct == 0)
                                        <input type="text" name="answer[]" class="form-control"
                                               placeholder="Nhập câu trả lời sai"
                                               value=" {{$answer->answer}}">
                                    @endif
                                @endforeach
                            @else
                                <input type="text" name="answer[]" class="form-control"
                                       placeholder="Nhập câu trả lời sai">
                            @endif
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
                    @if(isset($lessonContent))
                        Cập nhật nội dung
                    @else
                        Tạo nội dung
                    @endif
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
</div>
<script src="{{asset('modules/admin/managerContent/lessonContent-validation.js')}}"></script>
<script>
    $(document).ready(function () {
        //@naresh action dynamic childs
        var next = 0;
        $("#add-more").click(function (e) {
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            var label_name = $('.label-name').text();
            next = next + 1;
            var newIn = '<div id="field' + next + '" name="field' + next + '">' +
                '<!-- Text input--><div class="form-group"> ' +
                '<label class="col-md-4 control-label" for="action_id">' + label_name + '</label> ' +
                '<div class="col-md-5"> ' +
                '<input type="file" class="form-control add_field_button" name="background-image[]"\n' +
                '                               id="background-image"> ' +
                '</div>' +
                '</div></div>' +
                '<div class="form-group"> </div></div></div>';
            var newInput = $(newIn);
            var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Xóa</button></div></div><div id="field">';
            var removeButton = $(removeBtn);
            $(addto).after(newInput);
            $(addRemove).after(removeButton);
            $("#field" + next).attr('data-source', $(addto).attr('data-source'));
            $("#count").val(next);

            $('.remove-me').click(function (e) {
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length - 1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
        });

        $('.answer_last').click(function () {
            $(this).attr('value', 0);
            if ($(this).is(':checked')) {
                $(this).attr('value', 1);
            }
        });

        function changeAnswerCorrect(correct) {
            axios.get('/admin/manager-lesson/get-value-correct/' + correct).then(function (response) {
                var data = response.data;
            });
        }

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div style="margin-top: 1em"> <textarea type="text" id="content" class="md-textarea form-control " rows="2"\n' +
            '                              name="content[]"></textarea><a href="javascript:void(0);" style="margin-top: 1em" class="btn btn-danger remove_button">Xóa</a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });

        //add answer
        $(".add-more").click(function () {
            var html = $('#answer_false').clone().removeAttr("style");
            $('#form_answer_false').append(html);
        });

        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });

    });
</script>




