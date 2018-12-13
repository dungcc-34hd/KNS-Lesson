@isset($role)
    <input type="hidden" name="id" value="{{$role->role_id}}">
@endisset
<div class="col-md-6">
    <div class="form-group">
        <label>Tên @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="name"
                   value="@isset($role) {{ $role->name_role }} @endisset">
            {{-- @if($errors) --}}
                <span style="color: #dd4b39;" >{{$errors->first('name')}}</span> 
            {{-- @endif --}}
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label>Tên hiển thị @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control name" name="display_name"
                   value="@isset($role) {{ $role->display_role }} @endisset">
            @if($errors)
                <span style="color: #dd4b39;" class="text-danger">{{$errors->first('display_name')}}</span> 
            @endif
        </div>
    </div>
    <!-- /.form-group -->
</div>
<!-- /.col -->
<div class="col-md-6">
    <div class="form-group">
        <label>Quyền @include('common.require')</label>
        <div class="clearfix">   
            <select  class="select-option form-control" name="permission_id" id="">
                 <option value="">Chọn quyền</option>
                @foreach($permissions as $key => $value)
                <option @if(isset($role) && $role->permission_id == $value->id) selected @endif value="{{$value->id}}">{{$value->name}}</option>

                @endforeach
            </select>
             @if($errors)
                <span style="color: #dd4b39;" class="text-danger">{{$errors->first('permission_id')}}</span> 
            @endif
        </div>
        
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label>Mô tả</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="description"
                   value="@isset($role) {{ $role->description_role }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->
</div>
@push('scripts')
    {{-- <script src="{{ asset('modules/admin/role/role-validation.js') }}"></script> --}}
@endpush
