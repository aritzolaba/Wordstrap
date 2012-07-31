<?php
/**
 * The search template file.
 */

get_header();
?>
<div class="row-fluid">

    <?php get_sidebar('left'); ?>

    <div class="<?php echo WS_SPANCOL_CENTER; ?>">
        <div class="well well-breadcrumb ws-search">

            <?php get_template_part('partials/part_breadcrumb'); ?>

            <?php if (have_posts()) : ?>

                <h1><i class="icon-awesome-search" style="font-size: 1.4em; float: left; margin-top: .3em; margin-right: .6em;"></i><?php _e('Search results', 'wordstrap'); ?></h1>
                <h2><small><?php echo sprintf (__('%d result(s) found for the term', 'wordstrap'), $wp_query->post_count);?>&nbsp;<em>&QUOT;<?php echo get_search_query(); ?>&QUOT;</em></small></h2>

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