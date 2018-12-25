jQuery.validator.addMethod("VldHtml", function(value, element) {
    return this.optional( element ) || /^([a-zA-Z])+$/ig.test( value );
}, 'Không được nhập kí tự đặc biệt');
var id = $('#user-id').val();
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
            minlength: 3,
            remote:"/admin/user/checkEmail/"+id,
        },
        password: {
            required: true,
            minlength: 5
        },

        tel: {
            required: true,
            maxlength:10,
            number:true,
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
        grade_id:{
            required: true,
        },
        class_id:{
            required: true,
        },
        quantity_student:{
            digits:true,
            number:true,
        }
    },

    messages: {
        name: {
            required: "Xin vui lòng nhập tên.",
            minlength: "Độ dài tối thiểu là 3",

        },
        email: {
            required: "Xin vui lòng nhập email.",
            email:"Email không đúng định dạng .",
            remote:"Email đã tồn tại",
        },
        password:{
            required: "xin vui lòng nhập mật khẩu",
            minlength: "Độ dài tối thiểu là 6 ."
        },

        tel:{
            maxlength: "Số điện thoại không quá 10 kí tự .",
            required: "Xin vui lòng nhập số điện thoại."
        },
        role_id:{
            required: "Xin vui lòng chọn quyền ."
        },
        area_id:{
            required: "Xin vui lòng chọn khu vực ."
        },
        province_id:{
            required: "Xin vui lòng chọn tỉnh."
        },
        district_id:{
            required: "Xin vui lòng chọn quận/huyện."
        },
        school_id:{
            required: "Xin vui lòng chọn trường."
        },
        grade_id:{
            required: "Xin vui lòng chọn khối."
        },
        class_id:{
            required: "Xin vui lòng chọn lớp."
        },
        quantity_student:{
            digits:"Sĩ số không được nhập số âm."
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