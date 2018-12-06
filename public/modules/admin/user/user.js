// $(function () {
//    activeMenu('user', null, false);
//     $('.select2').select2();
//     var userID = $('#user-id').val();
//     if(userID !== undefined)
//     {
//         $.ajax({
//             type: 'GET',
//             url: '/admin/user/get-roles/' + userID,
//             success: function (result) {
//                 $('.select2').val(result).change();
//             }
//         });
//     }
//     $(document).on('click', '.delete-object', function (e) {
//         e.preventDefault();
//         var object_name = $(this).attr('object_name');
//         // var url = $(this).data('url');
//         console.log(object_name);
//         var object_id = $(this).attr('object_id');
//         var row = $(this).closest('tr');
//         $.confirm({
//             title: 'Confirm!',
//             content: 'Are you delete object: ' + object_name + '?',
//             buttons: {
//                 confirm: function () {
//                     $.ajax({
//                         type: 'GET',
//                         url: '/admin/user/delete/' + object_id,
//                         success: function (result) {
//                             if (result['status']) {
//                                 $('.alert-success').show();
//                                 $('.alert-danger').hide();
//                                 row.remove();
//                             }
//                             else {
//                                 $('.alert-success').hide();
//                                 $('.alert-danger').show();
//                             }
//                         }
//                     });
//                 },
//                 cancel: function () {

//                 }

//             }
//         });
//     });
// });

$(function () {
   activeMenu('user', null, false);
   $('.select2').select2();
    var userID = $('#user-id').val();
    if(userID !== undefined)
    {
        $.ajax({
            type: 'GET',
            url: '/admin/user/get-roles/' + userID,
            success: function (result) {
                $('.select2').val(result).change();
            }
        });
    }
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
});