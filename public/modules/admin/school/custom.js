$(document).ready(function () {

    $(function () {
        $('#selectArea').change(function () {
            if ($('#selectArea').val() != '') {
                process($(this).val());
            } else {
                $('#selectProvince').html("<option value=''>Chọn Tỉnh</option>");
                $('#selectDistrict').html("<option value=''>Chọn Quận/Huyện</option>");
            }



        });
        $('#selectProvince').change(function () {
            
            if ($('#selectProvince').val() != '') {
                changeProvince($(this).val());
            } else {
                $('#selectDistrict').html("<option value=''>Chọn Quận/Huyện</option>");
            }

        });
        $('#selectDistrict').change(function () {
            // changeDistrict($(this).val());
        });


    });

    function process(areaId) {
        axios.get('/admin/school/change-area/' + areaId).then(function (response) {

            var data = response.data;
            // console.log(data);
            $('#selectProvince').empty();
            if ($.isEmptyObject(data['provinces'])) {
                var option = "<option value=''>Không có dữ liệu</option>";
                $('#selectProvince').append(option)

            }
            else {
                $.each(data['provinces'], function (i, value) {
                    var option = '<option value=' + value.id + '>' + value.name + '</option>'
                    $('#selectProvince').append(option)
                });

            }
            $('#selectDistrict').empty();
            if ($.isEmptyObject(data['districts'])) {

                var option = "<option value=''>Không có dữ liệu</option>"
                $('#selectDistrict').html(option)

            }
            else {

                $.each(data['districts'], function (i, value) {
                    var option = '<option value=' + value.id + '>' + value.name + '</option>'

                    $('#selectDistrict').html(option)
                });
            }


        });

    }
    function changeProvince(provinceId) {

        axios.get('/admin/school/change-province/' + provinceId).then(function (response) {

            var data = response.data;
            // console.log(data);
            $('#selectDistrict').empty();
            if ($.isEmptyObject(data['districts'])) {

                var option = '<option>Không có dữ liệu</option>';
                $('#selectDistrict').html(option);

            }
            else {

                $.each(data['districts'], function (i, value) {
                    var option = '<option value=' + value.id + '>' + value.name + '</option>';

                    $('#selectDistrict').html(option);
                });
            }
            // ajaxLoadData($('#show-records').val(), $('#pages-current').val(), $('#nav-search-input').val());
        });

    }

});


