<div class="modal fade" id="modalAddDetailLesson" role="dialog">
    <div class="modal-dialog">
        <form action="{{route('admin.titleLesson.storeLessonDetail')}}" method="post" class="validation-form"
              enctype="multipart/form-data" id="formAdđetailLesson">
        {{csrf_field()}}
            <input type="hidden" class="addDetailLesson" value="#" name="#" />
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tạo tiêu đề nội dung</h4>
                </div>
                <div class="modal-body">
                    <label>Tên tiêu đề nội dung @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="detail-lesson" id="detail-lesson">
                    </div>
                </div>
                <div class="modal-body">
                    <label>Kiểu định dạng @include('common.require')</label>
                    <div class="clearfix">
                        <select class="form-control" name="select-type">
                            <option value="">Chọn kiểu </option>
                            <option value="1">PhotoSlide</option>
                            <option value="2">Video</option>
                            <option value="3">Quiz_1DapAn</option>
                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <label>Outline @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="onutline" id="onutline">
                    </div>
                </div>
                <div class="modal-body">
                    <label>Nhạc nền @include('common.require')</label>
                    <div class="clearfix">
                        <input type="file" class="form-control" name="background-audio" id="background-audio">
                    </div>
                </div>
                <div class="modal-body">
                    <label>Ảnh nền @include('common.require')</label>
                    <div class="clearfix">
                        <input type="file" class="form-control" name="background-image" id="background-image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="create-detail-lesson">Tạo tiêu đề</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
    </div>

</div>
</div>