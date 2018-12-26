<div class="box-body">
<div class="row">
    <div class="col-md-6">
        @isset($type)
              <input type="hidden" name="id" value="{{$type->id}}" id="type-id">
        @endisset
        <input type="hidden" value="">
        <div class="form-group">
            <label>Id </label>
            <div class="clearfix">
                <input type="number" class="form-control" name="id_type"
                       value="@isset($type){{$type->id_type}}@endisset">
                @if($errors)
                    <span style="color: #dd4b39;" class="text-danger">{{$errors->first('id_qualify')}}</span> 
                @endif
            </div>
        </div>
        <div class="form-group">
            <label>Tên @include('common.require')</label>
            <div class="clearfix">
                <input type="text" class="form-control" name="name"
                       value="@isset($type){{$type->name}}@endisset">
                @if($errors)
                    <span style="color: #dd4b39;" class="text-danger">{{$errors->first('name')}}</span> 
                @endif
            </div>
        </div>
        <div class="form-group">
            <label>Kiểu định dạng</label>
            <div class="clearfix">
                <select  class="form-control" name="type" >
                    <option value="1" @if(isset($type) && $type->type == 1) selected @endif>Ảnh</option>
                    <option value="2" @if(isset($type) && $type->type == 2) selected @endif>Video</option>
                    <option value="3" @if(isset($type) && $type->type == 3) selected @endif>Câu hỏi-trả lời</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Mô tả </label>
            <div class="clearfix">
                <input type="text" class="form-control" name="description"
                       value="@isset($type){{$type->description}}@endisset">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('modules/admin/typeLesson/typeLesson-validation.js') }}"></script>
@endpush
