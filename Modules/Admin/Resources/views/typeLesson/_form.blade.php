<div class="box-body">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Id </label>
            <div class="clearfix">
                <input type="text" class="form-control" name="id_qualify"
                       value="@isset($type){{$type->id_qualify}}@endisset">
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
            <label>Mô tả </label>
            <div class="clearfix">
                <input type="text" class="form-control" name="description"
                       value="@isset($type){{$type->description}}@endisset">
            </div>
        </div>
    </div>
</div>