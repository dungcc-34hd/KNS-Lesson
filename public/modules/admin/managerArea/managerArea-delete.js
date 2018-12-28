$(function () {
    activeMenu('data','managerArea', true);
    $(document).on('click', '.delete-area', function (e) {
        e.preventDefault();
        var object_name = $(this).attr('object_name');
        var object_id = $(this).attr('object_id');
        var row = $(this).closest('tr');

        $.confirm({
            title: 'Thông báo!',
            content: 'Bạn có muốn xóa khu vực: ' + object_name + '?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager-area/delete-area/' + object_id,
                        success: function (result) {
                            if (result['status']) {
                                $('.alert-success').show();
                                $('.alert-danger').hide();
                                location.reload();
                            }
                            else {

                                $('.alert-success').hide();
                                $('.alert-danger').show();
                               
                            }
                             window.location.href = '/admin/manager-area/';
                        }
                    });
                },
                cancel: function () {

                }

            }
        });
    });
});
$(function () {
    activeMenu('data','managerArea', true);
    $(document).on('click', '.delete-province', function (e) {
        e.preventDefault();
        var object_name = $(this).attr('object_name');
        var object_id = $(this).attr('object_id');
        var row = $(this).closest('tr');

        $.confirm({
            title: 'Thông báo!',
            content: 'Bạn có muốn xóa tỉnh/thành phố: ' + object_name + '?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager-area/delete-province/' + object_id,
                        success: function (result) {
                            if (result['status']) {
                                $('.alert-success').show();
                                $('.alert-danger').hide();
                                location.reload();
                            }
                            else {

                                $('.alert-success').hide();
                                $('.alert-danger').show();
                                
                            }
                             window.location.href = '/admin/manager-area/';
                        }
                    });
                },
                cancel: function () {

                }

            }
        });
    });
});
$(function () {
    activeMenu('data','managerArea', true);
    $(document).on('click', '.delete-district', function (e) {
        e.preventDefault();
        var object_name = $(this).attr('object_name');
        var object_id = $(this).attr('object_id');
        var row = $(this).closest('tr');

        $.confirm({
            title: 'Thông báo!',
            content: 'Bạn có muốn xóa quận/huyện: ' + object_name + '?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager-area/delete-district/' + object_id,
                        success: function (result) {
                            if (result['status']) {
                                $('.alert-success').show();
                                $('.alert-danger').hide();
                                location.reload();
                            }
                            else {

                                $('.alert-success').hide();
                                $('.alert-danger').show();
                              
                            }
                             window.location.href = '/admin/manager-area/';
                        }
                    });
                },
                cancel: function () {

                }

            }
        });
    });
});