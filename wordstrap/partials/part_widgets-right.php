<?php
/**
 * The widgets-right template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6.4
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('ws-sidebar-right')) : ?>
    <div class="ws-widget-container well well-widgets">
        <div class="ws-widget-title">
            <?php echo __ ('Widgets area #right', 'wordstrap'); ?>
        </div>
        <div class="ws-widget-content">
            <div class="ws-widgets-empty">
                <?php _e ('add widgets here', 'wordstrap'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>