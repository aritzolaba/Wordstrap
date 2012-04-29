<?php
/**
 * The comments template file.
 *
 * @package WordStrap
 * @subpackage Main Pages
 * @since Wordstrap 1.5
 */
?>

<?php if (have_comments()) : ?>

    <h3 style="margin-bottom: 20px;"><?php echo sprintf ( __('There are %d comments for this post','wordstrap'), get_comments_number()); ?></h3>

    <?php /* Anchor target for comment pagination #comments */ ?>
    <span id="comments" class="ws-anchor"></span>

    <?php $npages = get_comment_pages_count(); ?>

    <?php /* Pager Style 1 Above
      <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
      <nav id="comment-nav-above">
      <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'wordstrap')); ?></div>
      <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'wordstrap')); ?></div>
      </nav>
      <?php endif; ?>
     */ ?>

    <?php /* Pager Style 2 Above */ ?>
    <?php if ($npages>1) : ?>
        <nav id="comment-nav-above">
            <?php paginate_comments_links(); ?>
        </nav>
    <?php endif; ?>

    <?php
    /* See wordstrap_comment() in wordstrap/functions.php for more. */
    wp_list_comments(array('callback' => 'wordstrap_commentlist'));
    ?>

    <?php /* Pager Style 1 Below
    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
        <nav id="comment-nav-below">
            <div class="nav-previous"><?php echo str_replace('<a', '<a class="btn"', get_previous_comments_link(__('&larr; Older Comments', 'wordstrap'))); ?></div>
            <div class="nav-next"><?php echo str_replace('<a', '<a class="btn"', get_next_comments_link(__('Newer Comments &rarr;', 'wordstrap'))); ?></div>
        </nav>
    <?php endif; ?>
    */ ?>

    <?php /* Pager Style 2 Below */ ?>
    <?php if ($npages>1) : ?>
        <nav id="comment-nav-below">
            <?php paginate_comments_links(); ?>
        </nav>
    <?php endif; ?>

<?php elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>

    <p class="alert alert-message ws-alert nocomments"><?php _e('Comments for this post are closed.', 'wordstrap'); ?></p>

<?php elseif (post_type_supports(get_post_type(), 'comments')) : ?>

    <div class="alert alert-message nocomments"><?php _e('There are no comments yet. Don\'t you want to be the first ?', 'wordstrap'); ?></div>

<?php endif; ?>

<div id="respond" class="ws-commentform-container">

    <h3><?php _e('Leave a comment', 'wordstrap'); ?></h3>

    <?php if (is_user_logged_in()) : ?>

        <?php if (comments_open()) : ?>

            <div class="alert alert-message loggedas pull-left">
                <i class="icon-info-sign"></i>
                <?php _e('Commenting as ', 'wordstrap'); ?>
                <?php $userdata = get_userdata(get_current_user_id()); ?>
                <strong><?php echo $userdata->display_name; ?></strong>
            </div>

            <div class="clearfix"></div>

            <form id="commentform" class="ws-form-common" method="post" action="<?php echo get_site_url(); ?>/wp-comments-post.php">
                <textarea class="ws-comment-textarea" id="comment" name="comment" no-resize></textarea>
                <p class="form-submit">
                    <button class="btn btn-primary btn-large" id="submit" name="submit" type="submit"><i class="icon-pencil icon-white rightspace-icon"></i><?php _e('Post comment', 'wordstrap'); ?></button>
                    <input type="hidden" id="comment_post_ID" value="<?php echo get_the_ID(); ?>" name="comment_post_ID">
                </p>
            </form>

        <?php else : ?>

            <p class="alert alert-message ws-alert nocomments"><?php _e('Comments for this post are closed.', 'wordstrap'); ?></p>

        <?php endif; ?>

    <?php else : ?>

        <br />
        <div class="alert alert-message span5" style="padding: 10px;">
            <i class="icon-exclamation-sign rightspace-icon"></i>
            <?php _e('Only registered users can comment. Please ', 'wordstrap'); ?>
            <a href="<?php echo get_site_url(); ?>/wp-login.php"><?php _e('login', 'wordstrap'); ?></a>
            <?php _e(' or ', 'wordstrap'); ?>
            <a href="<?php echo get_site_url(); ?>/wp-login.php?action=register"><?php _e('register', 'wordstrap'); ?></a>
        </div>

    <?php endif; ?>
</div>