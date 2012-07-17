<?php
/**
 * The article template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6.4
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Theme Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');

// Enqueue Wordpress Thickbox
wp_enqueue_script('thickbox');
wp_enqueue_style('thickbox');

// Get attached file guid
$att = get_post_meta(get_the_ID(),'_thumbnail_id',true);
$thumb = get_post($att);
if ($att) { $att = $thumb->guid; }
else $att = $post->guid;
?>

<article class="ws-article <?php if (is_page()) echo 'ws-page'; ?> <?php if (is_search() OR is_author() OR is_category() OR is_archive()) echo 'ws-loop'; ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    // Article featured Image
    if ( !is_search() && !is_author() && has_post_thumbnail() ) : ?>
            <div class="entry-thumbnail">
                <a class="thickbox" href="<?php echo $att; ?>">
                <?php
                echo get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                ?>
                </a>
            </div>
        <?php endif; ?>

    <header class="entry-header">

        <?php
        // Article calendar
        if (!is_page() && !is_search()) : ?>
            <div class="calendar event_date <?php if (!is_single() && !is_page() && !is_home()) echo 'calendar-small'; ?>">
                <span class="month"><?php echo strtoupper(get_the_date('M')); ?></span>
                <span class="day"><?php echo get_the_date('d'); ?></span>
                <span class="year"><?php echo get_the_date('Y'); ?></span>
            </div>
        <?php endif; ?>

        <h1 class="entry-title">
            <?php if (is_single() OR is_page()) : ?>
                <?php the_title(); ?>
            <?php else : ?>
                <a href="<?php the_permalink(); ?>" title="<?php if (get_the_title()) the_title(); else echo __('Untitled','wordstrap'); ?>"><?php if (get_the_title()) echo get_the_title(); else echo __('Untitled','wordstrap'); ?></a>
            <?php endif; ?>
        </h1>

        <h2 class="entry-details">
            <small>

                <?php if (!is_author() AND !is_page()) :

                    _e('by', 'wordstrap');

                    // Get author first_name and last_name. If empty, get the nickname
                    $author_name = ws_get_authorfullname();
                    ?>

                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo $author_name; ?></a>

                <?php endif; ?>

                <?php
                // Post categories
                $cats = get_the_category_list( ', ' );
                if ($cats) echo ' '.sprintf (__('in %s','wordstrap'), $cats);
                ?>

                <?php // Comment number
                if (!is_single() AND !is_page()) : ?>
                    <?php if (comments_open()) : ?>
                        <?php $ncom=get_comments_number(); if ($ncom==0) $ncom= __('no', 'wordstrap'); ?>
                        <br /><i class="icon-awesome-comment" style="margin-top: 2px;"></i> <a href="<?php the_permalink(); ?>"><?php echo sprintf(__('%s comments', 'wordstrap'), $ncom); ?></a>
                    <?php endif; ?>
                <?php endif; ?>

            </small>
        </h2>

        <?php
        // Post tags
        if (is_single() && get_the_tag_list()) :
            echo '<div class="ws-tag-container">';
            echo '<i class="icon-tag"></i> ';
            the_tags();
            echo '</div>';
        endif;
        ?>

    </header><!-- .entry-header -->

    <?php if (!is_search() && !is_author()) : ?>

        <div class="entry-content clearfix <?php if (is_page()) echo 'ws-ispage'; ?>">

            <?php
            // Display content or excerpt
            if (is_single() OR is_page()) the_content();
            else the_excerpt();

            // Linked pages
            wp_link_pages(array(
                'next_or_number'	=> 'number',
		'nextpagelink'		=> __('Next page', 'wordstrap'),
		'previouspagelink'	=> __('Previous page', 'wordstrap'),
                'pagelink'  => '%',
                'link_before' => '<span class="btn">',
                'link_after' => '</span>',
                'before' => '<div class="clearfix"></div><br />'. __('Pages:','wordstrap') .' <div class="ws-pages btn-toolbar">',
                'after' => '</div>'
                ));
            ?>

        </div><!-- .entry-content -->

    <?php endif; ?>

    <?php if (is_single() && $wordstrap_theme_options['article_social'] == 1) : ?>

        <footer class="entry-meta">
            <div class="pull-left">
                <?php get_template_part('partials/part_article-social-buttons'); ?>
            </div>
        </footer><!-- .entry-meta -->

    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->