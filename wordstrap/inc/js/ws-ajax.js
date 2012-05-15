(function($) {
    $(document).ready( function() {

        /* FEATURED AjaxRequest */
        function sendRequest (newpage) {

            jQuery.post(
                WsAjax.ajaxurl,
                {
                    action:     'WsAjaxFeatured',                    
                    page:       newpage,
                    AJAXNonce:  WsAjax.AJAXNonce
                },
                function(response) {
                    $('#ws-ajax-featured').html('');
                    $('#ws-ajax-featured').append(response);
                }
            );
        }

        $('#ws-featured-next').live("click", function (event) {
            event.preventDefault();
            var newpage = parseInt($(this).val());
            sendRequest (newpage);
        });

        $('#ws-featured-prev').live("click", function (event) {
            event.preventDefault();
            var newpage = parseInt($(this).val());
            sendRequest (newpage);
        });
        /* FEATURED AjaxRequest */

    });
})(jQuery);