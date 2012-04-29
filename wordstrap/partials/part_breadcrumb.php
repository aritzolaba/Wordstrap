<?php
/**
 * The breadcrumb template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.5
 */
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo get_site_url(); ?>"><i class="icon-home rightspace-icon"></i><?php _e('Home', 'wordstrap'); ?></a>
            </li>
            <li class="separator">/</li>
            <?php if (is_single() OR is_page()) : ?>

                <?php if ($section) : ?>
                    <li>
                        <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                    </li>
                    <li class="separator">/</li>
                    <li>
                        <?php echo ucwords($section); ?>
                    </li>
                <?php else : ?>
                    <li>
                        <?php echo get_the_title(); ?>
                    </li>
                <?php endif; ?>

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
                    <?php _e('Posts in category:', 'wordstrap'); ?> <?php $category = get_the_category(); echo $category[0]->name; ?>
                </li>
            <?php elseif (is_archive()) : ?>
                <li>
                    <?php _e('Browsing archived posts', 'wordstrap'); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>