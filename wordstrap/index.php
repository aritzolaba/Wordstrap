<?php
/**
 * The index template file.
 *
 * @package WordStrap
 * @subpackage Main
 * @since Wordstrap 1.6.3
 */

get_header();
?>
<div class="row-fluid">

    <?php get_sidebar('left'); ?>

    <!-- Main Content -->
    <div class="<?php echo WS_SPANCOL_CENTER; ?>">

        <?php get_template_part('partials/part_landing'); ?>

    </div><!-- .<?php echo WS_SPANCOL_CENTER; ?> -->

    <?php get_sidebar(); ?>

</div><!-- .row-fluid -->

<?php get_footer(); ?>