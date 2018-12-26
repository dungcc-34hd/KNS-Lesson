<tr>
    <th class="order-number">STT</th>
    <th>Tên</th>
    <th>Email</th>
    <th>Trường</th>
    <th>Khối</th>
    <th>Lớp</th>
    <th>Sĩ số</th>
    <th>Quyền</th>
    <th>IP</th>
    <th>Lượt tải về</th>
    <th class="item-action-3">Trạng thái</th>
</tr>
</thead>
<tbody id="tbody">
    @if(!empty($users)) @foreach($users as $key => $user)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->school['name']}}</td>
        <td>{{$user->grade['name']}}</td>
        <td>{{$user->lsClass['name']}}</td>
        <td>{{$user->quantity_student}}</td>
        <td>{{$user->role['name']}}</td>
        <td>{{$user->IP}}</td>
        <td>{{$user->download}}</td>
        <td>
            <div class="btn-group btn-group-sm">
                <a class="btn btn-success" href="{{route('admin.user.show',['id' => $user->id])}}" title="Detail">
                            <i class="fa fa-eye"></i>
                        </a>
                <a class="btn btn-info" href="{{route('admin.user.edit',['id' => $user->id])}}" title="Edit">
                            <i class="ace-icon fa fa-pencil"></i>
                        </a>
                <a href="#" class="btn btn-danger delete-object" title="Delete" object_id="{{$user->id}}" object_name="{{$user->name}}">
                            <i class="fa fa-trash-o"></i>
                        </a>

            </div>
        </td>
    </tr>
    @endforeach @else
</tbody>
<tr>
    <td colspan="5">Không có bản ghi nào</td>
</tr>
@endif

{{-- 'CountProvince'=>$CountProvince,'CountDistrict'=>$CountDistrict,'CountSchool'=>$CountSchool --}}


<input type="hidden" id="countT" value="{{ isset($count) ? $count : 0 }}">
<input id="total-pages-current" type="hidden" value="{{ isset($pages) ? $pages : 0 }}">