<tr>
    <th class="order-number">No.</th>
    <th>Name</th>
    <th>Display Name</th>
    <th>Description</th>
    <th class="item-action-3"></th>
</tr>
@if(!empty($permissions))
    @foreach($permissions as $key => $permission)
        <tr>
            <td class="text-center">{{$key + 1}}</td>
            <td>{{$permission->name}}</td>
            <td class="green">{{$permission->display_name}}</td>
            <td>{{$permission->description}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a class="btn btn-success"
                       href="{{route('admin.permission.view',['id' => $permission->id])}}"
                       title="Detail">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-info"
                       href="{{route('admin.permission.edit',['id' => $permission->id])}}"
                       title="Edit">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                    <a class="btn btn-danger delete-role"
                       href="#" title="Delete"
                       role_id="{{$permission->id}}"
                       role_name="{{$permission->display_name}}">
                        <i class="fa fa-trash-o"></i>
                    </a>

                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5">No Records</td>
    </tr>
@endif
<input id="total-pages-current" type="hidden" value="{{ isset($pages) ? $pages : 0 }}">