<?php
/**
 * The search template file.
 *
 * @package WordStrap
 * @subpackage Main Pages
 * @since Wordstrap 1.6
 */
?>

<?php get_header(); ?>

<div class="row-fluid">
    
    <?php get_sidebar('left'); ?>
    
    <div class="<?php echo WS_SPANCOL_CENTER; ?>">
        <div class="well well-breadcrumb ws-search">

            <?php get_template_part('partials/part_breadcrumb'); ?>

            <?php if (have_posts()) : ?>

                <h1><?php _e('Search results', 'wordstrap'); ?></h1>
                <h2><small><?php echo sprintf (__('Term <em>&quot;%s&quot;</em>', 'wordstrap'), get_search_query()); ?>,&nbsp;<?php echo sprintf (__('%d result(s) found:', 'wordstrap'), $wp_query->post_count); ?></small></h2>

                <hr style="margin: 5px 0px; margin-bottom: 20px;">

                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('partials/part_article'); ?>

                <?php endwhile; ?>

            <?php else : ?>

                <?php ws_nothing_found(); ?>

            <?php endif; ?>            

        </div>
    </div><!-- .<?php echo WS_SPANCOL_CENTER; ?> -->

    <?php get_sidebar(); ?>

</div><!-- .row-fluid -->

<?php get_footer(); ?>