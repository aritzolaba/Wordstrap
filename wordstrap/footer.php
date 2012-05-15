<?php
/**
 * The template for displaying the footer.
 *
 * @package WordStrap
 * @subpackage Main Pages
 * @since Wordstrap 1.5
 */
?>

<?php
// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
$show_social = 0;
if ($wordstrap_theme_options['footer_show_fb'] == 1 OR $wordstrap_theme_options['footer_show_gp'] == 1 OR $wordstrap_theme_options['footer_show_tw'] == 1)
    $show_social = 1;

if ($show_social == 1) $span='span6'; else $span='span12';
?>

</div><!-- #ws-wrapper -->

<footer id="ws-footer" role="contentinfo">
    <div class="container">
        <div class="row-fluid">
            <div class="<?php echo $span; ?>">
                <h2>
                    <?php _e('About', 'wordstrap'); ?> <?php bloginfo('site_name'); ?>
                </h2>
                <hr>
                <?php echo $wordstrap_theme_options['footer_text']; ?>

                <?php if ($wordstrap_theme_options['footer_displaycc'] == 1) : ?>

                    <p>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/imgs/cc88x31.png" title="Creative Commons Share-Alike 3.0" alt="Creative Commons Share-Alike 3.0" />
                    </p>

                <?php endif; ?>
            </div>

            <?php if ($show_social == 1) : ?>
                <div class="span6">
                    <h2><?php _e('Follow us', 'wordstrap'); ?></h2>
                    <hr>

                    <div class="social_buttons_container_footer">
                        <?php if ($wordstrap_theme_options['footer_show_fb'] == 1) : ?>
                            <a class="fb" href="<?php echo $wordstrap_theme_options['footer_fb_url']; ?>" title="<?php echo gettext('Facebook', 'wordstrap'); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_fb.png'; ?>" title="Facebook" alt="Facebook" /></a>
                        <?php endif; ?>
                        <?php if ($wordstrap_theme_options['footer_show_gp'] == 1) : ?>
                            <a class="gplus" href="<?php echo $wordstrap_theme_options['footer_gp_url']; ?>" title="<?php echo gettext('Google+'); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_gplus.png'; ?>" title="Google+" alt="Google+" /></a>
                        <?php endif; ?>
                        <?php if ($wordstrap_theme_options['footer_show_tw'] == 1) : ?>
                            <a class="tw" href="<?php echo $wordstrap_theme_options['footer_tw_url']; ?>" title="<?php echo gettext('Twitter'); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_twitter.png'; ?>" title="Twitter" alt="Twitter" /></a>
                        <?php endif; ?>
                        <?php if ($wordstrap_theme_options['footer_show_git'] == 1) : ?>
                            <a class="tw" href="<?php echo $wordstrap_theme_options['footer_git_url']; ?>" title="<?php echo gettext('Github'); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_git.png'; ?>" title="Github" alt="Github" /></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer><!-- #ws-mainfooter -->

<?php wp_footer(); ?>

</div><!-- #ws-main -->

</body>
</html>