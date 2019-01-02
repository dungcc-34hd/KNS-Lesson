jQuery.validator.addMethod("VldHtml", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) ||  /[^a-zA-Z0-9]/.test( value )==true?false:true;
  }, 'Không được nhập kí tự đặc biệt');

var id = $('#id').val();
$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            required: true,
            remote:"/admin/grade/checkName/"+id,
            // minlength: 3
            VldHtml:true
        },
        // quantity: {
        //     required: true,
        // },
        // 'select-grade-level': {
        //     required: true
        // },
        // 'select-school':{ 
        //     required:true
        // },
        // 'select-user':{ 
        //     required:true
        // }
    },

    messages: {
        name: {
            required: "Xin vui lòng nhập tên.",
             remote:"Tên khối đã tồn tại."
        },
        // quantity: {
        //     required: "Vui lòng nhập khối ."
        // },
        // 'select-school': {
        //     required: "Vui lòng nhập trường."
        // },
        // 'select-grade-level': {
        //     required: "Vui lòng nhập số lượng học sinh ."
        // },
        // 'select-user':{ 
        //     required:"Vui lòng nhập User ."
        // }
    },
 

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
        $(e).remove();
    },


});