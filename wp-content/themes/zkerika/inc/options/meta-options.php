<?php
/**
 * Meta box config file
 */
if (! class_exists('MetaFramework')) {
    return;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'zkerika_meta_options'),
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Allow you to start the panel in an expanded way initially.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field
    'disable_save_warn' => true,
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => false,

    'output' => false,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => false,
    // save meta to multiple keys.
    'meta_mode' => 'multiple'
);

// -> Set Option To Panel.
MetaFramework::setArgs($args);

add_action('admin_init', 'zkerika_meta_boxs');

MetaFramework::init();

function zkerika_meta_boxs()
{

    /** page options */
    MetaFramework::setMetabox(array(
        'id'            => '_page_main_options',
        'label'         => esc_html__('Page Setting', 'zk-erika'),
        'post_type'     => 'page',
        'context'       => 'advanced',
        'priority'      => 'default',
        'open_expanded' => false,
        'sections'      => array(
            array(
                'title'  => esc_html__('Page Options', 'zk-erika'),
                'id'     => 'tab-page-header',
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'          => 'zkerika_page_layout',
                        'title'       => esc_html__('Page layout', 'zk-erika'),
                        'description' => esc_html__('This layout apply for page template layout', 'zk-erika'),
                        'type'        => 'button_set',
                        'options'     => array(
                            ''          => esc_html__('Default','zk-erika'), 
                            'left'      => esc_html__('Left Sidebar','zk-erika'), 
                            'full'      => esc_html__('No Sidebar','zk-erika'),
                            'right'     => esc_html__('Right Sidebar','zk-erika'), 
                        ), 
                        'default'   => '',
                    ),
                    array(
                        'id'          => 'zkerika_page_sidebar',
                        'title'       => esc_html__('Sidebar', 'zk-erika'),
                        'placeholder' => esc_html__('select a widget area for page', 'zk-erika'),
                        'description' => esc_html__('Leave blank  to load default sidebar from theme option', 'zk-erika'),
                        'type'        => 'select',
                        'data'        => 'sidebars',
                        'default'     => '',
                        'required'    => array( 0 => 'zkerika_page_layout', 1 => '=', 2 => array('left','right') )
                    )
                )
            ),
            array(
                'title'  => esc_html__('Header', 'zk-erika'),
                'id'     => 'tab-page-header',
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'       => 'zkerika_page_header_layout',
                        'title'    => esc_html__('Layouts', 'zk-erika'),
                        'subtitle' => esc_html__('select a layout for header', 'zk-erika'),
                        'default'  => '',
                        'type'     => 'image_select',
                        'options'  => array(
                            '' => get_template_directory_uri() . '/assets/images/header/default.jpg',
                            '1' => get_template_directory_uri() . '/assets/images/header/v1.jpg',
                            '2' => get_template_directory_uri() . '/assets/images/header/v2.jpg',
                        ),
                    ),
                    array(
                        'id'       => 'zkerika_page_header_menu',
                        'type'     => 'select',
                        'title'    => esc_html__('Select Menu', 'zk-erika'),
                        'subtitle' => esc_html__('custom menu for current page', 'zk-erika'),
                        'options'  => zkerika_get_nav_menu(),
                        'default'  => '',
                        'required' => array( 0 => 'zkerika_page_header_layout', 1 => '=', 2 => array('','1') )
                    ),
                    array(
                        'id'       => 'zkerika_page_header_menu_left',
                        'type'     => 'select',
                        'title'    => esc_html__('Header Menu Left', 'zk-erika'),
                        'subtitle' => esc_html__('Choose the menu will show in left handside of LOGO.', 'zk-erika'),
                        'options'  => zkerika_get_nav_menu(),
                        'default'  => '',
                        'required' => array( 0 => 'zkerika_page_header_layout', 1 => '=', 2 => '2' )
                    ),
                    array(
                        'id'       => 'zkerika_page_header_menu_right',
                        'type'     => 'select',
                        'title'    => esc_html__('Header Menu', 'zk-erika'),
                        'subtitle' => esc_html__('Choose the menu will show in right handside if LOGO.', 'zk-erika'),
                        'options'  => zkerika_get_nav_menu(),
                        'default'  => '',
                        'required' => array( 0 => 'zkerika_page_header_layout', 1 => '=', 2 => '2' )
                    ),
                )
            ),
            array(
                'title'  => esc_html__('Page Title & BC', 'zk-erika'),
                'id'     => 'tab-page-title-bc',
                'icon'   => 'el el-map-marker',
                'fields' => array(
                    array(
                        'id'       => 'zkerika_page_title_layout',
                        'title'    => esc_html__('Layouts', 'zk-erika'),
                        'subtitle' => esc_html__('select a layout for page title', 'zk-erika'),
                        'default'  => '',
                        'type'     => 'image_select',
                        'options'  => array(
                            ''     => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-default.png',
                            'none' => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-0.png',
                            '1'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-1.png',
                            '2'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-2.png',
                            '3'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-3.png',
                            '4'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-4.png',
                            '5'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-5.png',
                            '6'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-6.png',
                            '7'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-7.png',
                            '8'    => get_template_directory_uri() . '/assets/images/pagetitle/pt-s-8.png',
                        ), 
                    ),
                    array(
                        'id' => 'zkerika_page_title_text',
                        'type' => 'text',
                        'title' => esc_html__('Custom Title', 'zk-erika'),
                        'subtitle' => esc_html__('Custom current page title.', 'zk-erika'),
                        'required'  => array( 
                            array('zkerika_page_title_layout', '!=', 'none' ),
                        )
                    ),
                    array(
                        'id' => 'zkerika_page_title_subtext',
                        'type' => 'text',
                        'title' => esc_html__('Custom SubTitle', 'zk-erika'),
                        'subtitle' => esc_html__('Custom current page subtitle.', 'zk-erika'),
                        'required'  => array( 
                            array('zkerika_page_title_layout', '!=', 'none' ),
                        )
                    ),
                    array(
                        'id'        => 'zkerika_page_title_bg',
                        'type'      => 'background',
                        'title'     => esc_html__('Custom Background', 'zk-erika'),
                        'subtitle'  => esc_html__('Custom current page title background.', 'zk-erika'),
                        'default'   => '',
                        'required'  => array( 
                            array('zkerika_page_title_layout', '!=', '' ),
                            array('zkerika_page_title_layout', '!=', 'none' ),
                        )
                    ),
                    array(
                        'id'        => 'zkerika_page_title_bg_overlay',
                        'title'     => esc_html__('Overlay Background', 'zk-erika'),
                        'subtitle'  => esc_html__('Choose overlay background color', 'zk-erika'),
                        'type'      => 'color_rgba',
                        'default'   => array(),
                        'required'  => array( 
                            array('zkerika_page_title_layout', '!=', '' ),
                            array('zkerika_page_title_layout', '!=', 'none' ), 
                        ),
                    ),
                    array(
                        'id'        => 'zkerika_page_title_padding',
                        'title'     => esc_html__('Padding', 'zk-erika'),
                        'subtitle'  => esc_html__('Choose a space', 'zk-erika'),
                        'type'      => 'spacing',
                        'mode'      => 'padding',
                        'units'     => array('px'),
                        'required'  => array( 
                            array('zkerika_page_title_layout', '!=', '' ),
                            array('zkerika_page_title_layout', '!=', 'none' ),  
                        ),
                        'default'   => array(),
                    ),
                    array(
                        'id'        => 'zkerika_page_title_margin',
                        'title'     => esc_html__('Margin', 'zk-erika'),
                        'subtitle'  => esc_html__('Choose a space', 'zk-erika'),
                        'type'      => 'spacing',
                        'mode'      => 'margin',
                        'units'     => array('px'),
                        'required'  => array( 
                            array('zkerika_page_title_layout', '!=', '' ),
                            array('zkerika_page_title_layout', '!=', 'none' ), 
                        ),
                        'default'   => array(),
                    ),
                )
            ),
            array(
                'title'     => esc_html__('Footer', 'zk-erika'),
                'heading'   => '',
                'id'        => 'tab-footer',
                'icon'      => 'el el-credit-card',
                'fields'    => array(
                    array(
                        'title'     => esc_html__('Margin', 'zk-erika'),
                        'subtitle'  => esc_html__('Custom footer outer space', 'zk-erika'),
                        'id'        => 'zkerika_page_footer_margin',
                        'type'      => 'spacing',
                        'mode'      => 'margin',
                        'units'     => array('px'),
                        'default'   => array(),
                    ),

                )
            ),
        )
    ));

    /** post options */
    MetaFramework::setMetabox(array(
        'id'            => '_page_post_format_options',
        'label'         => esc_html__('Post Format', 'zk-erika'),
        'post_type'     => 'post',
        'context'       => 'advanced',
        'priority'      => 'default',
        'open_expanded' => true,
        'sections'      => array(
            array(
                'title'  => '',
                'id'     => 'zkerika_post_format', 
                'icon'   => 'el el-laptop',
                'fields' => array(
                    array(
                        'id'       => 'zkerika_format_video_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Select Video Type', 'zk-erika'),
                        'subtitle' => esc_html__('Local video or video-sharing website like: Youtube, Video, Daily Motion, ...', 'zk-erika'),
                        'options'  => array(
                            'local'    => esc_html__('Upload', 'zk-erika'),
                            'embed'    => esc_html__('Embed Video', 'zk-erika'),
                        ),
                        'std'      => ''
                    ),
                    array(
                        'id'             => 'zkerika_format_video_local',
                        'type'           => 'media',
                        'library_filter' =>array('mp4','m4v','mov','wmv','avi','mpg','ogv','3gp','3g2'),
                        'title'          => esc_html__('Local Video', 'zk-erika'),
                        'subtitle'       => esc_html__('Upload video media using the WordPress native uploader', 'zk-erika'),
                        'required'       => array('zkerika_format_video_type', '=', 'local')
                    ),
                    array(
                        'id'             => 'zkerika_format_video_local_thumb',
                        'type'           => 'media',
                        'library_filter' =>array('jpeg', 'jpg', 'png','gif','ico'),
                        'title'          => esc_html__('Video Thumb', 'zk-erika'),
                        'subtitle'       => esc_html__('Upload thumb media using the WordPress native uploader', 'zk-erika'),
                        'required'       => array('zkerika_format_video_type', '=', 'local')
                    ),
                    array(
                        'id'          => 'zkerika_format_embed_video',
                        'type'        => 'text',
                        'title'       => esc_html__('Embed Video', 'zk-erika'),
                        'subtitle'    => esc_html__('Load video from video-sharing website like: Youtube, Vimeo, Daily Motion,... Ex: https://youtu.be/iNJdPyoqt8U', 'zk-erika'),
                        'description' => sprintf('%s <a href="%s" target="_blank">%s</a>', esc_html__('What Sites Can You Embed From? please look at:', 'zk-erika'), esc_url('https://codex.wordpress.org/Embeds'), esc_html__('WordPress Embeds','zk-erika')),
                        'placeholder' => esc_html__('ex: https://youtu.be/iNJdPyoqt8U', 'zk-erika'),
                        'required'    => array('zkerika_format_video_type', '=', 'embed')
                    ),
                    array(
                        'id'       => 'zkerika_format_audio_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Select Audio Type', 'zk-erika'),
                        'subtitle' => esc_html__('Local audio or audio-sharing website like: SoundCloud,...', 'zk-erika'),
                        'options'  => array(
                            'local'    => esc_html__('Upload', 'zk-erika'),
                            'embed'    => esc_html__('Embed Audio', 'zk-erika'),
                        ),
                        'std'      => ''
                    ),
                    array(
                        'id'             => 'zkerika_format_audio',
                        'type'           => 'media',
                        'library_filter' =>array('mp3','m4a','ogg','wav'),
                        'title'          => esc_html__('Audio Media', 'zk-erika'),
                        'subtitle'       => esc_html__('Upload audio media using the WordPress native uploader', 'zk-erika'),
                        'required'       => array('zkerika_format_audio_type', '=', 'local')
                    ),
                    array(
                        'id'          => 'zkerika_format_embed_audio',
                        'type'        => 'text',
                        'title'       => esc_html__('Embed Audio', 'zk-erika'),
                        'subtitle'    => esc_html__('Load audio from audio-sharing website like: SoundCloud,... Ex: https://soundcloud.com/wavey-hefner/lil-pump-gucci-gang-prod-bighead-gnealz', 'zk-erika'),
                        'description' => sprintf('%s <a href="%s" target="_blank">%s</a>', esc_html__('What Sites Can You Embed From? please look at:', 'zk-erika'), esc_url('https://codex.wordpress.org/Embeds'), esc_html__('WordPress Embeds','zk-erika')),
                        'placeholder' => esc_html__('ex: https://soundcloud.com/wavey-hefner/lil-pump-gucci-gang-prod-bighead-gnealz', 'zk-erika'),
                        'required'    => array('zkerika_format_audio_type', '=', 'embed')
                    ),
                    array(
                        'id'             => 'zkerika_format_gallery',
                        'type'           => 'gallery',
                        'library_filter' =>array('jpeg', 'jpg', 'png','gif','ico'),
                        'title'          => esc_html__('Add/Edit Gallery', 'zk-erika'),
                        'subtitle'       => esc_html__('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'zk-erika'),
                    ),
                    array(
                        'id'       => 'zkerika_format_quote_title',
                        'type'     => 'text',
                        'title'    => esc_html__('Quote Title', 'zk-erika'),
                    ),
                    array(
                        'id'    => 'zkerika_format_quote_content',
                        'type'  => 'textarea',
                        'title' => esc_html__('Quote Content', 'zk-erika'),
                    ),
                    array(
                        'id'       => 'zkerika_format_link_text',
                        'type'     => 'text',
                        'placeholder' => 'Google',
                        'title'    => esc_html__('Your Text', 'zk-erika'),
                    ),
                    array(
                        'id'          => 'zkerika_format_link_url',
                        'type'        => 'text',
                        'placeholder' => 'http://google.com',
                        'title'       => esc_html__('Your Link', 'zk-erika'),
                    ),
                )
            ),
        )
    ));
}