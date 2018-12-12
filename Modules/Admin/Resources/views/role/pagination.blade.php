<tr>
    <th class="order-number">No.</th>
    <th>Tên</th>
    <th>Tên hiển thị</th>
    <th>Mô tả</th>
    <th>Quyền</th>/
    <th class="item-action-3"></th>
</tr>
  @if(count($roles) > 0)
    @foreach($roles as $key => $role)
        <tr>
            <td class="text-center">{{$key + 1}}</td>
            <td>{{$role->name_role}}</td>
            <td class="green">{{$role->display_role}}</td>
            <td>{{$role->description_role}}</td>
            <td>{{$role->name_permission}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    @if($role->id != 1)
                        <a class="btn btn-info"
                           href="{{route('admin.role.edit',['id' => $role->role_id])}}"
                           title="Edit">
                            <i class="ace-icon fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-danger delete-role"
                           href="#" title="Delete"
                           role_id="{{$role->role_id}}"
                           role_name="{{$role->display_role}}">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5">Không có bản ghi nào</td>
    </tr>
@endif
<input id="total-pages-current" type="hidden" value="{{ isset($pages) ? $pages : 0 }}">