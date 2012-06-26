<?php
/**
 * The category template file.
 *
 * @package WordStrap
 * @subpackage Main
 * @since Wordstrap 1.6.1
 */

get_header(); ?>

<div class="row-fluid">

    <?php get_sidebar('left'); ?>

    <div class="<?php echo WS_SPANCOL_CENTER; ?>">
        <div class="well well-breadcrumb">

            <?php get_template_part('partials/part_breadcrumb'); ?>

            <?php ws_category_pills(); ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('partials/part_article'); ?>

            <?php endwhile; ?>

            <?php ws_posts_navigation('ws-archive-nav'); ?>

        </div><!-- .well -->
    </div><!-- .<?php echo WS_SPANCOL_CENTER; ?> -->

    <?php get_sidebar(); ?>

</div><!-- .row-fluid -->

<?php get_footer(); ?>