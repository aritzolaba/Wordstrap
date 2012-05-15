<?php
/**
 * The comments template file.
 *
 * @package WordStrap
 * @subpackage Main Pages
 * @since Wordstrap 1.5
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
        'id_submit' => 'ws-comment-submit'
    );
    comment_form($args);    
    ?>

</div>