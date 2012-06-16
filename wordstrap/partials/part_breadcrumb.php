<?php
/**
 * The breadcrumb template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
?>
<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo get_site_url(); ?>"><i class="icon-home rightspace-icon"></i><?php _e('Home', 'wordstrap'); ?></a>
            </li>
            <li class="separator">/</li>
            <?php if (is_single() OR is_page()) : ?>
                <li>
                    <?php echo get_the_title(); ?>
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
            <?php elseif (is_archive()) : ?>
                <li>
                    <?php _e('Browsing archived posts', 'wordstrap'); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>