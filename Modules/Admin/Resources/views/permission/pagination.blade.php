 <tr>
    <th class="order-number">STT</th>
    <th>Tên</th>
    <th>Theo Khối</th>
    <th>Full Khối</th>
    <th>Beta</th>
    <th class="item-action-3"></th>
</tr>
    @if(!empty($permissions))
        @foreach($permissions as $key => $permission)
            <tr>
                <td class="text-center">{{$key + 1}}</td>
                <td>{{$permission->display_role}}</td>

                <td class="green" style="">      
                    <input  type="radio" name="{{($permission->role_id)}}" value="2" @if($permission->permission_id==2) checked @endif  data-url="{{route('admin.permission.changeRadio',['id' => $permission->role_id,'value'=>2])}}"
                           
                           class="radio-object"
                           data-object-name="{{$permission->name_role}}">
                </td>
                <td>                                            
                    <input type="radio" name="{{($permission->role_id)}}" value="1" @if($permission->permission_id==1) checked @endif data-url="{{route('admin.permission.changeRadio',['id' => $permission->role_id,'value'=>1])}}"
                           
                           class="radio-object"
                           data-object-name="{{$permission->name_role}}" >
                </td>
                <td>
                    <input type="radio" name="{{($permission->role_id)}}" value="3" @if($permission->permission_id==3) checked @endif data-url="{{route('admin.permission.changeRadio',['id' => $permission->role_id,'value'=>3])}}"
                           
                           class="radio-object"
                           data-object-name="{{$permission->name_role}}">
               
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        {{-- <a class="btn btn-success"
                           href="{{route('admin.permission.show',['id' => $permission->id])}}"
                           title="Detail">
                            <i class="fa fa-eye"></i>
                        </a> --}}
                        <a class="btn btn-info"
                           href="{{route('admin.permission.edit',['id' => $permission->role_id])}}"
                           title="Edit">
                            <i class="ace-icon fa fa-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-danger delete-object"
                           title="Delete"
                           object_id="{{$permission->role_id}}"
                           object_name="{{$permission->display_name}}">
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