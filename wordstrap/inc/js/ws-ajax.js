(function($) {
    $(document).ready( function() {

        /* FEATURED AjaxRequest */
        function sendRequestFeatured (action, container, newpage) {

            // Send AJAX Request
            $.ajax({
                url:        WsAjax.ajaxurl,
                type:       'post',
                cache:      false,
                data:       { 'action':action, 'page':newpage },
                beforeSend: function(){
                    $(container+' div.well, '+container+' button').css('opacity','.2');
                    $(container).prepend ('<div class="ws-loading" style="width: 80px;"><img src="'+WsAjax.ajaxloadingimg+'"></div>');
                    var top = (($(container).height()/3.5) - ($('.ws-loading').height()/2));
                    var left = (($(container).width()/2) - ($('.ws-loading').width()/2));
                    $('.ws-loading').css({
                        'box-shadow' : '0px 0px 5px #000',
                        'z-index' : '2000',
                        'position' : 'absolute',
                        'padding' : '5px',
                        'text-align' : 'center',
                        'border-radius' : '4px',
                        'border' : '2px solid #888',
                        'background' : '#ffffff',
                        'margin-left' : left+'px',
                        'margin-top' : top+'px'});
                },
                success:    function(response){
                    $(container).html(response);
                },
                error:      function(errorThrown){
                    $(container).html('<div class="alert alert-error">Error: '+errorThrown.status+'</div>');
                }
            });
        }

        // Change Page Action
        $('.ws-featured-change-page').live("click", function (event) {
            event.preventDefault();
            var page = parseInt($(this).val());
            sendRequestFeatured ('WsAjaxFeatured', '#ws-ajax-featured', page, null);
        });
        /*END FEATURED AjaxRequest */

    });
})(jQuery);