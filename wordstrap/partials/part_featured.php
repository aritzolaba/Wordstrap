<?php
/**
 * The featured template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6.4
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>

<?php
// Init of the pagination vars
if (isset($_POST['page']) && $_POST['page']!=0) $page = wp_kses($_POST['page'], NULL);
else $page=1;
$prev_class = '';
$prev_attr = '';
$next_class = '';
$next_attr = '';
?>

<?php
$args = array(
    'paged' => $page,
    'post_type' => 'post',
    'taxonomy' => 'category',
    'term' => $wordstrap_theme_options['featured_cat'],
    'posts_per_page' => $wordstrap_theme_options['featured_num']
);
$featured = new WP_Query($args);
?>

<?php
$maxpages = $featured->max_num_pages;
$i=0; $per_row=3;
$next=$page+1;
if ($page>=2) $prev=$page-1;
else $prev=1;

if ($page == 1) {
    $prev_class = ' disabled';
    $prev_attr = ' disabled="disabled"';
}
if ($page == $maxpages) {
    $next_class = ' disabled';
    $next_attr = ' disabled="disabled"';
}
?>

<div class="ws-featured">

<?php if ($featured->have_posts()) : ?>

    <?php while ($featured->have_posts()) : $featured->the_post(); ?>

        <?php $i++; if ($i==1) echo '<div class="row-fluid">'; ?>

        <div class="span4">
            <div class="well ws-featured">

                <a class="tip" rel="tooltip" title="<?php echo get_the_title(); ?>" href="<?php the_permalink(); ?>">
                    <div class="entry-thumbnail">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>
                    </div>
                </a>

                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php echo ws_title_excerpt(strip_tags(get_the_title())); ?></a>
                </h4>
                <br />
                <div style="text-align: right;">
                    <i class="icon-plus-sign"></i> <a href="<?php the_permalink(); ?>"><?php _e('Read article','wordstrap'); ?></a>
                </div>

            </div>
        </div>

        <?php if ($i%$per_row==0) echo '</div><div class="row-fluid">'; ?>

    <?php endwhile; ?>

    <?php $i++; if ($i==1) echo '</div>'; ?>

<?php else : ?>

    <?php ws_nothing_found(); ?>

<?php endif; ?>

    <input type="hidden" name="found_posts" id="max_pages" value="<?php echo $maxpages; ?>">

</div>

<?php if ($maxpages>1) : ?>
    <p>
        <button id="ws-featured-prev" class="btn<?php echo $prev_class; ?>" <?php echo $prev_attr; ?> value="<?php echo $prev; ?>">PREV</button>
        <button id="ws-featured-next" class="btn<?php echo $next_class; ?>" <?php echo $next_attr; ?> value="<?php echo $next; ?>">NEXT</button>
    </p>
<?php endif; ?>

</div><br />