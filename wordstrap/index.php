<?php
/**
 * The index template file.
 */

get_header();
?>
<div class="row-fluid">

    <?php get_sidebar('left'); ?>

    <!-- Main Content -->
    <div class="<?php echo WS_SPANCOL_CENTER; ?>">

        <?php get_template_part('partials/part_front'); ?>

    </div><!-- .<?php echo WS_SPANCOL_CENTER; ?> -->

    <?php get_sidebar(); ?>

</div><!-- .row-fluid -->

<?php get_footer(); ?>