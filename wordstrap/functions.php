<?php
/**
 * The Wordstrap functions file.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Get Theme Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');

// Set some CONSTANTS and WordPress $content_width required var
$ws_spancol_center = 12;
if ($wordstrap_theme_options['ws_layout'] == '2cols-left') {
    // Calculate width for center container
    $ws_spancol_center = $ws_spancol_center - $wordstrap_theme_options['ws_spancol_left'];
    define('WS_SPANCOL_LEFT', 'span'.$wordstrap_theme_options['ws_spancol_left']);
    define('WS_SPANCOL_CENTER', 'span'.$ws_spancol_center);
    if (!isset($content_width)) $content_width = 860;
}
elseif ($wordstrap_theme_options['ws_layout'] == '2cols-right') {
    // Calculate width for center container
    $ws_spancol_center = $ws_spancol_center - $wordstrap_theme_options['ws_spancol_right'];
    define('WS_SPANCOL_RIGHT', 'span'.$wordstrap_theme_options['ws_spancol_right']);
    define('WS_SPANCOL_CENTER', 'span'.$ws_spancol_center);
    if (!isset($content_width)) $content_width = 860;
}
elseif ($wordstrap_theme_options['ws_layout'] == '3cols') {
    // Calculate width for center container
    $ws_spancol_center = $ws_spancol_center - ($wordstrap_theme_options['ws_spancol_left'] + $wordstrap_theme_options['ws_spancol_right']);
    define('WS_SPANCOL_LEFT', 'span'.$wordstrap_theme_options['ws_spancol_left']);
    define('WS_SPANCOL_RIGHT', 'span'.$wordstrap_theme_options['ws_spancol_right']);
    define('WS_SPANCOL_CENTER', 'span'.$ws_spancol_center);
    if (!isset($content_width)) $content_width = 520;
}
else {
    define('WS_SPANCOL_CENTER', 'span'.$ws_spancol_center);
    if (!isset($content_width)) $content_width = 960;
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
        add_theme_support('post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio'));
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
 * Add custom image size for thumbnails in loops
 */
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'loop-thumb', 80, 80, true );
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
* Handle posts with no title
*/
function ws_title ($title) {
    if ($title == '') $title = __('Untitled','wordstrap');
    return $title;
}
add_filter('the_title', 'ws_title', 10, 1);

/*******************************************************************************
* Excerpt more link (read more link)
*/
function ws_excerpt_more($more) {
    global $post;
    return '...<br /><br /><a class="btn btn-mini btn-info" href="'. get_permalink($post->ID) .'" title="'.__('Read the rest of the article','wordstrap').'"><i class="icon-arrow-right"></i> '.__('Read the rest','wordstrap').'</a>';
}
add_filter('excerpt_more', 'ws_excerpt_more');

/*******************************************************************************
* Excerpt for titles
*/
function ws_title_excerpt ($title) {
    if (strlen($title)>30) $title=substr($title,0,30).'<i>...</i>';
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

        $next_posts_link = str_replace('<a', '<a class="btn '.$xtra.'"',get_next_posts_link(__('<i class="icon-circle-arrow-left"></i> OLDER POSTS', 'wordstrap')));
        $prev_posts_link = str_replace('<a', '<a class="btn '.$xtra.'"',get_previous_posts_link(__('NEWER POSTS <i class="icon-circle-arrow-right"></i>', 'wordstrap')));
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
            <li <?php echo $active; ?>><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->name; ?></a></li>
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

/*
* Function called from header.php to load all theme scripts and styles
*/
function ws_load_theme_scripts () {
    global $wordstrap_theme_options;
    // Enqueue bootstrap and font-awesome css styles
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css', array() );
    wp_enqueue_style( 'bootstrap-resp-css', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-responsive.min.css', array() );
    wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css', array() );
    wp_enqueue_style( 'wordstrap-css', get_template_directory_uri() . '/style.css', array() );
    wp_enqueue_style( 'wordstrap-style-css', get_template_directory_uri() . '/inc/styles/'.$wordstrap_theme_options['style'].'/style.css', array() );

    // Enqueue wordstrap and bootstrap js scripts
    wp_enqueue_script( 'wordstrap-js', get_template_directory_uri() . '/inc/js/wordstrap.js', array( 'jquery' ) );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );

    // Enqueue Wordpress Thickbox
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}

/*******************************************************************************
* Add custom styles dinamically based on options using wp_head hook
*/
function ws_theme_options_styles () {
    $gfontsstyle = '';
    global $wordstrap_theme_options;

    // Additional style override based in options
    $addstyle = '
    div.well-widgets div.ws-widget-title,
    article .calendar > .month {
        color: '.$wordstrap_theme_options['widget_header_color'].';
        background-image: -moz-linear-gradient(center top , '.$wordstrap_theme_options['widget_header_bg1'].', '.$wordstrap_theme_options['widget_header_bg2'].');
        background: -webkit-gradient(linear, left top, left bottom, from('.$wordstrap_theme_options['widget_header_bg1'].'), to('.$wordstrap_theme_options['widget_header_bg2'].'));
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$wordstrap_theme_options['widget_header_bg1'].'\', endColorstr=\''.$wordstrap_theme_options['widget_header_bg2'].'\');
    }
    div#ws-header.ws-header-container {
        background-image: -moz-linear-gradient(center top , '.$wordstrap_theme_options['header_bg1'].', '.$wordstrap_theme_options['header_bg2'].');
        background: -webkit-gradient(linear, left top, left bottom, from('.$wordstrap_theme_options['header_bg1'].'), to('.$wordstrap_theme_options['header_bg2'].'));
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$wordstrap_theme_options['header_bg1'].'\', endColorstr=\''.$wordstrap_theme_options['header_bg2'].'\');
    }';

    // SPECIAL OPTIONS FOR THE "SOLID" STYLE
    if ($wordstrap_theme_options['style'] == 'solid') {
        $addstyle .= '
        div#ws-header.ws-header-container {
            background: '.$wordstrap_theme_options['header_bg1'].' url(\''. get_stylesheet_directory_uri() .'/inc/styles/solid/imgs/light_toast_trans15.png\') repeat;
        }';

        $addstyle .= '
        div.well-widgets div.ws-widget-title {
            background: transparent;
        }';
    }

    $addstyle .= '
    div#ws-header h1,
    div#ws-header h2 {
        color: '.$wordstrap_theme_options['header_color'].';
    }
    .navbar ul.ws-nav.nav > li > a {
        color: '.$wordstrap_theme_options['navbar_color'].';
    }
    .navbar ul.ws-nav.nav > li > a:hover {
        color: #fafafa;
    }
    div.navbar-inner,
    div.navbar-inner div.divider-vertical,
    .navbar a.btn-navbar {
        background-image: -moz-linear-gradient(center top , '.$wordstrap_theme_options['navbar_bg1'].', '.$wordstrap_theme_options['navbar_bg2'].');
        background: -webkit-gradient(linear, left top, left bottom, from('.$wordstrap_theme_options['navbar_bg1'].'), to('.$wordstrap_theme_options['navbar_bg2'].'));
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$wordstrap_theme_options['navbar_bg1'].'\', endColorstr=\''.$wordstrap_theme_options['navbar_bg2'].'\');
    }
    .navbar a.btn-navbar:hover {
        background-image: -moz-linear-gradient(center top , '.$wordstrap_theme_options['navbar_bg1'].', '.$wordstrap_theme_options['navbar_bg2'].');
        background: -webkit-gradient(linear, left top, left bottom, from('.$wordstrap_theme_options['navbar_bg1'].'), to('.$wordstrap_theme_options['navbar_bg2'].'));
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$wordstrap_theme_options['navbar_bg1'].'\', endColorstr=\''.$wordstrap_theme_options['navbar_bg2'].'\');
        opacity: .5;
    }
    div.well.well-intro {
        background: '.$wordstrap_theme_options['intro_bg'].' url(\''. get_stylesheet_directory_uri() .'/inc/imgs/noise.png\') repeat;
        color: '.$wordstrap_theme_options['intro_color'].';
    }
    div.well.well-intro h1,
    .well.well-intro h2,
    .well.well-intro h3 {
        color: '.$wordstrap_theme_options['intro_color'].';
    }
    #ws-header.ws-header-container {
        height: '.$wordstrap_theme_options['header_height'].'px;
    }
    .ws-featured-title {
        color: '.$wordstrap_theme_options['landing_page_featured_title_color'].'
    }
    ';

    // Google Fonts
    if ($wordstrap_theme_options['use_googlefonts'] == 1) :

        $gfontsstyle = '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$wordstrap_theme_options['google_font'].'">';

        if ($wordstrap_theme_options['use_googlefonts_widgets'] == 1) :
            $addstyle .= '
            h1#site-title a,
            h2#site-description,
            .ws-widget-title,
            .well-intro h1,
            .well-intro h2,
            .well-intro h3,
            .well-intro h4,
            .well-intro h5,
            .navbar a.brand {
                font-family: \''.str_replace('+', ' ', $wordstrap_theme_options['google_font']).'\';
            }
            ';
        endif;

        if ($wordstrap_theme_options['use_googlefonts_posts'] == 1) :
            $addstyle .= '
            h1.entry-title {
                font-family: \''.str_replace('+', ' ', $wordstrap_theme_options['google_font']).'\';
            }
            ';
        endif;

        if ($wordstrap_theme_options['use_googlefonts_pages'] == 1) :
            $addstyle .= '
            .ws-widget-title,
            .well-intro h1 {
                font-family: \''.str_replace('+', ' ', $wordstrap_theme_options['google_font']).'\';
            }
            ';
        endif;

    endif;
    // End Google Fonts

    // #ws-wrapper padding-top depending header/navbar and fixed/not fixed options
    if ($wordstrap_theme_options['hide_wsnavbar'] != 1 && $wordstrap_theme_options['hide_wsheader'] == 1 && $wordstrap_theme_options['nav_fixed'] == 1) :
        $addstyle .= 'div#ws-wrapper{ padding-top: 4.2em; }';
    elseif ($wordstrap_theme_options['hide_wsnavbar'] == 1 && $wordstrap_theme_options['hide_wsheader'] != 1 && $wordstrap_theme_options['nav_fixed'] == 1) :
        $nav_top = intval($wordstrap_theme_options['header_height'])+40; $addstyle.= 'div#ws-wrapper{ padding-top: '.$nav_top.'px; }';
    elseif ($wordstrap_theme_options['hide_wsnavbar'] != 1 && $wordstrap_theme_options['hide_wsheader'] == 1 && $wordstrap_theme_options['nav_fixed'] != 1) :
        $addstyle .= 'div#ws-wrapper{ padding-top: .25em; }';
    elseif ($wordstrap_theme_options['hide_wsnavbar'] != 1 && $wordstrap_theme_options['hide_wsheader'] != 1 && $wordstrap_theme_options['nav_fixed'] == 1) :
        $nav_top = intval($wordstrap_theme_options['header_height'])+80; $addstyle .= 'div#ws-wrapper{ padding-top: '.$nav_top.'px; }';
    else :
        $addstyle .= 'div#ws-wrapper{ padding-top: .25em; }';
    endif;

    echo $gfontsstyle . '<style type="text/css">'.$addstyle.'</style>';
}
add_action ('wp_head', 'ws_theme_options_styles');

/*******************************************************************************
* Function for "fallback_cb" in part_navbar (wp_nav_menu)
*/
function ws_no_menu () {

    $link = '<b>custom menu</b> !';
    $output = '<div class="nav-collapse first-nav"><ul class="nav ws-nav"><li><a href="'. get_site_url() .'"><i class="icon-home icon-white"></i> Home</a></li><li class="divider-vertical"></li></ul>';
    $output .= '<div style="float: left; margin-top: 10px; color: #666; font-style: italic;">';
    $output .= sprintf ( __('You should customize a %s', 'wordstrap'), $link);
    $output .= '</div>';

    echo $output;
}

/*******************************************************************************
* Hook into wp_title()
*/
function ws_wp_title( $title, $sep ) {
	$title .= get_bloginfo( 'name' );

	if ( is_front_page() ) $title .= " {$sep} " . get_bloginfo( 'description' );

	return $title;
}
add_filter( 'wp_title', 'ws_wp_title', 1, 2 );

/*******************************************************************************
* AJAX IN FRONT-END AREA: Featured posts
*/
function WsAjaxFeatured() {
    die(get_template_part('partials/part_featured'));
}
// Hook to wp_ajax_nopriv_WsAjaxFunction (for non logged users)
// and to wp_ajax_WsAjaxFunction (for logged users)
add_action( 'wp_ajax_nopriv_WsAjaxFeatured', 'WsAjaxFeatured' );
add_action( 'wp_ajax_WsAjaxFeatured', 'WsAjaxFeatured' );

// Add .js file inc/js/ws-ajax.js
function add_ws_ajax_script() {
    wp_enqueue_script( 'ws-ajax', get_template_directory_uri() .'/inc/js/ws-ajax.js', array ('jquery') );

    // Whith this function we have JS vars set globally
    // in order to be used in the ws-ajax script, as "WsAjax.ajaxurl", etc.
    wp_localize_script( 'ws-ajax', 'WsAjax', array(
        // URL to wp-admin/admin-ajax.php to process the request
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'ajaxloadingimg' => get_template_directory_uri() . '/inc/imgs/loading.gif'
        )
    );
}
add_action( 'init', 'add_ws_ajax_script' );

// PRINT DONATE BUTTON
function ws_print_donate_button() {
    ?>
    <div style="float: right; font-size: .9em; margin-top: 6px; line-height: 1em;">
        <form class="alert alert-info" style="margin: 0px; padding: 5px; padding-left: 15px;" action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <i class="icon-info-sign"></i>&nbsp;
            <?php _e('Like this theme? Support my work','wordstrap'); ?>

            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="YG8XUQ6XE4ZW4">
            <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal. La forma r&aacute;pida y segura de pagar en Internet.">
            <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
<?php }

// Thickbox Gallery support
function add_rel_attribute_to_attachment_link( $anchor_tag, $image_id ) {
    $image = get_post( $image_id );
    $rel = '';
    if( isset( $image->post_parent ) ) {
        $rel = ' rel="attached-to-' . (int) $image->post_parent . '"';
    }
    if( !empty( $rel ) ) {
        $anchor_tag = str_replace( '<a', '<a' . $rel, $anchor_tag );
    }
    return $anchor_tag;
}
add_filter( 'wp_get_attachment_link', 'add_rel_attribute_to_attachment_link', 1, 2);

// GALLERY SHORTCODE FILTER FOR CAROUSEL
add_action('post_gallery', 'ws_gallery_carousel', 10, 2);
function ws_gallery_carousel ($output, $attr) {
    global $post;

    // OrderBy
    $orderby = 'menu_order';
    if (isset($attr['orderby']) && !empty($attr['orderby']))
        $orderby = sanitize_sql_orderby ($attr['orderby']);

    // If we got an include attr
    if (isset($attr['include']))
        $images = get_posts( array('include' => $attr['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => $orderby) );

    // If we do not have images yet...
    if (!isset($images) OR empty($images)) :
        // Get Post Images
        $images = get_children( array(
            'post_parent' => $post->ID,
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'numberposts' => 100,
            'orderby' => $orderby,
            'order' => 'DESC'
        ));
    endif;

    // If images are found, proceed
    if ( $images ) :

        $output = '<div class="clearfix"></div>

        <div class="row-fluid">
            <div class="span12">
                <div id="slideshow" class="carousel slide">
                    <div class="carousel-inner">';

                    $i=0;
                    foreach ($images as $image) :
                        $i++;
                        $act = '';
                        if ($i==1) $act = 'active';

                        $output .= '<div class="item '.$act.'" style="text-align: center;">
                            <a rel="attached-to-'.$image->post_parent.'" class="thickbox" href="'.$image->guid.'" title="'. get_the_title($image->ID).'">
                                <img src="'. $image->guid.'" alt="'.get_the_title($image->ID).'"/>
                            </a>
                            <div class="carousel-caption">
                                <h4>'. get_the_title($image->ID).'</h4>
                                <br />
                            </div>
                        </div>';

                    endforeach;

                    $output .= '</div>
                    <a class="left carousel-control ws-carousel-but-left" href="#slideshow" data-slide="prev"><i class="icon-circle-arrow-left"></i></a>
                    <a class="right carousel-control ws-carousel-but-right" href="#slideshow" data-slide="next"><i class="icon-circle-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        ';

        return $output;

    endif;

    // Return nothing
    return;
}

// SHORTCODES
add_shortcode('social_share', 'ws_social_share');

// Display social share buttons shortcode
function ws_social_share ($atts=array()) {

    extract(shortcode_atts(array(
        "link" => get_permalink()
    ), $atts));

    global $post;

    $output = '
    <div class="ws-social-buttons">

        <a href="http://twitter.com/share" class="twitter-share-button" data-url="'. $link.'" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <div class="g-plusone" data-size="medium" data-href="'.$link.'"></div>
        <iframe src="http://www.facebook.com/plugins/like.php?app_id=124765724272783&amp;href='. $link .'&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>

        <script type="text/javascript">
            (function() {
                var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
                po.src = \'https://apis.google.com/js/plusone.js\';
                var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
            })();

            (function($) {
                $(document).ready( function() {
                    $(".ws-social-buttons").delay(1000).fadeIn();
                });

            })(jQuery);
        </script>

    </div>';

    return $output;
}