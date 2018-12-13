$(function () {
    activeMenu('data', 'area', true);
    // $('.select2').select2();
    var areaID = $('#area-id').val();
    // if(areaID !== undefined)
    // {
    //     $.ajax({
    //         type: 'GET',
    //         url: '/admin/area/get-roles/' + areaID,
    //         success: function (result) {
    //             $('.select2').val(result).change();
    //         }
    //     });
    // }
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
                        url: '/admin/area/delete/' + object_id,
                        success: function (result) {
                            if (result['status']) {
                                $('.alert-success').show();
                                $('.alert-danger').hide();
                                row.remove();
                            }
                            else {
                                $('.alert-success').hide();
                                $('.alert-danger').show();
                                window.location.href = '/admin/area/index';
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
