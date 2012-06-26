(function($) {
    $(document).ready( function() {

        /* Initialize bootstrap elements */
        $('.pop').popover();
        $('.tip').tooltip();
        $('.carousel').carousel(
            {interval: 12500}
        );

        /* Color pickers */
        $('#colorpicker-1, #colorpicker-2, #colorpicker-3, #colorpicker-4').hide();
        $('#colorpicker-1').farbtastic('#color-1');
        $('#colorpicker-2').farbtastic('#color-2');
        $('#colorpicker-3').farbtastic('#color-3');
        $('#colorpicker-4').farbtastic('#color-4');

        $('#color-1').click(function() {
            $('#colorpicker-1').fadeIn();
        });

        $('#color-2').click(function() {
            $('#colorpicker-2').fadeIn();
        });

        $('#color-3').click(function() {
            $('#colorpicker-3').fadeIn();
        });

        $('#color-4').click(function() {
            $('#colorpicker-4').fadeIn();
        });

        $(document).mousedown(function() {
            $('#colorpicker-1, #colorpicker-2, #colorpicker-3, #colorpicker-4').each(function() {
                var display = $(this).css('display');
                if ( display == 'block' )
                    $(this).fadeOut();
            });
        });
        /* END Color pickers */

        /* Theme Options Controls */
        $('.ws-check').click(function() {
            $('.ws-check').removeClass('active');
            $(this).addClass('active');
        });

        $('#googlefonts_check').click(function() {
            if ($(this).attr('checked')== 'checked')
                $('#googlefonts_box').fadeIn();
            else
                $('#googlefonts_box').fadeOut();
        });

        $('#landing_page_featured_check').click(function(){
            if ($(this).attr('checked')== 'checked')
                $('#landing_page_featured_box').fadeIn();
            else
                $('#landing_page_featured_box').fadeOut();
        });

        $('#landing_page_intro_check').click(function(){
            if ($(this).attr('checked')== 'checked')
                $('#landing_page_intro_box').fadeIn();
            else
                $('#landing_page_intro_box').fadeOut();
        });

        $('.social_buttons_check').click(function(){
            var ele = $(this).attr('rel');
            if ($(this).attr('checked')== 'checked')
                $('.'+ele+'_button').css('opacity','1');
            else
                $('.'+ele+'_button').css('opacity','0.2');
        });
        /* END Theme Options Controls */

    });
})(jQuery);