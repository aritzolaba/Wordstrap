<?php
/**
 * The article content template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

global $wordstrap_theme_options;

// Single Post and Pages
if (!is_search() && !is_author()) : ?>

    <div class="entry-content clearfix <?php if (is_page()) echo 'ws-ispage'; ?> <?php if ((is_single() OR is_page()) && function_exists('get_post_format') && get_post_format(get_the_ID()) == 'gallery') echo 'ws-gallery'; ?>">

        <?php
        // Display content or excerpt
        if (is_single() OR is_page()) the_content();
        else the_excerpt();

        // Linked pages
        wp_link_pages(array(
            'next_or_number'    => 'number',
            'nextpagelink'      => __('Next page', 'wordstrap'),
            'previouspagelink'  => __('Previous page', 'wordstrap'),
            'pagelink'          => '%',
            'link_before'       => '<span class="btn">',
            'link_after'        => '</span>',
            'before'            => '<div class="clearfix"></div><br />'. __('Pages:','wordstrap') .' <div class="ws-pages btn-toolbar">',
            'after'             => '</div>'
        ));
        ?>

    </div><!-- .entry-content -->

<?php endif; ?>