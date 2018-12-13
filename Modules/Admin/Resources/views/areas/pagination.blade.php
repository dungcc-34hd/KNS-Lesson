<tr>
    <th class="order-number">Id.</th>
    <th>Tên khu vực</th>
    <th>Mô tả</th>
    <th class="item-action-3">Trạng thái</th>
</tr>
@if(!empty($areas))
    @foreach($areas as $key => $area)
        <tr>
            <td class="text-center">{{$key + 1}}</td>
            <td>{{$area->name}}</td>
            <td class="green">{{$area->description}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a class="btn btn-success"
                       href="{{route('admin.area.show',['id' => $area->id])}}"
                       title="Detail">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-info"
                       href="{{route('admin.area.edit',['id' => $area->id])}}"
                       title="Edit">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-danger delete-object"
                       title="Delete"
                       object_id="{{$area->id}}"
                       object_name="{{$area->name}}">
                        <i class="fa fa-trash-o"></i>
                    </a>

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