/**
 * Created by myii-developer.
 * v-1.0
 * MUNICH TEMPLATE
 */

(function ($) {
    "use strict";

    $(document).on('click',function (e) {

        //collapse header elements when click outside of them
        if (!$('#notice-headerbox').find(e.target).length) {
            $("#notice-headerbox .notice.open").removeClass('open').children('.dropdown-box').slideUp(200);
        }
        if (!$('#user-headerbox').find(e.target).length) {
            $("#user-headerbox.open").removeClass('open').children('.user-options').slideUp(400);
        }
        if (!$('#search-headerbox').find(e.target).length) {
            if ($("#search").is(":visible")) {
                $("#search").slideToggle();
            }
        }
    });
}).apply(this, [jQuery]);

// TOGGLE CLASS on click
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(function ($) {
    "use strict";

    var toggleClassOnClick = function (object) {

        var target = object.attr('data-target');
        var toggleClass = object.attr('data-toggle-class');

        object.on('click.toggleClass.fireEvent', function (e) {

            e.preventDefault();
            $(target).toggleClass(toggleClass);
        });
    };

    $(function () {
        $('[data-toggle-class][data-target]').each(function () {
            toggleClassOnClick($(this));
        });
    });
}).apply(this, [jQuery]);

//NAVIGATION LEFT-SIDEBAR
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(function ($) {
    "use strict";

    var main_nav =$('#main-nav');

    function openItem(item) {
        item.children('ul.child-nav').slideDown(500, function () {
            $(this).css('display', '');
        });
        item.addClass('open-item').removeClass('close-item');
    }

    function closeItem(item) {
        console.log('close item');
        item.children('ul.child-nav').slideUp(300, function () {
            $(this).css('display', '');
            item.addClass('close-item').removeClass('open-item');
        });
    }

    //OPEN NAV ITEMS
    //-------------------------------------------------------------------
    main_nav.on('click', 'li.close-item', function (event) {

        event.stopPropagation();
        var item = $(this);
        openItem(item);

        item.siblings('li.open-item').each(function () {
            closeItem($(this));
        });
    });

    //CLOSE NAV ITEMS
    //-------------------------------------------------------------------
    main_nav.on('click', 'li.open-item', function (event) {
        event.stopPropagation();
        closeItem($(this))
    });

    main_nav.on('click', 'li.active-item', function (event) {
        event.stopPropagation();
    });


}).apply(this, [jQuery]);

//USER HEADERBOX DROPDOWN
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(function ($) {
    "use strict";

    $('#user-headerbox').on('click', function (event) {

        var options = $(this).children('.user-options');
        $(this).toggleClass('open');

        if ($(this).hasClass('open')) {
            options.slideDown(400);
        } else {
            options.slideUp(400);
        }

    });
}).apply(this, [jQuery]);

// NOTIFICACTION HEADERBOX
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(function ($) {
    "use strict";

    function openItem(item) {
        item.children('.dropdown-box').slideDown(400);
    }

    function closeItem(item) {
        item.children('.dropdown-box').slideUp(200);
    }

    function closeSiblings(item) {
        item.siblings('.notice.open').each(function () {
            closeItem($(this));
            $(this).removeClass('open');
        });
    }

    $('#notice-headerbox .notice i').on('click', function (event) {

        var item = $(this).parent();

        item.toggleClass('open');

        if (item.hasClass('open')) {
            closeSiblings(item);
            openItem(item)

        } else {
            closeItem(item)
        }

    });
}).apply(this, [jQuery]);

// SEARCH HEADERBOX
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(function ($) {
    "use strict";

    $('#search-icon').on('click',function () {
        $("#search").slideToggle();
    });
}).apply(this, [jQuery]);

// PANEL ACTIONS
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(function ($) {
    "use strict";

    $('.panel').on('click', '.toggle-panel.panel-expand', function () {

        var panel = $(this).closest('.panel');

        panel.children('.panel-content, .panel-footer').slideUp(400);
        $(this).addClass('panel-collapse').removeClass('panel-expand');
    });

    $('.panel').on('click', '.toggle-panel.panel-collapse', function () {

        var panel = $(this).closest('.panel');

        panel.children('.panel-content, .panel-footer').slideDown(400);
        $(this).addClass('panel-expand').removeClass('panel-collapse');

    });

    $('.panel').on('click', '.remove-panel', function () {

        var panel = $(this).closest('.panel');
        var parent = panel.parent();

        if (parent.is('[class*="col-"]') && parent.children().length == 1) {
            parent.fadeOut(500, function () {
                parent.remove();
            });
        } else {
            panel.fadeOut(300, function () {
                panel.remove();
            });
        }
    });

}).apply(this, [jQuery]);


//SPINNING BUTTONS
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
function btnStartSpinning(elem) {
    "use strict";

    if (elem.hasClass('btn-loading')) {

        elem.prop("disabled", true)
            .addClass('btn-spinning')
            .append('<i class="fa fa-spinner fa-spin btn-spin" aria-hidden="true"></i>')
    }
};
function btnStopSpinning(elem) {
    "use strict";

    if (elem.hasClass('btn-spinning')) {

        elem.prop("disabled", false)
            .removeClass('btn-spinning')
            .find('i.btn-spin').remove();
    }
};

//SCROLL TO TOP
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$(function () {
    "use strict";

    var scroll = $('.scroll-to-top');
    $(window).on('scroll',function () {
        if ($(this).scrollTop() > 100) {
            scroll.fadeIn();
        } else {
            scroll.fadeOut();
        }
    });

    scroll.on('click',function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

});

// RIGHT SIDEBAR TEMPLATE SETTINGS
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(function ($) {
    "use strict";
    var html = $('html');
    var left_sidebar_collapse = $('#left-sidebar-collapsed');
    var content_header_fixed = $('#content-header-fixed');
    var left_sidebar_fixed = $('#left-sidebar-fixed');
    var header_fixed = $('#header-fixed');

    //FIXED HEADER
    header_fixed.on('change', function (event) {
        if (header_fixed.is(':checked')) {

            fixedStyle();
        } else {
            scrollStyle();
            left_sidebar_fixed.removeAttr('checked')
            content_header_fixed.removeAttr('checked')
        }
    });

    //FIXED LEFT SIDEBAR
    left_sidebar_fixed.on('change', function (event) {

        if (left_sidebar_fixed.is(':checked')) {
            fixedStyle();
            html.removeClass('scroll-left-sidebar');
        } else {
            html.addClass('scroll-left-sidebar');
        }
    });

    //FIXED CONTENT HEADER
    content_header_fixed.on('change', function (event) {

        if (content_header_fixed.is(':checked')) {
            fixedStyle();
            html.removeClass('scroll-content-header');

        } else {
            html.addClass('scroll-content-header');
        }
    });

    //COLLAPSED LEFT-SIDEBAR
    left_sidebar_collapse.on('change', function (event) {

        if (left_sidebar_collapse.is(':checked')) {
            html.addClass('left-sidebar-collapsed');

        } else {
            html.removeClass('left-sidebar-collapsed');
        }
    });

    function fixedStyle() {
        html.addClass('fixed').removeClass('scroll');
        header_fixed.prop("checked", true);

    }

    function scrollStyle() {
        html.addClass('scroll').addClass('scroll-left-sidebar').addClass('scroll-content-header').removeClass('fixed');
        header_fixed.removeAttr('checked')
    }

    //COLLAPSED LEFT-SIDEBAR
    $('.left-sidebar-toggle').on('click', function (event) {
        if (left_sidebar_collapse.is(':checked')) {
            left_sidebar_collapse.removeAttr('checked')
        } else {
            left_sidebar_collapse.prop("checked", true);
        }
    });
}).apply(this, [jQuery]);
