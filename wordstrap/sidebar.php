<?php
/**
 * The sidebar template file.
 */

// Get Theme Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>

<?php if ($wordstrap_theme_options['ws_layout'] == '2cols-right' OR $wordstrap_theme_options['ws_layout'] == '3cols') : ?>

    <!-- Sidebar Content -->
    <div class="<?php echo WS_SPANCOL_RIGHT; ?>">

        <!-- Widgetized Content -->
        <div class="row-fluid">
            <div class="span12">
                <?php get_template_part('partials/part_widgets-right'); ?>
            </div>
        </div>

    </div><!-- .<?php echo WS_SPANCOL_RIGHT; ?> -->

<?php endif; ?>