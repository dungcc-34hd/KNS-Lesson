@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/iCheck/all.css') }}">
@endpush
<form method="post"
      @isset($edit) action="{{route('admin.role.edit',['id' => $role->id])}}" @endisset
      @isset($create) action="{{route('admin.role.create')}}" @endisset
      class="form-horizontal validation-form">
    {{csrf_field()}}
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-check-square-o text-black"></i>

                        <h3 class="box-title">Descriptions</h3>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                @include('common.message')
                                @if((isset($edit) || isset($view)) && $role->id != 1)

                                    @isset($view)
                                        <a href="{{route('admin.role.edit',['id' => $role->id])}}"
                                           class="btn btn-success"> Update</a>
                                        <a href="/role/delete-view-detail/{{$role->id}}"
                                           role_name="{{$role->display_name}}"
                                           class="btn btn-danger delete-role-ve">Delete</a>
                                    @endisset
                                    @isset($edit)
                                        <button type="submit"
                                                class="btn btn-primary"> Save
                                        </button>
                                        <a href="/role/delete-view-detail/{{$role->id}}"
                                           role_name="{{$role->display_name}}"
                                           class="btn btn-danger">Delete</a>
                                    @endisset


                                @endif

                                @isset($create)
                                    <div class="form-group">
                                        @isset($create)
                                            <button type="submit"
                                                    class="btn btn-success btn-lg"> Create
                                            </button>
                                        @endisset
                                    </div>
                                @endisset

                                @isset($view)
                                    @if(!is_null($role))
                                        <table id="simple-table"
                                               class="table table-bordered table-hover table-striped">
                                            <tbody>
                                            <tr>
                                                <td>ID</td>
                                                <td>
                                                    {{$role->id}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td>
                                                    {{$role->name}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Display Name</td>
                                                <td>
                                                    {{$role->display_name}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>
                                                    {{$role->description}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Created At</td>
                                                <td>
                                                    {{$role->created_at}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Updated At</td>
                                                <td>
                                                    {{$role->updated_at}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                @endisset

                                @if(isset($edit) || isset($create))
                                    @isset($edit)<input type="hidden" name="id" value="{{ $role->id }}">@endisset
                                    <div class="form-group">
                                        <label class="bolder blue control-label col-sm-2 col-md-3"
                                               for="name">Name @include('common.require')</label>
                                        <div class="col-sm-8 col-md-7">
                                            <div class="clearfix">
                                                <input name="name" id="name" @isset($edit) readonly
                                                       @endisset class="form-control"
                                                       value="@isset($edit){{$role->name }}@endisset">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="bolder blue control-label col-sm-2 col-md-3" for="display_name">Display
                                            name @include('common.require')</label>
                                        <div class="col-sm-8 col-md-7">
                                            <div class="clearfix">
                                                <input class="form-control" id="display_name" name="display_name"
                                                       value="@isset($edit){{ $role->display_name }}@endisset">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="bolder blue control-label col-sm-2 col-md-3" for="description">Description</label>
                                        <div class="col-sm-8 col-md-7">
                                            <div class="clearfix">
                                            <textarea class="form-control" id="description" name="description"
                                                      rows="4">@isset($edit){{ $role->description }}@endisset</textarea>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-key text-black"></i>

                        <h3 class="box-title">Permissions</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(count($permissionByType) > 0)
                            @foreach($permissionByType as $type)
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{$type->type}}</h3>
                                </div>
                                <div class="box-body">
                                    <div class="demo-checkbox">
                                        <div class="row">
                                            @if(count($permissions) > 0)
                                                @foreach($permissions as $key => $permission)
                                                    @if($permission['type'] == $type->type)
                                                        <div class="col-md-6">
                                                            @if(isset($view))
                                                                <div class="state icheckbox_square-green @if($permission['has'] === 1) checked @endif"></div>
                                                            @else
                                                                <input type="checkbox" id="md_checkbox_{{$key}}"
                                                                       name="permission[{{$permissions[$key]['id']}}]"
                                                                       class="flat-red flat-state"
                                                                       @if($permission['has'] === 1) checked @endif/>
                                                            @endif
                                                                <label for="md_checkbox_{{$key}}"> {{$permission['name']}}</label>

                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</form>
@push('scripts')
    <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('modules/admin/role/role.js') }}"></script>
@endpush