// $(document).ready(function() {

    // $('#create-grade').click(function () {
    //     var formData = new FormData();
    //     var $form = $(this).closest('form');
    //     var url = $form.attr('action')
    //     var params = $('form').serializeArray();
    //     var fileSelect = $('form input:file');
    //     $.each(params, function (i, field) {
    //         var name = field.name;
    //         var value = field.value;
    //         if(name.indexOf('[]') !== -1)
    //         {
    //             var intputType = $("input[name='" + name + "']").attr('type');
    //             switch (intputType) {
    //                 case 'checkbox':
    //                     value = $("input[name='" + name + "']:checked")
    //                         .map(function () {
    //                             return $(this).data('value');
    //                         }).get();
    //                     break;
    //                 case undefined:
    //                     value = $("textarea[name='" + name + "']")
    //                         .map(function () {
    //                             return $(this).val();
    //                         }).get();
    //
    //                     break;
    //                 default:
    //                     value = $("input[name='" + name + "']").map(function () {
    //                         return $(this).val();
    //                     }).get();
    //                     break;
    //             }
    //         }
    //         if(name.indexOf('CKEditor') !== -1)
    //         {
    //             name = name.substr(0, name.indexOf('CKEditor'))
    //             value = CKEDITOR.instances[name].getData();
    //         }
    //         formData.append(name, value);
    //     });
    //     $.each(fileSelect, function (i, value) {
    //         var files = value.files;
    //         for (var i = 0; i < files.length; i++) {
    //             var file = files[i];
    //
    //             // Add the file to the request.
    //             formData.append(value.name + '[]', file, file.name);
    //         }
    //     });
    //
    //     axios.post(url, formData, {
    //         headers: {
    //             'Content-Type': 'multipart/form-data'
    //         }
    //     }).then( function (response) {
    //         }
    //     );
    //     window.location.reload();
    // });

    // $('.modalDetailLesson').on('click',function () {
    //     alert(1);
    //    var id = $(this).data('value');
    //    var text = $(this).data('text');
    //         $.ajax({
    //             type: "GET",
    //             url: '/admin/manager-lesson/get-value-lesson-detail/' + id+'/'+text,
    //             data: {'lesson-id' => id, 'lesson-name'=>text},
    //             success: function( msg ) {
    //                 console.log(msg);
    //             }
    //         });
    //     });
        // $('#create-detail-lesson').on('click',function () {
        //     var formData = new FormData();
        //     var $form = $(this).closest('form');
        //     var url = $form.attr('action')
        //     var params = $('#formAddDetailLesson').serializeArray()
        //     params.push(({name: "lesson-id", value:id}));
        //     params.push(({name: "lesson-name", value:text}));
        //     params.push(({name: "type", value:$('#type').val()}));
        //     var fileSelect = $('form input:file');
        //     $.each(params, function (i, field) {
        //         var name = field.name;
        //         var value = field.value;
        //         if(name.indexOf('[]') !== -1)
        //         {
        //             var intputType = $("input[name='" + name + "']").attr('type');
        //             switch (intputType) {
        //                 case 'checkbox':
        //                     value = $("input[name='" + name + "']:checked")
        //                         .map(function () {
        //                             return $(this).data('value');
        //                         }).get();
        //                     break;
        //                 case undefined:
        //                     value = $("textarea[name='" + name + "']")
        //                         .map(function () {
        //                             return $(this).val();
        //                         }).get();
        //
        //                     break;
        //                 default:
        //                     value = $("input[name='" + name + "']").map(function () {
        //                         return $(this).val();
        //                     }).get();
        //                     break;
        //             }
        //         }
        //         if(name.indexOf('CKEditor') !== -1)
        //         {
        //             name = name.substr(0, name.indexOf('CKEditor'))
        //             value = CKEDITOR.instances[name].getData();
        //         }
        //         formData.append(name, value);
        //     });
        //     $.each(fileSelect, function (i, value) {
        //         var files = value.files;
        //         for (var i = 0; i < files.length; i++) {
        //             var file = files[i];
        //
        //             // Add the file to the request.
        //             formData.append(value.name + '[]', file, file.name);
        //         }
        //     });
        //
        //     axios.post(url, formData, {
        //         headers: {
        //             'Content-Type': 'multipart/form-data'
        //         }
        //     }).then( function (response) {
        //             console.log(response);
        //         }
        //     );
        //     window.location.reload();
        // });

//     });
//
// });