$(function () {
    $(document).on('click', '.modal-show', function () {

        var url = $(this).data('url');
        if(url !== undefined)
        {
            var permission = $(this).data('active');
            if(permission)
            {
                declineAction();
            }
            else
            {
                $('#modal-action').modal('show').find('.modal-content').empty();
                $('#modal-action').modal('show').find('.modal-content').load(url);
            }
        }
        else
        {
            $('#modal-action').modal('show').find('.modal-content').empty();
            var content = $(this).data('content');
            var title = $(this).data('title');
            var append = '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span></button>' +
                '<h4 class="modal-title">'+ title +'</h4>' +
                '</div>' +
                '<div class="modal-body">' +
                '<p>'+ content +'</p>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>' +
                '</div>'
            $('#modal-action').modal('show').find('.modal-content').append(append);
        }
        var size = $(this).data('size') != undefined ? $(this).data('size') : "";
        $('.modal-dialog').css('width', size);

    });

    $(document).on('click', '.button-request', function () {
        $('#spiner-load-ajax').modal({backdrop: 'static', keyboard: false});
        // var formData = new FormData($('form').submit());
        var formData = new FormData();
        var $form = $(this).closest('form');
        var url = $form.attr('action')
        var params = $('form').serializeArray();
        var fileSelect = $('form input:file');
        $.each(params, function (i, field) {
            var name = field.name;
            var value = field.value;
            if(name.indexOf('[]') !== -1)
            {
                var intputType = $("input[name='" + name + "']").attr('type');
                switch (intputType) {
                    case 'checkbox':
                        value = $("input[name='" + name + "']:checked")
                            .map(function () {
                                return $(this).data('value');
                            }).get();
                        break;
                    case undefined:
                        value = $("textarea[name='" + name + "']")
                            .map(function () {
                                return $(this).val();
                            }).get();

                        break;
                    default:
                        value = $("input[name='" + name + "']").map(function () {
                                return $(this).val();
                            }).get();
                        break;
                }
            }
            if(name.indexOf('CKEditor') !== -1)
            {
                name = name.substr(0, name.indexOf('CKEditor'))
                value = CKEDITOR.instances[name].getData();
            }
            formData.append(name, value);
        });
        $.each(fileSelect, function (i, value) {
           var files = value.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                // Add the file to the request.
                formData.append(value.name + '[]', file, file.name);
            }
        });

        // $.ajax({
        //     type: 'POST',
        //     url: url,
        //     data: formData,
        //     contentType: false,
        //     processData: false,
        //     success: function (response) {
        //         switch (response.data.status) {
        //             case -1:
        //                 associate_errors(response.data, $form);
        //                 break;
        //             case 0:
        //                 alertShow(false, response.data.info);
        //                 $('#modal-action').modal('hide');
        //                 break;
        //             default:
        //                 alertShow(true, response.data.info);
        //                 $('#modal-action').modal('hide');
        //                 ajaxLoadData($('#show-records').val(), $('#pages-current').val(), $('#nav-search-input').val());
        //                 break;
        //
        //         }
        //     }
        // });
        axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then( function (response) {
                switch (response.data.status) {
                    case -1:
                        $('#spiner-load-ajax').modal('hide');
                        associate_errors(response.data, $form);
                        break;
                    case 0:
                        alertShow(false, response.data.info);
                        $('#modal-action').modal('hide');
                        break;
                    default:
                        alertShow(true, response.data.info);
                        $('#modal-action').modal('hide');
                        ajaxLoadData($('#show-records').val(), $('#pages-current').val(), $('#nav-search-input').val());
                        break;

                }
            }
        );
    });
    removeError('input');
    removeError('textare');
    removeError('select');
});

function associate_errors(errors, $form) {
    console.log(errors);
    $.each(errors, function (key) {
        var value = errors[key][0];
        //find each form group, which is given a unique id based on the form field's name
        var $element = $form.find('.' + key);
        var parentError = $element.closest('div.clearfix');
        var error = parentError.find('.help-block')
        if (error.length == 0) {
            //add the error class and set the error text
            parentError.append('<div class="help-block" id="' + key + '-error">' + value + '</div>');
        }
        else {
            error.html(value);
        }
    });
}

function removeError(element) {
    switch (element)
    {
        case 'select':
            $(document).on('change', element, function () {
                $(this).closest('div.clearfix').find('.help-block').remove();
            });
            break;
        default:
            $(document).on('keypress', element, function (e) {

                $(this).closest('div.clearfix').find('.help-block').remove();
            });
            break
    }
}
