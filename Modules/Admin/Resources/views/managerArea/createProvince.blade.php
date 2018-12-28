<div class="modal-content">
    <form @if(isset($province))
          action="{{route('admin.managerArea.updateProvince',[$province->id])}}"
          @else
          action="{{route('admin.managerArea.storeProvince')}}"
          @endif
          method="post" class="validation-form">
        {{csrf_field()}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tạo tỉnh/thành phố</h4>
            </div>
            <div class="modal-body">
                 @isset($province)
                    <input type="hidden" value="{{$province->id}}" id="id">
                @endisset
                <div class="form-group">
                    <label>Tỉnh/Thành phố @include('common.require')</label>
                    <div class="clearfix">
                        <input type="text" class="form-control" name="name" value="@isset($province){{$province->name}}@endisset">
                    </div>
                </div>
                <div class="form-group">
                    <label>Khu vực @include('common.require')</label>
                    <select  class="form-control" name="area_id">
                        <option value="">Chọn khu vực</option>
                        @foreach ($areas as $key => $area)
                            <option value="{{$area->id}}" @isset($province){{ $province->area_id == $area->id ? "selected" : '' }}@endisset>{{$area->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="create-grade">
                    @if(isset($province))
                        Sửa tỉnh/thành phố
                    @else
                        Tạo tỉnh/thành phố
                    @endif
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </form>
</div>
</div>
<script src="{{ asset('modules/admin/managerArea/province-validation.js')}}"></script>
<script src="{{ asset('modules/admin/school/school.js')}}"></script>
