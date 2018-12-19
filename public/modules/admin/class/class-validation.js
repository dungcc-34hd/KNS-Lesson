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
        // $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
        $(e).remove();
    },

   
});