$(function () {
    activeMenu('data','school', true);
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
                                window.location.href = '/admin/school/index';
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


$(function ()
{
   $('#selectArea').change(function () {
        process($(this).val());
         

   });
   $('#selectProvince').change(function ()
    {
       changeProvince($(this).val());
         
   });
   $('#selectDistrict').change(function() {
        changeDistrict($(this).val());
   });


});

function process(areaId) {
    
        var url = $('#selectArea').data('url');
        console.log(url);
        var indexOf = url.indexOf('change-area') + 11;
        console.log(indexOf);
        var lenght = url.length;
        var processUrl =  url.substr(0, indexOf)+ '/' + $('#selectArea').val();
        axios.get(processUrl).then(function (result) {
        var data = result.data;
        // console.log(data);
        $('#selectProvince').empty();
        if($.isEmptyObject(data['provinces']))
        {
            var option = '<option>Không có dữ liệu</option>'
            $('#selectProvince').append(option)
             
        }
        else
        {
            $.each(data['provinces'], function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'
                 $('#selectProvince').append(option)
            });
           
          
              
        }
         $('#selectDistrict').empty();
        if($.isEmptyObject(data['districts']))
        {
            
            var option = '<option>Không có dữ liệu</option>'
            $('#selectDistrict').append(option)
            
        }
        else
        {
           
            $.each(data['districts'], function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'

                $('#selectDistrict').append(option)
            });
        }
        $('.results-table tbody').empty();
        if($.isEmptyObject(data['data']))
        {
            
             var table = '<tr><td colspan="5">Không có bản ghi nào</td></tr>'
            $('.results-table tbody').append(table);
            
        }else{
            
            $.each(data['data'], function (i, value) {
                var a = (value.license_key==null)?"":value.license_key
                var table = '<tr><td>' +(i+1)+  '</td><td>'+value.name+'</td><td>'+value.name_level+'</td><td>'+value.name_area+'</td><td>'+value.name_province+'</td><td>'+value.name_district+'</td><td>'+a+'</td></tr>'
                $('.results-table tbody').append(table);
                
            });
        
        }

        
    });

}
function changeProvince(provinceId){
    
     var url = $('#selectProvince').data('url');
        console.log(url);
        var indexOf = url.indexOf('change-province') + 15;
        console.log(indexOf);
        var lenght = url.length;
        var processUrl =  url.substr(0, indexOf)+ '/' + $('#selectProvince').val();
        axios.get(processUrl).then(function (result) {
        var data = result.data;
   
         $('#selectDistrict').empty();
        if($.isEmptyObject(data['districts']))
        {
            
            var option = '<option>Không có dữ liệu</option>'
            $('#selectDistrict').append(option)
            
        }
        else
        {
           
            $.each(data['districts'], function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'

                $('#selectDistrict').append(option)
            }); 
        }
         $('.results-table tbody').empty();
         if($.isEmptyObject(data['data']))
        {
            
             var table = '<tr><td colspan="5">Không có bản ghi nào</td></tr>'
            $('.results-table tbody').append(table);
            
        }else{
            $.each(data['data'], function (i, value) {
                var a = (value.license_key==null)?"":value.license_key
                var data = '<tr><td>' +(i+1)+  '</td><td>'+value.name+'</td><td>'+value.name_level+'</td><td>'+value.name_area+'</td><td>'+value.name_province+'</td><td>'+value.name_district+'</td><td>'+value.license_key+'</td></tr>'
                $('.results-table tbody').append(data);
                
            });
         }
        
    });
}

function changeDistrict(districtId){
   
     var url = $('#selectDistrict').data('url');
        console.log(url);
        var indexOf = url.indexOf('change-district') + 15;
        console.log(indexOf);
        var lenght = url.length;
        var processUrl =  url.substr(0, indexOf)+ '/' + $('#selectDistrict').val();
        axios.get(processUrl).then(function (result) {
        var data = result.data;
        console.log(data);
        $('.results-table tbody').empty();
        if($.isEmptyObject(data))
        {
            
            var table = '<tr><td colspan="5">Không có bản ghi nào</td></tr>'
            $('.results-table tbody').append(table);
            
        }else{
            $.each(data, function (i, value) {
             var a = (value.license_key==null)?"":value.license_keys
            var table = '<tr><td>' +(i+1)+  '</td><td>'+value.name+'</td><td>'+value.name_level+'</td><td>'+value.name_area+'</td><td>'+value.name_province+'</td><td>'+value.name_district+'</td><td>'+value.license_key+'</td></tr>'
            $('.results-table tbody').append(table);
                
            });
         }
        
    });
}