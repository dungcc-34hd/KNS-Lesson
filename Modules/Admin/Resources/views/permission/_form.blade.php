@isset($permission)
    <input type="hidden" name="id" value="{{$permission->id}}">
@endisset
<div class="col-md-6">
    <div class="form-group">
        <label>Tên @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="name"
                   value="@isset($permission) {{ $permission->name }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label>Tên hiển thị @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="display_name"
                   value="@isset($permission) {{ $permission->display_name }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->
      <!-- /.form-group -->
    <div class="form-group">
        <label>Mô tả</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="description"
                   value="@isset($permission) {{ $permission->description }} @endisset">
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
