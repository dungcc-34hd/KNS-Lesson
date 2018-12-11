<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tạo nội dung chi tiết</h4>

    </div>

    <form action="{{route('admin.managerLesson.storeLessonContent')}}" method="post" class="validation-form"
          enctype="multipart/form-data" id="addLessonContent">
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
                           value="@isset($lessonContent){{$lessonContent->title}}@endisset" required>
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
                    <input type="file" class="form-control" name="background-music" >
                </div>
            </div>

            <div class="col-md-12">
                @if($typeId != 3)
                    <div id="field">
                        <div id="field0">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label label-name"
                                       for="action_id">{{\App\Models\LessonDetail::TYPE[$typeId]}}</label>
                                <div class="col-md-5 clearfix">
                                    <input type="file" class="add_field_button form-control " name="background-image[]"
                                           id="background-image" required>
                                </div>
                            </div>
                        </div>
                        <button id="add-more" name="add-more" class="btn btn-primary">Thêm</button>
                    </div>
                @endif
            </div>
            @if($typeId == 3)
                <div class="show-request-answer">
                    <div class="form-group">
                        <label>Câu hỏi @include('common.require')</label>
                        <div class="clearfix">
                            <textarea type="text" id="question" class="md-textarea form-control" rows="3"
                                      name="question" required></textarea>
                        </div>
                    </div>
                    <div class="answer-wrapper">
                        <label>Câu trả lời đúng @include('common.require') </label>
                        <input type="text" id="answer" class="md-textarea form-control" placeholder="Nhập câu trả lời đúng"
                                  name="answer[]" required>

                    </div>
                    <br/>
                    <div class="answer-wrapper">
                        <label>Câu trả lời Sai @include('common.require') </label>
                        <div class="input-group control-group after-add-more">
                            <input type="text" name="answerFail[]" class="form-control" placeholder="Nhập câu trả lời sai">
                            <div class="input-group-btn">
                                <button class="btn btn-success add-more" type="button"><i
                                            class="glyphicon glyphicon-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>



                    <!-- Copy Fields -->
                    <div class="copy hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="text" name="answerFail[]" class="form-control" placeholder="Nhập câu trả lời sai">
                            <div class="input-group-btn">
                                <button class="btn btn-danger remove" type="button"><i
                                            class="glyphicon glyphicon-remove"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>


                </div>
            @endif
            <br/>
            <div class="modal-footer" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary create-content-lesson " id="create-content-lesson">Cập nhật nội
                    dung
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
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
                    '                               id="background-image" required> ' +
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

            // $('.is-correct').each(function(index){
            //     $(this).click(function () {
            //         $('.is-correct').attr('value', 0);
            //         if ($(this).is(':checked')){
            //             $(this).attr('value', 1);
            //         }
            //     })
            //
            // });

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
                var html = $(".copy").html();
                $(".after-add-more").after(html);
            });


            $("body").on("click", ".remove", function () {
                $(this).parents(".control-group").remove();
            });


        });
    </script>
    @push('scripts')
        <script src="{{ asset('modules/admin/managerContent/lessonContent-validation.js')}}"></script>
@endpush


