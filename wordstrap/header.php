<?php
/**
 * The Header for our theme.
 *
 * @package WordStrap
 * @subpackage Main
 * @since Wordstrap 1.6.1
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php $site_description= get_bloginfo('description', 'display'); echo $site_description; ?>">
        <meta name="author" content="<?php echo get_bloginfo('name'); ?>">
        <title><?php
        // Get Options
        $wordstrap_theme_options = get_option('wordstrap_theme_options');

        global $page, $paged;

        wp_title('|', true, 'right');

        // Add the blog name.
        bloginfo('name');

        // Add the blog description for the home/front page.
        if ($site_description && ( is_home() || is_front_page() ))
            echo " | $site_description";

        // Add a page number if necessary:
        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'wordstrap'), max($paged, $page));
        ?></title>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php
        wp_enqueue_script( 'wordstrap', get_template_directory_uri() . '/inc/js/wordstrap.js', array( 'jquery' ) );
        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php /* Use Google API Fonts */ ?>
        <?php if ($wordstrap_theme_options['use_googlefonts'] == 1) : ?>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo $wordstrap_theme_options['google_font']; ?>">
        <?php endif; ?>
        <style type="text/css">
        <?php if ($wordstrap_theme_options['hide_wsnavbar'] == 1 && $wordstrap_theme_options['nav_fixed'] != 1) : ?>
            <?php echo 'div#ws-wrapper{ padding-top: 1em; }'; ?>
        <?php elseif ($wordstrap_theme_options['hide_wsnavbar'] == 1 && $wordstrap_theme_options['hide_wsheader'] != 1 && $wordstrap_theme_options['nav_fixed'] == 1) : ?>
            <?php $nav_top = intval($wordstrap_theme_options['header_height'])+40; echo 'div#ws-wrapper{ padding-top: '.$nav_top.'px; }'; ?>
        <?php elseif ($wordstrap_theme_options['hide_wsnavbar'] != 1 && $wordstrap_theme_options['hide_wsheader'] == 1 && $wordstrap_theme_options['nav_fixed'] == 1) : ?>
            <?php echo 'div#ws-wrapper{ padding-top: 4.45em; }'; ?>
        <?php elseif ($wordstrap_theme_options['hide_wsnavbar'] != 1 && $wordstrap_theme_options['hide_wsheader'] != 1 && $wordstrap_theme_options['nav_fixed'] == 1) : ?>
            <?php $nav_top = intval($wordstrap_theme_options['header_height'])+74; echo 'div#ws-wrapper{ padding-top: '.$nav_top.'px; }'; ?>
        <?php else : ?>
            <?php echo 'div#ws-wrapper{ padding-top: 0em; }'; ?>
        <?php endif; ?>
        </style>

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <?php // Google Analytics
    if ($wordstrap_theme_options['google_analytics'] != '') : ?>
        <?php echo str_replace('\\','',$wordstrap_theme_options['google_analytics']); ?>
    <?php endif; ?>

    <div id="ws-main">

        <?php if ($wordstrap_theme_options['hide_wsheader'] != 1) : ?>
            <?php get_template_part('partials/part_header'); ?>
        <?php endif; ?>

        <?php if ($wordstrap_theme_options['hide_wsnavbar'] != 1) : ?>
            <?php get_template_part('partials/part_navigation'); ?>
        <?php endif; ?>

        <div id="ws-wrapper" class="container">