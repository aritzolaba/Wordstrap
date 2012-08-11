<?php
/**
 * The latest-loop template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// wp_query args
$args = array(
    'post_type' => 'post',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'posts_per_page' => 4
);
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