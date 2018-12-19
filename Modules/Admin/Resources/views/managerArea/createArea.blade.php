<div class="modal-content">
    <form @if(isset($area))
          action="{{route('admin.managerArea.updateArea',[$area->id])}}"
          @else
          action="{{route('admin.managerArea.storeArea')}}"
          @endif
          method="post" class="validation-form-lesson">
        {{csrf_field()}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tạo khu vực</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tên khu vực @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="name"
                               value="@isset($area){{$area->name}}@endisset">
                        @if($errors)
                            <span style="color: #dd4b39;" class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label>Mô tả @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="description"
                               value="@isset($area){{$area->description}}@endisset">
                        @if($errors)
                            <span style="color: #dd4b39;" class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="create-grade">
                    @if(isset($area))
                        Sửa khu vực
                    @else
                        Tạo khu vực
                    @endif
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
</div>
</div>
<script src="{{ asset('modules/admin/managerContent/lesson-validation.js')}}"></script>
