<div class="modal-content">
    <form @if(isset($district))
          action="{{route('admin.managerArea.updateDistrict',[$district->id])}}"
          @else
          action="{{route('admin.managerArea.storeDistrict')}}"
          @endif
          method="post" class="validation-form-lesson">
        {{csrf_field()}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tạo quận/huyện</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Quận/Huyện @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="name" value="@isset($district){{$district->name}}@endisset">
                        @if($errors)
                            <span style="color: #dd4b39;">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label>Khu vực @include('common.require')</label>
                    <select class="form-control" name="area_id" id="selectArea">
                        <option value="">Chọn khu vực</option>
                        @foreach ($areas as $key => $area)
                            <option value="{{$area->id}}"@isset($provinceId) {{$provinceId->area_id == $area->id ? "selected" : '' }}@endisset>{{$area->name}}</option>
                        @endforeach
                    </select>
                    @if($errors)
                        <span style="color: #dd4b39;">{{$errors->first('area_id')}}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Tỉnh/Thành phố @include('common.require')</label>
                    <select class="form-control" name="province_id" id="provinces">
                        <option value="">Chọn tỉnh/thành phố</option>
                        @foreach ($provinces as $key => $province)
                            <option value="{{$province->id}}" @isset($district){{$district->province_id == $province->id ? "selected" : '' }}@endisset>{{$province->name}}</option>
                        @endforeach
                    </select>
                    @if($errors)
                        <span style="color: #dd4b39;">{{$errors->first('province_id')}}</span>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="create-grade">
                    @if(isset($lesson))
                        Sửa quận/huyện
                    @else
                        Tạo quận/huyện
                    @endif
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
</div>
</div>
<script src="{{ asset('modules/admin/managerContent/lesson-validation.js')}}"></script>
