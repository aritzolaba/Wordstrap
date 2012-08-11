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