<?php
/**
 * The header template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6.1
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>
<div id="ws-header" class="ws-header-container" <?php if ($wordstrap_theme_options['nav_fixed'] == 1) echo 'style="position: fixed;"'; ?>>
    <div class="container">
        <div class="row-fluid">
            <div class="span12">

                <?php
                // Display header image
                if ( get_header_image() ) : ?>

                    <a class="header_image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo('name'); ?>">
                        <img src="<?php header_image(); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
                    </a>

                <?php else : ?>

                    <a class="header_image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo('name'); ?>">
                        <h1><?php echo get_bloginfo('name'); ?></h1>
                    </a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>