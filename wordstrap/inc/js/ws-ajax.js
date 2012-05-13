(function($) {
    $(document).ready( function() {

        /* WsAjaxTest
         * The container which triggers this is in ws-config.php file
        */
        $('#WsAjaxTest').click(function (event) {

            event.preventDefault();

            jQuery.post(
                WsAjax.ajaxurl,
                {
                    action:     'WsAjaxFunction',
                    AJAXPost1:  'AJAXPost1 value',
                    AJAXPost2:  'AJAXPost2 value',
                    page:       $('#ws-page').val(),
                    AJAXNonce:  WsAjax.AJAXNonce
                },
                function(response) {
                    $('#ws-ajax-result-div-1').fadeOut('normal').delay(500).fadeIn('fast', function(){
                        $('#ws-ajax-result-div-1').html('');
                        $('#ws-ajax-result-div-1').append(response);
                        //$('#ws-ajax-result-div-1').append(response);
                        //$('#ws-page').val($('#ws-page').val()+1);
                    });
                }
            );

        });
        /* END WsAjaxTest */


        /* FEATURED AjaxRequest */
        function sendRequest (newpage) {

            jQuery.post(
                WsAjax.ajaxurl,
                {
                    action:     'WsAjaxFunction',
                    AJAXPost1:  'AJAXPost1 value',
                    AJAXPost2:  'AJAXPost2 value',
                    page:       newpage,
                    AJAXNonce:  WsAjax.AJAXNonce
                },
                function(response) {
                    $('#ws-ajax-result-div-1').html('');
                    $('#ws-ajax-result-div-1').append(response);
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