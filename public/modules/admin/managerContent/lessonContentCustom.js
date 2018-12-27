$(document).ready(function () {
    $('.answer_last').click(function () {
        $(this).val(0);
        if ($(this).is(':checked')) {
            $(this).val(1);
        }
    });

    function changeAnswerCorrect(correct) {
        axios.get('/admin/manager-lesson/get-value-correct/' + correct).then(function (response) {
            var data = response.data;
        });
    }

    //add content
    $(".add_content").click(function () {
        var content = $('#content').clone().removeAttr("style");
        $('#form-content').append(content);
    });

    $('.field_wrapper').on("click", ".remove_content", function () {
        $(this).parent('div').remove();

    });

    //add answer
    $(".add-more").click(function () {
        var html = $('#answer_false').clone().removeAttr("style");
        $('#form_answer_false').append(html);
    });

    $("body").on("click", ".remove", function () {
        $(this).parents(".control-group").remove();
    });
    $("body").on("click", ".remove-by-id", function () {
        $(this).parents(".answer-by-id").remove();
    });

});