var lessonDetailId = $('#detail-lesson-id').val();
var lessonId = $('.lesson-id').val();

console.log(lessonId,lessonDetailId);
$('.validation-form').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: "",
    rules: {

        'detail-lesson': {
            required: true,
            remote: '/admin/manager-lesson/check-lesson-detail-name/' + lessonId + '/' + lessonDetailId ,
        },
        name: {
            required: true,
        },
        type: {
            required: true,
        },
        outline: {
            required: true,
        },
    },

    messages: {
        'detail-lesson': {
            required: "Mời bạn nhập vào trường này",
            remote: "Tên bài học đã tồn tại"
        },
        name: {
            required: "Mời bạn nhập tiêu đề.",
        },

        type: {
            required: "Mời bạn chọn kiểu."
        },
        outline: {
            required: "Mời bạn nhập vào trường này."
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
        if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
            var controls = element.closest('div[class*="col-"]');
            if (controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if (element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if (element.is('.chosen-select')) {
            error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
        }
        else error.insertAfter(element.parent());
    }
});