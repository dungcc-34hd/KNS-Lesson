<tr>
    <th class="order-number">No.</th>
    <th>Name</th>
    <th>Display Name</th>
    <th>Description</th>
    <th class="item-action-3"></th>
</tr>
@if(count($roles) > 0)
    @foreach($roles as $key => $role)
        <tr>
            <td class="text-center">{{($currentPage -1) * $records + $key + 1}}</td>
            <td>{{$role->name}}</td>
            <td class="green">{{$role->display_name}}</td>
            <td>{{$role->description}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a class="btn btn-success"
                       href="/role/view/{{$role->id}}"
                       title="Detail">
                        <i class="fa fa-eye"></i>
                    </a>
                    @if($role->id != 1)
                        <a class="btn btn-info"
                           href="/role/edit/{{$role->id}}"
                           title="Edit">
                            <i class="ace-icon fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-danger delete-role"
                           href="#" title="Delete"
                           role_id="{{$role->id}}"
                           role_name="{{$role->display_name}}">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    @endif
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