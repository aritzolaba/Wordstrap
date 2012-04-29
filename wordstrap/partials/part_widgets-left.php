<?php
/**
 * The widgets-left template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.5
 */
?>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('ws-sidebar-left')) : ?>
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