$(function () {
    // activeMenu('data','managerLesson', true);
    $(document).on('click', '.delete-lesson-detail', function (e) {
        e.preventDefault();
        var object_name = $(this).attr('object_name');
        var object_id = $(this).attr('object_id');
        var row = $(this).closest('tr');

        $.confirm({
            title: 'Thông báo!',
            content: 'Bạn có muốn xóa bài học: ' + object_name + '?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager-lesson/delete-lesson-detail/' + object_id,
                        success: function (result) {
                            if (result['status']) {
                                $('.alert-success').show();
                                $('.alert-danger').hide();
                                row.remove();
                            }
                            else {

                                $('.alert-success').hide();
                                $('.alert-danger').show();
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
});

