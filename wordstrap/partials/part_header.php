<?php
/**
 * The header template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
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
                <?php if ($wordstrap_theme_options['show_wslogo'] == 1) : ?>
                    <a href="<?php echo get_site_url(); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/imgs/ws-logo.png" class="pull-left ws-logo">
                    </a>
                <?php endif; ?>
                <?php if ($wordstrap_theme_options['show_wstitle'] == 1) : ?>
                    <a class="brand" href="<?php echo get_site_url(); ?>"><?php echo bloginfo('site_name'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
