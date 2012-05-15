(function($) {
    $(document).ready( function() {

        /* Initialize bootstrap elements */
        /* This one initialises tooltips with live:true so that
         * they still work after ajax calls */
        $('body').tooltip({
            selector: '[rel=tooltip]'
        });
        $('.pop-top').popover({
            placement:'top'
        });
        $('.pop-bottom').popover({
            placement:'bottom'
        });
        $('.pop-bottom-show').popover({
            trigger:'manual',
            placement:'bottom'
        });
        $('.pop-left').popover({
            placement:'left'
        });
        $('.pop-right').popover({
            placement:'right'
        });

        $('.carousel').carousel(
        {
            interval: 10000
        }
        );

        /* Login Nav Bar Stop Propagation in Dropdown */
        $('.dropdown-menu form').click(function(event) {
            event.stopPropagation();
        });        

        /* User Box form footer mouseover/out opacity */
        if ($("#ws-user-box .ws-form-common-footer").length>0) {
            $("#ws-user-box .ws-form-common-footer").mouseover(function(){
                $(this).css('opacity','1');
            });
            $("#ws-user-box .ws-form-common-footer").mouseout(function(){
                $(this).css('opacity','0.5');
            });
        }

        /* Login submit, prevent empty fields */
        $('#wp_login_form').submit(function (event) {

            if ($('#log').val()=='') {
                $('#log').focus();
                event.preventDefault();
            } else if ($('#pwd').val()=='') {
                $('#pwd').focus();
                event.preventDefault();
            }

        });

        /* ForgotPassword submit, prevent empty fields */
        $('#lostpasswordform').submit(function (event) {

            if ($('#user_login').val()=='') {
                $('#user_login').focus();
                event.preventDefault();
            }

        });

        /* Registerform submit, prevent empty fields */
        $('#registerform').submit(function (event) {

            if ($('#new_user_login').val()=='') {
                $('#new_user_login').focus();
                event.preventDefault();
            } else if ($('#new_user_email').val()=='') {
                $('#new_user_email').focus();
                event.preventDefault();
            }

        });        

        /* Login,Register and Forget pass screens toggle */
        $('.ws-toggle').click(function (event) {
            event.preventDefault();

            if ($(this).attr('href') == 'lostpassword') {
                $('#wp_login_form').fadeOut('fast', function(){
                    $('#lostpasswordform').fadeIn();
                });
            }
            else if ($(this).attr('href') == 'register') {
                $('#wp_login_form').fadeOut('fast', function(){
                    $('#registerform').fadeIn();
                });
            }
            else if ($(this).attr('href') == 'login') {
                if ($('#lostpasswordform').is (':visible')) {
                    $('#lostpasswordform').fadeOut('fast', function(){
                        $('#wp_login_form').fadeIn();
                    });
                } else if ($('#registerform').is (':visible')) {
                    $('#registerform').fadeOut('fast', function(){
                        $('#wp_login_form').fadeIn();
                    });
                }
            }

            /* Reset values */
            $('#user_login').val('');
            $('#new_user_login').val('');
            $('#new_user_email').val('');
            $('#log').val('');
            $('#pwd').val('');
            $('.well-login .alert').fadeOut('fast');

            return false;

        });

    });
})(jQuery);