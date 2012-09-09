(function($) {
    $(document).ready( function() {

        /* Initialize bootstrap elements */
        $('.pop').popover();
        $('.tip').tooltip();
        $('.carousel').carousel(
            {interval: 12500}
        );

        /* Color Pickers */
        var numcol = 12;
        for (i=1; i<=numcol; i++) {
            $('#colorpicker-'+i).farbtastic('#color-'+i);
            $('#colorpicker-'+i).hide();
        }

        /* Color pickers input click */
        $('.colorpicker').click(function() {
            var id = $(this).attr('id').replace('color-', '');
            $('#colorpicker-'+i).hide();
            if ( $('#colorpicker-'+id).css('display') == 'block' )
                $('#colorpicker-'+id).fadeOut();
            else
                $('#colorpicker-'+id).fadeIn();
        });

        /* Color pickers fadeout on mousedown */
        $(document).mousedown(function() {
            for (i=1; i<=numcol; i++) {
                if ( $('#colorpicker-'+i).css('display') == 'block' )
                    $('#colorpicker-'+i).fadeOut();
            }
        });
        /* END Color pickers */

        /* Theme Options Controls */
        $('.ws-check').click(function() {
            $('.ws-check').removeClass('active');
            $(this).addClass('active');
        });

        $('#googlefonts_check').click(function() {
            if ($(this).attr('checked')== 'checked')
                $('#googlefonts_box').slideDown('fast');
            else
                $('#googlefonts_box').slideUp('fast');
        });

        $('#landing_page_featured_check').click(function(){
            if ($(this).attr('checked')== 'checked')
                $('#landing_page_featured_box').slideDown('fast');
            else
                $('#landing_page_featured_box').slideUp('fast');
        });

        $('#landing_page_intro_check').click(function(){
            if ($(this).attr('checked')== 'checked')
                $('#landing_page_intro_box').slideDown('fast');
            else
                $('#landing_page_intro_box').slideUp('fast');
        });

        $('#hide_wsheader').click(function(){
            if ($(this).attr('checked')!= 'checked')
                $('#header_height_box').slideDown('fast');
            else
                $('#header_height_box').slideUp('fast');
        });

        $('#hide_wsnavbar').click(function(){
            if ($(this).attr('checked')!= 'checked')
                $('#nav_box').slideDown('fast');
            else
                $('#nav_box').slideUp('fast');
        });

        $('.social_buttons_check').click(function(){
            var ele = $(this).attr('rel');
            if ($(this).attr('checked')== 'checked') {
                $('input.'+ele).fadeIn();
                $('.'+ele+'_button').css('opacity','1');
            }
            else {
                $('input.'+ele).fadeOut();
                $('.'+ele+'_button').css('opacity','0.2');
            }
        });
        /* END Theme Options Controls */

    });
})(jQuery);