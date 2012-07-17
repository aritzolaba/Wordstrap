<?php
/**
 * The theme options page in wp-admin
 *
 * @package WordStrap
 * @subpackage ThemeOptions
 * @since Wordstrap 1.6.4
 */
class wordstrap_theme_options_page {

    function init() {

        // Add menu
        add_action('admin_menu', array('wordstrap_theme_options_page', 'add_wordstrap_options_page'));

        // Initialize default options
        $def_theme_options = array();
        $def_theme_options['header_height'] = 32;
        $def_theme_options['hide_wsheader'] = 0;
        $def_theme_options['hide_wsnavbar'] = 0;
        $def_theme_options['show_wstitle_nav'] = 1;
        $def_theme_options['nav_fixed'] = 0;
        $def_theme_options['use_googlefonts'] = 0;
        $def_theme_options['use_googlefonts_widgets'] = 1;
        $def_theme_options['use_googlefonts_posts'] = 1;
        $def_theme_options['use_googlefonts_pages'] = 1;
        $def_theme_options['google_analytics'] = '';
        $def_theme_options['google_font'] = 'Oxygen';
        $def_theme_options['ws_layout'] = '2cols-right';
        $def_theme_options['article_social'] = 0;
        $def_theme_options['excerpt_length'] = 40;
        $def_theme_options['widget_header_bg1'] = '#62A49B';
        $def_theme_options['widget_header_bg2'] = '#0A7466';
        $def_theme_options['intro_bg'] = '#eee';
        $def_theme_options['intro_color'] = '#000';
        $def_theme_options['footer_title1'] = 'About';
        $def_theme_options['footer_title2'] = 'Follow us';
        $def_theme_options['footer_text'] = 'Powered by Wordstrap';
        $def_theme_options['footer_displaycc'] = 0;
        $def_theme_options['footer_show_fb'] = 0;
        $def_theme_options['footer_show_tw'] = 0;
        $def_theme_options['footer_show_gp'] = 0;
        $def_theme_options['footer_show_git'] = 0;
        $def_theme_options['footer_show_yt'] = 0;
        $def_theme_options['footer_show_li'] = 0;
        $def_theme_options['footer_fb_url'] = '';
        $def_theme_options['footer_tw_url'] = '';
        $def_theme_options['footer_gp_url'] = '';
        $def_theme_options['footer_git_url'] = '';
        $def_theme_options['footer_yt_url'] = '';
        $def_theme_options['footer_li_url'] = '';
        $def_theme_options['landing_page_intro'] = 0;
        $def_theme_options['landing_page_intro_id'] = NULL;
        $def_theme_options['landing_page_intro_title'] = 1;
        $def_theme_options['landing_page_tabs'] = 0;
        $def_theme_options['landing_page_blog'] = 1;
        $def_theme_options['landing_page_featured'] = 0;
        $def_theme_options['landing_page_featured_title'] = __('Featured', 'wordstrap');
        $def_theme_options['featured_cat'] = NULL;
        $def_theme_options['featured_num'] = 3;

        // Get current Options
        $wordstrap_theme_options = get_option('wordstrap_theme_options');

        // If there are options already
        if ( $wordstrap_theme_options ) {
            // Check array sizes, to detect if new options have been updated
            // or removed and if so, delete options first and set defaults
            $cur_size = sizeof($wordstrap_theme_options);
            $def_size = sizeof($def_theme_options);
            if ($def_size!=$cur_size) {
                delete_option('wordstrap_theme_options');
                add_option('wordstrap_theme_options', $def_theme_options);
            }
        } else
            // Add default options
            add_option('wordstrap_theme_options', $def_theme_options);
    }

    function add_wordstrap_options_page() {
        add_theme_page(__('Theme Options', 'wordstrap'), __('Theme Options', 'wordstrap'), 'edit_theme_options', 'theme-options-page', array('wordstrap_theme_options_page', 'page'));
    }

    function page() {
        wp_enqueue_style ('bootstrap-css', get_stylesheet_directory_uri().'/inc/bootstrap/css/bootstrap.min.css');
        wp_enqueue_style ('theme-options-css', get_stylesheet_directory_uri().'/inc/theme-options.css');
        wp_enqueue_script ('theme-options-js', get_stylesheet_directory_uri().'/inc/js/theme-options.js');
        wp_enqueue_script ('bootstrap-js', get_stylesheet_directory_uri().'/inc/bootstrap/js/bootstrap.min.js');
        wp_enqueue_style( 'farbtastic' ); // colorpicker
        wp_enqueue_script( 'farbtastic' ); // colorpicker

        // Get options
        $wordstrap_theme_options = get_option('wordstrap_theme_options');

        // GOOGLE FONT LIST
        $googlefonts = array (
            'Averia Libre'  => 'Averia+Libre',
            'Days One'      => 'Days+One',
            'Iceberg'       => 'Iceberg',
            'Metamorphous'  => 'Metamorphous',
            'Oxygen'        => 'Oxygen',
            'Russo One'     => 'Russo+One',
            'Nova Square'   => 'Nova+Square',
        );

        // SAVE OPTIONS
        if (isset($_POST['submit'])) :
            // Check referer
            check_admin_referer('wordstrap_theme_options_page');

            $allowedhtml = array('a' => array('href' => array(),'title' => array()),'br' => array(),'i' => array(),'ul' => array('style'=>array()),'ol' => array('style'=>array()),'li' => array('style'=>array()),'em' => array(),'p' => array('style'=>array()),'strong' => array());

            // Obtain all $_POST values and make sure unchecked options are
            // saved with a 0 value. Also check nav_excludelist is serialized and
            // footer_text has allowed html.
            foreach ($wordstrap_theme_options as $k => $v) {
                if (isset($_POST[$k])) {
                    if ($k == 'nav_excludelist')
                        $wordstrap_theme_options[$k] = serialize(wp_kses($_POST[$k], NULL));
                    elseif ($k == 'footer_text')
                        $wordstrap_theme_options[$k] = wp_kses($_POST[$k], $allowedhtml);
                    elseif ($k == 'google_analytics' && wp_kses($_POST[$k], NULL) != '') {
                        $wordstrap_theme_options[$k] = '<script>' . wp_kses($_POST[$k], NULL) .'</script>';
                    }
                    else
                        $wordstrap_theme_options[$k] = wp_kses($_POST[$k], NULL);
                }
                else {
                    if ($k == 'nav_excludelist')
                        $wordstrap_theme_options[$k] = serialize(array());
                    else
                        $wordstrap_theme_options[$k] = 0;
                }
            }

            // Update
            $ret=update_option('wordstrap_theme_options', $wordstrap_theme_options);
            if ($ret) $updated=1;
            ?>

        <?php endif; ?>

        <div class="wrap">

            <?php screen_icon(); ?>

            <h2>
                <?php printf(__('%s Theme Options', 'wordstrap'), wp_get_theme()); ?>
            </h2>

            <?php settings_errors(); ?>

            <br />

            <form method="post" action="">

                <div class="ws-special-tabs tabbable tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#lA"><i class="icon-tint"></i> <?php _e('Appearance','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lB"><i class="icon-list-alt"></i> <?php _e('Articles','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lC"><i class="icon-lock"></i> <?php _e('Extras','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lD"><i class="icon-arrow-down"></i> <?php _e('Footer Elements','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lE"><i class="icon-home"></i> <?php _e('Homepage Elements','wordstrap'); ?></a></li>
                    </ul>
                    <div class="tab-content">


                        <div id="lA" class="tab-pane active">
                            <h3><?php _e('Appearance settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Customize the layout and colors','wordstrap'); ?></small></h3>
                            <hr>

                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="clearfix">
                                        <label for="WsLayout"><?php _e('Site Layout','wordstrap'); ?></label>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <label for="ws_layout_1" class="checkbox ws-check <?php if ($wordstrap_theme_options['ws_layout'] == 'full-width') echo 'active'; ?>">
                                                    <p style="text-align: center; margin-bottom: 0px;">
                                                        <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/full-width.png'; ?>" >
                                                    </p>
                                                    <input class="ws-check-radio" id="ws_layout_1" type="radio" name="ws_layout" value="full-width" <?php if ($wordstrap_theme_options['ws_layout'] == 'full-width') echo 'checked="checked"'; ?>> <?php _e('Full width','wordstrap'); ?>
                                                </label>
                                            </div>

                                            <div class="span6">
                                                <label for="ws_layout_2" class="checkbox ws-check <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-left') echo 'active'; ?>"">
                                                    <p style="text-align: center; margin-bottom: 0px;">
                                                        <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/2cols-left.png'; ?>" >
                                                    </p>
                                                    <input class="ws-check-radio" id="ws_layout_2" type="radio" name="ws_layout" value="2cols-left" <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-left') echo 'checked="checked"'; ?>> <?php _e('2 cols left','wordstrap'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row-fluid" style="margin-top: 10px;">
                                            <div class="span6">
                                                <label for="ws_layout_3" class="checkbox ws-check <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-right') echo 'active'; ?>"">
                                                    <p style="text-align: center; margin-bottom: 0px;">
                                                        <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/2cols-right.png'; ?>" >
                                                    </p>
                                                    <input class="ws-check-radio" id="ws_layout_3" type="radio" name="ws_layout" value="2cols-right" <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-right') echo 'checked="checked"'; ?>> <?php _e('2 cols right','wordstrap'); ?>
                                                </label>
                                            </div>

                                            <div class="span6">
                                                <label for="ws_layout_4" class="checkbox ws-check <?php if ($wordstrap_theme_options['ws_layout'] == '3cols') echo 'active'; ?>"">
                                                    <p style="text-align: center; margin-bottom: 0px;">
                                                        <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/3cols.png'; ?>" >
                                                    </p>
                                                    <input class="ws-check-radio" id="ws_layout_4" type="radio" name="ws_layout" value="3cols" <?php if ($wordstrap_theme_options['ws_layout'] == '3cols') echo 'checked="checked"'; ?>> <?php _e('3 cols','wordstrap'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="clearfix">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <label for="WsHeader"><?php _e('Header options','wordstrap'); ?></label>
                                                <label class="checkbox" for="hide_wsheader" style="font-weight: normal; color: #999;"><?php _e('Hide Header','wordstrap'); ?>
                                                    <input type="checkbox" id="hide_wsheader" name="hide_wsheader" <?php if ($wordstrap_theme_options['hide_wsheader'] == 1) echo 'checked="checked"'; ?> value="1">
                                                </label>
                                                <div id ="header_height_box" <?php if ($wordstrap_theme_options['hide_wsheader'] == 1) echo 'style="display: none;"'; ?>>
                                                    <p class="help-block" style="font-weight: normal; color: #999;">
                                                    <input type="text" name="header_height" value="<?php echo $wordstrap_theme_options['header_height']; ?>" class="span1" maxlength="2">
                                                    <?php _e('Header Height','wordstrap'); ?>
                                                    </p>
                                                </div>
                                                <br />
                                                <label for="WsHeader"><?php _e('Navbar options','wordstrap'); ?></label>

                                                <label class="checkbox" style="font-weight: normal; color: #999;" for="hide_wsnavbar"><?php _e('Hide Nav bar','wordstrap'); ?>
                                                    <input type="checkbox" id="hide_wsnavbar" name="hide_wsnavbar" <?php if ($wordstrap_theme_options['hide_wsnavbar'] == 1) echo 'checked="checked"'; ?> value="1">
                                                </label>

                                                <label class="checkbox" style="font-weight: normal; color: #999;" for="nav_fixed"><?php _e('Fixed Navbar','wordstrap'); ?>
                                                    <input type="checkbox" id="nav_fixed" name="nav_fixed" <?php if ($wordstrap_theme_options['nav_fixed'] == 1) echo 'checked="checked"'; ?> value="1">
                                                </label>

                                                <label class="checkbox" style="font-weight: normal; color: #999;" for="show_wstitle_nav"><?php _e('Show Site title in nav bar','wordstrap'); ?>
                                                    <input type="checkbox" id="show_wstitle_nav" name="show_wstitle_nav" <?php if ($wordstrap_theme_options['show_wstitle_nav'] == 1) echo 'checked="checked"'; ?> value="1">
                                                </label>
                                                <br />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="clearfix">
                                    <label for="IntroContainer"><?php _e('Intro container','wordstrap'); ?></label>
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <p class="help-block">
                                                <?php _e('Background','wordstrap'); ?>
                                            </p>
                                            <input class="span2" type="text" name="intro_bg" id="color-3" value="<?php if ($wordstrap_theme_options['intro_bg']) echo $wordstrap_theme_options['intro_bg']; else echo '#dadada'; ?>" /><div style="position: absolute;" id="colorpicker-3"></div>
                                        </div>
                                        <div class="span6">
                                            <p class="help-block">
                                                <?php _e('Text','wordstrap'); ?>
                                            </p>
                                            <input class="span2" type="text" name="intro_color" id="color-4" value="<?php if ($wordstrap_theme_options['intro_color']) echo $wordstrap_theme_options['intro_color']; else echo '#dadada'; ?>" /><div style="position: absolute;" id="colorpicker-4"></div>
                                        </div>
                                    </div>
                                    <br />
                                    <label for="WidgetHeaders"><?php _e('Widget headers background','wordstrap'); ?></label>
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <p class="help-block">
                                                <?php _e('Start Color','wordstrap'); ?>
                                            </p>
                                            <input class="span2" type="text" name="widget_header_bg1" id="color-1" value="<?php if ($wordstrap_theme_options['widget_header_bg1']) echo $wordstrap_theme_options['widget_header_bg1']; else echo '#dadada'; ?>" /><div style="position: absolute;" id="colorpicker-1"></div>
                                        </div>

                                        <div class="span6">
                                            <p class="help-block">
                                                <?php _e('Ending Color','wordstrap'); ?>
                                            </p>
                                            <input class="span2" type="text" name="widget_header_bg2" id="color-2" value="<?php if ($wordstrap_theme_options['widget_header_bg2']) echo $wordstrap_theme_options['widget_header_bg2']; else echo '#eeeeee'; ?>" /><div style="position: absolute;" id="colorpicker-2"></div>
                                        </div>
                                    </div>
                                    <br />
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
                                <label for="article_social"><?php _e('Display social buttons in posts ?','wordstrap'); ?></label>
                                <input type="checkbox" id="article_social" name="article_social" <?php if ($wordstrap_theme_options['article_social'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Facebook, Google+ and Twitter like buttons','wordstrap'); ?>
                            </p>
                        </div>

                        <div id="lC" class="tab-pane">
                            <h3><?php _e('Extras','wordstrap'); ?></h3>
                            <h3><small><?php _e('Some extra functionalities','wordstrap'); ?></small></h3>
                            <hr>

                            <div class="row-fluid">
                                <div class="span12">
                                    <p class="help-block">
                                        <label class="checkbox" for="googlefonts_check"><?php _e('Use Google API Fonts ?','wordstrap'); ?>
                                            <input id="googlefonts_check" type="checkbox" name="use_googlefonts" <?php if ($wordstrap_theme_options['use_googlefonts'] == 1) echo 'checked="checked"'; ?> value="1">
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="row-fluid" <?php if ($wordstrap_theme_options['use_googlefonts'] != 1) echo 'style="display: none;"'; ?> id="googlefonts_box">
                                <div class="span4">
                                    <p class="help-block">
                                    <?php _e('Choose a font','wordstrap'); ?>
                                        </p>
                                    <select name="google_font" style="width: 160px;">
                                        <?php foreach ($googlefonts as $font_name => $font_val) : ?>
                                            <?php $sel= '';
                                            if ($font_val == $wordstrap_theme_options['google_font']) $sel='selected="selected"';
                                            echo '<option value="'.$font_val.'" '.$sel.'>'.$font_name.'</option>';
                                            ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="span8">
                                    <label class="checkbox" for="use_googlefonts_widgets"><?php _e('In widget titles','wordstrap'); ?>
                                    <input id="use_googlefonts_widgets" type="checkbox" name="use_googlefonts_widgets" <?php if ($wordstrap_theme_options['use_googlefonts_widgets'] == 1) echo 'checked="checked"'; ?> value="1">
                                    </label>
                                    <label class="checkbox" for="use_googlefonts_posts"><?php _e('In post titles','wordstrap'); ?>
                                        <input id="use_googlefonts_posts" type="checkbox" name="use_googlefonts_posts" <?php if ($wordstrap_theme_options['use_googlefonts_posts'] == 1) echo 'checked="checked"'; ?> value="1">
                                    </label>
                                    <label class="checkbox" for="use_googlefonts_pages"><?php _e('In page titles','wordstrap'); ?>
                                        <input id="use_googlefonts_pages" type="checkbox" name="use_googlefonts_pages" <?php if ($wordstrap_theme_options['use_googlefonts_pages'] == 1) echo 'checked="checked"'; ?> value="1">
                                    </label>
                                </div>
                            </div>
                            <br />

                            <label for="google_analytics"><?php _e('Google Analytics code','wordstrap'); ?></label>
                            <textarea name="google_analytics" style="width: 350px; height: 100px;"><?php if ($wordstrap_theme_options['google_analytics'] != '') echo str_replace('\\','',$wordstrap_theme_options['google_analytics']); ?></textarea>
                            <br />
                        </div>

                        <div id="lD" class="tab-pane">
                            <h3><?php _e('Footer Elements settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Customize the footer of your site','wordstrap'); ?></small></h3>
                            <hr>

                            <div class="row-fluid">
                                <div class="span8">

                                    <label for="FooterTitle"><?php _e('Footer Title', 'wordstrap'); ?></label>
                                    <input type="text" class="span5" name="footer_title1" value="<?php if (isset($wordstrap_theme_options['footer_title1'])) echo $wordstrap_theme_options['footer_title1']; ?>">
                                    <br />
                                    <label for="FooterTitleSocial"><?php _e('Footer Title Social', 'wordstrap'); ?></label>
                                    <input type="text" class="span5" name="footer_title2" value="<?php if (isset($wordstrap_theme_options['footer_title2'])) echo $wordstrap_theme_options['footer_title2']; ?>">
                                    <br />
                                    <label for="FooterText" style="float: left;"><?php _e('Footer text', 'wordstrap'); ?></label>
                                    <?php
                                    $editorsettings = array ('textarea_rows' => 10, 'media_buttons' => false, 'teeny' => true);
                                    wp_editor($wordstrap_theme_options['footer_text'],'footer_text', $editorsettings);
                                    ?>
                                    <br />
                                </div>
                                <div class="span4">

                                    <p><strong><?php _e('Social buttons','wordstrap'); ?></strong></p>

                                        <label for="footer_show_fb" class="checkbox" style="margin-bottom: 5px;"><input style="visibility: hidden;" rel="fb" type="checkbox" id="footer_show_fb" class="social_buttons_check" name="footer_show_fb" <?php if ($wordstrap_theme_options['footer_show_fb'] == 1) echo 'checked="checked"'; ?> value="1">
                                        <div class="buttons_container fb_button" <?php if ($wordstrap_theme_options['footer_show_fb'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_fb.png'; ?>" title="Facebook" alt="Facebook" /></div><?php _e('Show Facebook Button','wordstrap'); ?></label>
                                        <input type="text" name="footer_fb_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_fb_url']; ?>"><br />

                                        <label for="footer_show_gp" class="checkbox" style="margin-bottom: 5px;"><input style="visibility: hidden;" rel="gp" type="checkbox" id="footer_show_gp" class="social_buttons_check" name="footer_show_gp" <?php if ($wordstrap_theme_options['footer_show_gp'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Show Google+ Button','wordstrap'); ?>
                                        <div class="buttons_container gp_button" <?php if ($wordstrap_theme_options['footer_show_gp'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_gp.png'; ?>" title="Google+" alt="Google+" /></div></label>
                                        <input type="text" name="footer_gp_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_gp_url']; ?>"><br />

                                        <label for="footer_show_tw" class="checkbox" style="margin-bottom: 5px;"><input style="visibility: hidden;" rel="tw" type="checkbox" id="footer_show_tw" class="social_buttons_check" name="footer_show_tw" <?php if ($wordstrap_theme_options['footer_show_tw'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Show Twitter Button','wordstrap'); ?>
                                        <div class="buttons_container tw_button" <?php if ($wordstrap_theme_options['footer_show_tw'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_tw.png'; ?>" title="Twitter" alt="Twitter" /></div></label>
                                        <input type="text" name="footer_tw_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_tw_url']; ?>"><br />

                                        <label for="footer_show_li" class="checkbox" style="margin-bottom: 5px;"><input style="visibility: hidden;" rel="li" type="checkbox" id="footer_show_li" class="social_buttons_check" name="footer_show_li" <?php if ($wordstrap_theme_options['footer_show_li'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Show Linkedin Button','wordstrap'); ?>
                                        <div class="buttons_container li_button" <?php if ($wordstrap_theme_options['footer_show_li'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_li.png'; ?>" title="LinkedIn" alt="LinkedIn" /></div></label>
                                        <input type="text" name="footer_li_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_li_url']; ?>"><br />

                                        <label for="footer_show_git" class="checkbox" style="margin-bottom: 5px;"><input style="visibility: hidden;" rel="git" type="checkbox" id="footer_show_git" class="social_buttons_check" name="footer_show_git" <?php if ($wordstrap_theme_options['footer_show_git'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Show GitHub Button','wordstrap'); ?>
                                        <div class="buttons_container git_button" <?php if ($wordstrap_theme_options['footer_show_git'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_git.png'; ?>" title="GitHub" alt="GitHub" /></div></label>
                                        <input type="text" name="footer_git_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_git_url']; ?>"><br />

                                        <label for="footer_show_yt" class="checkbox" style="margin-bottom: 5px;"><input style="visibility: hidden;" rel="yt" type="checkbox" id="footer_show_yt" class="social_buttons_check" name="footer_show_yt" <?php if ($wordstrap_theme_options['footer_show_yt'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Show YouTube Button','wordstrap'); ?>
                                        <div class="buttons_container yt_button" <?php if ($wordstrap_theme_options['footer_show_yt'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_yt.png'; ?>" title="YouTube" alt="YouTube" /></div></label>
                                        <input type="text" name="footer_yt_url" class="span2" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_yt_url']; ?>"><br />

                                        <p style="margin-top: 10px;">
                                        <label class="checkbox" for="footer_displaycc"><?php _e('Display Creative Commons logo','wordstrap'); ?>
                                        <input type="checkbox" id="footer_displaycc" name="footer_displaycc" <?php if ($wordstrap_theme_options['footer_displaycc'] == 1) echo 'checked="checked"'; ?> value="1">
                                        </label>
                                    </p>

                                </div>
                            </div>

                        </div>

                        <div id="lE" class="tab-pane">
                            <h3><?php _e('Homepage Elements settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Select which elements will be displayed in the landing page.','wordstrap'); ?></small></h3>
                            <hr>

                            <label class="checkbox" for="landing_page_intro_check">
                                <input id="landing_page_intro_check" type="checkbox" name="landing_page_intro" <?php if ($wordstrap_theme_options['landing_page_intro'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Intro container','wordstrap'); ?>
                            </label>
                            <div id="landing_page_intro_box" class="alert alert-message ws-alert" <?php if ($wordstrap_theme_options['landing_page_intro'] != 1) echo 'style="display: none; margin-top: 10px;"'; else echo 'style="margin-top: 10px;"'; ?>>
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
                                        <label class="checkbox" for="landing_page_intro_title" ><?php _e('Show page title','wordstrap'); ?>
                                            <input type="checkbox" id="landing_page_intro_title" name="landing_page_intro_title" <?php if ($wordstrap_theme_options['landing_page_intro_title'] == 1) echo 'checked="checked"'; ?> value="1">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <label class="checkbox" for="landing_page_featured_check">
                                <input type="checkbox" id="landing_page_featured_check" name="landing_page_featured" <?php if ($wordstrap_theme_options['landing_page_featured'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Featured items container','wordstrap'); ?>
                            </label>
                            <div id="landing_page_featured_box" class="alert alert-message ws-alert" <?php if ($wordstrap_theme_options['landing_page_featured'] != 1) echo 'style="display: none; margin-top: 10px;"'; else echo 'style="margin-top: 10px;"'; ?>>
                                <div class="row-fluid">
                                    <div class="span2">
                                        <label><?php _e('Number','wordstrap'); ?></label>
                                        <input type="text" name="featured_num" value="<?php echo $wordstrap_theme_options['featured_num']; ?>" class="span1" maxlength="2">
                                    </div>
                                    <div class="span4">
                                        <label><?php _e('Select category:','wordstrap'); ?></label>
                                        <select name="featured_cat" class="span2">
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
                                        <br />
                                    </div>
                                    <div class="span6">
                                        <label for="landing_page_featured_title"><?php _e('Title','wordstrap'); ?></label>
                                        <input type="text" name="landing_page_featured_title" class="span3" value="<?php echo $wordstrap_theme_options['landing_page_featured_title']; ?>">
                                    </div>
                                </div>
                            </div>
                            <label class="checkbox" for="landing_page_tabs">
                                <input type="checkbox" id="landing_page_tabs" name="landing_page_tabs" <?php if ($wordstrap_theme_options['landing_page_tabs'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Tabs','wordstrap'); ?>
                            </label>
                            <label class="checkbox" for="landing_page_blog">
                                <input type="checkbox" id="landing_page_blog" name="landing_page_blog" <?php if ($wordstrap_theme_options['landing_page_blog'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Blog loop','wordstrap'); ?>
                            </label>
                        </div>

                    </div><!-- .tab-content -->
                </div><!-- .tabbable -->

                <br />

                <button type="submit" class="btn btn-primary btn-large pull-left rightspace-normal" id="submit" name="submit"><i class="icon-ok-sign icon-white"></i> <?php _e('Save Changes','wordstrap'); ?></button>
                <?php if (isset($updated) && $updated==1) : ?>
                    <div class="pull-left alert alert-success" style="margin-left: 20px; margin-top: 2px;"><a class="close" data-dismiss="alert">&times;</a><i class="icon-ok-sign"></i> <strong><?php _e('Theme options have been succesfully updated.', 'wordstrap'); ?></strong></div>
                <?php endif; ?>

                <?php wp_nonce_field( 'wordstrap_theme_options_page' ) ?>

            </form>

        </div><!-- .wrap -->
    <?php }
}
add_action('init', array('wordstrap_theme_options_page', 'init'));