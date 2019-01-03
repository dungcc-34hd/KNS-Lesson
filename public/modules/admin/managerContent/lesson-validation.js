$("#stt").on("keypress keyup blur",function (event) {
    $(this).val($(this).val().replace(/[^\d].+/,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});
jQuery.validator.addMethod("VldHtml", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) ||  /[@#$%^&*~/\|<>]/.test( value )==true?false:true;
  }, 'Không được nhập kí tự đặc biệt');
var lessonId = $('#lesson-name').val();

$('.validation-form-lesson').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "hidden",
    rules: {
        grade: {
            required: true,
        },
        name: {
            required: true,
            remote: '/admin/manager-lesson/check-lesson-name/' + lessonId,
            VldHtml: true,
        },
        thematic : {
            required: true,
        },
        stt : {
            required:true,
        }

    },

    messages: {
        grade: {
            required: "Mời bạn nhập vào trường này."
        },
        name: {
            required: "Mời bạn nhập vào trường này.",
            remote: "Bài học đã tồn tại"
        },
        thematic : {
            required: "Mời bạn chọn vào trường này.",
        },
        stt :{
            required : "Mời bạn chọn vào trường này.",
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