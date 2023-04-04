/**
 * Created by myii-developer.
 * v-1.0
 * MUNICH TEMPLATE
 */

//NANO-SCROLL LEFT-SIDEBAR
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(function( $ ) {
    "use strict";

    $(".nano").nanoScroller();
}).apply( this, [ jQuery ]);


$(function () {
    "use strict";
    //BOOTSTRAP TOOLTIPS
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $('[data-toggle="tooltip"]').tooltip({ container: 'body' })

    //BOOTSTRAP POPOVER
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $('[data-toggle="popover"]').popover({ container: 'body' })
})

