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
   $('#selectGrade').change(function() {
        changeGrade($(this).val());
   });
   


});

function process(areaId) {
    axios.get('/admin/user/change-select/' + areaId).then(function (response) {
        var data = response.data;
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
        $('#selectSchool').empty();
        if($.isEmptyObject(data['schools']))
        {
            
            var option = '<option>Không có dữ liệu</option>'
            $('#selectSchool').append(option)
            
        }
        else
        {
           
            $.each(data['schools'], function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'

                $('#selectSchool').append(option)
            });
        }

    });
}
function changeProvince(provinceId){
  axios.get('/admin/user/change-province/' + provinceId).then(function (response) {
      var data =response.data;
      console.log(data);
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
      $('#selectSchool').empty();
        if($.isEmptyObject(data['schools']))
        {
            
            var option = '<option>Không có dữ liệu</option>'
            $('#selectSchool').append(option)
            
        }
        else
        {
           
            $.each(data['schools'], function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'

                $('#selectSchool').append(option)
            });
        }
  });
}

function changeDistrict(districtId){
  axios.get('/admin/user/change-district/' + districtId).then(function (response) {
      var data =response.data;
      console.log(data);
      $('#selectSchool').empty();
        if($.isEmptyObject(data))
        {
            
            var option = '<option>Không có dữ liệu</option>'
            $('#selectSchool').append(option)
            
        }
        else
        {
           
            $.each(data, function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'

                $('#selectSchool').append(option)
            });
        }
      
  });
}

function changeGrade(gradeId){
  axios.get('/admin/user/change-grade/' + gradeId).then(function (response) {
      var data =response.data;
      console.log(data);
      $('#selectClass').empty();
        if($.isEmptyObject(data))
        {
            
            var option = '<option>Không có dữ liệu</option>'
            $('#selectClass').append(option)
            
        }
        else
        {
           
            $.each(data, function (i, value) {
                var option = '<option value='+value.id+'>'+value.name+'</option>'

                $('#selectClass').append(option)
            });
        }
      
  });
}