<?php
/**
 * The navigation template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
$nav_top = intval($wordstrap_theme_options['header_height'])+20;
?>

<div id="ws-navbar" class="navbar<?php if ($wordstrap_theme_options['nav_fixed'] == 1) echo ' navbar-fixed-top'; ?>" <?php if ($wordstrap_theme_options['hide_wsheader'] != 1 && $wordstrap_theme_options['nav_fixed'] == 1) echo 'style="top: '.$nav_top.'px; position: fixed;"'; ?>>
    <div class="navbar-inner">
        <div class="container-fluid" style="display: none; <?php if ($wordstrap_theme_options['nav_fixed'] != 1) echo 'padding: 0em;'; ?>">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".first-nav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <?php if ($wordstrap_theme_options['show_wstitle_nav'] == 1) : ?>
                <a class="brand" href="<?php echo get_site_url(); ?>"><?php echo bloginfo('site_name'); ?></a>
                <ul class="pull-left nav-collapse first-nav nav ws-nav collapse" style="margin-right: 0px;">
                    <li class="divider-vertical"></li>
                </ul>
            <?php endif; ?>

            <?php
            // Wordpress wp_nav_menu
            $add_items_wrap = '';
            if ($wordstrap_theme_options['show_home_nav'] == 1) :
                $add_items_wrap = '<li><a href="'. get_site_url() .'"><i class="icon-home icon-white"></i> '. __('Home', 'wordstrap') .'</a></li>';
            endif;

            $args = array (
                'theme_location' => 'primary',
                'container_class' => 'nav-collapse first-nav',
                'container' => false,
                'items_wrap' => '<div class="nav-collapse first-nav"><ul class="nav ws-nav">'.$add_items_wrap.'%3$s</ul>',
                'fallback_cb' => function () {
                    $link = '<b>custom menu</b> !';
                    echo '<div class="nav-collapse first-nav"><ul class="nav ws-nav"><li><a href="'. get_site_url() .'"><i class="icon-home icon-white"></i> Home</a></li><li class="divider-vertical"></li></ul>';
                    echo '<div style="float: left; margin-top: 10px; color: #666; font-style: italic;">';
                    echo sprintf ( __('You should customize a %s', 'wordstrap'), $link);
                    echo '</div>';
                }
            );
            wp_nav_menu($args);
            ?>
        </div>

        <?php if ($wordstrap_theme_options['show_wssearch_nav'] == 1) : ?>

            <ul class="pull-left nav-collapse first-nav nav ws-nav collapse" style="margin-right: 0px;">
                <li class="divider-vertical"></li>
            </ul>
            <div class="nav-collapse first-nav pull-left">
                <?php get_template_part('searchform'); ?>
            </div>

        <?php endif; ?>
        </div>
    </div>
</div>