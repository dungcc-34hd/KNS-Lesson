$(document).on('click', '.is_public', function (e) {
    e.preventDefault();
    var objectName = $(this).attr('object_name');
    var objectId = $(this).attr('object_id');
    var isPublic = $(this).attr('is_public');
    if (isPublic==1) {
         $.confirm({
            title: 'Xác nhận!',
            content: 'Bạn muốn có muốn hiển thị ' + objectName + '?',
           buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager-lesson/public/' + objectId,
                        success: function (result) {
                            if (result['status']) { 
                                    $('.is_public').data('is_public', 0);
                                 window.location.href = '/admin/manager-lesson/index';
                            }
                            else {
                                window.location.href = '/admin/manager-lesson/index';
                            }
                        }
                    });
                },
                cancel: function () {

                }

            }
        }); 
     }else{
        $.confirm({
            title: 'Xác nhận!',
            content: 'Bạn muốn có muốn bỏ hiển thị  ' + objectName + '?',
           buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager-lesson/public/' + objectId,
                        success: function (result) {
                            if (result['status']) {
                                    $('.is_public').data('is_public', 1);
                                    $('.is_public').attr('disabled', 'true');
                               
                                 window.location.href = '/admin/manager-lesson/index';
                            }
                            else {
                                window.location.href = '/admin/manager-lesson/index';
                            }
                        }
                    });
                },
                cancel: function () {

                }

            }
        });  
     }
         
});


$(document).on('click', '.test-object', function (e) {
    e.preventDefault();
    var objectName = $(this).attr('object_name');
    var objectId = $(this).attr('object_id');
    var isPublic = $(this).attr('is_public');
    console.log(isPublic);
        $.confirm({
            title: 'Xác nhận!',
            content: 'Bạn muốn thử nghiệm  ' + objectName + '?',
           buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager-lesson/test/' + objectId,
                        success: function (result) {   
                                window.location.href = '/admin/manager-lesson/index';
                        }
                    });
                },
                cancel: function () {

                }

            }
        });   
});