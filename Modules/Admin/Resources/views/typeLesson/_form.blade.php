<div class="box-body">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Id </label>
            <div class="clearfix">
                <input type="text" class="form-control" name="id_type"
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
            <label> Định dạng</label>
            <div class="clearfix">
                <select  class="form-control" name="type" >
                    <option value="1" @if(isset($type) && $type->type == 1) selected @endif>Ảnh</option>
                    <option value="2" @if(isset($type) && $type->type == 2) selected @endif>Video</option>
                    <option value="1" @if(isset($type) && $type->type == 3) selected @endif>Câu hỏi-trả lời</option>
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