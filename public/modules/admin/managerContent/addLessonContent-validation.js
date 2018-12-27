$('#add-lesson-content').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        title: {
            required: true,
        },
        'content[]': {
            required: true,
        },
        question: {
            required: true,
        },
        'answer[]': {
            required: true
        },
        'background-image[]':{
            required:true
        }
    },

    messages: {
        title: {
            required: "Mời bạn nhập vào trường này."
        },
        'content[]': {
            required: "Mời bạn nhập vào trường này."
        },
        question: {
            required: "Mời bạn nhập vào trường này."
        },
        'answer[]': {
            required: "Mời bạn nhập vào trường này."
        },
        'background-image[]':{
            required: "Mời bạn chọn file vào trường này."
        }
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
