<?php
/**
 * The marketing template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.5
 */
?>

<div class="row-fluid ws-marketing">
    <div class="span4">
        <div class="alert alert-heading">
            <img class="bs-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/inc/imgs/bootstrap.png">
            <h2><?php _e('Bootstrap ready', 'wordstrap'); ?></h2>
            <p><?php _e('Bootstrap is already packed for you, including the jQuery plugins and all the CSS and JS required.', 'wordstrap'); ?></p>
        </div>
    </div>

    <div class="span4">
        <div class="alert alert-heading">
            <img class="bs-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/inc/imgs/simple.png">
            <h2><?php _e('Minimalistic', 'wordstrap'); ?></h2>
            <p><?php _e('An attractive and minimalistic design, using the default bootstrap markup.', 'wordstrap'); ?></p>
        </div>
    </div>

    <div class="span4">
        <div class="alert alert-heading">
            <img class="bs-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/inc/imgs/custom.png">
            <h2><?php _e('Customizable', 'wordstrap'); ?></h2>
            <p><?php _e('Wordstrap is fully customizable to begin with the exact elements you need in your theme.', 'wordstrap'); ?></p>
        </div>
    </div>
</div><!-- .row -->