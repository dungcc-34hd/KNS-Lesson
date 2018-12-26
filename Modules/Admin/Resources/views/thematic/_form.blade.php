<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            @isset($thematic)
            <input type="hidden" value="{{$thematic->id}}" id="thematic-id">
            @endisset
            <div class="form-group">
                <label>Tên Chuyên đề @include('common.require')</label>
                <div class="clearfix">
                    <input type="text" class="form-control" name="name"
                           value="@isset($thematic){{$thematic->name}}@endisset">
                </div>
            </div>
            <div class="form-group">
                <label>Mô tả @include('common.require')</label>
                <div class="clearfix">
                    <input type="text" class="form-control" name="description"
                           value="@isset($thematic){{$thematic->description}}@endisset">
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('modules/admin/thematic/thematic-validation.js') }}"></script>
@endpush