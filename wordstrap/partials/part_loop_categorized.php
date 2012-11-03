<?php
/**
 * The categorized-loop template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

global $wordstrap_theme_options;

// wp_query args
$args = array(
    'post_type' => 'post',
    'taxonomy' => 'category',
    'term' => $wordstrap_theme_options['tabs_category'],
    'orderby' => 'post_date',
    'order' => 'DESC',
    'posts_per_page' => 4
);
$categorized = new WP_Query( $args );
?>

<?php if ($categorized->have_posts()) : ?>

    <?php while ($categorized->have_posts()) : $categorized->the_post(); ?>

        <div class="row-fluid">
            <div class="span12">

                <?php get_template_part( 'partials/part_article' ); ?>

            </div>
        </div>

    <?php endwhile; ?>

<?php else : ?>

    <?php ws_nothing_found(); ?>

<?php endif; ?>