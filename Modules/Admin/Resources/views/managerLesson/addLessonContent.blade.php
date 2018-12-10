<style>
    .hidden {
        display: none;
    }
    .formfield {
        float: left;
    }
    .example-template {
        clear: left;
    }
</style>
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
                <div class="">
                    <input type="text" id="title" class="form-control" name="title" required>
                </div>
            </div>
            <div class="form-group">
                <label>Nội dung @include('common.require')</label>
                <div class="clearfix">
                    <textarea type="text" id="content" class="md-textarea form-control" rows="3"
                              name="content"></textarea>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <div id="field">
                    <div id="field0">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="action_id">Slide </label>
                            <div class="col-md-5 clearfix">
                                <input type="file" class="form-control add_field_button" name="background-image[]"
                                       id="background-image" required>
                                {{--<input type="number" class="form-control" name="order-by[]" id="order-by" value="">--}}
                            </div>
                        </div>
                    </div>
                    <button id="add-more" name="add-more" class="btn btn-primary">Add More</button>
                </div>
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
                    <label>Câu trả lời @include('common.require') </label>
                    <div class="pull-right">Câu trả lời đúng <input type="radio" class="is-correct" style="width:15px"
                                                                    name="is-correct[]" value="0"></div>

                    <div class="md-form">
                    <textarea type="text" id="answer" class="md-textarea form-control" rows="3"
                              name="answer[]" required></textarea>

                    </div>
                    <label>Câu trả lời @include('common.require')</label>
                    <div class="pull-right">Câu trả lời đúng <input type="radio" class="is-correct" style="width:15px"
                                                                    name="is-correct[]" value="1"></div>
                    <div class="md-form">
                    <textarea type="text" id="answer" class="md-textarea form-control" rows="3"
                              name="answer[]" required></textarea>

                    </div>
                    <label>Câu trả lời @include('common.require')</label>
                    <div class="pull-right">Câu trả lời đúng <input type="radio" class="is-correct" style="width:15px"
                                                                    name="is-correct[]" value="2"></div>
                    <div class="md-form">
                <textarea type="text" id="answer" class="md-textarea form-control answer" rows="3"
                          name="answer[]" required></textarea>

                    </div>
                    <label>Câu trả lời @include('common.require')</label>
                    <div class="pull-right">Câu trả lời đúng <input type="radio" class="is-correct" style="width:15px"
                                                                    name="is-correct[]" value="3"></div>
                    <div class="md-form">
                    <textarea type="text" id="answer" class="md-textarea form-control " rows="3"
                              name="answer[]" required></textarea>
                    </div>
                    <br>
                </div>
            @endif
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary create-content-lesson " id="create-content-lesson">Tạo nội dung</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
    </form>
</div>
</div>
<script>
    $(document).ready(function () {
        //@naresh action dynamic childs
        var next = 0;
        $("#add-more").click(function (e) {
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            next = next + 1;
            var newIn = ' <div id="field' + next + '" name="field' + next + '">' +
                '<!-- Text input--><div class="form-group"> ' +
                '<label class="col-md-4 control-label" for="action_id">Slide</label> ' +
                '<div class="col-md-5"> ' +
                '<input type="file" class="form-control add_field_button" name="background-image[]"\n' +
                '                               id="background-image" required> ' +
                // ' <input type="number" class="form-control" name="order-by[]" id="order-by" value="">' +
                '</div>' +
                '</div></div>' +
                '<div class="form-group"> </div></div></div>';
            var newInput = $(newIn);
            var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field">';
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
    });
</script>
@push('scripts')
    <script src="{{ asset('modules/admin/managerContent/lessonContent-validation.js')}}"></script>
@endpush


