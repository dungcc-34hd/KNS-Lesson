/**
 * Created by ThanhMinh92it on 9/6/2017.
 */
$(function () {
    $(document).on('click','.pagination li a', function (e) {
        e.preventDefault();
        var active = $(this).hasClass('current');
        var page = $(this).attr('value');
        var records = $('#show-records').val();
        // var records = 1;
        if(!active)
        {
            if(parseInt(page) !== 1)
            {
                $('.first').removeClass('disabled');
                $('.previous').removeClass('disabled');
            }
            else
            {
                $('.first').addClass('disabled');
                $('.previous').addClass('disabled');
            }
            if(parseInt(page) !== parseInt($('.last').attr('value')))
            {
                $('.last').removeClass('disabled');
                $('.next').removeClass('disabled');
            }
            else
            {
                $('.last').addClass('disabled');
                $('.next').addClass('disabled');
            }
            $('.pagination > li > a.page').each(function () {
                var element = $(this);
                if($(element).hasClass('current'))
                {
                    $(element).removeClass('current');
                    return false;
                }
            });
            var pageCurrent = parseInt($(this).attr('value'));
            if($(this).hasClass('page')) {
                setValueNext(pageCurrent);
                setValuePrevious(pageCurrent);
                $(this).addClass('current');
            }
            else
            {
                $('.page').each(function () {
                    var page = parseInt($(this).attr('value'));
                    if(pageCurrent === page)
                    {
                        $(this).addClass('current');
                    }
                });
                if($(this).hasClass('next'))
                {
                    setValueNext(pageCurrent);

                }
                else if($(this).hasClass('last'))
                {
                    $(this).addClass('disabled');
                    $('.next').addClass('disabled');
                    $('.previous').attr('value', parseInt($(this).attr('value')) - 1)
                }
                else if($(this).hasClass('previous'))
                {
                    setValuePrevious(pageCurrent);
                }
                else if($(this).hasClass('first'))
                {
                    $(this).addClass('disabled');
                    $('.previous').addClass('disabled');
                    $('.next').attr('value', parseInt($(this).attr('value')) + 1)
                }
            }
            var search = $('#nav-search-input').val() !== '' ? $('#nav-search-input').val() : null;
            ajaxLoadData(records,page, search);
        }
    });
    $('#show-records').bind('change', function () {
        var per_page = $(this).val();
        var search = $('#nav-search-input').val() !== '' ? $('#nav-search-input').val() : null;
        ajaxLoadData(per_page,1,search);
    });
    $('#nav-search-input').keyup(function () {
        var records = $('#show-records').val();
        ajaxLoadData(records,1,$(this).val());
    });

    $(document).on('click','.sorting', function () {
        $('.sorting').each(function () {
            $(this).find('i').removeClass('fa-sort-asc').removeClass('fa-sort-desc').addClass('fa-sort');
        });
        var value = $(this).attr('data-type');
        if(value === 'asc')
        {
            $(this).find('i').removeClass('fa-sort').addClass('fa-sort-asc');
            $(this).attr('data-type', 'desc');
        }
        else
        {
            $(this).find('i').removeClass('fa-sort-asc').addClass('fa-sort-desc');
            $(this).attr('data-type', 'asc');
        }

        $.ajax({
            type: 'GET',
            url: '/sorting/' + $(this).attr('data-field') + '/' + $(this).attr('data-type'),
            success: function () {
                var records = $('#show-records').val();
                ajaxLoadData(records,1,$('#nav-search-input').val());
            } 
        });
    });

}); 
function ajaxLoadData(records,  current_page,search) {
    var url_controller = $('#url-ajax').val();
    var url = url_controller + records +"?page=" + current_page;
    if(search !== null && search !== '')
    {
        url = url_controller + records +"/"+search+"?page=" + current_page;
    }
    $.ajax({
        type: 'GET',
        url: url ,
        beforeSend: function () {
            $('#spiner-load-ajax').modal({backdrop: 'static', keyboard: false});
        },
        success: function (result) {
            //append data in table
            $('.results-table tbody').empty();
            $('.results-table tbody').append(result);

            //append pagination 
            $.ajax({
                type: 'GET',
                url: "/pagination/" + current_page + "/" + $('#total-pages-current').val(),
                success: function (re) {
                    $('.widget-page').empty();
                    $('.widget-page').append(re);
                    $('#spiner-load-ajax').modal('hide');
                }
            });

        }
    });
}
function setValuePrevious(pageCurrent) {
    var pagePrevious = pageCurrent - 1;
    if( pagePrevious <= 0) {
        pagePrevious = 1;
    }
    $('.next').attr('value', pageCurrent + 1);
    $('.previous').attr('value', pagePrevious);

}
function setValueNext(pageCurrent) {
    var pageNext = pageCurrent + 1;
    var pageMax = parseInt($('.last').attr('value'));

    if( pageNext > pageMax) {
        pageNext = pageMax;
    }
    $('.previous').attr('value', pageCurrent - 1);
    $('.next').attr('value', pageNext);

}
