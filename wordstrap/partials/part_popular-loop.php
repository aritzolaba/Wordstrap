<?php
/**
 * The popular-loop template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// wp_query args
$args = array(
    'post_type' => 'post',
    'orderby' => 'comment_count',
    'order' => 'DESC',
    'posts_per_page' => 4
);
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