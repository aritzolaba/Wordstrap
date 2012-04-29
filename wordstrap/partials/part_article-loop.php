<?php
/**
 * The article-loop template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.5
 */
?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <div class="row-fluid">
            <div class="span12">

                <?php get_template_part( 'partials/part_article' ); ?>

            </div>
        </div>

    <?php endwhile; ?>

    <?php ws_posts_navigation('ws-blog-nav'); ?>

<?php else : ?>

    <?php ws_nothing_found(); ?>

<?php endif; ?>