<?php
/**
 * The header template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6.3
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>
<header id="branding" role="banner">
    <div id="ws-header" class="ws-header-container" <?php if ($wordstrap_theme_options['nav_fixed'] == 1) echo 'style="position: fixed;"'; ?>>
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <?php if ( get_header_image() OR get_header_textcolor() != 'blank') : ?>

                        <?php if ( get_header_image() ) : ?>

                            <a class="header_title" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                                <img src="<?php header_image(); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
                            </a>

                        <?php endif; ?>

                        <hgroup>
                            <h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
                            <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </hgroup>

                    <?php else : ?>

                        <h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>