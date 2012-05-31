<?php
/**
 * The landing template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */
?>

<?php
// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>

<div class="row-fluid">

    <?php get_sidebar('left'); ?>

    <!-- Main Content -->
    <div class="<?php echo WS_SPANCOL_CENTER; ?>">

        <?php // Intro ?>

        <?php if ($wordstrap_theme_options['landing_page_intro'] == 1) : ?>

            <div class="row-fluid">
                <div class="span12">
                    <div class="well well-intro">

                        <?php
                        $args = array(
                            'p'        => $wordstrap_theme_options['landing_page_intro_id'],
                            'post_type'=> 'page'
                            );
                        // Override $wp_query with custom queries
                        $wp_query = new WP_Query( $args );
                        the_post();
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

        <?php // Slideshow ?>
        <?php if ($wordstrap_theme_options['landing_page_slideshow'] == 1) : ?>

            <div class="row-fluid">
                <div class="span12">
                    <div class="well well-slide">
                        <?php get_template_part('partials/part_slideshow'); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php // Featured ?>
        <?php if ($wordstrap_theme_options['landing_page_featured'] == 1) : ?>

            <!-- Featured content -->
            <div id="ws-ajax-featured">
                <?php get_template_part('partials/part_featured'); ?>
            </div> <!-- #ws-ajax-featured -->

        <?php endif; ?>

        <?php // Tabs ?>
        <?php if ($wordstrap_theme_options['landing_page_tabs'] == 1) : ?>

            <!-- Tabs content -->
            <div class="row-fluid">
                <div class="span12 ws-home-tabs">

                    <?php get_template_part('partials/part_tabs'); ?>

                </div>
            </div>

        <?php endif; ?>

        <?php // Blog ?>
        <?php if ($wordstrap_theme_options['landing_page_blog'] == 1) : ?>

            <div class="row-fluid" id="ws-blog">
                <div class="span12">
                    <div class="well">
                        <?php get_template_part('partials/part_article-loop'); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div><!-- .<?php echo WS_SPANCOL_CENTER; ?> -->

    <?php get_sidebar(); ?>

</div><!-- .row-fluid -->