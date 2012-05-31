<?php
/**
 * The article template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */
?>

<?php
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

    <?php if ( !is_search() && !is_author() && has_post_thumbnail() ) : ?>
            <div class="entry-thumbnail">
                <a class="thickbox" href="<?php echo $att; ?>">
                <?php
                echo get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                ?>
                </a>
            </div>
        <?php endif; ?>

    <header class="entry-header">

        <?php if (!is_page() && !is_search()) : ?>
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
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php endif; ?>
        </h1>

        <h2 class="entry-details">
            <small>

                <?php if (!is_author() AND !is_page()) : ?>

                    <?php _e('by', 'wordstrap'); ?>

                    <?php
                    // Get author first_name and last_name. If empty, get the nickname
                    $author_id = get_the_author_meta('ID');
                    $author_name = trim(get_the_author_meta('first_name', $author_id) . ' ' . get_the_author_meta('last_name', $author_id));
                    if (empty($author_name))
                        $author_name = get_the_author_meta('nickname', $author_id);
                    ?>

                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo $author_name; ?></a>

                <?php endif; ?>

                <?php
                // Post categories
                $cats = get_the_category_list( ', ' );
                if ($cats) echo ' '.sprintf (__('in %s','wordstrap'), $cats);
                ?>

                <?php
                // Comment number ?>
                <?php if (!is_single() AND !is_page()) : ?>
                    <?php $ncom=get_comments_number(); if ($ncom==0) $ncom= __('no', 'wordstrap'); ?>
                    <i class="icon-comment" style="margin-top: 2px;"></i> <a href="<?php the_permalink(); ?>"><?php echo sprintf(__('%s comments', 'wordstrap'), $ncom); ?></a>
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

        <div class="entry-content <?php if (is_page()) echo 'ws-ispage'; ?>">

            <?php
            if (is_single() OR is_page()) the_content();
            else the_excerpt();
            ?>

            <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'wordstrap') . '</span>', 'after' => '</div>')); ?>

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