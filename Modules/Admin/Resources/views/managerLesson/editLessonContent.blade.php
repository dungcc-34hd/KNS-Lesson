<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sửa nội dung chi tiết</h4>
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

            <div class="form-group field_wrapper" id="form-content">
                @foreach($contents as  $content)
                    <div style="margin-top: 1em ">
                        <label>Nội dung @include('common.require')</label>
                        <textarea type="text" class="md-textarea form-control " rows="2"
                                  name="content[]" style="margin-top: 15px;" value="{{$content}}"
                            >{{$content}}</textarea>
                        <a href="javascript:void(0);" style="margin-top: 1em"
                           class="btn btn-danger remove_content">Xóa</a>
                    </div>
                @endforeach
                <div class="form-group">
                    <div style="margin-top: 1em ; display:none" id="content">
                        <label>Nội dung @include('common.require')</label>
                        <textarea type="text" class="md-textarea form-control " rows="2"
                                  name="content[]" style="margin-top: 15px;"></textarea>
                        <a href="javascript:void(0);" style="margin-top: 1em"
                           class="btn btn-danger remove_content">Xóa</a>
                    </div>
                </div>

                <a href="javascript:void(0);" class="add_content btn btn-primary" title="Add field">
                    Thêm
                </a>
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
                                        @foreach($audios as $audio)
                                            {{$audio}}<br>
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
                                        <div class="control-group input-group  answer-by-id" style="margin-top:10px">
                                            <input type="text" name="answer[]" class="form-control"
                                                   placeholder="Nhập câu trả lời sai" value="{{$answer->answer}}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger remove-by-id" type="button"
                                                        id="{{$answer->id}}">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </button>
                                            </div>
                                        </div>

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

                        </label>
                    </div>
                </div>
            @endif
            <br/>
            <div class="modal-footer" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary create-content-lesson " id="create-content-lesson">
                        Cập nhật nội dung
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
</div>
<script src="{{asset('modules/admin/managerContent/lessonContent-validation.js')}}"></script>
<script src="{{asset('modules/admin/managerContent/lessonContentCustom.js')}}"></script>





