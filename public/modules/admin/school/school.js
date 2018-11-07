$(function () {
    activeMenu('school', null, false);
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

