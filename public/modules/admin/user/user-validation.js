$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            email: true,
            minlength: 3
        },
        tel: {

            required: true,
            phoneUS: true

        },
        role_id:{
            required: true
        },
        area_id:{
            required: true,
        },
        province_id:{
            required: true,
        },
        district_id:{
            required: true,
        },
        school_id:{
            required: true,
        },
        grades_id:{
            required: true,
        },
        class_id:{
            required: true,
        }


    },

    messages: {
        name: {
            required: "Xin vui lòng nhập tên .",
            minlength: "Độ dài tối thiểu là 3"
        },
        email: {
            required: "Xin vui lòng nhập email.",
            email:"Email không đúng định dạng ."
        },
        tel:{
            phoneUS: "Số điện thoại không đúng định dạng .",
            required: "Xin vui lòng nhập số điện thoại."
        },
        role_id:{
            required: "Xin vui lòng nhập quyển ."
        },
        area_id:{
            required: "Xin vui lòng nhập khu vực ."
        },
        province_id:{
            required: "Xin vui lòng nhập tỉnh."
        },
        district_id:{
            required: "Xin vui lòng nhập quận/huyện."
        },
        school_id:{
            required: "Xin vui lòng nhập trường."
        },
        grade_id:{
            required: "Xin vui lòng nhập khối."
        },
        class_id:{
            required: "Xin vui lòng nhập lớp."
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