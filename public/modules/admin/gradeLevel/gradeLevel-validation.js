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
        // $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
        $(e).remove();
    },


});