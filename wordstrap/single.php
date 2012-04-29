<?php
/**
 * The single template file.
 *
 * @package WordStrap
 * @subpackage Main Pages
 * @since Wordstrap 1.5
 */
?>

<?php get_header(); ?>

<div class="row-fluid">
    
    <?php get_sidebar('left'); ?>

    <div class="<?php echo WS_SPANCOL_CENTER; ?>">
        <div class="well well-breadcrumb">

            <?php get_template_part('partials/part_breadcrumb'); ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('partials/part_article'); ?>

                <div id="ws-comment-list">

                    <?php comments_template( '', true ); ?>

                </div>

            <?php endwhile; ?>
        </div>
    </div><!-- .<?php echo WS_SPANCOL_CENTER; ?> -->

    <?php get_sidebar(); ?>

</div><!-- .row-fluid -->

<?php get_footer(); ?>