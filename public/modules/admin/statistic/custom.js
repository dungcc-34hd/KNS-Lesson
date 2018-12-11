$(function ()
{
activeMenu('statistic', null, false);
});
$(document).ready(function(){
    
    // select areas
    $("#areas").change(function(){
        var area = $(this).val();

        $.ajax({
            type:'GET',
            url:'/admin/statistic/hanlding-area/',
            'data': {
                'area' : area,
            },
            success:function(data) {
                $('#provinces').html(data.select);
                $('#tbody').html(data.user);
                $("#districts").html('<option>Chọn Quận/Huyện</option>');
                $("#schools").html('<option>Chọn Trường </option>');
                // var records = $('#tbody').val();
                // ajaxLoadData(records,1,$('#nav-search-input').val());
            }
         });
    });

    // select provinces
    $("#provinces").change(function(){
        var province = $(this).val();
      
        $.ajax({
            type:'GET',
            url:'/admin/statistic/hanlding-province',
            'data': {
                'province' : province,
            },
            success:function(data) {
                $('#districts').html(data.select);
                $('#tbody').html(data.user);
                $("#schools").html('<option>Chọn Trường </option>');
                // ajaxLoadData(records,1,$('#nav-search-input').val());
            }
         });
    });

    // select districts
    $("#districts").change(function(){
        var district = $(this).val();
       
        $.ajax({
            type:'GET',
            url:'/admin/statistic/hanlding-district',
            'data': {
                'district' : district,
            },
            success:function(data) {
                $('#tbody').html(data.user);
                $('#schools').html(data.select);
            }
         });
    });
    $("#schools").change(function(){
        var school = $(this).val();
       
        $.ajax({
            type:'GET',
            url:'/admin/statistic/hanlding-school',
            'data': {
                'school' : school,
            },
            success:function(data) {
                $('#tbody').html(data.user);
            }
         });
    });

});