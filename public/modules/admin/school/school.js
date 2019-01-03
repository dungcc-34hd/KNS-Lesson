


$(document).ready(function () {
    $(function () {

        activeMenu('data', 'school', true);
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
                            url: '/admin/school/delete/' + object_id,
                            success: function (result) {
                                if (result['status']) {
                                    $('.alert-success').show();
                                    $('.alert-danger').hide();
                                    row.remove();


                                }
                                else {

                                    $('.alert-success').hide();
                                    $('.alert-danger').show();
                                    window.location.href = '/admin/school/index';
                                }

                            }
                        });
                    },
                    cancel: function () {

                    }

                }
            });
        });


        $("#areas").change(function () {
            var area = $(this).val();
            var table = $(this).data('table');
            var records = $('#show-records').val();
            
            // alert(area);
            
            if (area != '') {

                $.ajax({
                    type: 'GET',
                    url: '/admin/school/hanlding-area/',
                    'data': {
                        'area': area,
                    },
                    success: function (data) {
                       
                        $('#provinces').html(data.select);
                        $('#tbody').html(data.user);
                        $("#districts").html('<option value="" >Chọn Quận/Huyện</option>');
                      
                        ajaxLoadDataForSelect(records, 1, area,table);
                    }
                });


            } else {
                $.ajax({
                    type: 'GET',
                    url: '/admin/school/select/',
                    'data': {
                        'area': area,
                    },
                    success: function (data) {
                        console.log(data.user);
                        $('#tbody').html(data.user);
                        $("#provinces").html('<option>Chọn Tỉnh/thành phố</option>');
                        $("#districts").html('<option>Chọn Quận/Huyện</option>');
                        
                    }
                });
                ajaxLoadData(records,1,$('#nav-search-input').val());
            }


        });

        // select provinces
        $("#provinces").change(function () {
            var province = $(this).val();
            var table = $(this).data('table');
            var records = $('#show-records').val();

            if (province != '') {
                $.ajax({
                    type: 'GET',
                    url: '/admin/school/hanlding-province/',
                    'data': {
                        'province': province,
                    },
                    success: function (data) {
                        $('#districts').html(data.select);
                        $('#tbody').html(data.user);

                        $("#schools").html('<option>Chọn Trường </option>');
                        // ajaxLoadData(records,1,$('#nav-search-input').val());
                        ajaxLoadDataForSelect(records, 1, province,table);
                    }
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: '/admin/school/select/',
                    'data': {
                        'province': province,
                    },
                    success: function (data) {
                        // console.log(data.select);
                        $('#tbody').html(data.user);
                         $('#areas').html(data.select);
                        $("#districts").html('<option>Chọn Quận/Huyện</option>');
                        // $('#areas').html(data.select);


                        // ajaxLoadDataForSelect(records, 1, province,table);
                    }
                });
                ajaxLoadDataForSelect(records, 1, $(".areas_S").val(),$(".areas_S").data('table'));

            }

        });
        // select districts
        $("#districts").change(function () {
            var district = $(this).val();
            var table = $(this).data('table');
            var records = $('#show-records').val();
            if (district != '') {
                $.ajax({
                    type: 'GET',
                    url: '/admin/school/hanlding-district',
                    'data': {
                        'district': district,
                    },
                    success: function (data) {
                        $('#tbody').html(data.user);
                        $('#schools').html(data.select);
                        ajaxLoadDataForSelect(records, 1, district,table);
                    }
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: '/admin/school/select/',
                    'data': {
                        'district': district,
                    },
                    success: function (data) {
                        $('#tbody').html(data.user);
                        $('#areas').html(data.select);
                         $("#provinces").html('<option>Chọn Tỉnh</option>');
                         $("#districts").html('<option>Chọn Quận/Huyện</option>');
                    }
                });
                ajaxLoadDataForSelect(records, 1, $(".provinces_S").val(),$(".provinces_S").data('table'));
            }


        });
    });



    // $(document).on('click','.pagination li a', function (e) {
    //     e.preventDefault();
    //     var active = $(this).hasClass('current');
    //     var page = $(this).attr('value');
    //     var records = $('#show-records').val();
    //     // var records = 1;
    //     if(!active)
    //     {
    //         if(parseInt(page) !== 1)
    //         {
    //             $('.first').removeClass('disabled');
    //             $('.previous').removeClass('disabled');
    //         }
    //         else
    //         {
    //             $('.first').addClass('disabled');
    //             $('.previous').addClass('disabled');
    //         }
    //         if(parseInt(page) !== parseInt($('.last').attr('value')))
    //         {
    //             $('.last').removeClass('disabled');
    //             $('.next').removeClass('disabled');
    //         }
    //         else
    //         {
    //             $('.last').addClass('disabled');
    //             $('.next').addClass('disabled');
    //         }
    //         $('.pagination > li > a.page').each(function () {
    //             var element = $(this);
    //             if($(element).hasClass('current'))
    //             {
    //                 $(element).removeClass('current');
    //                 return false;
    //             }
    //         });
    //         var pageCurrent = parseInt($(this).attr('value'));
    //         if($(this).hasClass('page')) {
    //             setValueNext(pageCurrent);
    //             setValuePrevious(pageCurrent);
    //             $(this).addClass('current');
    //         }
    //         else
    //         {
    //             $('.page').each(function () {
    //                 var page = parseInt($(this).attr('value'));
    //                 if(pageCurrent === page)
    //                 {
    //                     $(this).addClass('current');
    //                 }
    //             });
    //             if($(this).hasClass('next'))
    //             {
    //                 setValueNext(pageCurrent);

    //             }
    //             else if($(this).hasClass('last'))
    //             {
    //                 $(this).addClass('disabled');
    //                 $('.next').addClass('disabled');
    //                 $('.previous').attr('value', parseInt($(this).attr('value')) - 1)
    //             }
    //             else if($(this).hasClass('previous')) 
    //             {
    //                 setValuePrevious(pageCurrent);
    //             }
    //             else if($(this).hasClass('first'))
    //             {
    //                 $(this).addClass('disabled');
    //                 $('.previous').addClass('disabled');
    //                 $('.next').attr('value', parseInt($(this).attr('value')) + 1)
    //             }
    //         }

            
    //         var search          = $('#nav-search-input').val() !== '' ? $('#nav-search-input').val() : null;
    //         var area            = $("#areas").val();
    //         var provinces       = $("#provinces").val();
    //         var districts       = $("#districts").val();
    //         var nameArea        = $("#areas").data('table');
    //         var nameProvinces   = $("#provinces").data('table');
    //         var nameDistricts   = $("#districts").data('table');
    //         alert(page);
    //         if(area !=""){
    //             ajaxLoadDataForSelect(records,  page,area,nameArea);
    //         }else if(provinces !="" ){
    //             ajaxLoadDataForSelect(records,  page,provinces,nameProvinces);
    //         }else if(districts != "" ){
    //             ajaxLoadDataForSelect(records,  page,districts,nameDistricts);
    //         }
    //         else{
    //             ajaxLoadData(records,page, search);
    //         }
    //     }
    // });
    // ajaxLoadDataForSelect(records, data.page, area,$('this').data('table'));
    // function ajaxLoadData(records,  current_page,search)

    // function ajaxLoadDataForSelect(records,  current_page,id,table) {
    //     $('#nav-search-input').val('');
    //     var url_controller = $('#pagination_Select').val();
        
    //     url = url_controller + records +"/"+table+ "/"+ id+"?page=" + current_page;
         
    //     $.ajax({
    //         type: 'GET',
    //         url: url ,
    //         beforeSend: function () {
    //             $('#spiner-load-ajax').modal({backdrop: 'static', keyboard: false});
    //         },
    //         success: function (result) {
    //             //append data in table
    //             $('.results-table tbody').empty();
    //             $('.results-table tbody').append(result);
    
    //             //append pagination 
    //             $.ajax({
    //                 type: 'GET',
    //                 url: "/pagination/" + current_page + "/" + $('#total-pages-current').val(),
    //                 success: function (re) {
    //                     $('.widget-page').empty();
    //                     $('.widget-page').append(re);
    //                     $('#spiner-load-ajax').modal('hide');
    //                 }
    //             });
    
    //         }
    //     });
    // }
});
    // select areas
