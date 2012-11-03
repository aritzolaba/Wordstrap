<?php
/**
 * The header template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Options
global $wordstrap_theme_options;
?>
<div id="ws-header" class="ws-header-container" style="<?php if ($wordstrap_theme_options['nav_fixed'] == 1) echo 'left: 0px; position: fixed; overflow: hidden;'; else echo 'height: auto;'; ?>">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">

                <?php if ($wordstrap_theme_options['show_wssearch_header'] == 1) : ?>

                    <div class="ws-search-header">
                        <?php get_template_part('searchform'); ?>
                    </div>

                <?php endif; ?>

                <?php if ( get_header_image() OR get_header_textcolor() != 'blank') : ?>

                    <?php if ( get_header_image() ) : ?>

                        <a class="header_title" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                            <img src="<?php header_image(); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
                        </a>

                    <?php endif; ?>

                    <?php if (get_header_textcolor() != 'blank') : ?>

                        <hgroup class="ws-site-title">
                            <h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
                            <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </hgroup>

                    <?php endif; ?>


                <?php else : ?>

                    <h1 id="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                        <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
                    </h1>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>