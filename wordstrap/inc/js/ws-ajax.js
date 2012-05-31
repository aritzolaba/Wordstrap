(function($) {
    $(document).ready( function() {

        /* FEATURED AjaxRequest */
        function sendRequestFeatured (action, container, newpage) {

            jQuery.post(
                WsAjax.ajaxurl,
                {
                    action:     action,
                    page:       newpage,
                    AJAXNonce:  WsAjax.AJAXNonce
                },
                function(response) {
                    $(container).html('');
                    $(container).append(response);
                }
                );
        }

        $('#ws-featured-next').live("click", function (event) {
            event.preventDefault();
            var newpage = parseInt($(this).val());
            $('#ws-ajax-featured').append('<div class="ws-loading"></div>');
            sendRequestFeatured ('WsAjaxFeatured', '#ws-ajax-featured', newpage, null);
        });

        $('#ws-featured-prev').live("click", function (event) {
            event.preventDefault();
            var newpage = parseInt($(this).val());
            $('#ws-ajax-featured').append('<div class="ws-loading"></div>');
            sendRequestFeatured ('WsAjaxFeatured', '#ws-ajax-featured', newpage, null);
        });
        /* END FEATURED AjaxRequest */

    });
})(jQuery);