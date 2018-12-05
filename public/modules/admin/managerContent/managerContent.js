$.fn.extend({
    treed: function (o) {

        var openedClass = 'glyphicon-minus-sign';
        var closedClass = 'glyphicon-plus-sign';

        if (typeof o != 'undefined') {
            if (typeof o.openedClass != 'undefined') {
                openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined') {
                closedClass = o.closedClass;
            }
        }
        ;

        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function () {
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();

$('#tree2').treed({openedClass: 'glyphicon-folder-open', closedClass: 'glyphicon-folder-close'});

$('#tree3').treed({openedClass: 'glyphicon-chevron-right', closedClass: 'glyphicon-chevron-down'});

$(document).ready(function() {

    $('#create-grade').click(function () {
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

        axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then( function (response) {
            }
        );
        window.location.reload();
    });

    $('.modalDetailLesson').on('click',function () {
       var id = $(this).data('value');
       var text = $(this).text();
        $('#create-detail-lesson').on('click',function () {
            var formData = new FormData();
            var $form = $(this).closest('form');
            var url = $form.attr('action')
            var params = $('#formAddDetailLesson').serializeArray()
            params.push(({name: "lesson-id", value:id}));
            params.push(({name: "lesson-name", value:text}));
            params.push(({name: "type", value:$('#type').val()}));
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

            axios.post(url, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then( function (response) {
                    console.log(response);
                }
            );
            window.location.reload();
        });
    });
});