$(document).ready(function () {
    $('#grade').click(function(){
        $('.form-grade').show();
        $('.form-thematic').hide();
        $('.thematic').attr('name','');

    });
    $('#thematic').click(function(){
        $('.form-thematic').show();
        $('.form-grade').hide();
        $('.grade').attr('name','');
    });
});