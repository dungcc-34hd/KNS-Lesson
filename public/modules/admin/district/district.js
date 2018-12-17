$(function () {
    activeMenu('data','district',true);
    $('#selectArea').change(function () {
        changeArea($(this).val());
    });
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
                        url: '/admin/district/delete/' + object_id,
                        success: function (result) {
                            if (result['status']) {
                                $('.alert-success').show();
                                $('.alert-danger').hide();
                                row.remove();
                            }
                            else {
                                $('.alert-success').hide();
                                $('.alert-danger').show();
                                window.location.href = '/admin/district/index';
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

function changeArea(areaId){
    axios.get('/admin/district/change-area/' + areaId).then(function (response) {
        
        var data = response.data;
        console.log(areaId);
         $('#selectProvince').empty();
        if($.isEmptyObject(data))
        {
            
            var option = '<option>Không có dữ liệu</option>'
            $('#selectProvince').append(option)
            
        }
        else
        {
           
            $.each(data, function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'

                $('#selectProvince').append(option)
            }); 
        }
        // ajaxLoadData($('#show-records').val(), $('#pages-current').val(), $('#nav-search-input').val());
    });
}