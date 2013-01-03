<?php
/**
 * The tabs template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
global $wordstrap_theme_options;
?>
<ul id="ws-home-tabs-ul" class="nav nav-tabs">

    <?php
    if ($wordstrap_theme_options['tabs_first'] == 'latest')
        $linktext = '<i class="icon-calendar ws-tab-icon"></i>'. __('Latest posts', 'wordstrap');
    elseif ($wordstrap_theme_options['tabs_first'] == 'popular')
        $linktext = '<i class="icon-fire ws-tab-icon"></i>'. __('Popular posts', 'wordstrap');
    elseif ($wordstrap_theme_options['tabs_first'] == 'categorized') {
        $tabs_category = ucfirst($wordstrap_theme_options['tabs_first_cat']);
        $linktext = '<i class="icon-tag ws-tab-icon"></i>'. $tabs_category;
    }
    ?>
    <li class="active"><a href="#1" data-toggle="tab"><span class="ws-tab-trigger"><?php echo $linktext; ?></span></a></li>

    <?php
    if ($wordstrap_theme_options['tabs_second'] != '') {
        if ($wordstrap_theme_options['tabs_second'] == 'latest')
            $linktext = '<i class="icon-calendar ws-tab-icon"></i>'. __('Latest posts', 'wordstrap');
        elseif ($wordstrap_theme_options['tabs_second'] == 'popular')
            $linktext = '<i class="icon-fire ws-tab-icon"></i>'. __('Popular posts', 'wordstrap');
        elseif ($wordstrap_theme_options['tabs_second'] == 'categorized') {
            $tabs_category = ucfirst($wordstrap_theme_options['tabs_second_cat']);
            $linktext = '<i class="icon-tag ws-tab-icon"></i>'. $tabs_category;
        }
        ?>
        <li><a href="#2" data-toggle="tab"><span class="ws-tab-trigger"><?php echo $linktext; ?></span></a></li>
    <?php } ?>

    <?php
    if ($wordstrap_theme_options['tabs_third'] != '') {
        if ($wordstrap_theme_options['tabs_third'] == 'latest')
            $linktext = '<i class="icon-calendar ws-tab-icon"></i>'. __('Latest posts', 'wordstrap');
        elseif ($wordstrap_theme_options['tabs_third'] == 'popular')
            $linktext = '<i class="icon-fire ws-tab-icon"></i>'. __('Popular posts', 'wordstrap');
        elseif ($wordstrap_theme_options['tabs_third'] == 'categorized') {
            $tabs_category = ucfirst($wordstrap_theme_options['tabs_third_cat']);
            $linktext = '<i class="icon-tag ws-tab-icon"></i>'. $tabs_category;
        }
        ?>
        <li><a href="#3" data-toggle="tab"><span class="ws-tab-trigger"><?php echo $linktext; ?></span></a></li>
    <?php } ?>

    <?php
    if ($wordstrap_theme_options['tabs_fourth'] != '') {
        if ($wordstrap_theme_options['tabs_fourth'] == 'latest')
            $linktext = '<i class="icon-calendar ws-tab-icon"></i>'. __('Latest posts', 'wordstrap');
        elseif ($wordstrap_theme_options['tabs_fourth'] == 'popular')
            $linktext = '<i class="icon-fire ws-tab-icon"></i>'. __('Popular posts', 'wordstrap');
        elseif ($wordstrap_theme_options['tabs_fourth'] == 'categorized') {
            $tabs_category = ucfirst($wordstrap_theme_options['tabs_fourth_cat']);
            $linktext = '<i class="icon-tag ws-tab-icon"></i>'. $tabs_category;
        }
        ?>
        <li><a href="#4" data-toggle="tab"><span class="ws-tab-trigger"><?php echo $linktext; ?></span></a></li>
    <?php } ?>

</ul>

<div id="ws-home-tabs" class="tab-content">

    <div class="tab-pane fade in active" id="1">
        <?php
        if ($wordstrap_theme_options['tabs_first'] == 'latest')
            get_template_part('partials/part_loop_latest');
        elseif ($wordstrap_theme_options['tabs_first'] == 'popular')
            get_template_part('partials/part_loop_popular');
        elseif ($wordstrap_theme_options['tabs_first'] == 'categorized') {
                $wordstrap_theme_options['tabs_category'] = $wordstrap_theme_options['tabs_first_cat'];
                get_template_part('partials/part_loop_categorized');
            }
        ?>
    </div>

    <?php if ($wordstrap_theme_options['tabs_second'] != '') : ?>
        <div class="tab-pane fade" id="2">
            <?php
            if ($wordstrap_theme_options['tabs_second'] == 'latest')
                get_template_part('partials/part_loop_latest');
            elseif ($wordstrap_theme_options['tabs_second'] == 'popular')
                get_template_part('partials/part_loop_popular');
            elseif ($wordstrap_theme_options['tabs_second'] == 'categorized') {
                $wordstrap_theme_options['tabs_category'] = $wordstrap_theme_options['tabs_second_cat'];
                get_template_part('partials/part_loop_categorized');
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if ($wordstrap_theme_options['tabs_third'] != '') : ?>
        <div class="tab-pane fade" id="3">
            <?php
            if ($wordstrap_theme_options['tabs_third'] == 'latest')
                get_template_part('partials/part_loop_latest');
            elseif ($wordstrap_theme_options['tabs_third'] == 'popular')
                get_template_part('partials/part_loop_popular');
            elseif ($wordstrap_theme_options['tabs_third'] == 'categorized') {
                $wordstrap_theme_options['tabs_category'] = $wordstrap_theme_options['tabs_third_cat'];
                get_template_part('partials/part_loop_categorized');
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if ($wordstrap_theme_options['tabs_fourth'] != '') : ?>
        <div class="tab-pane fade" id="4">
            <?php
            if ($wordstrap_theme_options['tabs_fourth'] == 'latest')
                get_template_part('partials/part_loop_latest');
            elseif ($wordstrap_theme_options['tabs_fourth'] == 'popular')
                get_template_part('partials/part_loop_popular');
            elseif ($wordstrap_theme_options['tabs_fourth'] == 'categorized') {
                $wordstrap_theme_options['tabs_category'] = $wordstrap_theme_options['tabs_fourth_cat'];
                get_template_part('partials/part_loop_categorized');
            }
            ?>
        </div>
    <?php endif; ?>

</div>