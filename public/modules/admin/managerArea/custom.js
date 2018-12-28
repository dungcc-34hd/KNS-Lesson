// change select option area

$(document).ready(function () {

    $(function () {
        $('#selectArea').change(function () {
               changeArea($(this).val());

        });
        $('#provinces').change(function () {            
        });
    });
    function changeArea(areaId){
    axios.get('/admin/manager-area/change-area/' + areaId).then(function (response) {
        
        var data = response.data;
        console.log(data);
         $('#provinces').empty();
        if($.isEmptyObject(data))
        {
            
            var option = "<option value=''>Không có dữ liệu</option>"
            $('#provinces').append(option)
            
        }
        else
        {
           
            $.each(data, function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'

                $('#provinces').append(option)
            }); 
        }
        // ajaxLoadData($('#show-records').val(), $('#pages-current').val(), $('#nav-search-input').val());
    });
}


});

