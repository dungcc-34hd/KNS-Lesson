 <tr>
    <th class="order-number">STT</th>
    <th>Tên chuyên đề</th>
    <th>Mô tả</th>
    <th class="item-action-3">Trạng thái</th>
</tr>
@if(!empty($thematics))
    @foreach($thematics as $key => $thematic)
        <tr>
            <td class="text-center">{{$key + 1}}</td>
            <td>{{$thematic->name}}</td>
            <td class="green">{{$thematic->description}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                   
                    <a class="btn btn-info"
                       href="{{route('admin.thematic.edit',['id' => $thematic->id])}}"
                       title="Edit">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-danger delete-object"
                       title="Delete"
                       object_id="{{$thematic->id}}"
                       object_name="{{$thematic->name}}">
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