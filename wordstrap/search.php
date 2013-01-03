<?php
/**
 * The search template file.
 */

get_header();

// Get theme options
global $wordstrap_theme_options;
?>
<div class="row-fluid">

    <?php get_sidebar('left'); ?>

    <div class="<?php echo WS_SPANCOL_CENTER; ?>">
        <div class="well ws-search">

            <?php
            if ($wordstrap_theme_options['hide_wsbreadcrumb'] != 1) :
                get_template_part('partials/part_breadcrumb');
            endif;
            ?>

            <?php if (have_posts()) : ?>

                <h1><i class="icon-search"></i> <?php _e('Search results', 'wordstrap'); ?></h1>
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