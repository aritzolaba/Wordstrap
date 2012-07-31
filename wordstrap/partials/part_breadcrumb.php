<?php
/**
 * The breadcrumb template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
?>
<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo get_site_url(); ?>"><i class="icon-home" style="margin-right: 4px;"></i><?php _e('Home', 'wordstrap'); ?></a>
            </li>
            <li class="separator">/</li>
            <?php if (is_single() OR is_page()) : ?>
                <li>
                    <?php echo ws_title_excerpt(strip_tags(get_the_title())); ?>
                </li>
            <?php elseif (is_author()) : ?>
                <li>
                    <?php _e('About the author', 'wordstrap'); ?>
                </li>
            <?php elseif (is_search()) : ?>
                <li>
                    <?php _e('Search results', 'wordstrap'); ?>
                </li>
            <?php elseif (is_category()) : ?>
                <li>
                    <?php _e('Posts in category:', 'wordstrap'); ?> <?php $category = get_queried_object(); echo $category->name; ?>
                </li>
            <?php elseif (is_tag()) : ?>
                <li>
                    <?php _e('Browsing posts tagged:', 'wordstrap'); ?> <?php $tag = get_queried_object(); echo $tag->name; ?>
                </li>
            <?php elseif (is_archive()) : ?>
                <li>
                    <?php _e('Browsing archived posts:', 'wordstrap'); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>