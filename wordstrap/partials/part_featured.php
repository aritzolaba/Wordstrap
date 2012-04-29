<?php
/**
 * The featured template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.5
 */
?>

<?php
// Get Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
?>

    <?php
    $args = array(
        'post_type' => 'post',
        'taxonomy' => 'category',
        'term' => $wordstrap_theme_options['featured_cat'],
        'posts_per_page' => $wordstrap_theme_options['featured_num']
    );
    $featured = new WP_Query( $args );
    $i=0; $per_row=3;
    ?>

    <?php if ($featured->have_posts()) : ?>

        <?php while ($featured->have_posts()) : $featured->the_post(); ?>

            <?php $i++; if ($i==1) echo '<div class="row-fluid">'; ?>

            <div class="span4">
                <div class="well ws-featured">

                    <?php if ( has_post_thumbnail() ) : ?>
                        <a class="tip" data-original-title="<?php echo strip_tags(get_the_title()); ?>" href="<?php the_permalink(); ?>" rel="tooltip">
                            <div class="entry-thumbnail">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>
                            </div>
                        </a>
                    <?php else : ?>
                        <div class="entry-thumbnail">
                            <a class="tip" data-original-title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="tooltip">
                                <div class="ws-nothumb">
                                    no thumbnail
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <br />
                    <div style="text-align: right;">
                        <i class="icon-plus-sign"></i> <a href="<?php the_permalink(); ?>"><?php _e('Read article','wordstrap'); ?></a>
                    </div>

                </div>
            </div>

            <?php if ($i%$per_row==0) echo '</div><div class="row-fluid">'; ?>

        <?php endwhile; ?>

    <?php else : ?>

        <?php ws_nothing_found(); ?>

    <?php endif; ?>

</div><!-- .row-fluid -->