$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    alertHide();

    $ ('body'). resize ()
});


function activeMenu(parent, children, treeview) {
    $('.sidebar-menu > li').each(function () {
        $('li').removeClass('active');
        $('li').find('li').removeClass('active');
    });
    $('.' + parent).addClass('active');
    if (treeview) {
        $('.' + children).addClass('active');
    }
}

function alertShow(success, message) {
    if(success)
    {
        setContentToAlert('.alert-success', message)
    }
    else
    {
        setContentToAlert('.alert-danger', message)
    }
    alertHide();
}
function setContentToAlert(element, message) {
    $(element).find('span').html(message);
    $(element).show();
}

function alertHide() {
    $('.alert').delay(5000).slideUp(200, function () {
        $(this).hide();
    });
}
function declineAction() {
    $.alert({
        title: 'Chú ý!',
        content: 'Xin hãy mở hóa bản ghi để thực hiện hành động này!',
    });
}



