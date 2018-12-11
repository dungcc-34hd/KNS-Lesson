
<tr>
    <th>STT</th>
    <th>Giáo viên</th>
    <th>Khu vực</th>
    <th>Tỉnh</th>
    <th>Quận/huyện</th>
    <th>Trường</th>
    <th>Khối</th>
    <th>Lớp</th>

    <th>Sĩ số</th>  
</tr>

</thead>
<tbody id="tbody">
@if(!empty($users))
    @foreach($users as $key => $user)
        <tr>
            <td >{{$key+1}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->area['name']}}</td>
            <td>{{$user->province['name']}}</td>
            <td>{{$user->district['name']}}</td>
            <td>{{$user->school['name']}}</td>
            <td>{{$user->grade['name']}}</td>
            <td>{{$user->lsClass['name']}}</td>
            <td>{{$user->quantity_student}}</td>
        </tr>
       
    @endforeach
@else
    <tr>
        <td colspan="9">No Records</td>

    </tr>
@endif
<input id="total-pages-current" type="hidden" value="{{ isset($pages) ? $pages : 0 }}">
<input id="pages-current" type="hidden" value="{{ isset($currentPage) ? $currentPage : 1}}"> 