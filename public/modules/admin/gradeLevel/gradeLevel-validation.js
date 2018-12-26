jQuery.validator.addMethod("VldHtml", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) || /<(.|\n)*?>/g.test( value )==true?false:true;
  }, 'Không được nhập kí tự đặc biệt');
  

$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            required: true,
            // minlength: 3
            VldHtml:true
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


});