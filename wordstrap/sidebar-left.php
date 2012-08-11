<?php
/**
 * The sidebar-left template file.
 */

// Get Theme Options
global $wordstrap_theme_options;

if ($wordstrap_theme_options['ws_layout'] == '2cols-left' OR $wordstrap_theme_options['ws_layout'] == '3cols') : ?>

    <!-- Sidebar Content -->
    <div class="<?php echo WS_SPANCOL_LEFT; ?>">

        <!-- Widgetized Content -->
        <div class="row-fluid">
            <div class="span12">
                <?php get_template_part('partials/part_widgets_left'); ?>
            </div>
        </div>

    </div><!-- .<?php echo WS_SPANCOL_LEFT; ?> -->

<?php endif; ?>