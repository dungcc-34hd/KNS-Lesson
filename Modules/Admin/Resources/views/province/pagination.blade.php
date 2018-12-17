<tr>
    <th class="order-number">STT</th>
    <th>Tỉnh/Thành phố</th>
    <th>Khu vực</th>
    <th class="item-action-3">Trạng thái</th>
</tr>
@if(!empty($provincials))
    @foreach($provincials as $key => $provincial)
        <tr>
            <td class="text-center">{{$key + 1}}</td>
            <td>{{$provincial->name}}</td>
            <td class="green">{{!empty($provincial->area) ? $provincial->area->name: ''}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a class="btn btn-success"
                       href="{{route('admin.province.show',['id' => $provincial->id])}}"
                       title="Detail">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-info"
                       href="{{route('admin.province.edit',['id' => $provincial->id])}}"
                       title="Edit">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-danger delete-object"
                       title="Delete"
                       object_id="{{$provincial->id}}"
                       object_name="{{$provincial->name}}">
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