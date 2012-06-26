<?php
/**
 * The Wordstrap functions file.
 *
 * @package WordStrap
 * @subpackage Main
 * @since Wordstrap 1.6.1
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Theme Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');

// Set some CONSTANTS and wordpress $content_width required var
if ($wordstrap_theme_options['ws_layout'] == 'full-width') {
    define('WS_SPANCOL_CENTER', 'span12');
    if (!isset($content_width)) $content_width = 870;
}
elseif ($wordstrap_theme_options['ws_layout'] == '2cols-left') {
    define('WS_SPANCOL_LEFT', 'span3');
    define('WS_SPANCOL_CENTER', 'span9');
    if (!isset($content_width)) $content_width = 770;
}
elseif ($wordstrap_theme_options['ws_layout'] == '2cols-right') {
    define('WS_SPANCOL_RIGHT', 'span3');
    define('WS_SPANCOL_CENTER', 'span9');
    if (!isset($content_width)) $content_width = 770;
}
elseif ($wordstrap_theme_options['ws_layout'] == '3cols') {
    define('WS_SPANCOL_LEFT', 'span2');
    define('WS_SPANCOL_RIGHT', 'span3');
    define('WS_SPANCOL_CENTER', 'span7');
    if (!isset($content_width)) $content_width = 580;
}
else {
    define('WS_SPANCOL_CENTER', 'span12');
    if (!isset($content_width)) $content_width = 770;
}

/*******************************************************************************
* Setup Theme
*/
if (!function_exists('wordstrap_setup')) :

    function wordstrap_setup() {

        // Internationalisation
        load_theme_textdomain('wordstrap', get_template_directory().'/languages');
        $locale = get_locale();
        $locale_file = get_template_directory()."/languages/{$locale}.php";
        if(is_readable($locale_file)) { require_once($locale_file); }

        // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

        // Load up our theme options page and related code.
        require( get_template_directory() . '/inc/theme-options.php' );

        // Theme supports
        add_theme_support( 'post-thumbnails', array( 'post' ) );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'menus' );
        $defaults = array(
            'height' => 80
        );
        add_theme_support( 'custom-header', $defaults );

        $defaults = array(
            'default-color' => '4E6C84'
        );
        add_theme_support( 'custom-background', $defaults );
    }

endif;

add_action('after_setup_theme', 'wordstrap_setup');

/*******************************************************************************
* Register widgetized sidebars and nav_menu
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

    // Register Nav Menu
    register_nav_menu( 'primary', 'Wordstrap nav menu' );
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
 * @since Wordstrap 1.6.1
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
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wordstrap' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>

            </article><!-- #comment-## -->
        </li>
    <?php }

endif; // ends check for wordstrap_comment()

/*******************************************************************************
* Add hierarchy support to wp_nav_menu
*/
add_filter('wp_nav_menu_objects', function ($items) {
    $hasSub = function ($menu_item_id, &$items) {
        foreach ($items as $item) {
            if ($item->menu_item_parent && $item->menu_item_parent==$menu_item_id) {
                return true;
            }
        }
        return false;
    };

    foreach ($items as &$item) {
        if ($hasSub($item->ID, &$items)) {
            $item->classes[] = 'ws-dropdown'; // all elements of field "classes" of a menu item get join together and render to class attribute of <li> element in HTML
        }
    }
    return $items;
});

/*******************************************************************************
* Handle posts with no title
*/
function ws_title ($title) {
    if ($title == '') $title = __('Untitled','wordstrap');
    return $title;
}
add_filter('the_title', 'ws_title', 10, 1);

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
* Author full name display
*
* Get author first_name and last_name. If empty, get the nickname
*/
function ws_get_authorfullname ($author_id=NULL) {

    if (is_null($author_id)) $author_id = get_the_author_meta('ID');
    $author_name = trim(get_the_author_meta('first_name', $author_id) . ' ' . get_the_author_meta('last_name', $author_id));
    if (empty($author_name))
        $author_name = get_the_author_meta('nickname', $author_id);

    return $author_name;
}

/*******************************************************************************
* Filter for get_the_post_thumbnail(), to display a custom 'not-found' image
*/
function ws_get_thumbnail ($html, $post_id, $post_image_id) {

    if (!$html)
        return '<img src="'. get_stylesheet_directory_uri() .'/inc/imgs/noimage.png">';
    else
        return $html;
}
add_filter('post_thumbnail_html', 'ws_get_thumbnail', 10, 3);

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

/*******************************************************************************
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
* AJAX IN FRONT-END AREA: Featured posts
*/
function WsAjaxFeatured() {
    get_template_part('partials/part_featured');
    die();
}
// Hook to wp_ajax_nopriv_WsAjaxFunction (for non logged users)
// and to wp_ajax_WsAjaxFunction (for logged users)
add_action( 'wp_ajax_nopriv_WsAjaxFeatured', 'WsAjaxFeatured' );
add_action( 'wp_ajax_WsAjaxFeatured', 'WsAjaxFeatured' );

// Add .js file inc/js/ws-ajax.js
function add_ws_ajax_script() {
    wp_enqueue_script( 'ws-ajax', get_template_directory_uri() ."/inc/js/ws-ajax.js", array ('jquery') );

    // Whith this function we have JS vars set globally
    // in order to be used in the ws-ajax script, as "WsAjax.ajaxurl", etc.
    wp_localize_script( 'ws-ajax', 'WsAjax', array(
        // URL to wp-admin/admin-ajax.php to process the request
        'ajaxurl'   => admin_url( 'admin-ajax.php' )
        )
    );
}
add_action( 'init', 'add_ws_ajax_script' );