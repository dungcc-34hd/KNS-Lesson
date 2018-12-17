$(document).on('click', '.is_public', function (e) {
    e.preventDefault();
    var objectName = $(this).attr('object_name');
    var objectId = $(this).attr('object_id');
    var isPublic = $(this).attr('is_public');
    console.log(isPublic);
        $.confirm({
            title: 'Xác nhận!',
            content: 'Bạn muốn thay đổi trạng thái của ' + objectName + '?',
           buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager-lesson/public/' + objectId,
                        success: function (result) {
                            if (result['status']) {
                                if (isPublic==0) {
                                    $('.is_public').data('is_public', 1);
                                }else{
                                    $('.is_public').data('is_public', 0);
                                }
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
    

   
});