$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.alert').delay(5000).slideUp(200, function () {
        $(this).hide();
    });
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