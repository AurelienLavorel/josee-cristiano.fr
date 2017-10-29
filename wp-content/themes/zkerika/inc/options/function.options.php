<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (! class_exists('Redux')) {
    return;
}

$show_wc_cart = $show_rev_slider = $show_rev_slider_list = $show_rev_slider_page = $show_donate = $show_donate_url = $show_donate_url2 = '';
if(class_exists('WooCommerce')){
    $show_wc_cart = array(
        'title'     => esc_html__('Show Cart', 'zk-erika'),
        'subtitle'      => esc_html__('Show/Hide cart icon', 'zk-erika'),
        'id'        => 'zkerika_show_header_wc_cart',
        'type'      => 'switch',
        'default'   => false,
    );
}

if(class_exists('RevSlider')){
    $show_rev_slider = array(
        'title'     => esc_html__('Revolution Slider', 'zk-erika'),
        'subtitle'      => esc_html__('Show a Revolution Slider before Main Header', 'zk-erika'),
        'id'        => 'zkerika_show_header_slider',
        'type'      => 'switch',
        'default'   => false,
    ); 

    $show_rev_slider_list = array(
        'id'        => 'zkerika_header_slider',
        'title'     => esc_html__('Slider', 'zk-erika'),
        'placeholder'  => esc_html__('select a slider for header', 'zk-erika'),
        'default'   => 'home',
        'type'      => 'select',
        'options'   => zkerika_get_list_rev_slider(),
        'required'  => array( 0 => 'zkerika_show_header_slider', 1 => '=', 2 => '1' )
    );
    $show_rev_slider_page = array(
        'id'        => 'zkerika_header_slider_page',
        'title'     => esc_html__('Show Slider on page ?', 'zk-erika'),
        'type'      => 'select',
        'data'      => 'pages',
        'multi'     => 'true',
        'placeholder'   => esc_html__('Select page you want to show slider','zk-erika'),
        'required'  => array( 0 => 'zkerika_header_slider', 1 => '!=', 2 => '' )
    );
}

/* Show Donate Button */
if(class_exists('ZoDonations')){
    $show_donate = array(
        'title'     => esc_html__('Show Donate Button', 'zk-erika'),
        'subtitle'  => esc_html__('Show/Hide donate button', 'zk-erika'),
        'id'        => 'zkerika_show_header_donate',
        'type'      => 'button_set',
        'options'  => array(
            0      => esc_html__('Hide', 'zk-erika'),
            1      => esc_html__('Internal Link', 'zk-erika'),
            2      => esc_html__('Extalnal Link', 'zk-erika')
        ),
        'default'   => 0,
    );
    $show_donate_url = array(
        'title'     => esc_html__('Donate Button Link', 'zk-erika'),
        'subtitle'  => esc_html__('Choose an exiting page', 'zk-erika'),
        'id'        => 'zkerika_header_donate_url',
        'type'      => 'select',
        'options'   => zkerika_list_page(),
        'required'  => array( 0 => 'zkerika_show_header_donate', 1 => '=', 2 => '1' )
    );
    $show_donate_url2 = array(
        'title'     => esc_html__('Donate Button Link', 'zk-erika'),
        'subtitle'  => esc_html__('Enter your url', 'zk-erika'),
        'id'        => 'zkerika_header_donate_url2',
        'type'      => 'text',
        'placeholder'   => 'http://your-url.com',
        'required'  => array( 0 => 'zkerika_show_header_donate', 1 => '=', 2 => '2' )
    );
}

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('opt_name', 'zkerika_theme_options');

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => $theme->get('Name'),
    'page_title' => $theme->get('Name'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => false,
    // Use a asynchronous font on the front end or font string
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-smiley',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    // 'open_expanded' => true, // Allow you to start the panel in an expanded way initially.
    'disable_save_warn' => true, // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-dashboard',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'dashicons-smiley',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit' => '', // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => ''
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right'
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover'
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave'
            )
        )
    )
);

Redux::setArgs($opt_name, $args);

/**
 * General
 * 
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'     => esc_html__('General', 'zk-erika'),
    'heading'   => '',
    'icon'      => 'dashicons dashicons-admin-home',
    'fields'    => array(
        array(
            'title'    => esc_html__('Boxed Layout', 'zk-erika'),
            'subtitle' => esc_html__('make your site is boxed?', 'zk-erika'),
            'id'       => 'zkerika_body_layout',
            'type'     => 'button_set',
            'options'  => array(
                0      => esc_html__('Default', 'zk-erika'),
                1      => esc_html__('Boxed', 'zk-erika')
            ),
            'default'  => 0
        ),
        array(
            'title'     => esc_html__('Boxed width', 'zk-erika'),
            'subtitle'  => esc_html__('This option just applied for screen larger than value you enter here!', 'zk-erika'),
            'id'        => 'zkerika_body_width',
            'type'      => 'dimensions',
            'units'     => array('px'),
            'height'    => false,
            'default'   => array(
                'width' => '1200px',
                'units' => 'px'
            ),
            'required'  => array( 
                array( 'zkerika_body_layout', '=', 1), 
            ),
        ),
        array(
            'title'     => esc_html__('Background', 'zk-erika'),
            'subtitle'  => esc_html__('Choose background style', 'zk-erika'),
            'id'        => 'zkerika_body_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('body')
        ),
        
        array(
            'title'     => esc_html__('Padding', 'zk-erika'),
            'subtitle'  => esc_html__('Choose padding for BODY tag', 'zk-erika'),
            'id'        => 'zkerika_body_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),     
            'default'   => array(),
            'output'    => array('body')
        ),
    )
));
/**
 * Extra
 * 
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'     => esc_html__('Extra', 'zk-erika'),
    'heading'   => '',
    'icon'      => 'dashicons dashicons-plus-alt',
    'subsection'=> true,
    'fields'    => array(
        array(
            'title'     => esc_html__('Enable Page Loading', 'zk-erika'),
            'subtitle'  => '',
            'id'        => 'zkerika_page_loading',
            'type'      => 'switch',
            'default'   => false
        ),
        array(
            'title'     => esc_html__('Page Loadding Style','zk-erika'),
            'subtitle'  => esc_html__('Select Style Page Loadding.','zk-erika'),
            'id'        => 'zkerika_page_loading_style',
            'type'      => 'select',
            'options'   => array(
                '1' => esc_html__('Newtons cradle','zk-erika'),
                '2' => esc_html__('Wave','zk-erika'),
                '3' => esc_html__('Circus','zk-erika'),
                '4' => esc_html__('Atom','zk-erika'),
                '5' => esc_html__('Fussion','zk-erika'),
                '6' => esc_html__('Mitosis','zk-erika'),
                '7' => esc_html__('Flower','zk-erika'),
                '8' => esc_html__('Clock','zk-erika'),
                '9' => esc_html__('Washing machine','zk-erika'),
                '10' => esc_html__('Pulse','zk-erika'),
            ),
            
            'default'   => '1',
            'required'  => array( 0 => 'zkerika_page_loading', 1 => '=', 2 => 1 )
        ) ,
        array(
            'title'     => esc_html__('Enable Back To Top', 'zk-erika'),
            'subtitle'  => '',
            'id'        => 'zkerika_backtotop',
            'type'      => 'switch',
            'default'   => false
        ),
    )
));

/**
 * Styling
 * 
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'     => esc_html__('Theme Color', 'zk-erika'),
    'icon'      => 'dashicons dashicons-art',
    'fields'    => array(
        array(
            'title'     => esc_html__('Primary Color', 'zk-erika'),
            'subtitle'  => esc_html__('Choose your primary color.', 'zk-erika'),
            'id'        => 'zkerika_primary_color',
            'type'      => 'link_color',
            'hover'     => false,
            'active'    => false,
            'default'   => array()
        ),
        array(
            'title'     => esc_html__('Accent Color', 'zk-erika'),
            'subtitle'  => esc_html__('Choose your accent color.', 'zk-erika'),
            'id'        => 'zkerika_accent_color',
            'type'      => 'link_color',
            'hover'     => false,
            'active'    => false,
            'default'   => array()
        )
    )
));
/**
 * Typography
 * 
 * @author Chinh Duong Manh
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'zk-erika'),
    'heading' => '',
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'                =>  'zkerika_font_body',
            'type'              =>  'typography',
            'title'             =>  esc_html__('Body Font', 'zk-erika'),
            'text-transform'    =>  true,
            'letter-spacing'    =>  true,
            'text-align'        =>  false,
            'output'            =>  array('body'),
            'units'             =>  'px',
            'subtitle'          =>  esc_html__('Typography option with each property can be called individually.', 'zk-erika'),
        )
    )
));
/**
 * Heading Font
 * 
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Heading', 'zk-erika'),
    'heading' => esc_html__('Choose style for all heading style', 'zk-erika'),
    'icon' => 'el-icon-text-width',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'zkerika_heading_h1',
            'type'              => 'typography',
            'title'             => esc_html__('H1', 'zk-erika'),
            'subtitle'          => esc_html__('Typography option with each property can be called individually.', 'zk-erika'),
            'description'       => esc_html__('If not choose any option here, all style for h1 will applied by default theme style.', 'zk-erika'),
            'text-transform'    =>  true,
            'letter-spacing'    =>  true,
            'text-align'        =>  false,
            'output'            => array('h1, .h1, h1 a, .h1 a'),
            'units'             => 'px',
        ),
        array(
            'id'             =>  'zkerika_heading_h2',
            'type'           =>  'typography',
            'title'          =>   esc_html__('H2', 'zk-erika'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'zk-erika'),
            'description'    =>  esc_html__('If not choose any option here, all style for h2 will applied by default theme style.', 'zk-erika'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h2, .h2, h2 a, .h2 a'),
            'units'          =>  'px',
        ),
        array(
            'id'             =>  'zkerika_heading_h3',
            'type'           =>  'typography',
            'title'          =>   esc_html__('H3', 'zk-erika'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'zk-erika'),
            'description'    =>  esc_html__('If not choose any option here, all style for h3 will applied by default theme style.', 'zk-erika'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h3, .h3, h3 a, .h3 a'),
            'units'          =>  'px',
        ),
        array(
            'id'             =>  'zkerika_heading_h4',
            'type'           =>  'typography',
            'title'          =>   esc_html__('H4', 'zk-erika'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'zk-erika'),
            'description'    =>  esc_html__('If not choose any option here, all style for h4 will applied by default theme style.', 'zk-erika'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h4, .h4, h4 a, .h4 a'),
            'units'          =>  'px',
        ),
        array(
            'id'             =>  'zkerika_heading_h5',
            'type'           =>  'typography',
            'title'          =>   esc_html__('H5', 'zk-erika'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'zk-erika'),
            'description'    =>  esc_html__('If not choose any option here, all style for h5 will applied by default theme style.', 'zk-erika'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h5, .h5, h5 a, .h5 a'),
            'units'          =>  'px',
        ),
        array(
            'id'             =>  'zkerika_heading_h6',
            'type'           =>  'typography',
            'title'          =>  esc_html__('H6', 'zk-erika'),
            'subtitle'       =>  esc_html__('Typography option with each property can be called individually.', 'zk-erika'),
            'description'    =>  esc_html__('If not choose any option here, all style for h6 will applied by default theme style.', 'zk-erika'),
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'output'         =>  array('h6, .h6, h6 a, .h6 a'),
            'units'          =>  'px',
        ),
    )
));

/* extra font. */
$custom_font_1 = Redux::getOption($opt_name, 'zkerika_extra_font_selector');
$custom_font_1 = !empty($custom_font_1) ? explode(',', $custom_font_1) : array();

$custom_font_2 = Redux::getOption($opt_name, 'zkerika_extra_font_selector2');
$custom_font_2 = !empty($custom_font_2) ? explode(',', $custom_font_2) : array();

Redux::setSection($opt_name, array(
    'title' => esc_html__('Extra Fonts', 'zk-erika'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id'            => 'zkerika_extra_font',
            'type'          => 'typography',
            'title'         => esc_html__('Custom Font', 'zk-erika'),
            'google'        => true,
            'font-backup'   => true,
            'all_styles'    => true,
            'color'         => false,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'text-align'    => false,
            'output'        =>  $custom_font_1,
            'units'         => 'px',
            'subtitle'      => esc_html__('Choose a font for some special place.', 'zk-erika'),
            'default'       => array(
            )
        ),
        array(
            'id'        => 'zkerika_extra_font_selector',
            'type'      => 'textarea',
            'title'     => esc_html__('Selector', 'zk-erika'),
            'subtitle'  => esc_html__('add html tags ID or class (body,a,.class-name,#id-name)', 'zk-erika'),
            'validate'  => 'no_html',
            'default'   => '',
        ),
        array(
            'id'            => 'zkerika_extra_font2',
            'type'          => 'typography',
            'title'         => esc_html__('Custom Font 2', 'zk-erika'),
            'google'        => true,
            'font-backup'   => true,
            'all_styles'    => true,
            'color'         => false,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'text-align'    => false,
            'output'        =>  $custom_font_2,
            'units'         => 'px',
            'subtitle'      => esc_html__('Choose a font for some special place.', 'zk-erika'),
            'default'       => array(
            )
        ),
        array(
            'id'        => 'zkerika_extra_font_selector2',
            'type'      => 'textarea',
            'title'     => esc_html__('Selector', 'zk-erika'),
            'subtitle'  => esc_html__('add html tags ID or class (body,a,.class-name,#id-name)', 'zk-erika'),
            'validate'  => 'no_html',
            'default'   => '',
        )
    )
));
/**
 * Header 
 * @author Chinh Duong Manh
 * @since 1.0.0
*/
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'zk-erika'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id'        => 'zkerika_header_layout',
            'title'     => esc_html__('Layouts', 'zk-erika'),
            'subtitle'  => esc_html__('select a layout for header', 'zk-erika'),
            'default'   => '1',
            'type'      => 'image_select',
            'options'   => array(
                '1'  => get_template_directory_uri().'/assets/images/header/v1.jpg',
                '2'  => get_template_directory_uri().'/assets/images/header/v2.jpg',
            )
        ),
        $show_rev_slider,
        $show_rev_slider_list,
        $show_rev_slider_page,
        array(
            'title'    => esc_html__('Header Height', 'zk-erika'),
            'subtitle' => esc_html__('Add height for header.', 'zk-erika'),
            'id'       => 'zkerika_header_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'width'    => false,
            'default'  => array(),
        ),
        array(
            'id'       => 'zkerika_header_menu',
            'type'     => 'select',
            'title'    => esc_html__('Header Menu', 'zk-erika'),
            'subtitle' => esc_html__('Choose the menu will show on header.', 'zk-erika'),
            'options'  => zkerika_get_nav_menu(),
            'default'  => 'all-pages',
            'required' => array( 0 => 'zkerika_header_layout', 1 => '=', 2 => '1' )
        ),
        array(
            'id'       => 'zkerika_header_menu_left',
            'type'     => 'select',
            'title'    => esc_html__('Header Menu Left', 'zk-erika'),
            'subtitle' => esc_html__('Choose the menu will show in left handside of LOGO.', 'zk-erika'),
            'options'  => zkerika_get_nav_menu(),
            'default'  => 'short',
            'required' => array( 0 => 'zkerika_header_layout', 1 => '=', 2 => '2' )
        ),
        array(
            'id'       => 'zkerika_header_menu_right',
            'type'     => 'select',
            'title'    => esc_html__('Header Menu', 'zk-erika'),
            'subtitle' => esc_html__('Choose the menu will show in right handside if LOGO.', 'zk-erika'),
            'options'  => zkerika_get_nav_menu(),
            'default'  => 'short',
            'required' => array( 0 => 'zkerika_header_layout', 1 => '=', 2 => '2' )
        ),
        array(
            'title'    => esc_html__('Mega Menu', 'zk-erika'),
            'subtitle' => esc_html__('Enable mega menu', 'zk-erika'),
            'id'       => 'zkerika_enable_mega_menu',
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'title'     => esc_html__('Widget for Mega menu', 'zk-erika'),
            'desc'      => esc_html__('You need manager widget in Widget Manager to get what you want to show in mega menu!', 'zk-erika'),
            'id'        => 'zkerika_mega_menu_wg',
            'type'      => 'slider',
            'min'       => 4,
            'max'       => 20,
            'default'   => 4,
            'display_value'     => 'label',
            'required'  => array('zkerika_enable_mega_menu', '=', 1)
        ),
        array(
            'title'    => esc_html__('Show Search', 'zk-erika'),
            'subtitle' => esc_html__('Show/Hide search icon', 'zk-erika'),
            'id'       => 'zkerika_show_header_search',
            'type'     => 'switch',
            'default'  => true,
        ),
        $show_wc_cart,
        array(
            'title'       => esc_html__('Show Tools', 'zk-erika'),
            'subtitle'    => esc_html__('Show/Hide tool icon', 'zk-erika'),
            'description' => esc_html__('When this options is ON, you need to add a widget to Header Tools area via Widget Manager', 'zk-erika'),
            'id'          => 'zkerika_show_header_tool',
            'type'        => 'switch',
            'default'     => false,
        ),
        
        array(
            'title'       => esc_html__('Show Tools on screen', 'zk-erika'),
            'description' => esc_html__('Tools icon show on what screen display', 'zk-erika'),
            'id'          => 'zkerika_show_header_tool_screen',
            'type'        => 'button_set',
            'multi'       => true,
            'options' => array(
                '1' => esc_html__('Extra Small','zk-erika'), 
                '2' => esc_html__('Small','zk-erika'), 
                '3' => esc_html__('Medium','zk-erika'), 
                '4' => esc_html__('Large','zk-erika'), 
                '5' => esc_html__('Extra Large','zk-erika'), 
             ), 
            'default' => array('1', '2', '3'),
            'required'  => array('zkerika_show_header_tool', '=', 1)
        ),
        array(
            'title'       => esc_html__('Show Sidebar Area', 'zk-erika'),
            'subtitle'    => esc_html__('Show/Hide sidebar area', 'zk-erika'),
            'description' => esc_html__('When this options is ON, you need to add a widget to Sidebar Menu area via Widget Manager', 'zk-erika'),
            'id'          => 'zkerika_sidebar_menu',
            'type'        => 'switch',
            'default'     => false,
        ),
        $show_donate,
        $show_donate_url,
        $show_donate_url2
    )
));

/* Header TOP section Option */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Header Top', 'zk-erika'),
    'heading'       => '',
    'icon'          => 'el-icon-credit-card',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Enable', 'zk-erika'),
            'desc'      => esc_html__('When this option is ON, you need to manage widget in Widget Manager too!', 'zk-erika'),
            'id'        => 'zkerika_header_top',
            'type'      => 'switch',
            'default'   => false,
        ),
        
        array(
            'title'          => esc_html__('Typography', 'zk-erika'),
            'subtitle'       => esc_html__('Choose typography style', 'zk-erika'),
            'id'             => 'zkerika_header_top_typo',
            'type'           => 'typography',
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'default'        => array(),
            'output'         => '#cms-header-top',
            'required'       => array( 'zkerika_header_top', '=', true )
        ),
        array(
            'title'          => esc_html__('Heading Typography', 'zk-erika'),
            'subtitle'       => esc_html__('Choose style for heading tag: H1 -> H6', 'zk-erika'),
            'id'             => 'zkerika_header_top_typo_heading',
            'type'           => 'typography',
            'text-transform' =>  true,
            'letter-spacing' =>  true,
            'text-align'     =>  false,
            'default'        => array(),
            'output'         => array(
                '#cms-header-top .wg-title',
                '#cms-header-top .widget-title',
                '#cms-header-top h1',
                '#cms-header-top h1 a',
                '#cms-header-top h2',
                '#cms-header-top h2 a',
                '#cms-header-top h3',
                '#cms-header-top h3 a',
                '#cms-header-top h4',
                '#cms-header-top h4 a',
                '#cms-header-top h5',
                '#cms-header-top h5 a',
                '#cms-header-top h6',
                '#cms-header-top h6 a',
            ),
            'required' => array( 'zkerika_header_top', '=', true )
        ),
        array(
            'title'    => esc_html__('Link Color', 'zk-erika'),
            'subtitle' => esc_html__('Choose color style for \'a\' tag', 'zk-erika'),
            'id'       => 'zkerika_header_top_link',
            'type'     => 'link_color',
            'active'   => false,
            'default'  => array(),
            'output'   => '#cms-header-top a',
            'required' => array( 'zkerika_header_top', '=', true )
        ),
        array(
            'title'    => esc_html__('Padding', 'zk-erika'),
            'desc'     => esc_html__('Choose space style: Top, Right, Bottom, Left', 'zk-erika'),
            'id'       => 'zkerika_header_top_padding',
            'type'     => 'spacing',
            'mode'     => 'padding',
            'units'    => array('px'),
            'default'  => array(),
            'output'   => '#cms-header-top > div',
            'required' => array( 'zkerika_header_top', '=', true )
        ),
        array(
            'title'     => esc_html__('Background Color', 'zk-erika'),
            'desc'      => esc_html__('Choose background color style', 'zk-erika'),
            'id'        => 'zkerika_header_top_background',
            'type'      => 'color_rgba',
            'default'   => array(),
            'output'    => array(
                'background-color' => '#cms-header-top'
            ),
            'required'  => array( 
                array('zkerika_header_top', '=', true ),
            )
        ),
    )
));
/* Logo Option */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Logo', 'zk-erika'),
    'heading'       => '',
    'icon'          => 'el-icon-picture',
    'subsection'    => true,
    'fields'        => array(
        
        array(
            'id'        => 'zkerika_logo_type',
            'title'     => esc_html__('Logo Type', 'zk-erika'),
            'subtitle'  => esc_html__('Choose your logo is Text or Image', 'zk-erika'),
            'default'   => '1',
            'type'      => 'select',
            'options'   => array(
                '1'     => esc_html__('Image','zk-erika'),
                '2'     => esc_html__('Text','zk-erika'),
            )
        ),
        array(
            'title'     => esc_html__('Logo Width', 'zk-erika'),
            'subtitle'  => esc_html__('Fixed width for logo!', 'zk-erika'),
            'id'        => 'zkerika_logo_size',
            'type'      => 'dimensions',
            'units'     => array('px'),
            'height'    => false,
            'default'   => array(
            ),
            'output'    => '#cms-header-logo',
        ),
        array(
            'title'     => esc_html__('Logo Image', 'zk-erika'),
            'subtitle'  => esc_html__('Select an image file for your logo.', 'zk-erika'),
            'id'        => 'zkerika_main_logo',
            'type'      => 'media',
            'url'       => true,
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_logo_type', '=', 1), 
            ),
        ),
        
        array(
            'title'     => esc_html__('Logo Text', 'zk-erika'),
            'subtitle'  => esc_html__('Enter the text for your logo.', 'zk-erika'),
            'id'        => 'zkerika_main_logo_text',
            'type'      => 'text',
            'required'  => array( 
                array( 'zkerika_logo_type', '=', 2), 
            ),
        ),
        array(
            'title'     => esc_html__('Slogan', 'zk-erika'),
            'subtitle'  => esc_html__('Enter the text for your slogan.', 'zk-erika'),
            'id'        => 'zkerika_main_logo_slogan',
            'type'      => 'text',
        ),
    )
));
/* Header Default */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Header Default', 'zk-erika'),
    'heading'       => '',
    'icon'          => 'el-icon-credit-card',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Background Color', 'zk-erika'),
            'subtitle'  => esc_html__('choose Background color style.', 'zk-erika'),
            'id'        => 'zkerika_header_bg_color',
            'type'      => 'color_rgba',
            'default'   => array(),
            'output'    => array(
                'background-color' => '.header-default',
            ),
        ),
        array(
            'title'     => esc_html__('Background Image', 'zk-erika'),
            'subtitle'  => esc_html__('choose Background image style.', 'zk-erika'),
            'id'        => 'zkerika_header_bg',
            'type'      => 'background',
            'background-color'  => false,
            'default'   => array(),
            'output'    => array('.header-default')
        ),
        array(
            'title'     => esc_html__('Typography', 'zk-erika'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'zk-erika'),
            'id'        => 'zkerika_header_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'line-height'       => false,
            'color'             => false,
            'text-align'        => false,
            'font-style'        => false,
            'default'           => array(),
            'output'    => array('.cms-nav-extra','div.cms-main-navigation.desktop-nav > ul > li > a','#cms-header-logo .logo-text')
        ),
        array(
            'title'     => esc_html__('Link Color', 'zk-erika'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'zk-erika'),
            'id'        => 'zkerika_header_fl_color',
            'type'      => 'link_color',
            'default'   => array(),
            'output'    => array()
        ),
    )
));

/* Header on Top */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Header on Top', 'zk-erika'),
    'heading'       => '',
    'icon'          => 'el-icon-credit-card',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Header on Top', 'zk-erika'),
            'subtitle'  => esc_html__('enable on top header.', 'zk-erika'),
            'id'        => 'zkerika_header_ontop',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'id'        => 'zkerika_header_ontop_page',
            'title'     => esc_html__('Page', 'zk-erika'),
            'type'      => 'select',
            'data'      => 'pages',
            'multi'     => 'true',
            'placeholder'   => esc_html__('Choose page you want applied Header On Top. If empty, Header On Top will applied for all page','zk-erika'),
            'required'  => array( 0 => 'zkerika_header_ontop', '=', 1 )
        ),
        array(
            'title'     => esc_html__('Logo Image', 'zk-erika'),
            'subtitle'  => esc_html__('Select an image file for your logo.', 'zk-erika'),
            'id'        => 'zkerika_header_ontop_logo',
            'type'      => 'media',
            'url'       => true,
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_header_ontop', '=', 1), 
                array( 'zkerika_logo_type', '=', 1), 
            ),
        ),
        array(
            'title'     => esc_html__('Background Color', 'zk-erika'),
            'subtitle'  => esc_html__('choose Background color style.', 'zk-erika'),
            'id'        => 'zkerika_header_ontop_bg_color',
            'type'      => 'color_rgba',
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_header_ontop', '=', 1), 
            ),
            'output'    => array(
                'background-color' => '#cms-header.header-ontop'
            ),
        ),
        array(
            'title'     => esc_html__('Background Image', 'zk-erika'),
            'subtitle'  => esc_html__('choose Background image style.', 'zk-erika'),
            'id'        => 'zkerika_header_ontop_bg',
            'type'      => 'background',
            'background-color'  => false,
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_header_ontop', '=', 1), 
            ),
            'output'    => array(),
        ),
        array(
            'title'     => esc_html__('Typography', 'zk-erika'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'zk-erika'),
            'id'        => 'zkerika_header_ontop_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'line-height'       => false,
            'color'             => false,
            'text-align'        => false,
            'font-style'        => false,
            'font-weight'       => false,
            'default'           => array(),
            'required'  => array( 
                array( 'zkerika_header_ontop', '=', 1), 
            ),
            'output'    => array('.header-ontop .cms-nav-extra','.header-ontop  div.cms-main-navigation.desktop-nav > ul > li > a','.header-ontop  #cms-header-logo .logo-text')
        ),
        array(
            'title'     => esc_html__('Link Color', 'zk-erika'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'zk-erika'),
            'id'        => 'zkerika_header_ontop_fl_color',
            'type'      => 'link_color',
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_header_ontop', '=', 1), 
            ),
            'output'    => array()
        ),
    )
));
/* Sticky Header */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Sticky Header', 'zk-erika'),
    'heading'    => '',
    'icon'       => 'el-icon-credit-card',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Sticky Header', 'zk-erika'),
            'subtitle'  => esc_html__('enable sticky header.', 'zk-erika'),
            'id'        => 'zkerika_header_sticky',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Select Logo', 'zk-erika'),
            'subtitle'  => esc_html__('Select an image file for your logo.', 'zk-erika'),
            'id'        => 'zkerika_header_sticky_logo',
            'type'      => 'media',
            'url'       => true,
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_header_sticky', '=', true), 
                array( 'zkerika_logo_type', '=', 1), 
            ),
        ),
        /* Sticky header default */
        array(
            'title'     => esc_html__('Background Color', 'zk-erika'),
            'subtitle'  => esc_html__('choose Background color style.', 'zk-erika'),
            'id'        => 'zkerika_header_sticky_bg_color',
            'type'      => 'color_rgba',
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_header_sticky', '=', true),
                array( 'zkerika_header_layout', '!=', '3'),
            ),
            'output'    => array(
                'background-color' => '#cms-header.header-sticky'
            ),
        ),
        array(
            'title'     => esc_html__('Background Image', 'zk-erika'),
            'subtitle'  => esc_html__('choose Background image style.', 'zk-erika'),
            'id'        => 'zkerika_header_sticky_bg',
            'type'      => 'background',
            'background-color'  => false,
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_header_sticky', '=', true),
            ),
            'output'    => array('#cms-header.header-sticky'),
        ),
        array(
            'title'     => esc_html__('Typography', 'zk-erika'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'zk-erika'),
            'id'        => 'zkerika_header_sticky_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'line-height'       => false,
            'color'             => false,
            'text-align'        => false,
            'font-style'        => false,
            'font-weight'       => false,
            'default'           => array(),
            'required'  => array( 
                array( 'zkerika_header_sticky', '=', 1), 
            ),
            'output'    => array('.header-sticky .cms-nav-extra','.header-sticky  div.cms-main-navigation:not(.mobile-nav) > ul > li > a','.header-sticky  #cms-header-logo .logo-text')
        ),
        array(
            'title'     => esc_html__('Link Color', 'zk-erika'),
            'subtitle'  => esc_html__('This option just applied for Menu first level', 'zk-erika'),
            'id'        => 'zkerika_header_sticky_fl_color',
            'type'      => 'link_color',
            'default'   => array(),
            'required'  => array( 
                array( 'zkerika_header_sticky', '=', 1), 
            ),
            'output'    => array()
        ),
    )
));

/* Dropdown & Mobile Menu */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Dropdown & Mobile', 'zk-erika'),
    'heading'    => esc_html__('All style in this section will apply for Dropdown & Mobile Menu','zk-erika'),
    'icon'       => 'dashicons dashicons-networking',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Background', 'zk-erika'),
            'subtitle'  => esc_html__('Choose background style.', 'zk-erika'),
            'id'        => 'zkerika_header_dropdown_mobile_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array(
                '.cms-main-navigation.mobile-nav',
                '.cms-main-navigation .sub-menu'
            )
        ),
        array(
            'title'     => esc_html__('Typography', 'zk-erika'),
            'subtitle'  => esc_html__('Choose typography style.', 'zk-erika'),
            'id'        => 'zkerika_header_dropdown_mobile_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'color'             => false,
            'default'   => array(),
            'output'    => array(
                '.cms-main-navigation .sub-menu',
                '.cms-main-navigation.mobile-nav > ul > li > a'
            )
        ),
        array(
            'title'     => esc_html__('Link Color', 'zk-erika'),
            'subtitle'  => esc_html__('Choose color for menu in Dropdown & Mobile', 'zk-erika'),
            'id'        => 'zkerika_header_dropdown_mobile_color',
            'type'      => 'link_color',
            'default'   => array(),
            'output'    => array()
        ),
    )
));
/**
 * Page Title & BC
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'     => esc_html__('Page Title & BC', 'zk-erika'),
    'icon'      => 'el-icon-map-marker',
    'fields'    => array(
        array(
            'title'     => esc_html__('Enable Page title and Breadcrumb', 'zk-erika'),
            'subtitle'  => '',
            'id'        => 'zkerika_page_title',
            'type'      => 'switch',
            'default'   => true
        ),
        array(
            'id'        => 'zkerika_page_title_layout',
            'title'     => esc_html__('Layouts', 'zk-erika'),
            'subtitle'  => esc_html__('select a layout for page title', 'zk-erika'),
            'default'   => '1',
            'type'      => 'image_select',
            'options'   => array(
                '1' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-1.png',
                '2' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-2.png',
                '3' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-3.png',
                '4' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-4.png',
                '5' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-5.png',
                '6' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-6.png',
                '7' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-7.png',
                '8' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-8.png',
            ),
            'required'  => array( 
                array( 'zkerika_page_title', '=', 1), 
            ),
        ),
        array(
            'id'        => 'zkerika_page_title_align',
            'title'     => esc_html__('Content Align', 'zk-erika'),
            'subtitle'  => esc_html__('choose text align for page title', 'zk-erika'),
            'default'   => 'text-start',
            'type'      => 'select',
            'options'   => array(
                'text-start'    => esc_html__('Default','zk-erika'),
                'text-left'     => esc_html__('Left','zk-erika'),
                'text-right'    => esc_html__('Right','zk-erika'),
                'text-center'   => esc_html__('Center','zk-erika'),
            ),
            'required'  => array( 
                array( 'zkerika_page_title', '=', 1),
            )
        ),
        array(
            'id'        => 'zkerika_page_title_bg',
            'title'     => esc_html__('Background', 'zk-erika'),
            'subtitle'  => esc_html__('Choose background style', 'zk-erika'),
            'default'   => array(),
            'type'      => 'background',
            'output'    => array('#cms-page-title-wrapper'),
            'required'  => array( 
                array( 'zkerika_page_title', '=', 1), 
            ),
        ),
        array(
            'id'        => 'zkerika_page_title_bg_overlay',
            'title'     => esc_html__('Overlay Background', 'zk-erika'),
            'subtitle'  => esc_html__('Choose overlay background color', 'zk-erika'),
            'default'   => array(),
            'type'      => 'color_rgba',
            'output'    => array(
                'background-color' => '#cms-page-title-wrapper:before'
            ),
            'required'  => array( 
                array( 'zkerika_page_title', '=', 1), 
            ),
        ),
        array(
            'id'        => 'zkerika_page_title_padding',
            'title'     => esc_html__('Padding', 'zk-erika'),
            'subtitle'  => esc_html__('Enter padding', 'zk-erika'),
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#cms-page-title-wrapper'),
            'required'  => array( 
                array( 'zkerika_page_title', '=', 1), 
            ),
        ),
        array(
            'id'        => 'zkerika_page_title_margin',
            'title'     => esc_html__('Margin', 'zk-erika'),
            'subtitle'  => esc_html__('Enter margin', 'zk-erika'),
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#cms-page-title-wrapper'),
            'required'  => array( 
                array( 'zkerika_page_title', '=', 1), 
            ),
        ),
    )
));

/* Page title  */
Redux::setSection($opt_name, array(
    'icon'          => 'el-icon-random',
    'title'         => esc_html__('Page title', 'zk-erika'),
    'heading'       => '',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Typography for page title', 'zk-erika'),
            'id'        => 'zkerika_pagetitle_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'text-align'        => false,
            'default'   => array(),
            'output'    => array('.cms-page-title-text')
        )
    )
));

/* Breadcrumb */
Redux::setSection($opt_name, array(
    'icon'       => 'el-icon-random',
    'title'      => esc_html__('Breadcrumb', 'zk-erika'),
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Typography for Breadcrumb', 'zk-erika'),
            'id'        => 'zkerika_breadcrumb_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'text-align'        => false,
            'default'   => array(),
            'output'    => array('#cms-breadcrumb')
        ),
        array(
            'title'     => esc_html__('Link Color', 'zk-erika'),
            'id'        => 'zkerika_breadcrumb_link_color',
            'type'      => 'link_color',
            'active'    => false,
            'default'   => array(),
            'output'    => array('#cms-breadcrumb a')
        )
    )
));
/**
 * Main Content
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Content', 'zk-erika'),
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'title'     => esc_html__('Background', 'zk-erika'),
            'subtitle'  => esc_html__('Choose background style', 'zk-erika'),
            'id'        => 'zkerika_main_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('#cms-main')
        ),
        array(
            'title'     => esc_html__('Padding', 'zk-erika'),
            'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'zk-erika'),
            'id'        => 'zkerika_main_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#cms-main')
        ),
    )
));
/**
 * Content Area
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Content Area', 'zk-erika'),
    'icon'       => 'el el-website',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Background', 'zk-erika'),
            'subtitle'  => esc_html__('Choose background style', 'zk-erika'),
            'id'        => 'zkerika_contentarea_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('#content-area')
        ),
        array(
            'title'     => esc_html__('Padding', 'zk-erika'),
            'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'zk-erika'),
            'id'        => 'zkerika_contentarea_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#content-area')
        ),
    )
));
/**
 * Sidebar Area
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Sidebar Area', 'zk-erika'),
    'icon'       => 'el el-website',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Background', 'zk-erika'),
            'subtitle'  => esc_html__('Choose background style', 'zk-erika'),
            'id'        => 'zkerika_sidebararea_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('#sidebar-area')
        ),
        array(
            'title'     => esc_html__('Padding', 'zk-erika'),
            'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'zk-erika'),
            'id'        => 'zkerika_sidebararea_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('#sidebar-area')
        ),
    )
));
/**
 * Page Options
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Page Options', 'zk-erika'),
    'icon'          => 'dashicons dashicons-schedule',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'zkerika_page_layout',
            'title'     => esc_html__('Page layout', 'zk-erika'),
            'description'  => esc_html__('This layout apply for page template layout', 'zk-erika'),
            'type'      => 'button_set',
            'options' => array(
                'left'     => esc_html__('Left Sidebar','zk-erika'), 
                'full'     => esc_html__('No Sidebar','zk-erika'),
                'right'     => esc_html__('Right Sidebar','zk-erika'), 
            ), 
            'default'   => 'full',
        ),
        array(
            'id'        => 'zkerika_page_sidebar',
            'title'     => esc_html__('Sidebar', 'zk-erika'),
            'placeholder'  => esc_html__('select a widget area for page', 'zk-erika'),
            'type'      => 'select',
            'data'      => 'sidebars',
            'default'   => 'sidebar-1',
            'required'  => array( 0 => 'zkerika_page_layout', 1 => '!=', 2 => 'full' )
        )
    )
));
/**
 * Blog Options
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Archives Options', 'zk-erika'),
    'icon'          => 'dashicons dashicons-schedule',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'zkerika_archive_layout',
            'title'     => esc_html__('Archives page layout', 'zk-erika'),
            'description'  => esc_html__('This layout apply for archives page: Recent Post, Category, Tag, Author, Search result, Taxonomy, ...', 'zk-erika'),
            'type'      => 'button_set',
            'options' => array(
                'left'     => esc_html__('Left Sidebar','zk-erika'), 
                'full'     => esc_html__('No Sidebar','zk-erika'),
                'right'     => esc_html__('Right Sidebar','zk-erika'), 
            ), 
            'default'   => 'right',
        ),
        array(
            'id'        => 'zkerika_archive_sidebar',
            'title'     => esc_html__('Sidebar', 'zk-erika'),
            'placeholder'  => esc_html__('select a widget area for archive page', 'zk-erika'),
            'type'      => 'select',
            'data'      => 'sidebars',
            'default'   => 'sidebar-1',
            'required'  => array( 0 => 'zkerika_archive_layout', 1 => '!=', 2 => 'full' )
        ),
        array(
            'id'        => 'zkerika_archive_content_layout',
            'title'     => esc_html__('Content Layouts', 'zk-erika'),
            'subtitle'  => esc_html__('select a layout for content', 'zk-erika'),
            'default'   => 'default',
            'type'      => 'image_select',
            'options'   => array(
                '' => get_template_directory_uri().'/assets/images/archive/content.jpg',
                'list' => get_template_directory_uri().'/assets/images/archive/content-list.jpg',
            ),
            'default'   => ''
        ),
        array(
            'title'     => esc_html__('Show Author', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post author', 'zk-erika'),
            'id'        => 'zkerika_archive_post_author',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Date', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post date', 'zk-erika'),
            'id'        => 'zkerika_archive_post_date',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Category', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post categories', 'zk-erika'),
            'id'        => 'zkerika_archive_post_category',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show tags', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post tags', 'zk-erika'),
            'id'        => 'zkerika_archive_archive_post_tags',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Comment', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post comment count', 'zk-erika'),
            'id'        => 'zkerika_archive_post_comment',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Views', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post view count', 'zk-erika'),
            'id'        => 'zkerika_archive_post_view',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Like', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post Like count', 'zk-erika'),
            'id'        => 'zkerika_archive_post_like',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Share', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide share to', 'zk-erika'),
            'id'        => 'zkerika_archive_post_share',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Read More', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide Read More button', 'zk-erika'),
            'id'        => 'zkerika_archive_post_readmore',
            'type'      => 'switch',
            'default'   => true,
        ),
    )
));


/**
 * Single Post
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Single Post', 'zk-erika'),
    'icon'          => 'dashicons dashicons-align-left',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Single Layout', 'zk-erika'),
            'subtitle'  => esc_html__('Choose a layout for single post page', 'zk-erika'),
            'id'        => 'zkerika_single_post_layout',
            'type'      => 'button_set',
            'options'   => array(
                'left'     => esc_html__('Left Sidebar','zk-erika'),
                'full'     => esc_html__('No Sidebar','zk-erika'),
                'right'     => esc_html__('Right Sidebar','zk-erika'),
            ),
            'default'   => 'right',
        ),
        array(
            'id'        => 'zkerika_single_post_sidebar',
            'title'     => esc_html__('Sidebar', 'zk-erika'),
            'placeholder'  => esc_html__('select a widget area for single post page', 'zk-erika'),
            'type'      => 'select',
            'data'      => 'sidebars',
            'default'   => 'sidebar-1',
            'required'  => array( 0 => 'zkerika_single_post_layout', 1 => '!=', 2 => 'full' )
        ),
        array(
            'title'     => esc_html__('Show Date', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post date', 'zk-erika'),
            'id'        => 'zkerika_single_post_date',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Author', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post author', 'zk-erika'),
            'id'        => 'zkerika_single_post_author',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Category', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post categories', 'zk-erika'),
            'id'        => 'zkerika_single_post_category',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show tags', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post tags', 'zk-erika'),
            'id'        => 'zkerika_single_post_tags',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Comment', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post comment count', 'zk-erika'),
            'id'        => 'zkerika_single_post_comment',
            'type'      => 'switch',
            'default'   => true,
        ),
        array(
            'title'     => esc_html__('Show Views', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post view count', 'zk-erika'),
            'id'        => 'zkerika_single_post_view',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Like', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post Like count', 'zk-erika'),
            'id'        => 'zkerika_single_post_like',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show share', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide icon to social site, like: facebook, twitter, google plus and linkedin', 'zk-erika'),
            'id'        => 'zkerika_single_post_share',
            'type'      => 'switch',
            'default'   => false,
        ),

        array(
            'title'     => esc_html__('Show about author', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide author information', 'zk-erika'),
            'id'        => 'zkerika_single_post_author_info',
            'type'      => 'switch',
            'default'   => false,
        ),
        
        array(
            'title'     => esc_html__('Show Next / Preview Post', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide Next / Preview link to other post', 'zk-erika'),
            'id'        => 'zkerika_single_post_nav',
            'type'      => 'switch',
            'default'   => true,
        ),

        array(
            'title'     => esc_html__('Show Related Post', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide related post. Related post using Post Tag', 'zk-erika'),
            'id'        => 'zkerika_single_post_related',
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Show Comment List & Form', 'zk-erika'),
            'subtitle'  => esc_html__('Show/Hide post commented list & Comment Form', 'zk-erika'),
            'id'        => 'zkerika_single_post_comment_list_form',
            'type'      => 'switch',
            'default'   => true,
        ),
    )
));

/**
 * Extra Options
 *
 * Add some extra config for button, social media, ...
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Extra Options', 'zk-erika'),
    'heading'       => '',
    'icon'          => 'dashicons dashicons-plus-alt',
    'fields'        => array(
    )
));

/* Default */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Default Button', 'zk-erika'),
    'heading'       => esc_html__('Choose style for Default Button', 'zk-erika'),
    'icon'          => 'dashicons dashicons-editor-bold',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Typography', 'zk-erika'),
            'subtitle'  => esc_html__('all style for: font-family, font-size, ...', 'zk-erika'),
            'id'        => 'zkerika_btn_default_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'color'             => false,
            'text-align'        => false,
            'line-height'       => false,
            'default'   => array(),
            'output'    => array('.btn, .btn-default, button, .button, input[type="button"], input[type="submit"]')
        ),
        array(
            'title'     => esc_html__('Text Color', 'zk-erika'),
            'subtitle'  => esc_html__('choose style for color text of button', 'zk-erika'),
            'id'        => 'zkerika_btn_default_color',
            'type'      => 'link_color',
            'active'    => false,
            'default'   => array(),
        ),
        array(
            'title'    => esc_html__('Border', 'zk-erika'),
            'subtitle' => esc_html__('Choose border style for default button', 'zk-erika'),
            'id'       => 'zkerika_btn_default_border',
            'type'     => 'border',
            'all'      => false,
            'default'  => array(
                'border-style'  => 'none'
            )
        ),
        array(
            'title'    => esc_html__('Border Radius', 'zk-erika'),
            'subtitle'     => esc_html__('This option will apply for button radius', 'zk-erika'),
            'id'       => 'zkerika_btn_default_border_radius',
            'type'     => 'dimensions',
            'height'   => false,
            'units'    => array('px'),
            'default'  => array(),
        ),
        array(
            'title'     => esc_html__('Background', 'zk-erika'),
            'subtitle'  => esc_html__('background style default', 'zk-erika'),
            'id'        => 'zkerika_btn_default_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('.btn, .btn-default, button, .button, input[type="button"], input[type="submit"]')
        ),
        array(
            'title'     => '',
            'subtitle'  => esc_html__('background style on mouse over', 'zk-erika'),
            'id'        => 'zkerika_btn_default_bg_hover',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('.btn:hover, .btn-default:hover, button:hover, .button:hover, input[type="button"]:hover, input[type="submit"]:hover')
        ),
    )
));
/* Primary */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Primary Button', 'zk-erika'),
    'heading'       => esc_html__('Choose style for Primary Button', 'zk-erika'),
    'icon'          => 'dashicons dashicons-editor-bold',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Typography', 'zk-erika'),
            'subtitle'  => esc_html__('all style for: font-family, font-size, ...', 'zk-erika'),
            'id'        => 'zkerika_btn_primary_typo',
            'type'      => 'typography',
            'text-transform'    => true,
            'letter-spacing'    => true,
            'color'             => false,
            'text-align'        => false,
            'default'   => array(),
            'output'    => array('.btn-primary')
        ),
        array(
            'title'     => esc_html__('Text Color', 'zk-erika'),
            'subtitle'  => esc_html__('choose style for color text of button', 'zk-erika'),
            'id'        => 'zkerika_btn_primary_color',
            'type'      => 'link_color',
            'active'    => false,
            'default'   => array(),
            'output'    => array()
        ),
        array(
            'title'    => esc_html__('Border', 'zk-erika'),
            'subtitle' => esc_html__('Choose border style for primary button', 'zk-erika'),
            'id'       => 'zkerika_btn_primary_border',
            'type'     => 'border',
            'all'      => false,
            'output'   => array(),
            'default'  => array(
                 'border-style'  => 'none'
            )
        ),
        array(
            'title'    => esc_html__('Border Radius', 'zk-erika'),
            'subtitle'     => esc_html__('This option will apply for button radius: Top, Right, Bottom, Left', 'zk-erika'),
            'id'       => 'zkerika_btn_primary_border_radius',
            'type'     => 'dimensions',
            'height'   => false,
            'units'    => array('px'),
            'default'  => array(),
        ),
        array(
            'title'     => esc_html__('Background', 'zk-erika'),
            'subtitle'  => esc_html__('background style default', 'zk-erika'),
            'id'        => 'zkerika_btn_primary_bg',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('.btn-primary')
        ),
        array(
            'title'     => '',
            'subtitle'  => esc_html__('background style on mouse over', 'zk-erika'),
            'id'        => 'zkerika_btn_primary_bg_hover',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('.btn-primary:hover')
        ),
    )
));

/* Social Media  */
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Social Link', 'zk-erika'),
    'heading'       => '',
    'icon'          => 'dashicons dashicons-share',
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__('Show in Header top', 'zk-erika'),
            'subtitle'  => esc_html__('Show all social link in Header Top section', 'zk-erika'),
            'id'        => 'zkerika_social_header_top',
            'type'      => 'switch',
            'default'   => false,
            'required'  => array( 
                array( 'zkerika_header_top', '=', 1),
                array( 'zkerika_social_number', '!=', 0), 
            ),
        ),
        array(
            'title'     => esc_html__('Show in Header', 'zk-erika'),
            'subtitle'  => esc_html__('Show all social link in Header section (beside the Main Navigation) ', 'zk-erika'),
            'id'        => 'zkerika_social_in_header',
            'type'      => 'switch',
            'default'   => false,
            'required'  => array( 
                array( 'zkerika_social_number', '!=', 0), 
            ),
        ),
        array(
            'title'     => esc_html__('Show in Footer', 'zk-erika'),
            'subtitle'  => esc_html__('Show all social link in Footer section', 'zk-erika'),
            'id'        => 'zkerika_social_footer',
            'type'      => 'switch',
            'default'   => false,
            'required'  => array( 
                array( 'zkerika_social_number', '!=', 0), 
            ),
        ),
        array(
            'title'     => esc_html__('Number of Social', 'zk-erika'),
            'subtitle'  => esc_html__('Choose the number of social link you want to use.', 'zk-erika'),
            'id'        => 'zkerika_social_number',
            'type'      => 'slider',
            "default"   => 0,
            "min"       => 0,
            "step"      => 1,
            "max"       => 10,
            'display_value' => 'label',
        ),
        array(
            'title'     => esc_html__('Link 1', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_1',
            'type'      => 'text',
            'default'   => 'https://facebook.com',
            'required'  => array( 
                array( 'zkerika_social_number', '!=', 0), 
            ),
        ),
        array(
            'title'     => esc_html__('Icon 1 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_1',
            'type'      => 'text',
            'default'   => 'fa fa-facebook',
            'required'  => array( 
                array( 'zkerika_social_number', '!=', 0), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 2', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_2',
            'type'      => 'text',
            'default'   => 'https://twitter.com',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('2','3','4','5','6','7','8','9','10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 2 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_2',
            'type'      => 'text',
            'default'   => 'fa fa-twitter',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('2','3','4','5','6','7','8','9','10')), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 3', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_3',
            'type'      => 'text',
            'default'   => 'https://dribbble.com',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('3','4','5','6','7','8','9','10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 3 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_3',
            'type'      => 'text',
            'default'   => 'fa fa-dribbble',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('3','4','5','6','7','8','9','10')), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 4', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_4',
            'type'      => 'text',
            'default'   => 'https://plus.google.com',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('4','5','6','7','8','9','10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 4 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_4',
            'type'      => 'text',
            'default'   => 'fa fa-google-plus',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('4','5','6','7','8','9','10')), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 5', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_5',
            'type'      => 'text',
            'default'   => 'https://instagram.com',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('5','6','7','8','9','10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 5 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_5',
            'type'      => 'text',
            'default'   => 'fa fa-instagram',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('5','6','7','8','9','10')), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 6', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_6',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('6','7','8','9','10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 6 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_6',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('6','7','8','9','10')), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 7', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_7',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('7','8','9','10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 7 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_7',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('7','8','9','10')), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 8', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_8',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('8','9','10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 8 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_8',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('8','9','10')), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 9', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_9',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('9','10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 9 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_9',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('9','10')), 
            ),
        ),
        array(
            'title'     => esc_html__('Link 10', 'zk-erika'),
            'subtitle'  => esc_html__('Enter a link', 'zk-erika'),
            'id'        => 'zkerika_social_link_10',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('10'))
            ),
        ),
        array(
            'title'     => esc_html__('Icon 10 class', 'zk-erika'),
            'subtitle'  => esc_html__('Enter class name of FontAwesome, ex: fa fa-facebook', 'zk-erika'),
            'id'        => 'zkerika_social_icon_10',
            'type'      => 'text',
            'default'   => '',
            'required'  => array( 
                array( 'zkerika_social_number', '=', array('10')), 
            ),
        ),
    )
));
/**
 * Footer
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'zk-erika'),
    'icon' => 'el el-icon-credit-card',
    'fields' => array(
        array(
            'title'     => esc_html__('Border', 'zk-erika'),
            'subtitle'  => esc_html__('Choose border style', 'zk-erika'),
            'id'        => 'zkerika_footer_border',
            'type'      => 'border',
            'all'       => 'false',
            'units'      => array('px'),
            'default'   => array(
                'border-style'  => 'none'
            ),
            'output'    => array('#cms-footer') 
        ),
        array(
            'title'     => esc_html__('Margin', 'zk-erika'),
            'subtitle'  => esc_html__('Enter outer spacing', 'zk-erika'),
            'id'        => 'zkerika_footer_margin',
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'      => array('px'),
            'default'   => array(
                'margin-top'  =>  ''
            ),
            'output'    => array('#cms-footer') 
        ),
        
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top', 'zk-erika'),
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        
        array(
            'title'     => esc_html__('Columns', 'zk-erika'),
            'desc'      => esc_html__('When you choose this option, you need manager widget in Widget Manager too!', 'zk-erika'),
            'id'        => 'zkerika_footer_top_column',
            'type'      => 'slider',
            'min'       => 0,
            'max'       => 4,
            'default'   => 0,
            'display_value'     => 'label'
        ),
        array(
            'title' => esc_html__('Layout', 'zk-erika'),
            'subtitle' => esc_html__('Choose footer top layout', 'zk-erika'),
            'id' => 'zkerika_footer_top_layout',
            'type'      => 'image_select',
            'options'   => array(
                '1' => get_template_directory_uri() . '/assets/images/header/default.jpg',
            ),
            'default'   => '1',
            'required'  => array( 
                array( 'zkerika_footer_top_column', '!=', 0), 
            ),
        ),
        array(
           'id'       => 'zkerika_footer_top_layout1',
           'type'     => 'section',
           'title'    => esc_html__('Layout 1', 'zk-erika'),
           'subtitle' => esc_html__('Choose style for layout 1', 'zk-erika'),
           'indent'   => true,
           'required'  => array( 
                array( 'zkerika_footer_top_column', '!=', 0), 
            ),
        ),
            array(
                'title'     => esc_html__('Typography', 'zk-erika'),
                'id'        => 'zkerika_footer_top_typo',
                'type'      => 'typography',
                'text-transform'    => true,
                'letter-spacing'    => true,
                'default'   => array(),
                'output'    => array('#cms-footer-top.layout1'),
                'required'  => array( 
                    array( 'zkerika_footer_top_column', '!=', 0), 
                ),
            ),
            array(
                'title'     => esc_html__('Heading Typography', 'zk-erika'),
                'id'        => 'zkerika_footer_top_typo_heading',
                'type'      => 'typography',
                'text-transform'    => true,
                'letter-spacing'    => true,
                'line-height'       => false,
                'default'   => array(),
                'output'    => array(
                    '#cms-footer-top.layout1 .wg-title',
                    '#cms-footer-top.layout1 .widget-title',
                    '#cms-footer-top.layout1 h1',
                    '#cms-footer-top.layout1 h2',
                    '#cms-footer-top.layout1 h3',
                    '#cms-footer-top.layout1 h4',
                    '#cms-footer-top.layout1 h5',
                    '#cms-footer-top.layout1 h6',
                ),
                'required'  => array( 
                    array( 'zkerika_footer_top_column', '!=', 0), 
                ),
            ),
            array(
                'title'     => esc_html__('Link Color', 'zk-erika'),
                'id'        => 'zkerika_footer_top_link_color',
                'type'      => 'link_color',
                'active'    => false,
                'default'   => array(),
                'output'    => array('#cms-footer-top.layout1 a'),
                'required'  => array( 
                    array( 'zkerika_footer_top_column', '!=', 0), 
                ),
            ),
            array(
                'title' => esc_html__('Background', 'zk-erika'),
                'subtitle' => esc_html__('Choose background style', 'zk-erika'),
                'id' => 'zkerika_footer_top_bg',
                'type' => 'background',
                'default' => array(),
                'output'    => array('#cms-footer-top.layout1'),
                'required'  => array( 
                    array( 'zkerika_footer_top_column', '!=', 0), 
                ),
            ),
            array(
                'title'     => esc_html__('Padding', 'zk-erika'),
                'subtitle'  => esc_html__('Enter spacing', 'zk-erika'),
                'id'        => 'zkerika_footer_top_padding',
                'type'      => 'spacing',
                'mode'      => 'padding',
                'units'      => array('px'),
                'default'   => array(),
                'output'    => array('#cms-footer-top.layout1'),
                'required'  => array( 
                    array( 'zkerika_footer_top_column', '!=', 0), 
                ),
            ),
            array(
                'title'     => esc_html__('Margin', 'zk-erika'),
                'subtitle'  => esc_html__('Enter spacing', 'zk-erika'),
                'id'        => 'zkerika_footer_top_margin',
                'type'      => 'spacing',
                'mode'      => 'margin',
                'units'     => array('px'),
                'default'   => array(),
                'output'    => array('#cms-footer-top.layout1'),
                'required'  => array( 
                    array( 'zkerika_footer_top_column', '!=', 0), 
                ),
            ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Footer Bottom', 'zk-erika'),
    'icon'       => '',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'    => esc_html__('Show Footer Bottom', 'zk-erika'),
            'subtitle' => esc_html__('Show/hide your footer bototm', 'zk-erika'),
            'id'       => 'zkerika_footer_bottom',
            'type'     => 'switch',
            'on'       => esc_html__('Yes','zk-erika'),
            'off'      => esc_html__('No','zk-erika'),
            'default'  => '1'
        ),
        array(
            'title'    => esc_html__('Layout', 'zk-erika'),
            'subtitle' => esc_html__('Choose layout for where you want to show copyright text and Social link', 'zk-erika'),
            'id'       => 'zkerika_footer_bottom_layout',
            'type'     => 'image_select',
            'options'  => array(
                '1'        => get_template_directory_uri() . '/assets/images/header/default.jpg',
            ),
            'default'  => '1',
            'required'  => array( 
                array( 'zkerika_footer_bottom', '!=', 0), 
            ),
        ),
        array(
            'subtitle'   => esc_html__('Enter your copyright text', 'zk-erika'),
            'id'         => 'zkerika_footer_bottom_copyright',
            'type'       => 'textarea',
            'title'      => esc_html__('Copyright', 'zk-erika'),
            'validate'   => 'html',
            'allow_html' => array('span', 'a'),
            'default'    => '',
            'required'  => array( 
                array( 'zkerika_footer_bottom', '!=', 0), 
            ),
        ),
        array(
            'id'       => 'zkerika_footer_bottom_layout1',
            'type'     => 'section',
            'title'    => esc_html__('Layout 1', 'zk-erika'),
            'subtitle' => esc_html__('Choose style for layout 1', 'zk-erika'),
            'indent'   => true,
            'required'  => array( 
                array( 'zkerika_footer_bottom', '!=', 0), 
            ),
        ),
            array(
                'title'     => esc_html__('Typography', 'zk-erika'),
                'id'        => 'zkerika_footer_bottom_typo',
                'type'      => 'typography',
                'text-transform'    => true,
                'letter-spacing'    => true,
                'text-align'        => false,
                'default'           => array(),
                'output'    => array('#cms-footer-bottom.layout1'),
                'required'  => array( 
                    array( 'zkerika_footer_bottom', '!=', 0), 
                ),
            ),
            array(
                'title'     => esc_html__('Link Color', 'zk-erika'),
                'id'        => 'zkerika_footer_bottom_link_color',
                'type'      => 'link_color',
                'default'   => array(),
                'output'    => array('#cms-footer-bottom.layout1 a'),
                'required'  => array( 
                    array( 'zkerika_footer_bottom', '!=', 0), 
                ),
            ),
            array(
                'title' => esc_html__('Background', 'zk-erika'),
                'subtitle' => esc_html__('Choose background style', 'zk-erika'),
                'id' => 'zkerika_footer_bottom_bg',
                'type' => 'background',
                'default' => array(),
                'output'    => array('#cms-footer-bottom.layout1'),
                'required'  => array( 
                    array( 'zkerika_footer_bottom', '!=', 0), 
                ),
            ),
            array(
                'title'     => esc_html__('Padding', 'zk-erika'),
                'subtitle'  => esc_html__('Enter spacing', 'zk-erika'),
                'id'        => 'zkerika_footer_bottom_padding',
                'type'      => 'spacing',
                'mode'      => 'padding',
                'units'      => array('px'),
                'default'   => array(),
                'output'    => array('#cms-footer-bottom.layout1'),
                'required'  => array( 
                    array( 'zkerika_footer_bottom', '!=', 0), 
                ),
            ),
            array(
                'title'     => esc_html__('Margin', 'zk-erika'),
                'subtitle'  => esc_html__('Enter spacing', 'zk-erika'),
                'id'        => 'zkerika_footer_bottom_margin',
                'type'      => 'spacing',
                'mode'      => 'margin',
                'units'      => array('px'),
                'default'   => array(),
                'output'    => array('#cms-footer-bottom.layout1'),
                'required'  => array( 
                    array( 'zkerika_footer_bottom', '!=', 0), 
                ),
            ),
    )
));

/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Chinh Duong Manh
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Optimal Core', 'zk-erika'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => esc_html__('no minimize , generate css over time...', 'zk-erika'),
            'id' => 'zkerika_dev_mode',
            'type' => 'switch',
            'title' => esc_html__('Dev Mode (not recommended)', 'zk-erika'),
            'default' => true
        )
    )
));