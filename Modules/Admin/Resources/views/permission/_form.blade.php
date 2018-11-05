@isset($permission)
    <input type="hidden" name="id" value="{{$permission->id}}">
@endisset
<div class="col-md-6">
    <div class="form-group">
        <label>Name @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="name"
                   value="@isset($permission) {{ $permission->name }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label>Display Name @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="display_name"
                   value="@isset($permission) {{ $permission->display_name }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->
</div>
<!-- /.col -->
<div class="col-md-6">
    <div class="form-group">
        <label>Type @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="type"
                   value="@isset($permission) {{ $permission->type }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label>Description</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="description"
                   value="@isset($permission) {{ $permission->description }} @endisset">
        </div>
    </div>
    <!-- /.form-group -->
</div>
@push('scripts')
    <script src="{{ asset('modules/admin/permission/permission.js') }}"></script>
    <script src="{{ asset('modules/admin/permission/permission-validate.js') }}"></script>
@endpush
