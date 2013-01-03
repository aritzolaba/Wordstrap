<?php
/**
 * The author template file.
 */

get_header();

// Get theme options
global $wordstrap_theme_options;
?>
<div class="row-fluid">
    <div class="span12">
        <div class="well">

            <div class="row-fluid">
                <div class="span4">
                    <?php
                    if ($wordstrap_theme_options['hide_wsbreadcrumb'] != 1) :
                        get_template_part('partials/part_breadcrumb');
                    endif;
                    ?>

                    <div class="ws-author author-container alert alert-info ws-alert">
                        <?php
                        // Get author from wp_query
                        global $wp_query;
                        $curauth = $wp_query->get_queried_object();
                        $author = $curauth->data;

                        // Get authordata
                        $author_registered = strtotime($author->user_registered);
                        $author_name = trim(get_the_author_meta('first_name', $author->ID) . ' ' . get_the_author_meta('last_name', $author->ID));
                        $author_bio = get_the_author_meta('description', $author->ID);
                        $author_url = $author->user_url;
                        ?>

                        <div class="ws-author-avatar">
                            <?php echo get_avatar($author->ID, 54); ?>
                        </div>

                        <div class="ws-user-details">
                            <?php
                            if (empty($author_name))
                                $author_name = $author->display_name;
                            ?>

                            <h1 style="padding-bottom: 0px;"><small><?php echo $author_name; ?></small></h1>
                            <p>
                                <?php echo sprintf (__('registered %s ago','wordstrap'), human_time_diff($author_registered)); ?>
                            </p>
                            <?php if (!empty($author_url)) : ?>
                                <p>
                                    <i class="icon-share"></i> <a href="<?php echo $author_url; ?>" target="_blank"><?php echo $author_url; ?></a>
                                </p>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($author_bio)) : ?>
                            <div class="ws-user-bio">
                                <h2><small>&quot;<?php echo $author_bio; ?>&quot;</small></h2>
                            </div>
                        <?php endif; ?>

                    </div><!-- .author-container -->
                </div><!-- .span4 -->

                <div class="span8">

                    <h3><?php echo sprintf ( __('Posts published by %s','wordstrap'), $author_name); ?></h3>
                    <br />
                    <?php rewind_posts(); ?>
                    <?php if (have_posts()) : the_post(); ?>
                        <?php get_template_part('partials/part_loop_default'); ?>
                    <?php else: ?>
                        <div class="alert alert-message">
                            <?php _e('Sorry, but there are no posts by this author.','wordstrap'); ?>
                        </div>
                    <?php endif; ?>

                </div><!-- .span8 -->
            </div><!-- .row -->
        </div>
    </div><!-- .span12 -->
</div><!-- .row -->

<?php get_footer(); ?>