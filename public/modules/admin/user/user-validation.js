jQuery.validator.addMethod("VldHtml", function(value, element) {
    return this.optional( element ) || /^([a-zA-Z])+$/ig.test( value );
  }, 'Không được nhập kí tự đặc biệt');
  jQuery.validator.addMethod("biggerO", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) || value==""?false:true;
  }, 'Bạn chưa chọn.');
  
$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {
        name: {
            required: true,
            minlength: 3,
            VldHtml:true
        },
        email: {
            required: true,
            email: true,
            minlength: 3
        },
        password: {
            required: true,
            minlength: 5
        },
       
        tel: {
            maxlength:11,
        },
        role_id:{
            biggerO:true
        },
        area_id:{
            biggerO:true
        },
        province_id:{
            biggerO:true
        },
        district_id:{
            biggerO:true
        },
        school_id:{
            biggerO:true
        },
        grade_id:{
            biggerO:true
        },
        class_id:{
            biggerO:true
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
        password:{
            required: "xin vui lòng nhập mật khẩu",
            minlength: "Độ dài tối thiểu là 5 ."
        },
      
        tel:{
            maxlength: "Số điện thoại không quá 11 kí tự .",
            required: "Xin vui lòng nhập số điện thoại."
        },
        role_id:{
            biggerO: "Xin vui lòng chọn quyền ."
        },
        area_id:{
            biggerO: "Xin vui lòng chọn khu vực ."
        },
        province_id:{
            biggerO: "Xin vui lòng chọn tỉnh."
        },
        district_id:{
            biggerO: "Xin vui lòng chọn quận/huyện."
        },
        school_id:{
            biggerO: "Xin vui lòng chọn trường."
        },
        grade_id:{
            biggerO: "Xin vui lòng chọn khối."
        },
        class_id:{
            biggerO: "Xin vui lòng chọn lớp."
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