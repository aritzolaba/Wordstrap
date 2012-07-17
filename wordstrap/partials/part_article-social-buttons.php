<?php
/**
 * The social buttons template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6.4
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
?>
<div class="ws-social-buttons-container">
    <div class="ws-social-buttons">

        <a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
        <iframe src="http://www.facebook.com/plugins/like.php?app_id=124765724272783&amp;href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>

        <script type="text/javascript">
            (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();

            (function($) {
                $(document).ready( function() {

                    $(".ws-social-buttons").delay(1000).fadeIn();

                });

            })(jQuery);

        </script>

    </div>
</div>