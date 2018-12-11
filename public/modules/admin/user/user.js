$(function () {
   activeMenu('user', null, false);

    $(document).on('click', '.delete-object', function (e) {
        e.preventDefault();
        var object_name = $(this).attr('object_name');
        var object_id = $(this).attr('object_id');
        var row = $(this).closest('tr');
        $.confirm({
            title: 'Confirm!',
            content: 'Are you delete object: ' + object_name + '?',
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

        $.ajax({
            type:'GET',
            url:'/admin/user/hanlding-area/',
            'data': {
                'area' : area,
            },
            success:function(data) {
                $('#provinces').html(data.select);
                $('#tbody').html(data.user);
                $("#districts").html('<option>Chọn Quận/Huyện</option>');
                $("#schools").html('<option>Chọn Trường </option>');
                // var records = $('#tbody').val();
                // ajaxLoadData(records,1,$('#nav-search-input').val());
            }
         });
    });

    // select provinces
    $("#provinces").change(function(){
        var province = $(this).val();
      
        $.ajax({
            type:'GET',
            url:'/admin/user/hanlding-province',
            'data': {
                'province' : province,
            },
            success:function(data) {
                $('#districts').html(data.select);
                $('#tbody').html(data.user);
                $("#schools").html('<option>Chọn Trường </option>');
                // ajaxLoadData(records,1,$('#nav-search-input').val());
            }
         });
    });

    // select districts
    $("#districts").change(function(){
        var district = $(this).val();
       
        $.ajax({
            type:'GET',
            url:'/admin/user/hanlding-district',
            'data': {
                'district' : district,
            },
            success:function(data) {
                $('#tbody').html(data.user);
                $('#schools').html(data.select);
            }
         });
    });
    $("#schools").change(function(){
        var school = $(this).val();
       
        $.ajax({
            type:'GET',
            url:'/admin/user/hanlding-school',
            'data': {
                'school' : school,
            },
            success:function(data) {
                $('#tbody').html(data.user);
            }
         });
    });


});



