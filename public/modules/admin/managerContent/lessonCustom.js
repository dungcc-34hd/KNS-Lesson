$(document).ready(function () {

    $('#select-lesson').on('change',function () {
        var check = $(this).val();
        if (check == 1){
            $('.thematic').attr('name','')
            $('.grade').attr('name','grade')
            $('.form-thematic').addClass('hidden');
            $('.form-grade').removeClass('hidden');
        } else{
            $('.grade').attr('name','')
            $('.thematic').attr('name','thematic')
            $('.form-thematic').removeClass('hidden');
            $('.form-grade').addClass('hidden');
        }

    });
});

