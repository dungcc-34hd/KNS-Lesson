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
        grade_id: {
            required: true
        },
    },

    messages: {
        name: {
            required: "Vui lòng nhập tên ."
        },
        
        grade_id: {
            required: "Vui lòng chọn khối."
        },
        
    },
 

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
        $(e).remove();
    },

   
});