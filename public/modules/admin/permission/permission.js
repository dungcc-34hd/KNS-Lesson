$(function () {
   activeMenu('users', 'permission', true);
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
                        url: '/admin/permission/delete/' + object_id,
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
});

$(document).on('change', '.radio-object', function (e) {
    e.preventDefault();  
    var objectName = $(this).data('object-name');
    console.log(objectName);
    var url = $(this).data('url');
    // var a =$('.radio-object').val();
    // console.log(a);
    console.log(url);
    $.confirm({
            title: 'Xác nhận!',
            content: 'Bạn muốn thay đổi quyền ' + objectName + '?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: url,

                        success: function (result) {
                            if (result['status']) {
                                 // var a =$('.radio-object:checked').val();
                               
                                $('.alert-success').show();
                                $('.alert-danger').hide();
                                
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
