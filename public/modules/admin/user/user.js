

$(function () {
   activeMenu('users','user', true);

    $(document).on('click', '.delete-object', function (e) {
        e.preventDefault();
        var object_name = $(this).attr('object_name');
        var object_id = $(this).attr('object_id');
        var row = $(this).closest('tr');
        $.confirm({
            title: 'Confirm!',
            content: 'Bạn có muốn xóa: ' + object_name + '?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/user/delete/' + object_id,
                        success: function (result) {
                            if (result['status']) {
                                $('.alert-success').show();
                                $('.alert-danger').hide();
                                row.remove();
                            }
                            else {
                                $('.alert-success').hide();
                                $('.alert-danger').show();
                                window.location.href = '/admin/user';
                            }
                             
                        }
                    });
                },
                cancel: function () {

                }

            }
        });
    });
    // select areas
    $("#areas").change(function(){
        var area = $(this).val();
        console.log(area);
        var table = $(this).data('table');
        var records = $('#show-records').val();
        
        if (area!=''){

            $.ajax({
                type:'GET',
                url:'/admin/user/hanlding-area/',
                'data': {
                    'area' : area,
                }, 
                success:function(data) {
                    $('#provinces').html(data.select);
                    // if(area==""){}
                    $('#tbody').html(data.user);
                    $("#districts").html('<option value="">Chọn Quận/Huyện</option>');
                    $("#schools").html('<option value="">Chọn Trường </option>');

                    $("#CountProvince").val(data.CountProvince);
                    $("#CountDistrict").val(data.CountDistrict);
                    $("#CountSchool").val(data.CountSchool);
                    // 'CountProvince'=>$CountProvince,'CountDistrict'=>$CountDistrict,'CountSchool'=>$CountSchool
                    // $("#countUs").html(" Tìm thấy : " +data.count+" tài khoản");
                    ajaxLoadDataForSelect(records, 1, area,table);
                }
             });
        }else{
            $.ajax({
                type:'GET',
                url:'/admin/user/select/',
                'data': {
                    'area' : area,
                },
                success:function(data) {

                    $('#provinces').html('<option value="">Chọn Tỉnh/thành phố</option>');

                    $('#tbody').html(data.user);
                    $("#districts").html('<option value="">Chọn Quận/Huyện</option>');
                    $("#schools").html('<option value="">Chọn Trường </option>');

                    $("#CountProvince").val("");
                    $("#CountDistrict").val("");
                    $("#CountSchool").val("");
                }
             });
            ajaxLoadData(records,1,$('#nav-search-input').val());
        }
            
    });

    // select provinces
    $("#provinces").change(function(){
        var province = $(this).val();
        var table = $(this).data('table');
        var records = $('#show-records').val();
        
        if(province!=''){
            $.ajax({
            type:'GET',
            url:'/admin/user/hanlding-province',
            'data': {
                'province' : province,
            },
            success:function(data) {
                $('#districts').html(data.select);
                $('#tbody').html(data.user);
                $("#schools").html('<option value="">Chọn Trường </option>');
                
                $("#CountProvince").val("");
                $("#CountDistrict").val(data.CountDistrict);
                $("#CountSchool").val(data.CountSchool);

                ajaxLoadDataForSelect(records, 1, province,table);
            }
         });
        }else{
            $.ajax({
                type:'GET',
                url:'/admin/user/select/',
                'data': {
                    'province' : province,
                },
                success:function(data) {
                    $('#tbody').html(data.user);
                    $('#areas').html(data.select);
                    $("#districts").html('<option value="">Chọn Quận/Huyện</option>');
                    $("#schools").html('<option value="">Chọn Trường </option>');
                    $('#provinces').html('<option value="">Chọn Tỉnh/thành phố</option>');

                    $("#CountProvince").val("");
                    $("#CountDistrict").val("");
                    $("#CountSchool").val("");
                }
             });
            ajaxLoadDataForSelect(records, 1, $(".areas_S").val(),$(".areas_S").data('table'));
        }

    });

    // select districts
    $("#districts").change(function(){
        var district = $(this).val();
        var table = $(this).data('table');
        var records = $('#show-records').val();
        
        if(district!=''){
            $.ajax({
            type:'GET',
            url:'/admin/user/hanlding-district',
            'data': {
                'district' : district,
            },
            success:function(data) {
                $('#tbody').html(data.user);
                $('#schools').html(data.select);

                

                $("#CountSchool").val(data.CountSchool);
                $("#CountDistrict").val("");
                $("#CountProvince").val("");

                ajaxLoadDataForSelect(records, 1, district,table);
            }
         });
        }else{
            $.ajax({
                type:'GET',
                url:'/admin/user/select/',
                'data': {
                    'district' : district,
                },
                success:function(data) {
                    $('#tbody').html(data.user);
                    $('#areas').html(data.select);
                    $('#provinces').html('<option value="">Chọn Tỉnh/thành phố</option>');
                    $("#districts").html('<option value="">Chọn Quận/Huyện</option>');
                    $("#schools").html('<option  value="">Chọn Trường </option>');

                    $("#CountSchool").val("");
                    $("#CountDistrict").val("");
                    $("#CountProvince").val("");
                
                }
             });
            ajaxLoadDataForSelect(records, 1, $(".provinces_S").val(),$(".provinces_S").data('table'));
        }
       
        
    });
    $("#schools").change(function(){
        var school = $(this).val();
        var table = $(this).data('table');
        var records = $('#show-records').val();

        if(school!=''){
            $.ajax({
            type:'GET',
            url:'/admin/user/hanlding-school',
            'data': {
                'school' : school,
            },
            success:function(data) {
                $('#tbody').html(data.user);

                $("#CountProvince").val("");
                $("#CountDistrict").val("");
                $("#CountSchool").val("");

                ajaxLoadDataForSelect(records, 1, school,table);
            }
         });
        }else{
            $.ajax({
                type:'GET',
                url:'/admin/user/select/',
                'data': {
                    'school' : school,
                },
                success:function(data) {
                    $('#tbody').html(data.user);
                    $('#areas').html(data.select);
                    $('#provinces').html('<option value="">Chọn Tỉnh/thành phố</option>');
                    $("#districts").html('<option value="">Chọn Quận/Huyện</option>');
                    $("#schools").html('<option  value="">Chọn Trường </option>');
                }
             });
            // ajaxLoadDataForSelect(records, 1, $(".district_S").val(),$(".district_S").data('table'));
             ajaxLoadDataForSelect(records, 1, $(".districts_S").val(),$(".districts_S").data('table'));
        }
       
        
    });


});



