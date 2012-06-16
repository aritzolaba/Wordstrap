<?php
/**
 * The tabs template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
?>
<ul id="ws-home-tabs-ul" class="nav nav-tabs">
    <li class="active"><a href="#tab-popular" data-toggle="tab"><span class="ws-tab-trigger"><i class="icon-awesome-fire ws-tab-icon"></i> <?php _e('Popular posts', 'wordstrap'); ?></span></a></li>
    <li><a href="#tab-latest" data-toggle="tab"><span class="ws-tab-trigger"><i class="icon-awesome-calendar ws-tab-icon"></i> <?php _e('Latest posts', 'wordstrap'); ?></span></a></li>
</ul>

<div id="ws-home-tabs" class="tab-content">
    <div class="tab-pane fade in active" id="tab-popular">
        <?php get_template_part('partials/part_popular-loop'); ?>
    </div>
    <div class="tab-pane fade" id="tab-latest">
        <?php get_template_part('partials/part_latest-loop'); ?>
    </div>
</div>