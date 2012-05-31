<?php
/**
 * The auth template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */
?>

<?php
if (isset($_GET['user_login'])) $user_login = wp_kses($_GET['user_login'], NULL);
if (isset($_POST['user_login'])) $user_login = wp_kses($_POST['user_login'], NULL);
if (!isset($user_login)) $user_login = '';

if (isset($_GET['user_email'])) $user_email = wp_kses($_GET['user_email'], NULL);
if (isset($_POST['user_email'])) $user_email = wp_kses($_POST['user_email'], NULL);
if (!isset($user_email)) $user_email = '';

if (isset($_GET['action'])) $action = wp_kses($_GET['action'], NULL);
if (isset($_POST['action'])) $action = wp_kses($_POST['action'], NULL);
if (!isset($action)) $action = '';

if (isset($_GET['key'])) $key = wp_kses($_GET['key'], NULL);
if (isset($_POST['key'])) $key = wp_kses($_POST['key'], NULL);
if (!isset($key)) $key = '';

if (isset($_GET['login'])) $login = wp_kses($_GET['login'], NULL);
if (isset($_POST['login'])) $login = wp_kses($_POST['login'], NULL);
if (!isset($login)) $login = '';
?>

<div <?php if (is_user_logged_in()) echo 'id="ws-user-box"'; ?> class="well well-login<?php if (is_user_logged_in()) echo ' well-padding-small'; ?>">

    <?php if (!is_user_logged_in() && $action != 'rp') : ?>

        <form id="wp_login_form" class="ws-form-common <?php if ($action=='lostpassword' OR $action=='register') { echo 'inactive'; } ?>" method="post" action="<?php echo get_site_url(). '/index.php'; ?>">
            <legend>
                <h1><?php _e('Sign in', 'wordstrap'); ?></h1>
            </legend>

            <fieldset>
                <label for="Username"><?php _e('Username', 'wordstrap'); ?></label>
                <input class="span2" type="text" id="log" name="log">
                <label for="password"><?php _e('Password', 'wordstrap'); ?></label>
                <input class="span2" type="password" id="pwd" name="pwd">

                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" id="rememberme" name="rememberme" value="forever">
                        <?php _e('Remember me', 'wordstrap'); ?>
                    </label>
                </div>
            </fieldset>

            <div class="ws-form-common-footer">
                <button id="btnsubmit" type="submit" class="btn btn-success"><i class="icon-lock icon-white rightspace-icon"></i><?php _e('Sign in', 'wordstrap'); ?></button>
            </div>

            <div class="ws-form-toggle">
                <span class="ws-link-arrows">&rsaquo;&rsaquo;</span><a class="ws-toggle" href="lostpassword"><?php _e('Lost your password ?','wordstrap'); ?></a><br />
                <?php if (get_option('users_can_register') == 1) : ?>
                    <span class="ws-link-arrows">&rsaquo;&rsaquo;</span><a class="ws-toggle" href="register"><?php _e('Create a new account','wordstrap'); ?></a>
                <?php endif; ?>
            </div>

        </form>

        <form name="lostpasswordform" id="lostpasswordform" class="ws-form-common <?php if ($action!='lostpassword') { echo 'inactive'; } ?>" action="<?php echo get_site_url(). '/index.php'; ?>" method="post">
            <legend>
                <h1><?php _e('Lost pass', 'wordstrap'); ?></h1>
            </legend>

            <fieldset>
                <label for="user_login"><?php _e('Username or email','wordstrap'); ?></label>
                <input class="span2" type="text" name="user_login" id="user_login" value="<?php echo $user_login; ?>">
            </fieldset>

            <div class="ws-form-common-footer">
                <button id="btnsubmit" type="submit" class="btn btn-success"><i class="icon-envelope icon-white rightspace-icon"></i><?php _e('Send reminder', 'wordstrap'); ?></button>
                <input type="hidden" name="action" value="lostpassword" />
            </div>

            <div class="ws-form-toggle">
                <span class="ws-link-arrows">&lsaquo;&lsaquo;</span><a class="ws-toggle" href="login"><?php _e('Back to login','wordstrap'); ?></a>
            </div>

        </form>

        <?php if (get_option('users_can_register') == 1) : ?>

            <form name="registerform" id="registerform" class="ws-form-common <?php if ($action!='register') { echo 'inactive'; } ?>" action="" method="post">
                <legend>
                    <h1><?php _e('Register', 'wordstrap'); ?></h1>
                </legend>

                <fieldset>
                    <label for="user_login"><?php _e('Username','wordstrap'); ?></label>
                    <input class="span2" type="text" name="user_login" id="new_user_login" value="<?php echo $user_login; ?>">
                </fieldset>

                <fieldset>
                    <label for="user_email"><?php _e('Email','wordstrap'); ?></label>
                    <input class="span2" type="text" name="user_email" id="new_user_email" value="<?php echo $user_email; ?>">
                </fieldset>

                <div class="ws-form-common-footer">
                    <button id="btnsubmit" type="submit" class="btn btn-success"><i class="icon-ok-sign icon-white rightspace-icon"></i><?php _e('Create account', 'wordstrap'); ?></button>
                    <input type="hidden" name="action" value="register" />
                </div>

                <div class="ws-form-toggle">
                    <span class="ws-link-arrows">&lsaquo;&lsaquo;</span><a class="ws-toggle" href="login"><?php _e('Back to login','wordstrap'); ?></a>
                </div>
            </form>

        <?php endif; ?>

    <?php elseif (!is_user_logged_in() && $action == 'rp' && !$_POST['pass1'] && !$_POST['pass2']) : ?>

        <form name="resetpassform" id="resetpassform" class="ws-form-common" action="" method="post">
            <legend>
                <h1><?php _e('Reset pass', 'wordstrap'); ?></h1>
            </legend>

            <fieldset>
                <label for="pass1"><?php _e('New password','wordstrap'); ?></label>
                <input type="password" autocomplete="off" value="" size="20" class="span2" id="pass1" name="pass1">
                <label for="pass2"><?php _e('Confirm new password','wordstrap'); ?></label>
                <input type="password" autocomplete="off" value="" size="20" class="span2" id="pass2" name="pass2">
            </fieldset>

            <div class="ws-form-common-footer">
                <button id="btnsubmit" type="submit" class="btn btn-success"><i class="icon-lock icon-white rightspace-icon"></i><?php _e('Update password', 'wordstrap'); ?></button>
                <input type="hidden" name="action" value="rp" />
                <input type="hidden" name="key" value="<?php echo $key; ?>" />
                <input type="hidden" name="user_login" value="<?php echo $login; ?>" />
            </div>

            <div class="ws-form-toggle">
                <span class="ws-link-arrows">&lsaquo;&lsaquo;</span><a class="ws-toggle" href="login" onclick="location.href='<?php echo get_site_url(); ?>';"><?php _e('Cancel','wordstrap'); ?></a>
            </div>
        </form>

    <?php elseif (is_user_logged_in()) : ?>

        <div class="ws-user-avatar">
            <?php echo get_avatar( get_current_user_id(), 36); ?>
        </div>

        <div class="ws-user-details">
            <?php
            // Get current user data
            $user_id = get_current_user_id();
            $userdata = get_userdata($user_id);
            $user_registered = strtotime($userdata->data->user_registered);
            $user_name = trim(get_the_author_meta('first_name', $user_id) . ' ' . get_the_author_meta('last_name', $user_id));
            if (empty($user_name))
                $user_name = $userdata->data->display_name;
            ?>

            <h1><small><?php echo $user_name; ?></small></h1>
            <p>
                <?php //echo sprintf (__('registered %s ago','wordstrap'), human_time_diff($user_registered)); ?>
                <?php echo '@'.$userdata->data->display_name; ?>
            </p>
        </div>

        <div class="ws-form-common-footer logged">

            <a href="<?php echo wp_logout_url( get_site_url() ); ?>" class="btn btn-danger pull-right"><i class="icon-off icon-white"></i></a>
            <?php if (current_user_can('manage_options')) : ?>
                <a target="_blank" href="<?php echo get_site_url(); ?>/wp-admin" class="btn pull-right rightspace-small"><i class="icon-cog"></i></a>
            <?php endif; ?>
            <?php if (current_user_can('publish_posts')) : ?>
                <a href="<?php echo str_replace('/feed', '', get_author_feed_link($user_id)); ?>" class="btn pull-right rightspace-small"><i class="icon-question-sign rightspace-icon"></i><?php _e('About you','wordstrap'); ?></a>
            <?php endif; ?>

        </div>

    <?php endif; ?>

    <?php
    /* Display Messages */
    if (defined('login_message')) : ?>
        <div class="alert alert-error ws-alert">
            <?php /* <a class="close ws-alert-close" data-dismiss="alert">&times;</a> */ ?>
            <?php echo login_message; ?>
        </div>
    <?php elseif (defined('login_success')) : ?>
        <div class="alert alert-success ws-alert">
            <?php /* <a class="close ws-alert-close" data-dismiss="alert">&times;</a> */ ?>
            <?php echo login_success; ?>
        </div>
    <?php endif; ?>

</div>