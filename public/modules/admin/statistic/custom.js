
$(function ()
{
    activeMenu('statistic', null, false);
   $('#selectProvince').change(function () {
        process($(this).val());
   });
   $('#selectDistrict').change(function ()
    {
        Data();
   });
   $('#selectSchool').change(function ()
    {
        changeSchool();
   });

   
   

});
function process(provinceId) {

    axios.get('/admin/statistic/change-province/' + provinceId).then(function (response) {
   
        var data = response.data;
        $('#selectDistrict').empty();
        if($.isEmptyObject(data))
        {
         
            var option = '<option>Không có dữ liệu</option>'
            
            $('#selectDistrict').append(option)
             
        }
        else
        {
           
            $.each(data, function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'
                $('#selectDistrict').append(option)
            });
            
            
        }
        Data();
    });
}

function Data(){
    var url = $('#selectDistrict').data('url');
    var indexOf = url.indexOf('change-district') + 15;
    var lenght = url.length;
    var processUrl =  url.substr(0, indexOf) + '/' + $('#selectDistrict').val();
    axios.get(processUrl).then(function (result) {
        var data = result.data;
        console.log(data);   
        var tr = '<tr><td>'+data['sum_teacher']+'</td><td>'+data['sum_student']+'</td></tr>'
        $('#tSchool').find('tr').remove()
        $('#tSchool').append(tr)

        console.log(tr);
     
    });
}

function changeSchool(){
    var url = $('#selectSchool').data('url');
    console.log(url);  
    var indexOf = url.indexOf('change-school') + 13;
    var lenght = url.length;
    var processUrl =  url.substr(0, indexOf) + '/' + $('#selectSchool').val();
    axios.get(processUrl).then(function (result) {
        var data = result.data;
        console.log(data);   
        var tr = '<tr><td>'+data+'</td></tr>'
        $('tbody').find('tr').remove()
        $('tbody').append(tr)
    });
}

