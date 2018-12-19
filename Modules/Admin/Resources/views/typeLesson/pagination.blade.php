<tr>
    <th class="order-number">STT</th>
    <th>Id </th>
    <th>Tên </th>
    <th>Định dạng</th>
    <th>Mô tả</th>
    <th class="item-action-3">Trạng thái</th>
</tr>
@if(!empty($types))
@foreach($types as $key => $type)
    <tr>
        <td class="text-center">{{$key + 1}}</td>
        <td>{{$type->id_type}}</td>
        <td>{{$type->name}}</td>
         <td>@isset($type->type){{\App\Models\LessonType::TYPE[$type->type]}}@endisset</td>
        <td class="green">{{$type->description}}</td>
        <td>
            <div class="btn-group btn-group-sm">
                <a class="btn btn-info"
                   href="{{route('admin.typeLesson.edit',['id' => $type->id])}}"
                   title="Edit">
                    <i class="ace-icon fa fa-pencil"></i>
                </a>
                <a href="#" class="btn btn-danger delete-object"
                   title="Delete"
                   object_id="{{$type->id}}"
                   object_name="{{$type->name}}">
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