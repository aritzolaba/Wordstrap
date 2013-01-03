<?php
/**
 * The comments template file.
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
        echo '<h2 class="ws-comments-title"><small><i class="icon-comments ws-comments-icon"></i> ';
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
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(
        'author' => '<p class="comment-form-author">' . '<label for="author">' . ( $req ? '<span class="required">*</span> ' : '' ) . __( 'Name', 'wordstrap' ) . '</label> ',
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . ( $req ? '<span class="required">*</span> ' : '' ) . __( 'Email', 'wordstrap' ) . '</label> ',
                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>'
    );
    $args = array (
        'id_submit' => 'ws-comment-submit',
        'title_reply' => '<i class="icon-pencil" style="float: left; margin-top: .2em; margin-right: .25em;"></i> '. __('Leave a Reply','wordstrap'),
        'fields' => apply_filters( 'comment_form_default_fields', $fields )
    );
    comment_form($args);
    ?>

</div>