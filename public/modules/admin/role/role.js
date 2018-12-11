$(function () {
    activeMenu('users', 'role', true);

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass   : 'iradio_flat-green'
    });

    $(document).on('click', '.delete-role', function (e) {
        e.preventDefault();
        var role_name = $(this).attr('role_name');
        var role_id = $(this).attr('role_id');
        var row = $(this).closest('tr');
        $.confirm({
            title: 'Confirm!',
            content: 'Bạn có muốn xóa: ' + role_name + '?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/role/delete/' + role_id,
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

    $(document).on('click', '.delete-role-ve', function (e) {
        var role_name = $(this).attr('role_name');
        var url = $(this).attr('href');
        e.preventDefault();
        $.confirm({
            title: 'Confirm!',
            content: 'Are you delete role: ' + role_name + '?',
            buttons: {
                confirm: function () {
                    console.log(url);
                    window.location.href = url;
                },
                cancel: function () {

                }

            }
        });
    })
});