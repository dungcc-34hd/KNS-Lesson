@isset($role)
    <input type="hidden" name="id" value="{{$role->role_id}}">
@endisset
<div class="col-md-6">
    <div class="form-group">
        <label>Tên @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="name"
                   value="@isset($role) {{ $role->name_role }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label>Tên hiển thị @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="display_name"
                   value="@isset($role) {{ $role->display_role }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->

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
<!-- /.col -->

  
</div>
@push('scripts')
    <script src="{{ asset('modules/admin/permission/permission.js') }}"></script>
    <script src="{{ asset('modules/admin/permission/permission-validate.js') }}"></script>
@endpush
