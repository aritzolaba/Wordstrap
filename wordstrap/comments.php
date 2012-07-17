<?php
/**
 * The comments template file.
 *
 * @package WordStrap
 * @subpackage Main
 * @since Wordstrap 1.6.4
 */
?>

<div id="comments">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'wordstrap' ); ?></p>
        </div><!-- #comments -->
        <?php
        /* Stop the rest of comments.php from being processed,
         * but don't kill the script entirely -- we still have
         * to fully load the template.
         */
        return;
    endif;
    ?>

    <?php
    if (comments_open()) :
        $ncomments = get_comments_number();
        echo '<h2 style="margin: 0px; margin-bottom: 10px; overflow: hidden;"><small><span style="font-size: 1.5em; float: left; margin-right: 5px; margin-top: 2px;"><i class="icon-awesome-comments"></i></span> ';
        if ($ncomments == 1)
            echo sprintf ( __('There is %d comment','wordstrap'), $ncomments);
        elseif ($ncomments > 1)
            echo sprintf ( __('There are %d comments','wordstrap'), $ncomments);
        else
            echo __('There are no comments','wordstrap');
        echo '</small></h2>';
    endif;
    ?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-above">
            <?php paginate_comments_links(); ?>
        </nav>
    <?php endif; ?>

    <div class="commentlist">
        <?php
        $args = array ('paged' => true);
        wp_list_comments(array('callback' => 'wordstrap_commentlist'));
        ?>
    </div>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-above">
            <?php paginate_comments_links(); ?>
        </nav>
    <?php endif; ?>

    <?php
    $args = array (
        'id_submit' => 'ws-comment-submit',
        'title_reply' => '<i class="icon-awesome-comment"></i> '. __('Leave a Reply','wordstrap')
    );
    comment_form($args);
    ?>

</div>