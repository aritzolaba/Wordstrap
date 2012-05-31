<?php
/**
 * The popular-loop template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */
?>

<?php
$args = array(
    'post_type' => 'post',
    'orderby' => 'comment_count',
    'order' => 'DESC',
    'posts_per_page' => 4
);
// Override $wp_query with custom queries
$popular = new WP_Query( $args );
?>

<?php if ($popular->have_posts()) : ?>

    <?php while ($popular->have_posts()) : $popular->the_post(); ?>

        <div class="row-fluid">
            <div class="span12">

                <?php get_template_part( 'partials/part_article' ); ?>

            </div>
        </div>

    <?php endwhile; ?>

<?php else : ?>

    <?php ws_nothing_found(); ?>

<?php endif; ?>