<?php
/**
 * The widgets_left template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('ws-sidebar-left')) : ?>
    <div class="ws-widget-container well well-widgets">
        <div class="ws-widget-title">
            <?php echo __ ('Widgets area #left', 'wordstrap'); ?>
        </div>
        <div class="ws-widget-content">
            <div class="ws-widgets-empty">
                <?php _e ('add widgets here', 'wordstrap'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>