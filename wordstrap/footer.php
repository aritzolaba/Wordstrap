<?php
/**
 * The template for displaying the footer.
 */

// Get Options
global $wordstrap_theme_options;
$show_social = 0;

if ($wordstrap_theme_options['footer_show_fb'] == 1 OR $wordstrap_theme_options['footer_show_gp'] == 1 OR $wordstrap_theme_options['footer_show_tw'] == 1 OR $wordstrap_theme_options['footer_show_git'] == 1 OR $wordstrap_theme_options['footer_show_li'] == 1 OR $wordstrap_theme_options['footer_show_yt'] == 1) {
    $show_social = 1;
    $span='span6';
}
else {
    $span='span12';
}
?>
</div><!-- #ws-wrapper (initiated at header -->

<footer id="ws-footer">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="<?php echo $span; ?>">
                <div class="footer-padder">
                    <h2><?php echo $wordstrap_theme_options['footer_title1']; ?></h2>
                    <hr>
                    <?php echo $wordstrap_theme_options['footer_text']; ?>

                    <?php if ($wordstrap_theme_options['footer_displaycc'] == 1) : ?>

                        <p class="clearfix footer-cc">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/imgs/cc88x31.png" title="Creative Commons Share-Alike 3.0" alt="Creative Commons Share-Alike 3.0" />
                        </p>

                    <?php endif; ?>
                </div>
            </div>

            <?php if ($show_social == 1) : ?>
                <div class="span6">
                    <div class="footer-padder">
                        <h2><?php echo $wordstrap_theme_options['footer_title2']; ?></h2>
                        <hr>

                        <div class="social_buttons_container_footer">
                            <?php if ($wordstrap_theme_options['footer_show_fb'] == 1) : ?>
                                <a class="social_btn" href="<?php echo $wordstrap_theme_options['footer_fb_url']; ?>" title="Facebook"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_fb.png'; ?>" title="Facebook" alt="Facebook" /></a>
                            <?php endif; ?>
                            <?php if ($wordstrap_theme_options['footer_show_gp'] == 1) : ?>
                                <a class="social_btn" href="<?php echo $wordstrap_theme_options['footer_gp_url']; ?>" title="Google+"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_gp.png'; ?>" title="Google+" alt="Google+" /></a>
                            <?php endif; ?>
                            <?php if ($wordstrap_theme_options['footer_show_tw'] == 1) : ?>
                                <a class="social_btn" href="<?php echo $wordstrap_theme_options['footer_tw_url']; ?>" title="Twitter"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_tw.png'; ?>" title="Twitter" alt="Twitter" /></a>
                            <?php endif; ?>
                            <?php if ($wordstrap_theme_options['footer_show_li'] == 1) : ?>
                                <a class="social_btn" href="<?php echo $wordstrap_theme_options['footer_li_url']; ?>" title="LinkedIn"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_li.png'; ?>" title="LinkedIn" alt="LinkedIn" /></a>
                            <?php endif; ?>
                            <?php if ($wordstrap_theme_options['footer_show_git'] == 1) : ?>
                                <a class="social_btn" href="<?php echo $wordstrap_theme_options['footer_git_url']; ?>" title="Github"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_git.png'; ?>" title="GitHub" alt="GitHub" /></a>
                            <?php endif; ?>
                            <?php if ($wordstrap_theme_options['footer_show_yt'] == 1) : ?>
                                <a class="social_btn" href="<?php echo $wordstrap_theme_options['footer_yt_url']; ?>" title="Youtube"><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_yt.png'; ?>" title="YouTube" alt="YouTube" /></a>
                            <?php endif; ?>
                        </div>
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