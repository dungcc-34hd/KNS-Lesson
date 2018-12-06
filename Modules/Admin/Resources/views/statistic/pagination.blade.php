@php $current = 10 * ($currentPage - 1) + 1@endphp

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
@if(!empty($users))
@foreach($users as $key => $user)
    <tr>
        <td class="text-center">{{$key + 1}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->name_area}}</td>
        <td>{{$user->name_province}}</td>
        <td>{{$user->name_district}}</td>
        <td>{{$user->name_school}}</td>
        <td>{{$user->name_grade}}</td>
        <td>{{$user->name_class}}</td>
        <td>{{$user->quantity_student}}</td>
    </tr>
@endforeach
@else
    <tr>
        <td colspan="5">Không có bản ghi nào</td>
    </tr>
@endif
<input id="total-pages-current" type="hidden" value="{{ isset($pages) ? $pages : 0 }}">
<input id="pages-current" type="hidden" value="{{ isset($currentPage) ? $currentPage : 1}}">