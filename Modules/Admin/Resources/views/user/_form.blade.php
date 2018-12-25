@isset($user)
    <input type="hidden" name="id" value="{{$user->id}}" id="user-id">
@endisset
@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/bower_components/select2/dist/css/select2.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
@endpush
<div class="col-md-6">
    <div class="form-group">
        <label>Tên @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="name"
                   value="@isset($user){{$user->name}}@endisset">
            
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label>Email @include('common.require')</label>
        <div class="clearfix">
            <input type="text" class="form-control" name="email"
                   value="@isset($user){{$user->email}}@endisset">
          
        </div>
    </div> 
    @if(!isset($user))
    <div class="form-group">
            <label>Mật khẩu @include('common.require')</label>
            <div class="clearfix">
                <input type="password" class="form-control" name="password"
                       value="">
            
            </div>
        </div> 
        @endif
    <div class="form-group">
        <label>SĐT @include('common.require')</label>
        <div class="clearfix">
            <input type="number" class="form-control" name="tel"
                   value="@isset($user){{$user->tel}}@endisset">
             
        </div>
    </div> 
    <div class="form-group">
        <label>Khu vực @include('common.require')</label>
        <div class="clearfix">
            <select name="area_id" id="selectArea" class="select-option form-control">
                <option value="">Chọn khu vực</option>
                @foreach($areas as $key => $area)
                <option @if(isset($user) && $user->area_id == $area->id) selected @endif value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
            </select>
            
        </div>
    </div>
    <div class="form-group">
        <label>Tỉnh/Thành phố @include('common.require')</label>
        <div class="clearfix">
            <select name="province_id" id="selectProvince" class="select-option form-control">
                <option value="">Chọn tỉnh/thành phố</option>
                @foreach($provinces as $key => $province)   
                <option @if(isset($user) && $user->province_id == $province->id) selected @endif value="{{$province->id}}">{{$province->name}}</option>
                @endforeach
            </select>
           
        </div>

    </div>  
    <div class="form-group">
        <label>Quận/huyện @include('common.require')</label>
        <div class="clearfix">
             <select name="district_id" id="selectDistrict" class="select-option form-control">
                <option value="">Chọn quận/huyện</option>
                @foreach($districts as $key => $district)
                    <option @if(isset($user) && $user->district_id == $district->id) selected @endif value="{{$district->id}}">{{$district->name}}</option>
                @endforeach
            </select>
             
        </div>
    </div>    
    <div class="form-group">
        <label>Trường @include('common.require')</label>
        <div class="clearfix">
            <select name="school_id" id="selectSchool" class="select-option form-control">
                <option value="">Chọn trường</option>
                @foreach($schools as $key => $school)
                    <option @if(isset($user) && $user->school_id == $school->id) selected @endif value="{{$school->id}}">{{$school->name}}</option>
                @endforeach
            </select>
            
        </div>
    </div>
     <div class="form-group">
        <label>Chuyên đề@include('common.require')</label>
        <div class="clearfix">
          <select class="form-control select2" multiple="multiple"  name="thematics[]"
                    style="width: 100%;">

                    
                @foreach($thematics as $key => $thematic)
                    <option @if(isset($user) && in_array($thematic->id,$findThematics)) selected @endif  value="{{$thematic->id}}">{{$thematic->name}}</option>
                @endforeach
               

            </select>
        </div>
    </div>  

    <div class="form-group">
        <label>Khối @include('common.require')</label>
        <div class="clearfix">
            <select  name="grade_id" id="selectGrade" class="select-option form-control">
                <option value="">Chọn khối</option>
                @foreach($grades as $key => $grade)
                    <option @if(isset($user) && $user->grade_id == $grade->id) selected @endif value="{{$grade->id}}">{{$grade->name}}</option>
                @endforeach
            </select>
          
        </div>
    </div>
    <div class="form-group">
        <label>Lớp @include('common.require')</label>
          <div class="clearfix">
            <select name="class_id" id="selectClass" class="select-option form-control">
                <option value="">Chọn lớp</option>
                @foreach($class as $key => $value)
                    <option @if(isset($user) && $user->class_id == $value->id) selected @endif value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
           
        </div>
    </div>
    <div class="form-group">
        <label>Sĩ số</label>
        <div class="clearfix">
            <input type="number" class="form-control" name="quantity_student"
                   value="@isset($user){{$user->quantity_student}}@endisset">
        </div>
    </div> 
    <div class="form-group">
        <label>Quyền @include('common.require')</label>
          <div class="clearfix">
            <select name="role_id" id="selectRole" class="select-option form-control">
                <option value="">Chọn quyền</option>
                @foreach($roles as $key => $role)
                    <option @if(isset($user) && $user->role_id == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <!-- /.form-group -->
</div>

<!-- /.col -->
@push('scripts')
    <script src="{{ asset('modules/admin/user/user.js') }}"></script>
    <script src="{{ asset('modules/admin/user/user-validation.js') }}"></script>
    <script src="{{ asset('assets/admin/bower_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('modules/admin/user/custom.js') }}"></script>
    <script>
        $(document).ready(function () {
             $('.select2').select2({
                placeholder: 'Chọn chuyên đề'
             });

        })     
    </script>
@endpush
 