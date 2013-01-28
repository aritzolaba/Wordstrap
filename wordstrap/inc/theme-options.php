<?php
/**
 * The theme options page in wp-admin
 */
class wordstrap_theme_options_page {

    function init() {

        // Add menu
        add_action('admin_menu', array('wordstrap_theme_options_page', 'add_wordstrap_options_page'));

        // Initialize default options
        $def_theme_options = array();
        $def_theme_options['tabs_first'] = 'latest';
        $def_theme_options['tabs_second'] = '';
        $def_theme_options['tabs_third'] = '';
        $def_theme_options['tabs_fourth'] = '';
        $def_theme_options['tabs_first_cat'] = '';
        $def_theme_options['tabs_second_cat'] = '';
        $def_theme_options['tabs_third_cat'] = '';
        $def_theme_options['tabs_fourth_cat'] = '';
        $def_theme_options['style'] = 'default';
        $def_theme_options['ws_spancol_left'] = 3;
        $def_theme_options['ws_spancol_right'] = 3;
        $def_theme_options['header_height'] = 32;
        $def_theme_options['hide_wsheader'] = 0;
        $def_theme_options['hide_wsnavbar'] = 0;
        $def_theme_options['hide_wsbreadcrumb'] = 0;
        $def_theme_options['show_wstitle_nav'] = 0;
        $def_theme_options['show_wssearch_nav'] = 0;
        $def_theme_options['show_home_nav'] = 1;
        $def_theme_options['show_wssearch_header'] = 1;
        $def_theme_options['nav_fixed'] = 0;
        $def_theme_options['use_googlefonts'] = 1;
        $def_theme_options['use_googlefonts_widgets'] = 1;
        $def_theme_options['use_googlefonts_posts'] = 1;
        $def_theme_options['use_googlefonts_pages'] = 1;
        $def_theme_options['google_analytics'] = '';
        $def_theme_options['google_font'] = 'Oxygen';
        $def_theme_options['ws_layout'] = '2cols-right';
        $def_theme_options['article_social'] = 0;
        $def_theme_options['widget_header_bg1'] = '#333333';
        $def_theme_options['widget_header_bg2'] = '#222222';
        $def_theme_options['widget_header_color'] = '#FAFAFA';
        $def_theme_options['navbar_bg1'] = '#333333';
        $def_theme_options['navbar_bg2'] = '#222222';
        $def_theme_options['navbar_color'] = '#aaaaaa';
        $def_theme_options['header_bg1'] = '#FAFAFA';
        $def_theme_options['header_bg2'] = '#C0C0C0';
        $def_theme_options['header_color'] = '#333333';
        $def_theme_options['intro_bg'] = '#eee';
        $def_theme_options['intro_color'] = '#000';
        $def_theme_options['footer_title1'] = __('About','wordstrap');
        $def_theme_options['footer_title2'] = __('Follow us','wordstrap');
        $def_theme_options['footer_text'] = __('Powered by Wordstrap','wordstrap');
        $def_theme_options['footer_displaycc'] = 1;
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
        $def_theme_options['landing_page_intro_id'] = '';
        $def_theme_options['landing_page_intro_title'] = 1;
        $def_theme_options['landing_page_tabs'] = 0;
        $def_theme_options['landing_page_blog'] = 1;
        $def_theme_options['landing_page_featured'] = 0;
        $def_theme_options['landing_page_featured_title'] = __('Featured', 'wordstrap');
        $def_theme_options['landing_page_featured_title_color'] = '#ffffff';
        $def_theme_options['featured_cat'] = '';
        $def_theme_options['featured_num'] = 3;

        // Get current Options
        global $wordstrap_theme_options;

        // This part is for theme updates, to ensure options are stored
        // properly in wp-config.

        // If there are options already, check if there are new options or
        // if any option has been deleted in a theme update, updating
        // the options array without loosing the current configuration
        if (is_array($wordstrap_theme_options) && count($wordstrap_theme_options)>1) {

            $cur_size = count($wordstrap_theme_options);
            $def_size = count($def_theme_options);
            if ($def_size!=$cur_size) {
                // Check for new options
                foreach ($def_theme_options as $def_key => $def_value) :
                    if (!isset($wordstrap_theme_options[$def_key])) {
                        $wordstrap_theme_options[$def_key] = $def_value;
                    }
                endforeach;

                // Check for deleted options
                foreach ($wordstrap_theme_options as $cur_key => $cur_value) :
                    if (!isset($def_theme_options[$cur_key])) {
                        unset ($wordstrap_theme_options[$cur_key]);
                    }
                endforeach;

                delete_option('wordstrap_theme_options');
                add_option('wordstrap_theme_options', $wordstrap_theme_options);
            }
        } else {
            // Update options with defaults
            $wordstrap_theme_options = $def_theme_options;
            // Add default options to db
            add_option('wordstrap_theme_options', $def_theme_options);
        }
    }

    function add_wordstrap_options_page() {
        add_theme_page(__('Theme Options', 'wordstrap'), __('Theme Options', 'wordstrap'), 'edit_theme_options', 'theme-options-page', array('wordstrap_theme_options_page', 'page'));
    }

    function page() {
        wp_enqueue_style ('bootstrap-css', get_stylesheet_directory_uri().'/inc/bootstrap/css/bootstrap.min.css');
        wp_enqueue_script ('bootstrap-js', get_stylesheet_directory_uri().'/inc/bootstrap/js/bootstrap.min.js');
        wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css', array() );
        wp_enqueue_script ('theme-options-js', get_stylesheet_directory_uri().'/inc/js/theme-options.js');
        wp_enqueue_style ('theme-options-css', get_stylesheet_directory_uri().'/inc/theme-options.css');
        wp_enqueue_script ('farbtastic'); // colorpicker
        wp_enqueue_style ('farbtastic'); // colorpicker

        // Get options
        global $wordstrap_theme_options;

        // GOOGLE FONT LIST
        $googlefonts = array (
            'Averia Libre',
            'Capriola',
            'Chivo',
            'Days One',
            'Domine',
            'Dosis',
            'Electrolize',
            'Iceberg',
            'Karla',
            'Maven Pro',
            'Metamorphous',
            'Monda',
            'Noticia Text',
            'Nova Square',
            'Oxygen',
            'Pirata One',
            'Raleway',
            'Russo One',
            'Share',
            'Quando',
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

            <?php ws_print_donate_button(); ?>

            <?php screen_icon(); ?>

            <h2>
                <?php printf(__('%s Theme Options', 'wordstrap'), wp_get_theme()); ?>
            </h2>

            <?php settings_errors(); ?>

            <br />

            <form style="margin-bottom: 0px;" method="post" action="">

                <div class="ws-special-tabs tabbable tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#lA"><i class="icon-tint" style="display:inline-block;"></i> <?php _e('Appearance','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lB"><i class="icon-gift" style="display:inline-block;"></i> <?php _e('Extras','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lC"><i class="icon-arrow-down" style="display:inline-block;"></i> <?php _e('Footer','wordstrap'); ?></a></li>
                        <li><a data-toggle="tab" href="#lD"><i class="icon-home" style="display:inline-block;"></i> <?php _e('Front page','wordstrap'); ?></a></li>
                    </ul>
                    <div class="tab-content">

                        <div id="lA" class="tab-pane active">
                            <h3><?php _e('Appearance settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Customize the layout and colors','wordstrap'); ?></small></h3>
                            <hr>

                            <div class="row-fluid">
                                <div class="span5">
                                    <div class="clearfix">
                                        <label for="WsLayout"><h4><?php _e('Layout','wordstrap'); ?></h4></label>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <label for="ws_layout_1" rel="SidebarWidths" class="checkbox ws-check <?php if ($wordstrap_theme_options['ws_layout'] == 'full-width') echo 'active'; ?>">
                                                    <p style="text-align: center; margin-bottom: 0px;">
                                                        <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/full-width.png'; ?>" >
                                                    </p>
                                                    <input class="ws-check-radio" id="ws_layout_1" type="radio" name="ws_layout" value="full-width" <?php if ($wordstrap_theme_options['ws_layout'] == 'full-width') echo 'checked="checked"'; ?>> <?php _e('Full width','wordstrap'); ?>
                                                </label>
                                            </div>

                                            <div class="span6">
                                                <label for="ws_layout_2" rel="SidebarWidths" class="checkbox ws-check <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-left') echo 'active'; ?>"">
                                                    <p style="text-align: center; margin-bottom: 0px;">
                                                        <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/2cols-left.png'; ?>" >
                                                    </p>
                                                    <input class="ws-check-radio" id="ws_layout_2" type="radio" name="ws_layout" value="2cols-left" <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-left') echo 'checked="checked"'; ?>> <?php _e('2 cols left','wordstrap'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row-fluid" style="margin-top: 10px;">
                                            <div class="span6">
                                                <label for="ws_layout_3" rel="SidebarWidths" class="checkbox ws-check <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-right') echo 'active'; ?>"">
                                                    <p style="text-align: center; margin-bottom: 0px;">
                                                        <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/2cols-right.png'; ?>" >
                                                    </p>
                                                    <input class="ws-check-radio" id="ws_layout_3" type="radio" name="ws_layout" value="2cols-right" <?php if ($wordstrap_theme_options['ws_layout'] == '2cols-right') echo 'checked="checked"'; ?>> <?php _e('2 cols right','wordstrap'); ?>
                                                </label>
                                            </div>

                                            <div class="span6">
                                                <label for="ws_layout_4" rel="SidebarWidths" class="checkbox ws-check <?php if ($wordstrap_theme_options['ws_layout'] == '3cols') echo 'active'; ?>"">
                                                    <p style="text-align: center; margin-bottom: 0px;">
                                                        <img src="<?php echo get_stylesheet_directory_uri() .'/inc/imgs/3cols.png'; ?>" >
                                                    </p>
                                                    <input class="ws-check-radio" id="ws_layout_4" type="radio" name="ws_layout" value="3cols" <?php if ($wordstrap_theme_options['ws_layout'] == '3cols') echo 'checked="checked"'; ?>> <?php _e('3 cols','wordstrap'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div id="SidebarWidths" class="clearfix" <?php if ($wordstrap_theme_options['ws_layout']=='full-width') echo 'style="display: none;"'; ?>>

                                        <label for="SidebarWidths"><h4><?php _e('Sidebar widths','wordstrap'); ?></h4></label>
                                        <p class="help-block" style="font-style: italic; color: #777; font-size: .85em;">
                                            <?php _e('Sidebar widths are given in Bootstrap\'s grid system "units". Maximum size is 12. The width of the center column is automatically calculated.','wordstrap'); ?>
                                        </p>
                                        <div class="row-fluid">
                                            <div class="span4" id="ws_spancol_left" <?php if ($wordstrap_theme_options['ws_layout']=='2cols-right' AND $wordstrap_theme_options['ws_layout']!='3cols') echo 'style="display: none;"'; ?>>
                                                <p class="help-block">
                                                    <?php _e('Left sidebar','wordstrap'); ?>
                                                </p>
                                                <div class="input-prepend">
                                                    <span class="add-on" style="line-height: 1em; padding-bottom: .06em;">span</span><input style="width: 30px; text-align: center;" type="text" id="prependedInput" name="ws_spancol_left" value="<?php if ($wordstrap_theme_options['ws_spancol_left']) echo $wordstrap_theme_options['ws_spancol_left']; ?>" />
                                                </div>
                                            </div>
                                            <div class="span8" id="ws_spancol_right" style="margin-left: 0px;" <?php if ($wordstrap_theme_options['ws_layout']=='2cols-left' AND $wordstrap_theme_options['ws_layout']!='3cols') echo 'style="display: none;"'; ?>>
                                                <p class="help-block">
                                                    <?php _e('Right sidebar','wordstrap'); ?>
                                                </p>
                                                <div class="input-prepend">
                                                    <span class="add-on" style="line-height: 1em; padding-bottom: .06em;">span</span><input style="width: 30px; text-align: center;" type="text" name="ws_spancol_right" value="<?php if ($wordstrap_theme_options['ws_spancol_right']) echo $wordstrap_theme_options['ws_spancol_right']; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <br />
                                    <div class="clearfix">

                                        <label for="Styles"><h4><?php _e('Style','wordstrap'); ?></h4></label>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <p class="help-block">
                                                    <?php _e('Select a style from the "inc/styles" folder','wordstrap'); ?>
                                                </p>
                                                <?php
                                                // Browse available styles (folders inside inc/styles)
                                                $location = str_replace('\\','/',get_template_directory()).'/inc/styles/*';
                                                $styles = glob($location, GLOB_ONLYDIR );

                                                if (!empty($styles[0])) :

                                                    echo '<select id="style" name="style">';

                                                        foreach ($styles as $style) :
                                                            $style = explode('/',$style);
                                                            $style = $style[count($style)-1];
                                                            if ($style == $wordstrap_theme_options['style'])
                                                                $sel = 'selected="selected"';
                                                            else
                                                                $sel = '';

                                                            echo '<option '.$sel.' value="'.$style.'">'.$style.'</option>';

                                                        endforeach;

                                                    echo '</select>';

                                                else :

                                                    __('There are no styles available !','wordstrap');

                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="clearfix">

                                        <label for="WidgetHeaders"><h4><?php _e('Background gradient for widget headers','wordstrap'); ?></h4></label>
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <p class="help-block">
                                                    <?php _e('Start Color','wordstrap'); ?>
                                                </p>
                                                <input class="input-mini colorpicker" type="text" name="widget_header_bg1" id="color-1" value="<?php if ($wordstrap_theme_options['widget_header_bg1']) echo $wordstrap_theme_options['widget_header_bg1']; ?>" /><div style="position: absolute;" id="colorpicker-1"></div>
                                            </div>

                                            <div class="span4">
                                                <p class="help-block">
                                                    <?php _e('Ending Color','wordstrap'); ?>
                                                </p>
                                                <input class="input-mini colorpicker" type="text" name="widget_header_bg2" id="color-2" value="<?php if ($wordstrap_theme_options['widget_header_bg2']) echo $wordstrap_theme_options['widget_header_bg2']; ?>" /><div style="position: absolute;" id="colorpicker-2"></div>
                                            </div>

                                            <div class="span4">
                                                <p class="help-block">
                                                    <?php _e('Text Color','wordstrap'); ?>
                                                </p>
                                                <input class="input-mini colorpicker" type="text" name="widget_header_color" id="color-9" value="<?php if ($wordstrap_theme_options['widget_header_color']) echo $wordstrap_theme_options['widget_header_color']; ?>" /><div style="position: absolute;" id="colorpicker-9"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <br />
                                </div>
                                <div class="span7">
                                    <div class="clearfix">

                                        <div class="row-fluid">
                                            <div class="span12">

                                                <label for="WsHeader"><h4><?php _e('Header options','wordstrap'); ?></h4></label>
                                                <label class="checkbox" for="hide_wsheader" style="font-weight: normal;"><?php _e('Hide Header','wordstrap'); ?>
                                                    <input type="checkbox" id="hide_wsheader" name="hide_wsheader" <?php if ($wordstrap_theme_options['hide_wsheader'] == 1) echo 'checked="checked"'; ?> value="1">
                                                </label>

                                                <div class="clearfix"></div>

                                                <div id="header_height_box" style="margin-top: 1em; <?php if ($wordstrap_theme_options['hide_wsheader'] == 1) echo 'display: none;'; ?>">

                                                    <label class="checkbox" style="font-weight: normal;" for="show_wssearch_header"><?php _e('Show Search form in header','wordstrap'); ?>
                                                        <input type="checkbox" id="show_wssearch_header" name="show_wssearch_header" <?php if ($wordstrap_theme_options['show_wssearch_header'] == 1) echo 'checked="checked"'; ?> value="1">
                                                    </label><br />

                                                    <div class="clearfix"></div>

                                                    <input type="text" name="header_height" value="<?php echo $wordstrap_theme_options['header_height']; ?>" class="input-mini" style="float: left; margin-top: -.25em; margin-right: .5em;" maxlength="3">
                                                    <?php _e('Header Height','wordstrap'); ?><br />

                                                    <div class="clearfix"></div>

                                                    <label for="HeaderBg"><?php _e('Header Background gradient','wordstrap'); ?></label>
                                                    <div class="row-fluid">
                                                        <div class="span3">
                                                            <p class="help-block">
                                                                <?php _e('Start Color','wordstrap'); ?>
                                                            </p>
                                                            <input class="input-mini colorpicker" type="text" name="header_bg1" id="color-5" value="<?php if ($wordstrap_theme_options['header_bg1']) echo $wordstrap_theme_options['header_bg1']; ?>" /><div style="position: absolute;" id="colorpicker-5"></div>
                                                        </div>

                                                        <div class="span3">
                                                            <p class="help-block">
                                                                <?php _e('Ending Color','wordstrap'); ?>
                                                            </p>
                                                            <input class="input-mini colorpicker" type="text" name="header_bg2" id="color-6" value="<?php if ($wordstrap_theme_options['header_bg2']) echo $wordstrap_theme_options['header_bg2']; ?>" /><div style="position: absolute;" id="colorpicker-6"></div>
                                                        </div>

                                                        <div class="span6">
                                                            <p class="help-block">
                                                                <?php _e('Text Color', 'wordstrap'); ?>
                                                            </p>
                                                            <input class="input-mini colorpicker" type="text" name="header_color" id="color-10" value="<?php if ($wordstrap_theme_options['header_color']) echo $wordstrap_theme_options['header_color']; ?>" /><div style="position: absolute;" id="colorpicker-10"></div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <br />

                                                <label for="WsNavbar"><h4><?php _e('Navbar options','wordstrap'); ?></h4></label>

                                                <label class="checkbox" style="font-weight: normal;" for="hide_wsnavbar"><?php _e('Hide Nav bar','wordstrap'); ?>
                                                    <input type="checkbox" id="hide_wsnavbar" name="hide_wsnavbar" <?php if ($wordstrap_theme_options['hide_wsnavbar'] == 1) echo 'checked="checked"'; ?> value="1">
                                                </label>

                                                <div id="nav_box" style="margin-top: 1em; <?php if ($wordstrap_theme_options['hide_wsnavbar'] == 1) echo 'display: none;'; ?>">
                                                    <label class="checkbox" style="font-weight: normal;" for="show_wstitle_nav"><?php _e('Show Site title in nav bar','wordstrap'); ?>
                                                        <input type="checkbox" id="show_wstitle_nav" name="show_wstitle_nav" <?php if ($wordstrap_theme_options['show_wstitle_nav'] == 1) echo 'checked="checked"'; ?> value="1">
                                                    </label>

                                                    <label class="checkbox" style="font-weight: normal;" for="show_wssearch_nav"><?php _e('Show Search form in nav bar','wordstrap'); ?>
                                                        <input type="checkbox" id="show_wssearch_nav" name="show_wssearch_nav" <?php if ($wordstrap_theme_options['show_wssearch_nav'] == 1) echo 'checked="checked"'; ?> value="1">
                                                    </label>

                                                    <label class="checkbox" style="font-weight: normal;" for="show_home_nav"><?php _e('Show Home link in nav bar','wordstrap'); ?>
                                                        <input type="checkbox" id="show_home_nav" name="show_home_nav" <?php if ($wordstrap_theme_options['show_home_nav'] == 1) echo 'checked="checked"'; ?> value="1">
                                                    </label>

                                                    <div class="clearfix"></div>

                                                    <label for="NavbarBg"><?php _e('Navbar Background gradient','wordstrap'); ?></label>
                                                    <div class="row-fluid">
                                                        <div class="span3">
                                                            <p class="help-block">
                                                                <?php _e('Start Color','wordstrap'); ?>
                                                            </p>
                                                            <input class="input-mini colorpicker" type="text" name="navbar_bg1" id="color-7" value="<?php if ($wordstrap_theme_options['navbar_bg1']) echo $wordstrap_theme_options['navbar_bg1']; ?>" /><div style="position: absolute;" id="colorpicker-7"></div>
                                                        </div>

                                                        <div class="span3">
                                                            <p class="help-block">
                                                                <?php _e('Ending Color','wordstrap'); ?>
                                                            </p>
                                                            <input class="input-mini colorpicker" type="text" name="navbar_bg2" id="color-8" value="<?php if ($wordstrap_theme_options['navbar_bg2']) echo $wordstrap_theme_options['navbar_bg2']; ?>" /><div style="position: absolute;" id="colorpicker-8"></div>
                                                        </div>

                                                        <div class="span6">
                                                            <p class="help-block">
                                                                <?php _e('Text Color', 'wordstrap'); ?>
                                                            </p>
                                                            <input class="input-mini colorpicker" type="text" name="navbar_color" id="color-11" value="<?php if ($wordstrap_theme_options['navbar_color']) echo $wordstrap_theme_options['navbar_color']; ?>" /><div style="position: absolute;" id="colorpicker-11"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br />

                                                <label for="Breadcrumb"><h4><?php _e('Breadcrumb','wordstrap'); ?></h4></label>
                                                <label class="checkbox" for="hide_wsbreadcrumb" style="font-weight: normal;"><?php _e('Hide Breadcrumb','wordstrap'); ?>
                                                    <input type="checkbox" id="hide_wsbreadcrumb" name="hide_wsbreadcrumb" <?php if ($wordstrap_theme_options['hide_wsbreadcrumb'] == 1) echo 'checked="checked"'; ?> value="1">
                                                </label>

                                                <br />

                                                <label for="WsHeader"><h4><?php _e('Misc.','wordstrap'); ?></h4></label>
                                                <label class="checkbox" style="font-weight: normal;" for="nav_fixed"><?php _e('Fixed Header/Nav bar','wordstrap'); ?>
                                                    <input type="checkbox" id="nav_fixed" name="nav_fixed" <?php if ($wordstrap_theme_options['nav_fixed'] == 1) echo 'checked="checked"'; ?> value="1">
                                                    <p class="help-block" style="color: #999;">
                                                        <?php _e('This will make the Header, Nav bar or both of them stick to the top.','wordstrap'); ?>
                                                    </p>
                                                </label>

                                                <br />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="lB" class="tab-pane">
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
                                <div class="span3">
                                    <p class="help-block">
                                        <?php _e('Type the name of a font','wordstrap'); ?>
                                    </p>
                                    <?php $font_list = ''; foreach ($googlefonts as $font_name) : ?>
                                        <?php $font_list .= '&quot;'.$font_name.'&quot;,'; ?>
                                    <?php endforeach; $font_list=substr($font_list,0,-1); ?>
                                    <input type="text" name="google_font" data-provide="typeahead" value="<?php if (isset($wordstrap_theme_options['google_font'])) echo $wordstrap_theme_options['google_font']; ?>" data-items="5" data-source="[<?php echo $font_list; ?>]">
                                    <br />
                                    <p class="muted"><small><?php _e('Find more fonts at', 'wordstrap'); ?> <a href="http://www.google.com/webfonts" title="Google Web Fonts" target="_blank">Google Web Fonts</a></small></p>
                                </div>

                                <div class="span9">
                                    <p class="help-block">
                                        <?php _e('Use it in','wordstrap'); ?>
                                    </p>
                                    <label class="checkbox" for="use_googlefonts_widgets"><?php _e('Widget titles','wordstrap'); ?>
                                    <input id="use_googlefonts_widgets" type="checkbox" name="use_googlefonts_widgets" <?php if ($wordstrap_theme_options['use_googlefonts_widgets'] == 1) echo 'checked="checked"'; ?> value="1">
                                    </label>
                                    <label class="checkbox" for="use_googlefonts_posts"><?php _e('Post titles','wordstrap'); ?>
                                        <input id="use_googlefonts_posts" type="checkbox" name="use_googlefonts_posts" <?php if ($wordstrap_theme_options['use_googlefonts_posts'] == 1) echo 'checked="checked"'; ?> value="1">
                                    </label>
                                    <label class="checkbox" for="use_googlefonts_pages"><?php _e('Page titles','wordstrap'); ?>
                                        <input id="use_googlefonts_pages" type="checkbox" name="use_googlefonts_pages" <?php if ($wordstrap_theme_options['use_googlefonts_pages'] == 1) echo 'checked="checked"'; ?> value="1">
                                    </label>
                                </div>
                            </div>
                            <br />

                            <label class="checkbox" for="article_social"><?php _e('Display social share buttons in ALL posts?','wordstrap'); ?>
                                <input type="checkbox" id="article_social" name="article_social" <?php if ($wordstrap_theme_options['article_social'] == 1) echo 'checked="checked"'; ?> value="1">
                            </label>
                            <p class="help-block"><?php _e('or uncheck this and use the shortcode <b>[social_share]</b> for displaying social share buttons only where you want posts or pages','wordstrap'); ?></p>

                            <label for="google_analytics"><?php _e('Google Analytics code','wordstrap'); ?></label>
                            <p class="help-block"><?php _e('Here you can paste the full Google Analytics script for your site, including the <b>&lt;script&gt;</b> tags.','wordstrap'); ?></p>
                            <textarea name="google_analytics" style="width: 350px; height: 100px;"><?php if ($wordstrap_theme_options['google_analytics'] != '') echo str_replace('\\','',$wordstrap_theme_options['google_analytics']); ?></textarea>
                            <br />
                        </div>

                        <div id="lC" class="tab-pane">
                            <h3><?php _e('Footer Elements settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Customize the footer of your site','wordstrap'); ?></small></h3>
                            <hr>

                            <div class="row-fluid">
                                <div class="span7">

                                    <label for="FooterTitle"><?php _e('Footer Title', 'wordstrap'); ?></label>
                                    <input type="text" class="input-xlarge" name="footer_title1" value="<?php if (isset($wordstrap_theme_options['footer_title1'])) echo $wordstrap_theme_options['footer_title1']; ?>">
                                    <br />
                                    <label for="FooterTitleSocial"><?php _e('Footer Title Social', 'wordstrap'); ?></label>
                                    <input type="text" class="input-xlarge" name="footer_title2" value="<?php if (isset($wordstrap_theme_options['footer_title2'])) echo $wordstrap_theme_options['footer_title2']; ?>">
                                    <br />
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <label for="FooterText" style="float: left;"><?php _e('Footer text', 'wordstrap'); ?></label>
                                            <?php
                                            $editorsettings = array ('textarea_rows' => 10, 'media_buttons' => false, 'teeny' => true);
                                            wp_editor($wordstrap_theme_options['footer_text'],'footer_text', $editorsettings);
                                            ?>
                                            <br />
                                        </div>
                                    </div>
                                </div>
                                <div class="span5">

                                    <p><strong><?php _e('Social buttons','wordstrap'); ?></strong></p>

                                        <label for="footer_show_fb" class="checkbox" style="margin-bottom: 5px;"><input rel="fb" type="checkbox" id="footer_show_fb" class="social_buttons_check" name="footer_show_fb" <?php if ($wordstrap_theme_options['footer_show_fb'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Facebook Button','wordstrap'); ?>
                                        <div class="buttons_container fb_button" <?php if ($wordstrap_theme_options['footer_show_fb'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_fb.png'; ?>" title="Facebook" alt="Facebook" /></div></label>
                                        <input type="text" name="footer_fb_url" class="fb input-medium" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_fb_url']; ?>" style="<?php if ($wordstrap_theme_options['footer_show_fb'] == 1) echo 'display: block;'; else echo 'display: none;'; ?>">
                                        <div class="clearfix"></div>
                                        <br />

                                        <label for="footer_show_gp" class="checkbox" style="margin-bottom: 5px;"><input rel="gp" type="checkbox" id="footer_show_gp" class="social_buttons_check" name="footer_show_gp" <?php if ($wordstrap_theme_options['footer_show_gp'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Google+ Button','wordstrap'); ?>
                                        <div class="buttons_container gp_button" <?php if ($wordstrap_theme_options['footer_show_gp'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_gp.png'; ?>" title="Google+" alt="Google+" /></div></label>
                                        <input type="text" name="footer_gp_url" class="gp input-medium" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_gp_url']; ?>" style="<?php if ($wordstrap_theme_options['footer_show_gp'] == 1) echo 'display: block;'; else echo 'display: none;'; ?>">
                                        <div class="clearfix"></div>
                                        <br />

                                        <label for="footer_show_tw" class="checkbox" style="margin-bottom: 5px;"><input rel="tw" type="checkbox" id="footer_show_tw" class="social_buttons_check" name="footer_show_tw" <?php if ($wordstrap_theme_options['footer_show_tw'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Twitter Button','wordstrap'); ?>
                                        <div class="buttons_container tw_button" <?php if ($wordstrap_theme_options['footer_show_tw'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_tw.png'; ?>" title="Twitter" alt="Twitter" /></div></label>
                                        <input type="text" name="footer_tw_url" class="tw input-medium" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_tw_url']; ?>" style="<?php if ($wordstrap_theme_options['footer_show_tw'] == 1) echo 'display: block;'; else echo 'display: none;'; ?>">
                                        <div class="clearfix"></div>
                                        <br />

                                        <label for="footer_show_li" class="checkbox" style="margin-bottom: 5px;"><input rel="li" type="checkbox" id="footer_show_li" class="social_buttons_check" name="footer_show_li" <?php if ($wordstrap_theme_options['footer_show_li'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Show Linkedin Button','wordstrap'); ?>
                                        <div class="buttons_container li_button" <?php if ($wordstrap_theme_options['footer_show_li'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_li.png'; ?>" title="LinkedIn" alt="LinkedIn" /></div></label>
                                        <input type="text" name="footer_li_url" class="li input-medium" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_li_url']; ?>" style="<?php if ($wordstrap_theme_options['footer_show_li'] == 1) echo 'display: block;'; else echo 'display: none;'; ?>">
                                        <div class="clearfix"></div>
                                        <br />

                                        <label for="footer_show_git" class="checkbox" style="margin-bottom: 5px;"><input rel="git" type="checkbox" id="footer_show_git" class="social_buttons_check" name="footer_show_git" <?php if ($wordstrap_theme_options['footer_show_git'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Show GitHub Button','wordstrap'); ?>
                                        <div class="buttons_container git_button" <?php if ($wordstrap_theme_options['footer_show_git'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_git.png'; ?>" title="GitHub" alt="GitHub" /></div></label>
                                        <input type="text" name="footer_git_url" class="git input-medium" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_git_url']; ?>" style="<?php if ($wordstrap_theme_options['footer_show_git'] == 1) echo 'display: block;'; else echo 'display: none;'; ?>">
                                        <div class="clearfix"></div>
                                        <br />

                                        <label for="footer_show_yt" class="checkbox" style="margin-bottom: 5px;"><input rel="yt" type="checkbox" id="footer_show_yt" class="social_buttons_check" name="footer_show_yt" <?php if ($wordstrap_theme_options['footer_show_yt'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Show YouTube Button','wordstrap'); ?>
                                        <div class="buttons_container yt_button" <?php if ($wordstrap_theme_options['footer_show_yt'] == 1) echo 'style="opacity: 1;"'; ?>><img src="<?php echo get_stylesheet_directory_uri() . '/inc/imgs/social_yt.png'; ?>" title="YouTube" alt="YouTube" /></div></label>
                                        <input type="text" name="footer_yt_url" class="yt input-medium" placeholder="http://" value="<?php echo $wordstrap_theme_options['footer_yt_url']; ?>" style="<?php if ($wordstrap_theme_options['footer_show_yt'] == 1) echo 'display: block;'; else echo 'display: none;'; ?>">
                                        <div class="clearfix"></div>
                                        <br />

                                        <p style="margin-top: 10px;">
                                            <label class="checkbox" for="footer_displaycc"><?php _e('Display Creative Commons logo','wordstrap'); ?>
                                            <input type="checkbox" id="footer_displaycc" name="footer_displaycc" <?php if ($wordstrap_theme_options['footer_displaycc'] == 1) echo 'checked="checked"'; ?> value="1">
                                            </label>
                                        </p>

                                </div>
                            </div>

                        </div>

                        <div id="lD" class="tab-pane">
                            <h3><?php _e('Front page settings','wordstrap'); ?></h3>
                            <h3><small><?php _e('Select which elements will be displayed in the front page.','wordstrap'); ?></small></h3>
                            <hr>

                            <label class="checkbox" for="landing_page_intro_check">
                                <input id="landing_page_intro_check" type="checkbox" name="landing_page_intro" <?php if ($wordstrap_theme_options['landing_page_intro'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Intro container','wordstrap'); ?>
                            </label>
                            <div id="landing_page_intro_box" class="alert alert-message ws-alert" <?php if ($wordstrap_theme_options['landing_page_intro'] != 1) echo 'style="display: none; margin-top: 10px;"'; else echo 'style="margin-top: 10px;"'; ?>>
                                <div class="row-fluid">
                                    <div class="span3">
                                        <label for="landing_page_intro_id"><?php _e('Display page','wordstrap'); ?></label>
                                        <?php $list_pages = get_pages(); ?>
                                        <select class="input-medium" name="landing_page_intro_id">
                                            <option value="" style="font-style: italic;"><?php _e('Select an item...','wordstrap'); ?></option>
                                            <?php foreach ($list_pages as $list) : ?>
                                                <option value="<?php echo $list->ID; ?>" <?php if ($wordstrap_theme_options['landing_page_intro_id'] == $list->ID) echo 'selected="selected"'; ?>><?php echo $list->post_title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="span3">

                                        <label for="IntroContainer"><?php _e('Container colors','wordstrap'); ?></label>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <p class="help-block">
                                                    <?php _e('Background','wordstrap'); ?>
                                                </p>
                                                <input class="input-mini colorpicker" type="text" name="intro_bg" id="color-3" value="<?php if ($wordstrap_theme_options['intro_bg']) echo $wordstrap_theme_options['intro_bg']; else echo '#dadada'; ?>" /><div style="position: absolute;" id="colorpicker-3"></div>
                                            </div>
                                            <div class="span6">
                                                <p class="help-block">
                                                    <?php _e('Text','wordstrap'); ?>
                                                </p>
                                                <input class="input-mini colorpicker" type="text" name="intro_color" id="color-4" value="<?php if ($wordstrap_theme_options['intro_color']) echo $wordstrap_theme_options['intro_color']; else echo '#dadada'; ?>" /><div style="position: absolute;" id="colorpicker-4"></div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="span6">
                                        <label for="IntroContainer"><?php _e('Options','wordstrap'); ?></label>
                                        <label class="checkbox" for="landing_page_intro_title" style="font-weight: normal; color: #555;"><?php _e('Show page title','wordstrap'); ?>
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
                                    <div class="span3">
                                        <label><?php _e('Select category:','wordstrap'); ?></label>
                                        <select name="featured_cat" class="input-medium">
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
                                    <div class="span3">
                                        <label for="landing_page_featured_title"><?php _e('Title','wordstrap'); ?></label>
                                        <input type="text" name="landing_page_featured_title" class="input-medium" value="<?php echo $wordstrap_theme_options['landing_page_featured_title']; ?>">
                                    </div>
                                    <div class="span2">
                                        <label for="landing_page_featured_title_color"><?php _e('Title color','wordstrap'); ?></label>
                                        <input class="input-mini colorpicker" type="text" name="landing_page_featured_title_color" id="color-12" value="<?php if ($wordstrap_theme_options['landing_page_featured_title_color']) echo $wordstrap_theme_options['landing_page_featured_title_color']; ?>" /><div style="position: absolute;" id="colorpicker-12"></div>
                                    </div>
                                    <div class="span4">
                                        <label><?php _e('Number','wordstrap'); ?></label>
                                        <input class="input-mini colorpicker" type="text" name="featured_num" value="<?php echo $wordstrap_theme_options['featured_num']; ?>" maxlength="2">
                                    </div>
                                </div>
                            </div>
                            <label class="checkbox" for="landing_page_tabs_check">
                                <input type="checkbox" id="landing_page_tabs_check" name="landing_page_tabs" <?php if ($wordstrap_theme_options['landing_page_tabs'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Tabs','wordstrap'); ?>
                            </label>
                            <div id="landing_page_tabs_box" class="alert alert-message ws-alert" <?php if ($wordstrap_theme_options['landing_page_tabs'] != 1) echo 'style="display: none; margin-top: 10px;"'; else echo 'style="margin-top: 10px;"'; ?>>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <label><?php _e('First tab','wordstrap'); ?></label>
                                        <select name="tabs_first" id="tabs_first" class="tabs_select">
                                            <option value="categorized" <?php if ($wordstrap_theme_options['tabs_first'] == 'categorized') echo 'selected="selected"'; ?>><?php _e('Categorized posts','wordstrap'); ?></option>
                                            <option value="latest" <?php if ($wordstrap_theme_options['tabs_first'] == 'latest') echo 'selected="selected"'; ?>><?php _e('Latest posts','wordstrap'); ?></option>
                                            <option value="popular" <?php if ($wordstrap_theme_options['tabs_first'] == 'popular') echo 'selected="selected"'; ?>><?php _e('Popular posts','wordstrap'); ?></option>
                                        </select>
                                        <div id="tabs_first_cat_box" <?php if ($wordstrap_theme_options['tabs_first'] != 'categorized') echo 'style="display: none;"'; ?>>
                                            <div class="input-prepend" style="font-weight: normal;"><?php _e('category','wordstrap'); ?>
                                            <select name="tabs_first_cat" class="input-medium">
                                                <option value="" style="font-style: italic;"><?php _e('Select a category...','wordstrap'); ?></option>
                                                <?php
                                                $cats = get_all_category_ids();
                                                foreach ($cats as $cat) :
                                                    $term = get_term($cat, 'category');
                                                    $sel=''; if ($term->slug == $wordstrap_theme_options['tabs_first_cat']) $sel='selected="selected"';
                                                    echo '<option value="'.$term->slug.'" '.$sel.'>'.$term->name.'</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <label><?php _e('Second tab','wordstrap'); ?></label>
                                        <select name="tabs_second" id="tabs_second" class="tabs_select">
                                            <option value="" selected><?php _e('Unused','wordstrap'); ?></option>
                                            <option value="categorized" <?php if ($wordstrap_theme_options['tabs_second'] == 'categorized') echo 'selected="selected"'; ?>><?php _e('Categorized posts','wordstrap'); ?></option>
                                            <option value="latest" <?php if ($wordstrap_theme_options['tabs_second'] == 'latest') echo 'selected="selected"'; ?>><?php _e('Latest posts','wordstrap'); ?></option>
                                            <option value="popular" <?php if ($wordstrap_theme_options['tabs_second'] == 'popular') echo 'selected="selected"'; ?>><?php _e('Popular posts','wordstrap'); ?></option>
                                        </select>
                                        <div id="tabs_second_cat_box" <?php if ($wordstrap_theme_options['tabs_second'] != 'categorized') echo 'style="display: none;"'; ?>>
                                            <div class="input-prepend" style="font-weight: normal;"><?php _e('category','wordstrap'); ?>
                                            <select name="tabs_second_cat" class="input-medium">
                                                <option value="" style="font-style: italic;"><?php _e('Select a category...','wordstrap'); ?></option>
                                                <?php
                                                $cats = get_all_category_ids();
                                                foreach ($cats as $cat) :
                                                    $term = get_term($cat, 'category');
                                                    $sel=''; if ($term->slug == $wordstrap_theme_options['tabs_second_cat']) $sel='selected="selected"';
                                                    echo '<option value="'.$term->slug.'" '.$sel.'>'.$term->name.'</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <label><?php _e('Third tab','wordstrap'); ?></label>
                                        <select name="tabs_third" id="tabs_third" class="tabs_select">
                                            <option value="" selected><?php _e('Unused','wordstrap'); ?></option>
                                            <option value="categorized" <?php if ($wordstrap_theme_options['tabs_third'] == 'categorized') echo 'selected="selected"'; ?>><?php _e('Categorized posts','wordstrap'); ?></option>
                                            <option value="latest" <?php if ($wordstrap_theme_options['tabs_third'] == 'latest') echo 'selected="selected"'; ?>><?php _e('Latest posts','wordstrap'); ?></option>
                                            <option value="popular" <?php if ($wordstrap_theme_options['tabs_third'] == 'popular') echo 'selected="selected"'; ?>><?php _e('Popular posts','wordstrap'); ?></option>
                                        </select>
                                        <div id="tabs_third_cat_box" <?php if ($wordstrap_theme_options['tabs_third'] != 'categorized') echo 'style="display: none;"'; ?>>
                                            <div class="input-prepend" style="font-weight: normal;"><?php _e('category','wordstrap'); ?>
                                            <select name="tabs_third_cat" class="input-medium">
                                                <option value="" style="font-style: italic;"><?php _e('Select a category...','wordstrap'); ?></option>
                                                <?php
                                                $cats = get_all_category_ids();
                                                foreach ($cats as $cat) :
                                                    $term = get_term($cat, 'category');
                                                    $sel=''; if ($term->slug == $wordstrap_theme_options['tabs_third_cat']) $sel='selected="selected"';
                                                    echo '<option value="'.$term->slug.'" '.$sel.'>'.$term->name.'</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <label><?php _e('Fourth tab','wordstrap'); ?></label>
                                        <select name="tabs_fourth" id="tabs_fourth" class="tabs_select">
                                            <option value="" selected><?php _e('Unused','wordstrap'); ?></option>
                                            <option value="categorized" <?php if ($wordstrap_theme_options['tabs_fourth'] == 'categorized') echo 'selected="selected"'; ?>><?php _e('Categorized posts','wordstrap'); ?></option>
                                            <option value="latest" <?php if ($wordstrap_theme_options['tabs_fourth'] == 'latest') echo 'selected="selected"'; ?>><?php _e('Latest posts','wordstrap'); ?></option>
                                            <option value="popular" <?php if ($wordstrap_theme_options['tabs_fourth'] == 'popular') echo 'selected="selected"'; ?>><?php _e('Popular posts','wordstrap'); ?></option>
                                        </select>
                                        <div id="tabs_fourth_cat_box" <?php if ($wordstrap_theme_options['tabs_fourth'] != 'categorized') echo 'style="display: none;"'; ?>>
                                            <div class="input-prepend" style="font-weight: normal;"><?php _e('category','wordstrap'); ?>
                                            <select name="tabs_fourth_cat" class="input-medium">
                                                <option value="" style="font-style: italic;"><?php _e('Select a category...','wordstrap'); ?></option>
                                                <?php
                                                $cats = get_all_category_ids();
                                                foreach ($cats as $cat) :
                                                    $term = get_term($cat, 'category');
                                                    $sel=''; if ($term->slug == $wordstrap_theme_options['tabs_fourth_cat']) $sel='selected="selected"';
                                                    echo '<option value="'.$term->slug.'" '.$sel.'>'.$term->name.'</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="checkbox" for="landing_page_blog">
                                <input type="checkbox" id="landing_page_blog" name="landing_page_blog" <?php if ($wordstrap_theme_options['landing_page_blog'] == 1) echo 'checked="checked"'; ?> value="1"> <?php _e('Display Blog loop','wordstrap'); ?>
                            </label>
                        </div>
                        <br />
                    </div><!-- .tab-content -->
                </div><!-- .tabbable -->

                <br />

                <button type="submit" class="btn btn-success btn-large pull-left" id="submit" name="submit"><i class="icon-save"></i> <?php _e('Save Changes','wordstrap'); ?></button>
                <?php if (isset($updated) && $updated==1) : ?>
                    <div class="pull-left alert alert-success" style="margin-left: 20px; margin-top: 2px;"><a class="close" data-dismiss="alert">&times;</a><i class="icon-ok-sign"></i> <strong><?php _e('Theme options have been succesfully updated.', 'wordstrap'); ?></strong></div>
                <?php endif; ?>

                <?php wp_nonce_field( 'wordstrap_theme_options_page' ) ?>

            </form>

        </div><!-- .wrap -->

    <?php }
}
add_action('init', array('wordstrap_theme_options_page', 'init'));