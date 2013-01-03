<?php
/**
 * The article header template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
?>
<header class="entry-header">

    <?php
    // Article calendar
    if (!is_page() && !is_search()) : ?>
        <div class="calendar event_date">
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
            <?php
            // Author name
            if (!is_author() AND !is_page()) :

                // Get author first_name and last_name. If empty, get the nickname
                $author_name = ws_get_authorfullname();
                ?>

                <i class="icon-user" <?php echo 'title="'. __('Author','wordstrap') .'"'; ?>></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo $author_name; ?></a>

            <?php endif; ?>

            <?php
            // Post categories
            $cats = get_the_category_list( ', ' );
            if ($cats) echo '<i title="'. __('Categories','wordstrap') .'" class="icon-bookmark"></i>'.$cats;
            ?>

            <?php // Comment number
            if (!is_single() AND !is_page()) : ?>
                <?php if (comments_open()) : ?>
                    <?php $ncom=get_comments_number(); if ($ncom==0) $ncom= __('no', 'wordstrap'); ?>
                    <br /><i class="icon-comment"></i><a href="<?php the_permalink(); ?>"><?php echo sprintf(__('%s comments', 'wordstrap'), $ncom); ?></a>
                <?php endif; ?>
            <?php endif; ?>

        </small>
    </h2>

    <?php
    // Post tags
    if (is_single() && get_the_tag_list()) :
        echo '<div class="ws-tag-container">';
        echo '<i title="'. __('Tags','wordstrap') .'" class="icon-tag" style="font-size: 1.3em;"></i>';
        the_tags();
        echo '</div>';
    endif;
    ?>

</header><!-- .entry-header -->