 <tr>
    <th class="order-number">STT</th>
    <th>Tên</th>
    <th>Tên hiển thị</th>
    <th>Mô tả</th>
    <th class="item-action-3"></th>
</tr>
    @if(!empty($permissions))
                                    @foreach($permissions as $key => $permission)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->display_name}}</td>
                                            <td>{{$permission->description}}</td>

                                            
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-info"
                                                       href="{{route('admin.permission.edit',['id' => $permission->id])}}"
                                                       title="Edit">
                                                        <i class="ace-icon fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger delete-object"
                                                       title="Delete"
                                                       object_id="{{$permission->id}}"
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