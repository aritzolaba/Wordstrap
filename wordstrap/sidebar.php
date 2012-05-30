<?php
/**
 * The sidebar template file.
 *
 * @package WordStrap
 * @subpackage Main Pages
 * @since Wordstrap 1.5
 */
?>

<?php
// Get Theme Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>

<?php if ($wordstrap_theme_options['ws_layout'] == '2cols-right' OR $wordstrap_theme_options['ws_layout'] == '3cols') : ?>

    <!-- Sidebar Content -->
    <div class="<?php echo WS_SPANCOL_RIGHT; ?>">

        <?php if ($wordstrap_theme_options['auth_system'] == 1 && $wordstrap_theme_options['auth_system_display'] == 'right') : ?>

            <!-- WS Login -->
            <div class="row-fluid">
                <div class="span12">
                    <?php get_template_part('partials/part_auth'); ?>
                </div>
            </div>

        <?php endif; ?>                        

        <!-- Widgetized Content -->
        <div class="row-fluid">
            <div class="span12">
                <?php get_template_part('partials/part_widgets-right'); ?>
            </div>
        </div>

    </div><!-- .<?php echo WS_SPANCOL_RIGHT; ?> -->

<?php endif; ?>