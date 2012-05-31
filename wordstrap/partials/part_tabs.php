<?php
/**
 * The tabs template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */
?>

<ul id="ws-home-tabs-ul" class="nav nav-tabs">
    <li class="active"><a href="#tab-popular" data-toggle="tab"><i class="icon-fire"></i> <span class="ws-tab-trigger"><?php _e('Popular posts', 'wordstrap'); ?></span></a></li>
    <li><a href="#tab-latest" data-toggle="tab"><i class="icon-calendar"></i> <span class="ws-tab-trigger"><?php _e('Latest posts', 'wordstrap'); ?></span></a></li>
</ul>

<div id="ws-home-tabs" class="tab-content">
    <div class="tab-pane fade in active" id="tab-popular">
        <?php get_template_part('partials/part_popular-loop'); ?>
    </div>
    <div class="tab-pane fade" id="tab-latest">
        <?php get_template_part('partials/part_latest-loop'); ?>
    </div>
</div>