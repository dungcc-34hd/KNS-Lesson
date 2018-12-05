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
          enctype="multipart/form-data">
        {{csrf_field()}}
        @isset($typeId)
            <input type="hidden" value="{{$typeId}}" name="type">
        @endisset
        @isset($title)
            <input type="hidden" value="{{$title}}" name="title">
        @endisset
        @isset($id)
            <input type="hidden" value="{{$id}}" name="id">
        @endisset

        <div class="modal-body">
            <label>Nội dung @include('common.require')</label>
            <div class="md-form">
                <textarea type="text" id="content" class="md-textarea form-control" rows="3" name="content"></textarea>
            </div>
            <br>
            <div class="col-xs-12">
                <div class="col-md-12">
                    <div id="field">
                        <div id="field0">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="action_id">Slide </label>
                                <div class="col-md-5">
                                    <input type="file" class="form-control add_field_button" name="background-image[]"
                                           id="background-image">
                                    <input type="number" class="form-control" name="order-by[]" id="order-by" value="">
                                </div>
                                <br>
                            </div>
                        </div>
                        <button id="add-more" name="add-more" class="btn btn-primary">Add More</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary create-content-lesson button-request"
                    id="create-content-lesson">Tạo nội dung
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modalAddLessonContent">Close</button>
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
                '                               id="background-image"> ' +
                ' <input type="number" class="form-control" name="order-by[]" id="order-by" value="">' +
                '</div>' +
                '</div><br></div>' +
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

    });
</script>

