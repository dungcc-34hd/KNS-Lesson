<div class="modal-content">
    <form @if(isset($lesson))
          action="{{route('admin.managerLesson.updateLesson',[$lesson->id])}}"
          @else
          action="{{route('admin.managerLesson.storeLesson')}}"
          @endif
          method="post" class="validation-form-lesson">
        {{csrf_field()}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sửa bài học</h4>
            </div>
            <div class="modal-body ">
                @if($lesson && !is_null($lesson->grade_id))
                <div class="form-group form-grade">
                    <label>Chọn khối @include('common.require')</label>
                    <div class="clearfix">
                        <select class="form-control grade" name="grade" >
                            <option value="">Chọn khối</option>
                            @foreach ($grades as $grade)
                                @if(isset($lesson))
                                    <option value="{{$grade->id}}" {{$grade->id == $lesson->grade_id ? "selected" : ''}}>{{$grade->name}}</option>
                                @else
                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @else
                <div class="form-group form-thematic">
                    <label>Chọn chuyên đề @include('common.require')</label>
                    <div class="clearfix">
                        <select class="form-control thematic" name="thematic" >
                            <option value="">Chọn chuyên đề</option>
                            @foreach ($thematics as $thematic)
                                    <option value="{{$thematic->id}}" {{$thematic->id == $lesson->thematic_id ? "selected" : ''}}>{{$thematic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label>Tên bài học @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="name" value="{{$lesson->name}}">
                        <input type="hidden" class="form-control" name="lesson-name" id="lesson-name" value="{{$lesson->id}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="create-grade">
                    @if(isset($lesson))
                        Sửa bài học
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

<script src="{{ asset('modules/admin/managerContent/lesson-validation.js')}}"></script>
<script src="{{ asset('modules/admin/managerContent/lessonCustom.js')}}"></script>