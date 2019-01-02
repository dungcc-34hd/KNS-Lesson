jQuery.validator.addMethod("VldHtml", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) ||  /[^a-zA-Z0-9\s]/.test( value )==true?false:true;
  }, 'Không được nhập kí tự đặc biệt');


   var id= $('#id').val();
$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            remote:"/admin/manager-area/checkNameDistrict/"+id,
            required: true,
            VldHtml: true,
               
        },
        area_id:{
             required: true,
        },
        province_id:{
            required: true,
        },

    },

    messages: {
        name: {
            remote: "Tên đã tồn tại",
            required: "Xin vui lòng nhập tên.",
        },
         area_id:{
             required: "Xin vui lòng chọn khu vực.",
        },
          province_id:{
            required: "Xin vui lòng chọn tỉnh/thành phố.",
        },

    },


    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },

    success: function (e) {
    $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
    $(e).remove();
    },

    errorPlacement: function (error, element) {
    if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
        var controls = element.closest('div[class*="col-"]');
        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
    }
    else if(element.is('.select2')) {
        error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
    }
    else if(element.is('.chosen-select')) {
        error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
    }
    else error.insertAfter(element.parent());
    }
});