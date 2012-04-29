<?php
/**
 * The theme options page in wp-admin
 *
 * @package WordStrap
 * @subpackage Wordstrap
 * @since Wordstrap 1.5
 */

class wordstrap_theme_options_page {

    function init() {
        add_action('admin_menu', array('wordstrap_theme_options_page', 'add_options_page'));

        // If we have no options in the database, let's add them now.
        $wordstrap_theme_options = get_option('wordstrap_theme_options');
	if ( !$wordstrap_theme_options ) {

            // Default Options
            $wordstrap_theme_options['landing_page_slideshow'] = 1;
            $wordstrap_theme_options['landing_page_intro'] = 0;
            $wordstrap_theme_options['landing_page_featured'] = 0;
            $wordstrap_theme_options['auth_system_display'] = 'nav';
            $wordstrap_theme_options['featured_num'] = 3;
            $wordstrap_theme_options['article_social'] = 1;
            $wordstrap_theme_options['excerpt_length'] = 40;
            $wordstrap_theme_options['widget_header_bg1'] = '#62A49B';
            $wordstrap_theme_options['widget_header_bg2'] = '#0A7466';
            $wordstrap_theme_options['intro_bg'] = '#FFFFFF';
            $wordstrap_theme_options['intro_h1'] = '#000';
            $wordstrap_theme_options['show_wslogo'] = 1;
            $wordstrap_theme_options['show_wstitle'] = 1;
            $wordstrap_theme_options['footer_show_social'] = 1;
            $wordstrap_theme_options['footer_displaycc'] = 1;
            $wordstrap_theme_options['ws_layout'] = '2cols-right';
            $wordstrap_theme_options['nav_excludelist'] = '';

            // Update
            add_option('wordstrap_theme_options', $wordstrap_theme_options);

        }
    }

    function add_options_page() {
        add_theme_page(__('Theme Options', 'wordstrap'), __('Theme Options', 'wordstrap'), 8, 'theme-options-page', array('wordstrap_theme_options_page', 'page'));
    }

    function page() {

        wp_enqueue_style ('bootstrap-css', get_stylesheet_directory_uri().'/inc/bootstrap/css/bootstrap.min.css');
        wp_enqueue_style ('theme-options-css', get_stylesheet_directory_uri().'/inc/theme-options.css');
        wp_enqueue_script ('theme-options-js', get_stylesheet_directory_uri().'/inc/js/theme-options.js');
        wp_enqueue_script ('bootstrap-js', get_stylesheet_directory_uri().'/inc/bootstrap/js/bootstrap.min.js');

        wp_enqueue_style( 'farbtastic' );
        wp_enqueue_script( 'farbtastic' );

        $wordstrap_theme_options = get_option('wordstrap_theme_options');

        /* SAVE OPTIONS */
        if (isset($_POST['submit'])) :
            // Check referer
            check_admin_referer('wordstrap_theme_options_page');

            $allowedhtml = array('a' => array('href' => array(),'title' => array()),'br' => array(),'i' => array(),'ul' => array('style'=>array()),'ol' => array('style'=>array()),'li' => array('style'=>array()),'em' => array(),'p' => array('style'=>array()),'strong' => array());

            // The options
            $wordstrap_theme_options['hide_adminbar'] = wp_kses($_POST['hide_adminbar'], NULL);
            $wordstrap_theme_options['hide_wsnavbar'] = wp_kses($_POST['hide_wsnavbar'], NULL);
            $wordstrap_theme_options['show_wstitle'] = wp_kses($_POST['show_wstitle'], NULL);
            $wordstrap_theme_options['show_wslogo'] = wp_kses($_POST['show_wslogo'], NULL);
            $wordstrap_theme_options['auth_system'] = wp_kses($_POST['auth_system'], NULL);
            $wordstrap_theme_options['auth_system_display'] = wp_kses($_POST['auth_system_display'], NULL);
            $wordstrap_theme_options['secure_wp'] = wp_kses($_POST['secure_wp'], NULL);
            $wordstrap_theme_options['landing_page_slideshow'] = wp_kses($_POST['landing_page_slideshow'], NULL);
            $wordstrap_theme_options['landing_page_intro'] = wp_kses($_POST['landing_page_intro'], NULL);
            $wordstrap_theme_options['landing_page_intro_id'] = wp_kses($_POST['landing_page_intro_id'], NULL);
            $wordstrap_theme_options['landing_page_intro_title'] = wp_kses($_POST['landing_page_intro_title'], NULL);
            $wordstrap_theme_options['landing_page_blog'] = wp_kses($_POST['landing_page_blog'], NULL);
            $wordstrap_theme_options['landing_page_featured'] = wp_kses($_POST['landing_page_featured'], NULL);
            $wordstrap_theme_options['landing_page_tabs'] = wp_kses($_POST['landing_page_tabs'], NULL);
            $wordstrap_theme_options['featured_cat'] = wp_kses($_POST['featured_cat'], NULL);
            $wordstrap_theme_options['featured_num'] = wp_kses($_POST['featured_num'], NULL);
            $wordstrap_theme_options['article_social'] = wp_kses($_POST['article_social'], NULL);
            $wordstrap_theme_options['excerpt_length'] = wp_kses($_POST['excerpt_length'], NULL);
            $wordstrap_theme_options['widget_header_bg1'] = wp_kses($_POST['widget_header_bg1'], NULL);
            $wordstrap_theme_options['widget_header_bg2'] = wp_kses($_POST['widget_header_bg2'], NULL);
            $wordstrap_theme_options['intro_bg'] = wp_kses($_POST['intro_bg'], NULL);
            $wordstrap_theme_options['intro_h1'] = wp_kses($_POST['intro_h1'], NULL);
            $wordstrap_theme_options['footer_show_fb'] = wp_kses($_POST['footer_show_fb'], NULL);
            $wordstrap_theme_options['footer_show_gp'] = wp_kses($_POST['footer_show_gp'], NULL);
            $wordstrap_theme_options['footer_show_tw'] = wp_kses($_POST['footer_show_tw'], NULL);
            $wordstrap_theme_options['footer_fb_url'] = wp_kses($_POST['footer_fb_url'], NULL);
            $wordstrap_theme_options['footer_gp_url'] = wp_kses($_POST['footer_gp_url'], NULL);
            $wordstrap_theme_options['footer_tw_url'] = wp_kses($_POST['footer_tw_url'], NULL);
            $wordstrap_theme_options['footer_text'] = wp_kses($_POST['footer_text'], $allowedhtml);
            $wordstrap_theme_options['footer_displaycc'] = wp_kses($_POST['footer_displaycc'], NULL);
            $wordstrap_theme_options['ws_layout'] = wp_kses($_POST['ws_layout'], NULL);
            $wordstrap_theme_options['nav_excludelist'] = serialize(wp_kses($_POST['nav_excludelist'], NULL));

            // Update
            $ret=update_option('wordstrap_theme_options', $wordstrap_theme_options);
            if ($ret) $updated=1;
            ?>

        <?php endif; ?>

        <div class="wrap">

            <?php screen_icon(); ?>

            <h2>
                <?php printf(__('%s Theme Options', 'wordstrap'), get_current_theme()); ?>
            </h2>

            <?php settings_errors(); ?>

            <hr>

            <form method="post" action="">

                <div class="ws-special-tabs tabbable tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#lA"><i class="icon-tint"></i> <?php _e('Appearance','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lB"><i class="icon-list-alt"></i> <?php _e('Articles','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lC"><i class="icon-lock"></i> <?php _e('Auth and Security','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lD"><i class="icon-arrow-down"></i> <?php _e('Footer Elements','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lE"><i class="icon-home"></i> <?php _e('Homepage Elements','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lF"><i class="icon-th-list"></i> <?php _e('Navigation','wordstrap'); ?></a></li>
                    </ul>
                    <div class="tab-content">


                        <div id="lA" class="tab-pane active">
                            <h3><?php _e('Appearance settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Customize the layout and colors','wordstrap'); ?></small></h3>
                            <hr>

                            <div class="row-fluid">
                                <div class="span6">
                                    <label for="WsLayout"><?php _e('Site Layout','wordstrap'); ?></label>
                                    <div class="clearfix">
                                        <div style="text-align: center; width: 100px; float: left;">
                                            <p style="text-align: center; margin-bottom: 0px;">
                                                <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/full-width.png'; ?>" >
                                            </p>
                                            <input type="radio" name="ws_layout" value="full-width" <?php if ($wordstrap_theme_options['ws_layout'] == 'full-width') echo 'checked="checked"'; ?>> <?php _e('Full width','wordstrap'); ?>
                                        </div>

                                        <div style="text-align: center; width: 100px; float: left;">
                                            <p style="text-align: center; margin-bottom: 0px;">
                                                <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/2cols-left.png'; ?>" >
                                            </p>
                                            <input type="radio" name="ws_layout" value="2cols-left" <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-left') echo 'checked="checked"'; ?>> <?php _e('2 cols left','wordstrap'); ?>
                                        </div>

                                        <div style="text-align: center; width: 100px; float: left;">
                                            <p style="text-align: center; margin-bottom: 0px;">
                                                <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/2cols-right.png'; ?>" >
                                            </p>
                                            <input type="radio" name="ws_layout" value="2cols-right" <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-right') echo 'checked="checked"'; ?>> <?php _e('2 cols right','wordstrap'); ?>
                                        </div>

                                        <div style="text-align: center; width: 100px; float: left;">
                                            <p style="text-align: center; margin-bottom: 0px;">
                                                <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/3cols.png'; ?>" >
                                            </p>
                                            <input type="radio" name="ws_layout" value="3cols" <?php if ($wordstrap_theme_options['ws_layout'] == '3cols') echo 'checked="checked"'; ?>> <?php _e('3 cols','wordstrap'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="span6">
                                    <label for="IntroContainer"><?php _e('Intro container background','wordstrap'); ?></label>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <p class="help-block">
                                                <?php _e('Background','wordstrap'); ?>
                                            </p>
                                            <input type="text" name="intro_bg" id="color-3" value="<?php if ($wordstrap_theme_options['intro_bg']) echo $wordstrap_theme_options['intro_bg']; else echo '#dadada'; ?>" style="width: 80px;" /><div style="position: absolute;" id="colorpicker-3"></div>
                                        </div>
                                        <div class="span3">
                                            <p class="help-block">
                                                <?php _e('Color','wordstrap'); ?>
                                            </p>
                                            <input type="text" name="intro_h1" id="color-4" value="<?php if ($wordstrap_theme_options['intro_h1']) echo $wordstrap_theme_options['intro_h1']; else echo '#dadada'; ?>" style="width: 80px;" /><div style="position: absolute;" id="colorpicker-4"></div>
                                        </div>
                                    </div>
                                    <br />
                                    <label for="WidgetHeaders"><?php _e('Widget headers background','wordstrap'); ?></label>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <p class="help-block">
                                                <?php _e('Start Color','wordstrap'); ?>
                                            </p>
                                            <input type="text" name="widget_header_bg1" id="color-1" value="<?php if ($wordstrap_theme_options['widget_header_bg1']) echo $wordstrap_theme_options['widget_header_bg1']; else echo '#dadada'; ?>" style="width: 80px;" /><div style="position: absolute;" id="colorpicker-1"></div>
                                        </div>

                                        <div class="span3">
                                            <p class="help-block">
                                                <?php _e('Ending Color','wordstrap'); ?>
                                            </p>
                                            <input type="text" name="widget_header_bg2" id="color-2" value="<?php if ($wordstrap_theme_options['widget_header_bg2']) echo $wordstrap_theme_options['widget_header_bg2']; else echo '#eeeeee'; ?>" style="width: 80px;" /><div style="position: absolute;" id="colorpicker-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="lB" class="tab-pane">
                            <h3><?php _e('Article settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Select how to display posts and article loops','wordstrap'); ?></small></h3>
                            <hr>
                            <p class="help-block">
                            <label for="ArticleSocial"><?php _e('Excerpt length in loops (number of words)','wordstrap'); ?></label>
                            <input type="text" name="excerpt_length" value="<?php echo $wordstrap_theme_options['excerpt_length']; ?>" maxlength="4" style="width: 40px;">
                            </p>

                            <p class="help-block">
                                <label for="ArticleSocial"><?php _e('Display social buttons in posts ?','wordstrap'); ?></label>
                                <input type="checkbox" name="article_social" <?php if ($wordstrap_theme_options['article_social'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Facebook, Google+ and Twitter like buttons','wordstrap'); ?>
                            </p>
                        </div>

                        <div id="lC" class="tab-pane">
                            <h3><?php _e('Auth and Security settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Login, Register, Forgot password and security features','wordstrap'); ?></small></h3>
                            <hr>

                            <label for="BackgroundColor"><?php _e('Use Wordstrap Auth system','wordstrap'); ?></label>
                            <p class="help-block" style="margin-bottom: 10px;">
                                <input id="auth_system_check" type="checkbox" name="auth_system" <?php if ($wordstrap_theme_options['auth_system'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Use a custom auth system to login, register and forget/reset pass procedures','wordstrap'); ?>
                            </p>
                            <div id="auth_system_box" class="alert alert-message ws-alert" <?php if ($wordstrap_theme_options['auth_system'] != 1) echo 'style="display: none;"'; ?>>
                                <label><?php _e('Display login form in:','wordstrap'); ?></label>
                                <select name="auth_system_display">
                                    <option value="" style="font-style: italic;"><?php _e('Select an area...','wordstrap'); ?></option>
                                    <option value="nav" <?php if ($wordstrap_theme_options['auth_system_display']=='nav') echo 'selected="selected"'; ?>>Nav Bar</option>
                                    <option value="left" <?php if ($wordstrap_theme_options['auth_system_display']=='left') echo 'selected="selected"'; ?>>Left sidebar</option>
                                    <option value="right" <?php if ($wordstrap_theme_options['auth_system_display']=='right') echo 'selected="selected"'; ?>>Right sidebar</option>
                                </select>
                            </div>
                            <label for="BackgroundColor"><?php _e('Secure wp-admin and wp-login','wordstrap'); ?></label>
                            <p class="help-block">
                                <input type="checkbox" name="secure_wp" <?php if ($wordstrap_theme_options['secure_wp'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Disable access to wp-admin and wp-login to all users until they are logged in','wordstrap'); ?>
                            </p>
                            <br />
                        </div>

                        <div id="lD" class="tab-pane">
                            <h3><?php _e('Footer Elements settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Customize the footer of your site','wordstrap'); ?></small></h3>
                            <hr>

                            <div class="row-fluid">
                                <div class="span4">
                                    <p>
                                        <label for="footer_show_social"><?php _e('Display social buttons','wordstrap'); ?></label>
                                    </p>
                                    <p class="help-block">
                                        <input type="checkbox" name="footer_show_fb" <?php if ($wordstrap_theme_options['footer_show_fb'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Facebook Button','wordstrap'); ?><br />
                                        <input type="text" name="footer_fb_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_fb_url']; ?>">
                                    </p>
                                    <p class="help-block">
                                        <input type="checkbox" name="footer_show_gp" <?php if ($wordstrap_theme_options['footer_show_gp'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Google+ Button','wordstrap'); ?><br />
                                        <input type="text" name="footer_gb_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_gp_url']; ?>">
                                    </p>
                                    <p class="help-block">
                                        <input type="checkbox" name="footer_show_tw" <?php if ($wordstrap_theme_options['footer_show_tw'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Twitter Button','wordstrap'); ?><br />
                                        <input type="text" name="footer_tw_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_tw_url']; ?>">
                                    </p><br />
                                    <p>
                                        <label for="footer_displaycc"><?php _e('Display Creative Commons logo','wordstrap'); ?>
                                        <input type="checkbox" name="footer_displaycc" <?php if ($wordstrap_theme_options['footer_displaycc'] == 1) echo 'checked="checked"'; ?> value="1">
                                        </label>
                                    </p>
                                </div>
                                <div class="span8">

                                    <label for="FooterText" style="float: left;"><?php _e('Footer text', 'wordstrap'); ?></label>
                                    <?php
                                    $editorsettings = array ('textarea_rows' => 10, 'media_buttons' => false, 'teeny' => true);
                                    wp_editor($wordstrap_theme_options['footer_text'],'footer_text', $editorsettings);
                                    ?>
                                    <br />

                                </div>
                            </div>

                        </div>

                        <div id="lE" class="tab-pane">
                            <h3><?php _e('Homepage Elements settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Select which elements will be displayed in the landing page.','wordstrap'); ?></small></h3>
                            <hr>                            

                            <p>
                                <input id="landing_page_intro_check" type="checkbox" name="landing_page_intro" <?php if ($wordstrap_theme_options['landing_page_intro'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Intro container','wordstrap'); ?>
                            </p>
                            <div id="landing_page_intro_box" class="alert alert-message ws-alert" <?php if ($wordstrap_theme_options['landing_page_intro'] != 1) echo 'style="display: none;"'; ?>>
                                <div class="row-fluid">
                                    <div class="span3">
                                        <label><?php _e('and use this page:','wordstrap'); ?></label>
                                        <?php $list_pages = get_pages(); ?>
                                        <select class="span2" name="landing_page_intro_id">
                                            <option value="" style="font-style: italic;"><?php _e('Select an item...','wordstrap'); ?></option>
                                            <?php foreach ($list_pages as $list) : ?>
                                                <option value="<?php echo $list->ID; ?>" <?php if ($wordstrap_theme_options['landing_page_intro_id'] == $list->ID) echo 'selected="selected"'; ?>><?php echo $list->post_title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="span9">
                                        <label><?php _e('Show page title','wordstrap'); ?></label>
                                        <input type="checkbox" name="landing_page_intro_title" <?php if ($wordstrap_theme_options['landing_page_intro_title'] == 1) echo 'checked="checked"'; ?> value="1">
                                    </div>
                                </div>
                            </div>
                            
                            <p>
                                <input type="checkbox" name="landing_page_slideshow" <?php if ($wordstrap_theme_options['landing_page_slideshow'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Slideshow','wordstrap'); ?>
                            </p>

                            <p>
                                <input id="landing_page_featured_check" type="checkbox" name="landing_page_featured" <?php if ($wordstrap_theme_options['landing_page_featured'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Featured items container','wordstrap'); ?>
                            </p>
                            <div id="landing_page_featured_box" class="alert alert-message ws-alert" <?php if ($wordstrap_theme_options['landing_page_featured'] != 1) echo 'style="display: none;"'; ?>>
                                <div class="row-fluid">
                                    <div class="span3">
                                        <label><?php _e('Number of items','wordstrap'); ?></label>
                                        <input type="text" name="featured_num" value="<?php echo $wordstrap_theme_options['featured_num']; ?>" class="span1" maxlength="2">
                                    </div>
                                    <div class="span9">
                                        <label><?php _e('Select category:','wordstrap'); ?></label>
                                        <select name="featured_cat">
                                            <option value="" style="font-style: italic;"><?php _e('Select a category...','wordstrap'); ?></option>
                                            <?php
                                            $cats = get_all_category_ids();
                                            foreach ($cats as $cat) :
                                                $term = get_term($cat, 'category');
                                                $sel=''; if ($term->slug == $wordstrap_theme_options['featured_cat']) $sel='selected="selected"';
                                                echo '<option value="'.$term->slug.'" '.$sel.'>'.$term->name.'</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <input type="checkbox" name="landing_page_tabs" <?php if ($wordstrap_theme_options['landing_page_tabs'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Tabs','wordstrap'); ?>
                            </p>
                            <p>
                                <input type="checkbox" name="landing_page_blog" <?php if ($wordstrap_theme_options['landing_page_blog'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Blog loop','wordstrap'); ?>
                            </p>
                        </div>

                        <div id="lF" class="tab-pane">
                            <h3><?php _e('Navigation settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Select the navigation elements','wordstrap'); ?></small></h3>
                            <hr>

                            <label for="AdminBar"><?php _e('Hide Wordpress admin bar','wordstrap'); ?></label>
                            <p class="help-block">
                                <input type="checkbox" name="hide_adminbar" <?php if ($wordstrap_theme_options['hide_adminbar'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Completely remove wordpress admin bar','wordstrap'); ?>
                            </p>
                            <br />
                            <label for="WsBar"><?php _e('Hide Wordstrap nav bar','wordstrap'); ?></label>
                            <p class="help-block">
                                <input type="checkbox" name="hide_wsnavbar" <?php if ($wordstrap_theme_options['hide_wsnavbar'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Do not display wordstrap nav bar','wordstrap'); ?>
                            </p>
                            <br />
                            <label for="WsTitle"><?php _e('Show Site title in nav bar','wordstrap'); ?></label>
                            <p class="help-block">
                                <input type="checkbox" name="show_wstitle" <?php if ($wordstrap_theme_options['show_wstitle'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display title in wordstrap nav bar','wordstrap'); ?>
                            </p>
                            <br />
                            <label for="WsLogo"><?php _e('Show Site logo in nav bar','wordstrap'); ?></label>
                            <p class="help-block">
                                <input type="checkbox" name="show_wslogo" <?php if ($wordstrap_theme_options['show_wslogo'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display logo in wordstrap nav bar','wordstrap'); ?>
                            </p>
                            <br />
                            <label for="WsLogo"><?php _e('Exclude pages','wordstrap'); ?></label>
                            <?php $list_pages = get_pages(); ?>
                            <select class="span2" name="nav_excludelist[]" multiple style="height: 80px;">
                                <option value="0" style="font-style: italic;"><?php _e('None','wordstrap'); ?></option>
                                <?php foreach ($list_pages as $list) : ?>
                                <option value="<?php echo $list->ID; ?>" <?php if (in_array($list->ID, unserialize($wordstrap_theme_options['nav_excludelist']))) echo 'selected="selected"'; ?>><?php echo $list->post_title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div><!-- .tab-content -->
                </div><!-- .tabbable -->

                <br />

                <button type="submit" class="btn btn-primary btn-large pull-left rightspace-normal" id="submit" name="submit"><i class="icon-ok-sign icon-white"></i> <?php _e('Save Changes','wordstrap'); ?></button>
                <?php if ($updated==1) : ?>
                    <div class="pull-left alert alert-success" style="margin-left: 20px; margin-top: 2px;"><a class="close" data-dismiss="alert">&times;</a><i class="icon-ok-sign"></i> <strong><?php _e('Theme options have been succesfully updated.', 'wordstrap'); ?></strong></div>
                <?php endif; ?>

                <?php wp_nonce_field( 'wordstrap_theme_options_page' ) ?>

            </form>

        </div><!-- .wrap -->

        <script type="text/javascript">
            jQuery(document).ready( function($) {

                $('#landing_page_featured_check').click(function(){
                    if ($(this).attr('checked')== 'checked')
                        $('#landing_page_featured_box').fadeIn();
                    else
                        $('#landing_page_featured_box').fadeOut();
                });

                $('#landing_page_intro_check').click(function(){
                    if ($(this).attr('checked')== 'checked')
                        $('#landing_page_intro_box').fadeIn();
                    else
                        $('#landing_page_intro_box').fadeOut();
                });

                $('#auth_system_check').click(function(){
                    if ($(this).attr('checked')== 'checked')
                        $('#auth_system_box').fadeIn();
                    else
                        $('#auth_system_box').fadeOut();
                });

            });
        </script>
    <?php }
}

add_action('init', array('wordstrap_theme_options_page', 'init'));

function wordstrap_style_options () {
    $wordstrap_theme_options = get_option('wordstrap_theme_options');
    echo '<style>
        .well-widgets .ws-widget-title {
            background-image: -moz-linear-gradient(center top , '.$wordstrap_theme_options['widget_header_bg1'].', '.$wordstrap_theme_options['widget_header_bg2'].');
            background: -webkit-gradient(linear, left top, left bottom, from('.$wordstrap_theme_options['widget_header_bg1'].'), to('.$wordstrap_theme_options['widget_header_bg2'].'));
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$wordstrap_theme_options['widget_header_bg1'].'\', endColorstr=\''.$wordstrap_theme_options['widget_header_bg2'].'\');
        }
        .well.well-intro {
            background: '.$wordstrap_theme_options['intro_bg'].' url(\''. get_stylesheet_directory_uri() .'/inc/imgs/noise1.png\') repeat;
        }
        .well.well-intro h1 {
            color: '.$wordstrap_theme_options['intro_h1'].';
        }
    </style>';
}
add_action ('wp_head', 'wordstrap_style_options');