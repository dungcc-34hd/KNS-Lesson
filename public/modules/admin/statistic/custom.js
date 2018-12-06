
$(function ()
{
    activeMenu('statistic', null, false);
    $('#selectArea').change(function () {
        Area();
   });
   $('#selectProvince').change(function () {
       
   });
   $('#selectDistrict').change(function ()
    {
        
   });
   $('#selectSchool').change(function ()
    {
     
   });

});


function Area(){
         var url = $('#selectArea').data('url');        
         console.log(url);
        var indexOf = url.indexOf('change-area') + 11;    
        var length = url.length;
        var processUrl =  url.substr(0, indexOf) + '/' + $('#selectArea').val();
        axios.get(processUrl).then(function (result) {
        var data = result.data;
        console.log(data);
        // $('#selectProvince').empty();
        // if($.isEmptyObject(data['provinces']))
        // {
        //     var option = '<option>Không có dữ liệu</option>'
        //     $('#selectProvince').append(option)
             
        // }
        // else
        // {
           
        //     $.each(data['provinces'], function (i, value) {
        //         var option = '<option value='+value.id+'>'+value.name+'</option>'
        //         $('#selectProvince').append(option)
        //     });
              
        // }
        //  $('#selectDistrict').empty();
        // if($.isEmptyObject(data['districts']))
        // {
            
        //     var option = '<option>Không có dữ liệu</option>'
        //     $('#selectDistrict').append(option)
            
        // }
        // else
        // {
           
        //     $.each(data['districts'], function (i, value) {
        //         var option = '<option value='+value.id+'>'+value.name+'</option>'

        //         $('#selectDistrict').append(option)
        //     });
             
          
        
        // }
        // $('#selectSchool').empty();
        // if($.isEmptyObject(data['schools']))
        // {
            
        //     var option = '<option>Không có dữ liệu</option>'
        //     $('#selectSchool').append(option)
            
        // }
        // else
        // {
           
        //     $.each(data['schools'], function (i, value) {
        //         var option = '<option value='+value.id+'>'+value.name+'</option>'

        //         $('#selectSchool').append(option)
        //     });
        // }
            ajaxLoadData($('#show-records').val(), $('#pages-current').val(), $('#nav-search-input').val());
    });
        
}