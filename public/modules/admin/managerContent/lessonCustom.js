$(document).ready(function () {
    $('#grade').click(function(){
        $('.form-grade').show();
        $('.form-thematic').hide();
        $('.thematic').attr('name','');
        $('.grade').attr('name','grade');

    });
    $('#thematic').click(function(){
        $('.form-thematic').show();
        $('.form-grade').hide();
        $('.grade').attr('name','');
        $('.thematic').attr('name','thematic');
    });
});