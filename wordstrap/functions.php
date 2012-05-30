<?php
/**
 * The Wordstrap functions file.
 *
 * @package WordStrap
 * @subpackage Main Pages
 * @since Wordstrap 1.5
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Theme Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');

if ($wordstrap_theme_options['ws_layout'] == 'full-width') {
    define('WS_SPANCOL_CENTER', 'span12');
}
elseif ($wordstrap_theme_options['ws_layout'] == '2cols-left') {
    define('WS_SPANCOL_LEFT', 'span3');
    define('WS_SPANCOL_CENTER', 'span9');
}
elseif ($wordstrap_theme_options['ws_layout'] == '2cols-right') {
    define('WS_SPANCOL_RIGHT', 'span3');
    define('WS_SPANCOL_CENTER', 'span9');
}
elseif ($wordstrap_theme_options['ws_layout'] == '3cols') {
    define('WS_SPANCOL_LEFT', 'span2');
    define('WS_SPANCOL_RIGHT', 'span3');
    define('WS_SPANCOL_CENTER', 'span7');
}
else {
    define('WS_SPANCOL_CENTER', 'span12');
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
    $content_width = 960;

/*******************************************************************************
* Setup Theme
*/
if (!function_exists('wordstrap_setup')) :

    function wordstrap_setup() {

        // Internationalisation
        load_theme_textdomain('wordstrap', get_template_directory().'/languages');
        $locale = get_locale();
        $locale_file = TEMPLATEPATH."/languages/{$locale}.php";
        if(is_readable($locale_file)) { require_once($locale_file); }

        // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

        // Load up our theme options page and related code.
        require( get_template_directory() . '/inc/theme-options.php' );

        // Add thumbnail support for posts
        add_theme_support( 'post-thumbnails', array( 'post', 'ws_products' ) );
        add_theme_support( 'automatic-feed-links' );
    }

endif;

add_action('after_setup_theme', 'wordstrap_setup');

/*******************************************************************************
* Register widgetized sidebars
*/
if (function_exists('register_sidebar')) {

    if ($wordstrap_theme_options['ws_layout'] == '2cols-left' OR $wordstrap_theme_options['ws_layout'] == '3cols') :
        register_sidebar(array(
            'name' => "ws-sidebar-left",
            'id' => "ws-sidebar-left",
            'description' => __('Wordstrap widgetized area', 'wordstrap'),
            'before_widget' => '<div class="ws-widget-container well well-widgets">',
            'before_title' => '<div class="ws-widget-title">',
            'after_title' => '</div><div class="ws-widget-content">',
            'after_widget' => '</div></div>'
        ));
    endif;

    if ($wordstrap_theme_options['ws_layout'] == '2cols-right' OR $wordstrap_theme_options['ws_layout'] == '3cols') :
        register_sidebar(array(
            'name' => "ws-sidebar-right",
            'id' => "ws-sidebar-right",
            'description' => __('Wordstrap widgetized area', 'wordstrap'),
            'before_widget' => '<div class="ws-widget-container well well-widgets">',
            'before_title' => '<div class="ws-widget-title">',
            'after_title' => '</div><div class="ws-widget-content">',
            'after_widget' => '</div></div>'
        ));
    endif;
}

/*******************************************************************************
* Comment List Template
*/
if (!function_exists('wordstrap_commentlist')) :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own wordstrap_commentlist(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since Wordstrap 1.5
     */
    function wordstrap_commentlist($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        $defaults = array('walker' => null, 'max_depth' => '', 'style' => 'ul', 'callback' => null, 'end-callback' => null, 'type' => 'all',
		'page' => '', 'per_page' => '', 'avatar_size' => 32, 'reverse_top_level' => null, 'reverse_children' => '');

	$args = wp_parse_args( $args, $defaults );
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" style="list-style: none;">
            <article id="div-comment-<?php comment_ID(); ?>" class="comment ws-article">
                <header class="entry-header">
                    <?php
                    $avatar_size = 32;
                    if ('0' != $comment->comment_parent) $avatar_size = 24;
                    ?>

                    <div class="comment-avatar">
                        <?php echo get_avatar($comment, $avatar_size); ?>
                    </div>

                    <div class="comment-details">
                        <?php
                        /* translators: 1: comment author, 2: date and time */
                        printf(__('%1$s on %2$s <span class="says">said:</span>', 'wordstrap'),
                        sprintf('<span class="label label-info fn">%s</span>', get_comment_author_link()),
                        sprintf('<time pubdate datetime="%2$s">%3$s</time>',
                            esc_url(get_comment_link($comment->comment_ID)),
                            get_comment_time('c'),
                            sprintf(__('%1$s at %2$s', 'wordstrap'),
                                get_comment_date(),
                                get_comment_time()
                            )
                        ));
                        ?>

                        <?php if ($comment->comment_approved == '0') : ?>
                            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'wordstrap'); ?></em>
                            <br />
                        <?php endif; ?>

                    </div><!-- .comment-details -->

                </header>

                <div class="entry-content">
                    <?php comment_text(); ?>
                </div>

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'wordstrap' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>

            </article><!-- #comment-## -->
        </li>
    <?php }

endif; // ends check for wordstrap_comment()

/*******************************************************************************
* BEGIN WORDSTRAP CUSTOM FUNCTIONS
*/

/*******************************************************************************
* Remove Admin Bar
*/
if ($wordstrap_theme_options['hide_adminbar'] == 1) :

    function ws_remove_adminbar() {
        return false;
    }
    add_filter('show_admin_bar', 'ws_remove_adminbar');

endif;

/*******************************************************************************
* Excerpt length
*/
function ws_excerpt_length( $length ) {
    $wordstrap_theme_options = get_option('wordstrap_theme_options');
    return $wordstrap_theme_options['excerpt_length'];
}
add_filter( 'excerpt_length', 'ws_excerpt_length');

/*******************************************************************************
* Excerpt more link (read more link)
*/
function ws_excerpt_more($more) {
    global $post;
    return '&nbsp;[...]<p class="ws-read-more"><a href="'. get_permalink($post->ID) .'" title="'.__('Read the rest...','wordstrap').'">'.__('...continue reading...','wordstrap').'</a></p>';
}
add_filter('excerpt_more', 'ws_excerpt_more');

/*******************************************************************************
* Excerpt for titles
*/
function ws_title_excerpt ($title) {
    if (strlen($title)>=45) $title=substr($title,0,40).'<i>[...]</i>';
    return $title;
}

/*******************************************************************************
* Posts navigation (next and prev buttons)
*/
function ws_posts_navigation ($nav_id) {
    global $wp_query;

    if ($wp_query->max_num_pages > 1) :

        $xtra='btn-large';
        if (is_author()) $xtra = '';

        $next_posts_link = str_replace('<a', '<a class="btn '.$xtra.'"',get_next_posts_link(__('<i class="icon-arrow-left"></i> Older posts', 'wordstrap')));
        $prev_posts_link = str_replace('<a', '<a class="btn '.$xtra.'"',get_previous_posts_link(__('Newer posts <i class="icon-arrow-right"></i>', 'wordstrap')));
        ?>

        <nav id="<?php echo $nav_id; ?>" class="post-nav-pagination">
            <div class="post-nav-previous"><?php echo $next_posts_link; ?></div>
            <div class="post-nav-next"><?php echo $prev_posts_link; ?></div>
        </nav><!-- #nav-above -->

    <?php endif;
}

/*******************************************************************************
* Products navigation (next and prev buttons)
*/
function ws_products_navigation ($nav_id, $wp_query) {

    if ($wp_query->max_num_pages > 1) :

        $xtra='btn-large';
        if (is_author()) $xtra = '';

        $next_posts_link = str_replace('<a', '<a class="btn '.$xtra.'"',get_next_posts_link(__('<i class="icon-arrow-left"></i> Older posts', 'wordstrap')));
        $prev_posts_link = str_replace('<a', '<a class="btn '.$xtra.'"',get_previous_posts_link(__('Newer posts <i class="icon-arrow-right"></i>', 'wordstrap')));
        ?>

        <nav id="<?php echo $nav_id; ?>" class="post-nav-pagination">
            <div class="post-nav-previous"><?php echo $next_posts_link; ?></div>
            <div class="post-nav-next"><?php echo $prev_posts_link; ?></div>
        </nav><!-- #nav-above -->

    <?php endif;
}

/*******************************************************************************
* Category pills
*/
function ws_category_pills ($taxonomy=NULL) {
    $args = array();
    $query_object = get_queried_object();
    $tax = get_taxonomy($query_object->taxonomy);
    $tax_slug = $tax->rewrite['slug'];
    $taxonomy = $query_object->taxonomy;    

    if (!is_null($taxonomy)) {
        $args = array ('taxonomy' => $taxonomy, 'parent' => 0);
        if (!$tax_slug) $tax_slug = 'category';
    }

    $cat_list = get_categories($args);
    if (sizeof($cat_list)>0) : ?>
        <ul class="nav nav-pills">
            <?php foreach ($cat_list as $cat) :

                if ($cat->name == $query_object->name) $active='class="active"'; else $active='';
                ?>
                <li <?php echo $active; ?>><a href="<?php echo site_url().'/'.$tax_slug.'/'.$cat->slug; ?>"><?php echo $cat->name; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <hr>
    <?php endif; ?>
<?php }

/**
* Function for displaying a "Nothing found" partial
*/
function ws_nothing_found() { ?>
    <article class="ws-article" id="post-0" class="post no-results not-found">
        <header>
            <h1><?php _e('Nothing Found !', 'wordstrap'); ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <p><?php _e('Sorry, but no results were found for the requested query. Try another search.', 'wordstrap'); ?></p>
            <hr>
            <?php get_search_form(); ?>
        </div><!-- .entry-content -->
    </article><!-- #post-0 -->
<?php }

/*******************************************************************************
* AUTH SYSTEM: Login, Forget, Reset and Register procedures
*/
function ws_auth() {

    if (!is_user_logged_in() && $_POST) {

        $action = wp_kses ($_POST['action'], NULL);

        // Check if the user is trying to register
        if (!empty($_POST['user_login']) && !empty($_POST['user_email']) && $action == 'register') {

            $user_login = wp_kses($_POST['user_login'], NULL);
            $user_email = wp_kses($_POST['user_email'], NULL);
            $ret = ws_register_new_user($user_login, $user_email);

            if (is_wp_error($ret)) {
                define('login_message', $ret->get_error_message());
            } else {
                define('login_success', __('Your account has been created. We have sent you an email with the password.','wordstrap'));
            }

            return;
        }

        // Check if the user is trying to reset password
        if (!empty($_POST['pass1']) && $action == 'rp') {
            $ret = ws_init_reset_password();
            if (is_wp_error($ret)) {
                define('login_message', __('Reset password error.','wordstrap'));
            } else {
                define('login_message', __('Password succesfully changed.','wordstrap'));
            }

            return;
        }

        // Check if the user is trying to retrieve password
        if (!empty($_POST['user_login']) && $action == 'lostpassword') {
            $ret = ws_retrieve_password();
            if (is_wp_error($ret)) {
                define('login_message', __('There is no user with that username or email.','wordstrap'));
            } else {
                define('login_success', __('We have sent you an email to complete reseting your password.','wordstrap'));
            }

            return;
        }

        // Check if the user is trying to log in
        if (!empty($_POST['log']) && !empty($_POST['pwd'])) {

            $log = wp_kses($_POST['log'], NULL);
            $pwd = wp_kses($_POST['pwd'], NULL);
            $rem = wp_kses($_POST['rememberme'], NULL);

            if (!empty($log) && !empty($pwd)) :

                if($rem) $rem="true";
                else $rem=NULL;

                $login_data = array (
                    'user_login'    => $log,
                    'user_password' => $pwd,
                    'remember'      => $rem

                );
                $user_verify = wp_signon( $login_data, false );

                if (is_wp_error($user_verify)) {
                    define('login_message', __('Incorrect login!','wordstrap'));
                } else {
                    wp_redirect(site_url());
                    exit();
                }

            endif;

        }
    } else {
        return;
    }
}

/**
 * Handles registering a new user.
 *
 * @param string $user_login User's username for logging in
 * @param string $user_email User's email address to send password and add
 * @return int|WP_Error Either user's ID or error on failure.
 */
function ws_register_new_user( $user_login, $user_email ) {
	$errors = new WP_Error();

	$sanitized_user_login = sanitize_user( $user_login );
	$user_email = apply_filters( 'user_registration_email', $user_email );

	// Check the username
	if ( $sanitized_user_login == '' ) {
		$errors->add( 'empty_username', __( '<strong>ERROR</strong>: Please enter a username.' ) );
	} elseif ( ! validate_username( $user_login ) ) {
		$errors->add( 'invalid_username', __( '<strong>ERROR</strong>: This username is invalid because it uses illegal characters. Please enter a valid username.' ) );
		$sanitized_user_login = '';
	} elseif ( username_exists( $sanitized_user_login ) ) {
		$errors->add( 'username_exists', __( '<strong>ERROR</strong>: This username is already registered, please choose another one.' ) );
	}

	// Check the e-mail address
	if ( $user_email == '' ) {
		$errors->add( 'empty_email', __( '<strong>ERROR</strong>: Please type your e-mail address.' ) );
	} elseif ( ! is_email( $user_email ) ) {
		$errors->add( 'invalid_email', __( '<strong>ERROR</strong>: The email address isn&#8217;t correct.' ) );
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		$errors->add( 'email_exists', __( '<strong>ERROR</strong>: This email is already registered, please choose another one.' ) );
	}

	do_action( 'register_post', $sanitized_user_login, $user_email, $errors );

	$errors = apply_filters( 'registration_errors', $errors, $sanitized_user_login, $user_email );

	if ( $errors->get_error_code() )
		return $errors;

	$user_pass = wp_generate_password( 12, false);
	$user_id = wp_create_user( $sanitized_user_login, $user_pass, $user_email );
	if ( ! $user_id ) {
		$errors->add( 'registerfail', sprintf( __( '<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !' ), get_option( 'admin_email' ) ) );
		return $errors;
	}

	update_user_option( $user_id, 'default_password_nag', true, true ); //Set up the Password change nag.

	wp_new_user_notification( $user_id, $user_pass );

	return $user_id;
}

/*
* Forget password email send
*/
function ws_retrieve_password() {
	global $wpdb, $current_site;

	$errors = new WP_Error();

	if ( empty( $_POST['user_login'] ) ) {
		$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.'));
	} else if ( strpos( $_POST['user_login'], '@' ) ) {
		$user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
		if ( empty( $user_data ) )
			$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
	} else {
		$login = trim($_POST['user_login']);
		$user_data = get_user_by('login', $login);
	}

	do_action('lostpassword_post');

	if ( $errors->get_error_code() )
		return $errors;

	if ( !$user_data ) {
		$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or e-mail.'));
		return $errors;
	}

	// redefining user_login ensures we return the right case in the email
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;

	do_action('retreive_password', $user_login);  // Misspelled and deprecated
	do_action('retrieve_password', $user_login);

	$allow = apply_filters('allow_password_reset', true, $user_data->ID);

	if ( ! $allow )
		return new WP_Error('no_password_reset', __('Password reset is not allowed for this user'));
	else if ( is_wp_error($allow) )
		return $allow;

	$key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
	if ( empty($key) ) {
		// Generate something random for a key...
		$key = wp_generate_password(20, false);
		do_action('retrieve_password_key', $user_login, $key);
		// Now insert the new md5 key into the db
		$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
	}
	$message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
	$message .= network_site_url() . "\r\n\r\n";
	$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
	$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
	$message .= '' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";

	if ( is_multisite() )
		$blogname = $GLOBALS['current_site']->site_name;
	else
		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

	$title = sprintf( __('[%s] Password Reset'), $blogname );

	$title = apply_filters('retrieve_password_title', $title);
	$message = apply_filters('retrieve_password_message', $message, $key);

	if ( $message && !wp_mail($user_email, $title, $message) )
		wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );

	return true;
}

/**
 * Inits reset password procedure
 *
 * @return type
 */
function ws_init_reset_password () {

    $user = ws_check_password_reset_key($_GET['key'], $_GET['login']);

    if ( is_wp_error($user) ) {
            wp_redirect( site_url('wp-login.php?action=lostpassword&error=invalidkey') );
            exit;
    }

    $errors = '';

    if ( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] ) {
            $errors = new WP_Error('password_reset_mismatch', __('The passwords do not match.'));
    } elseif ( isset($_POST['pass1']) && !empty($_POST['pass1']) ) {
            $ret = ws_reset_password($user, $_POST['pass1']);
    }

    return $ret;
}

/**
 * Handles resetting the user's password.
 *
 * @uses $wpdb WordPress Database object
 *
 * @param string $key Hash to validate sending user's password
 */
function ws_reset_password($user, $new_pass) {
	do_action('password_reset', $user, $new_pass);

	wp_set_password($new_pass, $user->ID);

	wp_password_change_notification($user);
}

/**
 * Retrieves a user row based on password reset key and login
 *
 * @uses $wpdb WordPress Database object
 *
 * @param string $key Hash to validate sending user's password
 * @param string $login The user login
 *
 * @return object|WP_Error
 */
function ws_check_password_reset_key($key, $login) {
	global $wpdb;

	$key = preg_replace('/[^a-z0-9]/i', '', $key);

	if ( empty( $key ) || !is_string( $key ) )
		return new WP_Error('invalid_key', __('Invalid key'));

	if ( empty($login) || !is_string($login) )
		return new WP_Error('invalid_key', __('Invalid key'));

	$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $key, $login));

	if ( empty( $user ) )
		return new WP_Error('invalid_key', __('Invalid key'));

	return $user;
}

/* END WORDSTRAP CUSTOM FUNCTIONS
*******************************************************************************/

/*******************************************************************************
* SECURITY FUNCTIONS
*/
if ($wordstrap_theme_options['secure_wp'] == 1) :

    /**
     * wordstrap_wpadmin_restrict ()
     *
     */
    function wordstrap_wpadmin_restrict () {
        if (!current_user_can('publish_pages') AND !current_user_can('manage_options')) {
            ob_start();
            wp_redirect( get_site_url() );
            ob_end_flush();
            exit ();
        }
    }
    add_action ('_admin_menu','wordstrap_wpadmin_restrict');

    /**
     * wordstrap_wplogin_restrict ()
     *
     */
    function wordstrap_wplogin_restrict () {

        // Allow logout of logged in users
        if (wp_kses($_GET['action'], NULL) == 'logout' && is_user_logged_in())
            return;

        // If is reset pass, send input vars to site_url
        elseif (wp_kses($_GET['action'], NULL) == 'rp') {
            $key=wp_kses($_GET['key'], NULL);
            $login=wp_kses($_GET['login'], NULL);
            ob_start();
            wp_redirect( get_site_url().'?action=rp&key='.$key.'&login='.$login );
            ob_end_flush();
            return;
        }

        // If is register, send input vars to site_url
        elseif (wp_kses($_GET['action'], NULL) == 'register' && wp_kses($_POST['user_email'], NULL) == '') {
            ob_start();
            wp_redirect( get_site_url().'?action=register' );
            ob_end_flush();
            return;
        }

        ob_start();
        wp_redirect( get_site_url() );
        ob_end_flush();
        exit ();
    }
    add_action ('login_init','wordstrap_wplogin_restrict',10);

endif;
?>

<?php
/*******************************************************************************
* AJAX IN FRONT-END AREA
*/
function WsAjaxFeatured() {
    //get the data from ajax() call
    $AJAXNonce = $_POST['AJAXNonce'];

    if (!wp_verify_nonce( $AJAXNonce, 'ws-secure-nonce' ))
        die ('<div class="alert alert-danger ws-alert">Nonces are invalid.</div>');

    include ('partials/part_featured.php');
    die();
    }
// Hook to wp_ajax_nopriv_WsAjaxFunction (for non logged users)
// and to wp_ajax_WsAjaxFunction (for logged users)
add_action( 'wp_ajax_nopriv_WsAjaxFeatured', 'WsAjaxFeatured' );
add_action( 'wp_ajax_WsAjaxFeatured', 'WsAjaxFeatured' );

// Add .js file inc/js/ws-ajax.js
function add_ws_ajax_script() {
    wp_enqueue_script( 'ws-ajax', get_template_directory_uri() ."/inc/js/ws-ajax.js", NULL );

    // Con esta funcion tenemos variables JS globales
    // para usar dentro del script ws-ajax, llamandolas WsAjax.ajaxurl, etc.
    wp_localize_script( 'ws-ajax', 'WsAjax', array(
        // URL to wp-admin/admin-ajax.php to process the request
        'ajaxurl'   => admin_url( 'admin-ajax.php' ),
        // generate a nonce with a unique ID
        // so that you can check it later when an AJAX request is sent
        'AJAXNonce' => wp_create_nonce( 'ws-secure-nonce' )
        )
    );

    }
add_action( 'init', 'add_ws_ajax_script' );
?>