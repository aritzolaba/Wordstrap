<?php
/**
 * The single template file.
 */

get_header();

// Get theme options
global $wordstrap_theme_options;
?>
<div class="row-fluid">

    <?php get_sidebar('left'); ?>

    <div class="<?php echo WS_SPANCOL_CENTER; ?>">
        <div class="well">

            <?php
            if ($wordstrap_theme_options['hide_wsbreadcrumb'] != 1) :
                get_template_part('partials/part_breadcrumb');
            endif;
            ?>

            <?php $attdata = wp_get_attachment_metadata(); ?>

            <h3><?php echo get_the_title(); ?></h3>
            <p align="center">
                <?php echo wp_get_attachment_link(0, 'full', false); ?>
            </p>

        </div>
    </div><!-- .<?php echo WS_SPANCOL_CENTER; ?> -->

    <?php get_sidebar(); ?>

</div><!-- .row-fluid -->

<?php get_footer(); ?>