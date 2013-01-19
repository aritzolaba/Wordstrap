(function($) {
    $(document).ready( function() {

        /* Initialize bootstrap elements */
        /* This one delegates the function so
         * they still work after ajax calls */
        $('body').tooltip({
            selector: '[rel=tooltip]'
        });
        $('body').popover({
            selector: '[rel=popover]',
            placement:'top'
        });
        $('.carousel').carousel({
            interval: 10000
        });
        /* END Initialize elements */

        /* Add some css classes dinamically */
        // Adds bootstrap classes to the comment submit button
        if ($('#ws-comment-submit').length>0)
            $('#ws-comment-submit').addClass('btn btn-primary btn-large');
        // Adds bootstrap classes to tables
        if ($('table').length>0)
            $('table').addClass('table table-condensed table-striped table-bordered');
        if ($('table#wp-calendar').length>0)
            $('table#wp-calendar').removeClass('table-bordered');

        // Cancel comment button
        if ($('#cancel-comment-reply-link').length>0)
            $('#cancel-comment-reply-link').addClass('btn btn-mini').css('margin-top', '-5px').css('margin-left', '2px');

        // Comment reply button
        if ($('.comment-reply-link').length>0)
            $('.comment-reply-link').addClass('btn btn-mini');

        // Adds required dropdown classes for hierarchical navigation with wp_navmenu
        if ($('ul.sub-menu').length>0) {
            $('ul.sub-menu').parent().addClass('ws-dropdown');
            $('li.ws-dropdown').addClass('dropdown');
            $('ul.ws-nav li.ws-dropdown>a').addClass('dropdown-toggle').attr('data-toggle', 'dropdown').append(' <b class="caret"></b>');
            $('.ws-dropdown ul').addClass('dropdown-menu');
        }

        // Display the navbar after dropdown classes have been set (element has "display: none;" in style)
        if ($('div.navbar-inner div.container-fluid').length>0) {
            $('div.navbar-inner div.container-fluid').css('display','block');
        }

        // Adds thickbox class to gallery images in gallery post-formats
        if ($('div.gallery .gallery-icon a').length>0) {
            $('div.gallery .gallery-icon a').addClass('thickbox');
        }

    });
})(jQuery);