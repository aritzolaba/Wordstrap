<?php
/**
 * The navigation template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');

// Navigation Options
$home_slug = 'Home';
$add_args='';
$excludelist = unserialize($wordstrap_theme_options['nav_excludelist']);
if (!empty($excludelist)) :
    // Additional args for page exclude
    $add_args = '&exclude=' . implode(',', $excludelist);
endif;
$navigation = get_pages('parent=0&title_li=&depth=1' . $add_args);

if (isset($_GET['action'])) $action = wp_kses($_GET['action'], NULL);
else $action='';
?>

<div class="navbar<?php if ($wordstrap_theme_options['nav_fixed'] == 1) echo ' navbar-fixed-top'; ?>" <?php if ($wordstrap_theme_options['hide_wsheader'] != 1 && $wordstrap_theme_options['nav_fixed'] == 1) echo 'style="top: 52px; position: fixed;"'; ?>>
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".first-nav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <?php if ($wordstrap_theme_options['show_wslogo_nav'] == 1) : ?>
                <a href="<?php echo get_site_url(); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/imgs/ws-logo.png" class="pull-left ws-logo">
                </a>
            <?php endif; ?>
            <?php if ($wordstrap_theme_options['show_wstitle_nav'] == 1) : ?>
                <a class="brand" href="<?php echo get_site_url(); ?>"><?php echo bloginfo('site_name'); ?></a>
            <?php endif; ?>

                <?php if ($wordstrap_theme_options['use_wpnavmenu'] == 1) : ?>

                    <?php
                    // Wordpress wp_nav_menu
                    $args = array (
                        'theme_location' => 'primary',
                        'container_class' => 'nav-collapse first-nav',
                        'container' => false,
                        'items_wrap' => '<div class="nav-collapse first-nav"><ul class="nav"><li class="divider-vertical"></li><li><a href="'. get_site_url() .'"><i class="icon-home icon-white"></i> Home</a></li>%3$s</ul>'
                    );
                    wp_nav_menu($args);
                    ?>

                <?php else : ?>

                    <div class="nav-collapse first-nav">
                        <ul class="nav">
                            <li class="divider-vertical"></li>
                            <li <?php if (is_home()) echo 'class="active"'; ?>>
                                <a href="<?php echo get_site_url(); ?>" title="<?php _e('Home', 'wordstrap'); ?>"><i class="icon-home icon-white rightspace-icon"></i><?php echo $home_slug; ?></a>
                            </li>

                            <?php foreach ($navigation as $nav) : ?>
                                <?php
                                $addclass = '';
                                $navigation_child = get_pages(array('child_of' => $nav->ID, 'post_status' => 'publish'));
                                if (is_page($nav->post_name)) $addclass = 'active';

                                if (sizeof($navigation_child)>0) { ?>
                                    <li class="<?php echo $addclass; ?> dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $nav->guid; ?>"><?php echo ucfirst($nav->post_title); ?> <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <?php if (is_page($nav->post_name)) $addclass = 'active'; ?>
                                            <li class="<?php echo $addclass; ?>"><a href="<?php echo $nav->guid; ?>"><?php echo $nav->post_title; ?></a></li>
                                            <?php foreach ($navigation_child as $child) :
                                                $addclass = '';
                                                if (is_page($child->post_name)) { $addclass = 'active'; }
                                                ?>
                                                <li class="<?php echo $addclass; ?>"><a href="<?php echo $child->guid; ?>"><?php echo $child->post_title; ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php } else { ?>
                                    <li class="<?php echo $addclass; ?>"><a href="<?php echo $nav->guid; ?>"><?php echo ucfirst($nav->post_title); ?></a></li>
                                <?php } ?>

                            <?php endforeach; ?>

                        </ul>

                <?php endif; ?>

            </div><!--/.nav-collapse .first-nav -->
        </div>
    </div>
</div>