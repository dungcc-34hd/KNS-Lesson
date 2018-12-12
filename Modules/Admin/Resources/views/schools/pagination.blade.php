
@if(!empty($schools))
    @foreach($schools as $key => $school)
        <tr>
            <td class="text-center">{{$key + 1}}</td>
            <td>{{$school->name}}</td>
            <td>{{!empty($school->schoolLevel) ? $school->schoolLevel->name: ''}}</td>
             <td>{{!empty($school->area) ? $school->area->name: ''}}</td>
             <td>{{!empty($school->province) ? $school->province->name: ''}}</td>
            <td>{{!empty($school->district) ? $school->district->name: ''}}</td>
           
            <td> {{$school->license_key}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a class="btn btn-success"
                       href="{{route('admin.school.show',['id' => $school->id])}}"
                       title="Detail">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-info"
                       href="{{route('admin.school.edit',['id' => $school->id])}}"
                       title="Edit">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-danger delete-object"
                       title="Delete"
                       object_id="{{$school->id}}"
                       object_name="{{$school->name}}">
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