<div class="box-body">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Tên khu vực @include('common.require')</label>
            <div class="clearfix">
                <input type="text" class="form-control" name="name"
                       value="@isset($area){{$area->name}}@endisset">
                @if($errors)
                    <span style="color: #dd4b39;" class="text-danger">{{$errors->first('name')}}</span> 
                @endif
            </div>
        </div>
        <div class="form-group">
            <label>Mô tả @include('common.require')</label>
            <div class="clearfix">
                <input type="text" class="form-control" name="description"
                       value="@isset($area){{$area->description}}@endisset">
            </div>
        </div>
    </div>
</div>