<?php
/**
 * The navigation template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.5
 */
?>

<?php
// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>

<?php
// Navigation Options
$home_slug = 'Home';
$add_args='';
$excludelist = unserialize($wordstrap_theme_options['nav_excludelist']);
if (!empty($excludelist)) :
    // Additional args for page exclude
    $add_args = '&exclude=' . implode(',', $excludelist);
endif;
$navigation = get_pages('parent=0&title_li=&depth=1' . $add_args);
?>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".first-nav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <?php if ($wordstrap_theme_options['show_wslogo'] == 1) : ?>
                <a href="<?php echo get_site_url(); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/imgs/ws-logo.png" class="pull-left ws-logo">
                </a>
            <?php endif; ?>
            <?php if ($wordstrap_theme_options['show_wstitle'] == 1) : ?>
                <a class="brand" href="<?php echo get_site_url(); ?>"><?php echo bloginfo('site_name'); ?></a>
            <?php endif; ?>
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

                <?php if (current_user_can('manage_options')) : ?>

                    <ul class="nav pull-right">
                        <li class="divider-vertical"></li>
                        <li>
                            <a target="_blank" href="<?php echo get_site_url(); ?>/wp-admin" title="<?php _e('Wordpress Dashboard', 'wordstrap'); ?>">
                                <i class="icon-cog icon-white rightspace-icon"></i><?php _e('Dashboard', 'wordstrap'); ?>
                            </a>
                        </li>
                        <li class="divider-vertical"></li>
                    </ul>

                <?php endif; ?>

                <?php
                // NAV Login Form ?>
                <?php if ($wordstrap_theme_options['auth_system'] == 1 && $wordstrap_theme_options['auth_system_display'] == 'nav') : ?>

                    <ul class="nav pull-right ws-nav-login">
                        <li class="divider-vertical"></li>
                        <li class="dropdown <?php $action = wp_kses($_GET['action'], NULL); if (defined('login_message') OR defined('login_success') OR $action == 'rp' OR $action == 'register') echo 'open'; ?>">
                            <?php if (!is_user_logged_in()) : ?>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login <b class="caret"></b></a>
                            <?php else : ?>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><div class="pull-left rightspace-small ws-avatar-nav"><?php echo get_avatar(get_current_user_id(), 24); ?></div> <?php $userdata = get_userdata(get_current_user_id()); echo $userdata->display_name; ?> <b class="caret"></b></a>
                            <?php endif; ?>
                            <div class="span3 dropdown-menu">
                                <?php get_template_part('partials/part_auth'); ?>
                            </div>
                        </li>
                    </ul>

                <?php endif; ?>

            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>