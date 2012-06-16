<?php
/**
 * The sidebar-left template file.
 *
 * @package WordStrap
 * @subpackage Main
 * @since Wordstrap 1.6
 */

// Get Theme Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>

<?php if ($wordstrap_theme_options['ws_layout'] == '2cols-left' OR $wordstrap_theme_options['ws_layout'] == '3cols') : ?>

    <!-- Sidebar Content -->
    <div class="<?php echo WS_SPANCOL_LEFT; ?>">

        <!-- Widgetized Content -->
        <div class="row-fluid">
            <div class="span12">
                <?php get_template_part('partials/part_widgets-left'); ?>
            </div>
        </div>

    </div><!-- .<?php echo WS_SPANCOL_LEFT; ?> -->

<?php endif; ?>