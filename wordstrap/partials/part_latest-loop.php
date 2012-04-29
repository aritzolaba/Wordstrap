<?php
/**
 * The latest-loop template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.5
 */
?>

<?php
$args = array(
    'post_type' => 'post',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'posts_per_page' => 4
);
// Override $wp_query with custom queries
$latest = new WP_Query( $args );
?>

<?php if ($latest->have_posts()) : ?>

    <?php while ($latest->have_posts()) : $latest->the_post(); ?>

        <div class="row-fluid">
            <div class="span12">

                <?php get_template_part( 'partials/part_article' ); ?>

            </div>
        </div>

    <?php endwhile; ?>

<?php else : ?>

    <?php ws_nothing_found(); ?>

<?php endif; ?>