$(document).ready(function () {
    $("#nav-search-input").change(function (event) {
        var gradeId = $(this).val();
        $.ajax({
            type: "GET",
            url: '/admin/manager-lesson/pagination/1000/' + gradeId,
            data: {'gradeId': gradeId},
            success: function (data) {
                if (data != '') {
                    $('#changeLessonName').html(data);
                    $('.displayLesson').addClass('hidden');
                    $('.displayFull').removeClass('hidden');
                } else {
                    $('.displayFull').addClass('hidden');
                    $('.displayLesson').removeClass('hidden');
                }
            }
        });
    });
    $(".add-json-lesson").click(function (event) {
        var lessonId = $(this).val();
        $.ajax({
            type: "GET",
            url: '/admin/manager-lesson/add-lesson-json/' + lessonId,
            data: {'gradeId': lessonId},
            success: function (data) {

            }
        });
    });
    $(function () {
        $(".sortable").sortable({
            // update: function( event, ui ) {
            //     var lessonOrderId = ui.item.data('id' );
            //     var posittionOrder = ui.item.index();
            //
            //     $.ajax({
            //         type: "POST",
            //         url: '/admin/manager-lesson/update-order-lesson/' + lessonOrderId + '/'+ posittionOrder ,
            //         success: function (data) {
            //         }
            //     });
            // }
            start: function(event, ui) {
                ui.item.startPos = ui.item.index();
            },
            stop: function(event, ui) {
                var lessonOrderId = ui.item.data('id' );
                var start = ui.item.startPos;
                var stop = ui.item.index();
                axios.get('/admin/manager-lesson/update-order-lesson/'+ lessonOrderId +'/' + start + '/' + stop).then(function () {
                    $('table > .ui-sortable > tr').each(function (key, item) {
                       $(this).find('td:first').text(key + 1);
                    });
                })
                ;
            }
        });
        $("#sortable").disableSelection();
    });
});

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