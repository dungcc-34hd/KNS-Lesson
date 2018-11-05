@isset($user)
    <input type="hidden" name="id" value="{{$user->id}}" id="user-id">
@endisset
@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/bower_components/select2/dist/css/select2.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
@endpush
<div class="col-md-6">
    <div class="form-group">
        <label>Name @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="name"
                   value="@isset($user){{$user->name}}@endisset">
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label>Email @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="email"
                   value="@isset($user){{$user->email}}@endisset">
        </div>
    </div>
    <!-- /.form-group -->
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Roles @include('common.require')</label>
        <div class="clearfix">
            <select class="form-control select2" multiple="multiple" data-placeholder="Select a Role" name="roles[]"
                    style="width: 100%;">
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<!-- /.col -->
@push('scripts')
    <script src="{{ asset('modules/admin/user/user.js') }}"></script>
    <script src="{{ asset('modules/admin/user/user-validation.js') }}"></script>
    <script src="{{ asset('assets/admin/bower_components/select2/dist/js/select2.full.js') }}"></script>
@endpush
