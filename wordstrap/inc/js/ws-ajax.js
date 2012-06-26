(function($) {
    $(document).ready( function() {

        /* FEATURED AjaxRequest */
        function sendRequestFeatured (action, container, newpage) {

            jQuery.post(
                WsAjax.ajaxurl,
                {
                    action:     action,
                    page:       newpage
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
            sendRequestFeatured ('WsAjaxFeatured', '#ws-ajax-featured', newpage, null);
        });

        $('#ws-featured-prev').live("click", function (event) {
            event.preventDefault();
            var newpage = parseInt($(this).val());
            sendRequestFeatured ('WsAjaxFeatured', '#ws-ajax-featured', newpage, null);
        });
        /* END FEATURED AjaxRequest */

    });
})(jQuery);