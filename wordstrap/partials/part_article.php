<?php
/**
 * The article template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get theme options
global $wordstrap_theme_options;
?>
<article class="ws-article <?php if (is_page()) echo 'ws-page'; ?> <?php if (is_search() OR is_author() OR is_category() OR is_archive()) echo 'ws-loop'; ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    // Article featured Image
    if ( (!is_search() && !is_author() && has_post_thumbnail()) && function_exists('get_post_format') && get_post_format(get_the_ID()) != 'gallery') : ?>

        <?php
        // Get attached file guid
        $att = get_post_meta(get_the_ID(),'_thumbnail_id',true);
        $thumb = get_post($att);
        if ($att) { $att = $thumb->guid; }
        else $att = $post->guid;
        ?>
        <div class="entry-thumbnail">
            <a class="thickbox" href="<?php echo $att; ?>">
            <?php
            echo get_the_post_thumbnail(get_the_ID(), 'loop-thumb');
            ?>
            </a>
        </div>

    <?php endif; ?>

    <?php get_template_part('partials/part_article_header'); ?>

    <?php get_template_part('partials/part_article_content'); ?>

    <?php if ($wordstrap_theme_options['article_social'] == 1) :
        echo ws_social_share();
    endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->