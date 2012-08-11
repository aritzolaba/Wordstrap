<?php
/**
 * The landing template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Options
global $wordstrap_theme_options;
$wp_page_for_posts = get_option('page_for_posts');

// Intro
if ($wordstrap_theme_options['landing_page_intro'] == 1) : ?>

    <div class="row-fluid">
        <div class="span12">
            <div class="well well-intro">

                <?php
                $args = array(
                    'p'        => $wordstrap_theme_options['landing_page_intro_id'],
                    'post_type'=> 'page',
                    );
                $intro_page = new WP_Query( $args );
                $intro_page->the_post();
                ?>

                <?php if ($wordstrap_theme_options['landing_page_intro_title'] == 1) : ?>
                    <h1><?php the_title(); ?></h1>
                    <br />
                <?php endif; ?>

                <p><?php the_content(); ?></p>

            </div>
        </div>
    </div>

<?php endif; ?>

<?php // Featured
if ($wordstrap_theme_options['landing_page_featured'] == 1) : ?>

    <?php if ($wordstrap_theme_options['landing_page_featured_title'] != '') : ?>
        <h1 class="ws-featured-title"><?php echo $wordstrap_theme_options['landing_page_featured_title']; ?></h1>
    <?php endif; ?>

    <!-- Featured content -->
    <div id="ws-ajax-featured">
        <?php get_template_part('partials/part_featured'); ?>
    </div> <!-- #ws-ajax-featured -->

<?php endif; ?>

<?php // Tabs
if ($wordstrap_theme_options['landing_page_tabs'] == 1) : ?>

    <!-- Tabs content -->
    <div class="row-fluid">
        <div class="span12 ws-home-tabs">

            <?php get_template_part('partials/part_tabs'); ?>

        </div>
    </div>

<?php endif; ?>

<?php // Blog
if ($wordstrap_theme_options['landing_page_blog'] == 1 OR $wp_page_for_posts > 0) : ?>

    <div class="row-fluid" id="ws-blog">
        <div class="span12">
            <div class="well">
                <?php get_template_part('partials/part_loop_default'); ?>
            </div>
        </div>
    </div>

<?php endif; ?>