<?php
/**
 * The Header for our theme.
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
        global $wordstrap_theme_options, $page, $paged;

        // Add wp_title ()
        wp_title( '|', true, 'right' );

        // Add a page number if necessary:
        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'wordstrap'), max($paged, $page));
        ?></title>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php
        // Load theme scripts
        ws_load_theme_scripts(); ?>
        
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <?php // Google Analytics
    if ($wordstrap_theme_options['google_analytics'] != '') : ?>
        <?php echo str_replace('\\','',$wordstrap_theme_options['google_analytics']); ?>
    <?php endif; ?>

    <div id="ws-main">

        <header id="branding" role="banner">

            <?php if ($wordstrap_theme_options['hide_wsheader'] == 0) : ?>
                <?php get_template_part('partials/part_header'); ?>
            <?php endif; ?>

            <?php if ($wordstrap_theme_options['hide_wsnavbar'] == 0) : ?>
                <?php get_template_part('partials/part_navbar'); ?>
            <?php endif; ?>

        </header>

        <div id="ws-wrapper" class="container-fluid">