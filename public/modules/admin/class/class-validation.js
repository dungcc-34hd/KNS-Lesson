$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            required: true,
            // minlength: 3
        },
        quantity: {
            required: true,
        },
        'select-grade-level': {
            required: true
        },
        'select-school':{ 
            required:true
        },
        'select-user':{ 
            required:true
        }
    },

    messages: {
        name: {
            required: "Vui lòng nhập tên ."
        },
        quantity: {
            required: "Vui lòng nhập khối ."
        },
        'select-school': {
            required: "Vui lòng nhập trường."
        },
        'select-grade-level': {
            required: "Vui lòng nhập số lượng học sinh ."
        },
        'select-user':{ 
            required:"Vui lòng nhập User ."
        }
    },
 

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
        $(e).remove();
    },

    // errorPlacement: function (error, element) {
    //     if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
    //         var controls = element.closest('div[class*="col-"]');
    //         if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
    //         else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
    //     }
    //     else if(element.is('.select2')) {
    //         error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
    //     }
    //     else if(element.is('.chosen-select')) {
    //         error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
    //     }
    //     else error.insertAfter(element.parent());
    // }
});