<tr>
    <th class="order-number">STT</th>
    <th>Quận/Huyện</th>
    <th>Tỉnh/Thành phố</th>
    <th class="item-action-3">Trạng thái</th>
</tr>
@if(!empty($districts))
    @foreach($districts as $key => $district)
        <tr>
            <td class="text-center">{{$key + 1}}</td>
            <td>{{$district->name}}</td>
            <td class="green">{{!empty($district->Province) ? $district->Province->name: ''}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a class="btn btn-success"
                       href="{{route('admin.district.show',['id' => $district->id])}}"
                       title="Detail">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-info"
                       href="{{route('admin.district.edit',['id' => $district->id])}}"
                       title="Edit">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-danger delete-object"
                       title="Delete"
                       object_id="{{$district->id}}"
                       object_name="{{$district->name}}">
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