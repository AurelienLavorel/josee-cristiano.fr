<?php
/**
 * ZK Erika functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 1170;
	
/**
 * ZK Erika setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * SP ChariyPlus supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0.0
 */
function zkerika_setup() {

	// load language.
	load_theme_textdomain( 'zk-erika' , get_template_directory() . '/languages' );

	// Adds title tag
	add_theme_support( "title-tag" );
	
	// Add woocommerce
	add_theme_support('woocommerce');
	
	// Adds custom header
	add_theme_support( 'custom-header' );
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'quote','link') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'zk-erika' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array('default-color' => 'ffffff',) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1170, 500 , true); // Limited height, hard crop
    /* Change default image thumbnail sizes in wordpress */
    update_option('large_size_w', 770);
    update_option('large_size_h', 520);
    update_option('large_crop', 1); /* limited width/height, hard crop */
    update_option('medium_large_size_w', 570);
    update_option('medium_large_size_h', 385);
    update_option('medium_large_crop', 1); /* limited width/height, hard crop */ 
    update_option('medium_size_w', 370);
    update_option('medium_size_h', 250);
    update_option('medium_crop', 1); /* limited width/height, hard crop */ 
    update_option('thumbnail_size_w', 100);
    update_option('thumbnail_size_h', 100);
    update_option('thumbnail_crop', 1); /* limited width/height, hard crop */
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}

add_action( 'after_setup_theme', 'zkerika_setup' );

/**
 * Enqueue scripts and styles for front-end.
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
function zkerika_front_end_scripts() {
	global $wp_styles, $zkerika_meta_options;
	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0-beta');
    /* all jquery lib use in theme */
    if(file_exists(get_template_directory().'/assets/js/jquery.libs.min.js')){
        wp_register_script( 'jquery.libs.min', get_template_directory_uri() . '/assets/js/jquery.libs.min.js', array('jquery'), '1.0.0');
    } else {
        wp_register_script( 'jquery.libs.min', get_template_directory_uri() . '/assets/js/jquery.libs.js', array('jquery'), '1.0.0');
    }    
    /* Add main.js */
    if(file_exists(get_template_directory().'/assets/js/main.min.js')){
        wp_enqueue_script('zkmetric_main', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), '1.0.0', true);
    } else {
        wp_enqueue_script('zkmetric_main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    }
    /* Add menu.js */
    if(file_exists(get_template_directory().'/assets/js/menu.min.js')){
        wp_enqueue_script('zkmetric_menu', get_template_directory_uri() . '/assets/js/menu.min.js', array('jquery'), '1.0.0', true);
    } else {
        wp_enqueue_script('zkmetric_menu', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '1.0.0', true);
    }
	/* Comment */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css','', '4.0.0-beta');
	
	/* Loads Font stylesheet. */
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css','','4.7.0');     
	wp_enqueue_style('font-Simple-Line-Icons-Pro', get_template_directory_uri() . '/assets/css/Simple-Line-Icons-Pro.css','','1.0.0');		
	
	/* Load static css*/
	wp_enqueue_style('zkerika_static', get_template_directory_uri() . '/assets/css/static.css','','1.0.0');

}
add_action( 'wp_enqueue_scripts', 'zkerika_front_end_scripts' );

/**
 * load admin scripts.
 * 
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
function zkerika_admin_scripts(){

	/* Loads FontAwesome stylesheet. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0');
	/* Adds style for admin */
    wp_enqueue_style('zkerika_admin_css', get_template_directory_uri() . '/assets/css/cms-admin.css', array(), '1.0.0');

	$screen = get_current_screen();

	/* load js for edit post. */
	if($screen->post_type == 'post'){
		/* post format select. */
		wp_enqueue_script('post-format', get_template_directory_uri() . '/assets/js/post-format.js', array(), '1.0.0', true);
	}
}

add_action( 'admin_enqueue_scripts', 'zkerika_admin_scripts' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
function zkerika_widgets_init() {

	global $zkerika_theme_options;

	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'zk-erika' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'zk-erika' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
    /* Shop Sidebar */
    if (class_exists('WooCommerce')) {
        register_sidebar(array(
            'name'          => esc_html__('WooCommerce Sidebar', 'zk-erika'),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__('Appears in WooCommerce Archive page', 'zk-erika'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="wg-title"><span>',
            'after_title'   => '</span></h4>',
        ));
    }
    /* Sidebar Menu */
    if (isset($zkerika_theme_options['zkerika_sidebar_menu']) && $zkerika_theme_options['zkerika_sidebar_menu']) {
        register_sidebar(array(
            'name'          => esc_html__('Sidebar Menu', 'zk-erika'),
            'id'            => 'sidebar-menu',
            'description'   => esc_html__('Appears in Left/Right handside when click Bars icon', 'zk-erika'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="wg-title"><span>',
            'after_title'   => '</span></h4>',
        ));
    }

	/* Header Top */
    if (isset($zkerika_theme_options['zkerika_header_top']) && $zkerika_theme_options['zkerika_header_top']) {
        register_sidebar(array(
            'name'          => esc_html__('Header Top 1', 'zk-erika'),
            'id'            => 'sidebar-header-top-1',
            'description'   => esc_html__('Appears in Top Left of the site', 'zk-erika'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="wg-title">',
            'after_title'   => '</h4>',
        ));
        register_sidebar(array(
            'name'          => esc_html__('Header Top 2', 'zk-erika'),
            'id'            => 'sidebar-header-top-2',
            'description'   => esc_html__('Appears in Top Right of the site', 'zk-erika'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="wg-title">',
            'after_title'   => '</h4>',
        ));
    }
	/* Header Tools */
    if (isset($zkerika_theme_options['zkerika_show_header_tool']) && $zkerika_theme_options['zkerika_show_header_tool']) {
        register_sidebar(array(
            'name'          => esc_html__('Header Tools', 'zk-erika'),
            'id'            => 'header-tool',
            'description'   => esc_html__('Appears in right side of the site when you click on Header TooLs icon', 'zk-erika'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="wg-title">',
            'after_title'   => '</h4>',
        ));
    }
	/* footer-top */
	if(isset($zkerika_theme_options) && !empty($zkerika_theme_options['zkerika_footer_top_column'])) {

		for($i = 1 ; $i <= $zkerika_theme_options['zkerika_footer_top_column'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Top %s', 'zk-erika'), $i),
				'id' => 'sidebar-footer-top-' . $i,
				'description' => esc_html__('Appears at bottm of page', 'zk-erika'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}
	/* Widget for Mega Menu */
    if (isset($zkerika_theme_options) && !empty($zkerika_theme_options['zkerika_enable_mega_menu']) && !empty($zkerika_theme_options['zkerika_mega_menu_wg'])) {
        for ($i = 1; $i <= $zkerika_theme_options['zkerika_mega_menu_wg']; $i++) {
            register_sidebar(array(
                'name'          => sprintf(esc_html__('Mega Menu Widget %s', 'zk-erika'), $i),
                'id'            => 'megamenu-' . $i,
                'description'   => esc_html__('Add widget here then go to Menu manager and choose the widget you want to show!', 'zk-erika'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="wg-title">',
                'after_title'   => '</h3>',
            ));
        }
    }
}

add_action( 'widgets_init', 'zkerika_widgets_init' );
/**
 * Add widgets
 * @author Chinh Duong Manh
 * @since 1.0.0
 * CMS Instagram
 * CMS Recent Post
 */
require(get_template_directory() . '/inc/widgets/cms_instagram.php');
require(get_template_directory() . '/inc/widgets/cms_quick_contact.php');
require(get_template_directory() . '/inc/widgets/cms_recent_post.php');

/**
 * Display navigation on archive page.
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
function zkerika_paging_nav() {
    the_posts_pagination(array(
    	'prev_text' => '<i class="fa fa-angle-left"></i>',
    	'next_text' => '<i class="fa fa-angle-right"></i>',
    ));
}

/**
 * Add Post view count
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
function zkerika_set_post_views($postID)
{
    $count_key = 'zkerika_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function zkerika_track_post_views($post_id)
{
    if (!is_single()) return;
    if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    zkerika_set_post_views($post_id);
}

add_action('wp_head', 'zkerika_track_post_views');

function zkerika_get_post_views($show_text = true)
{
	global $post;
    $postID = $post->ID;
    $count_key = 'zkerika_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $text = esc_html__('view', 'zk-erika');
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        if ($show_text) {
            return '0' . ' ' . esc_html($text);
        } else {
            return '<i class="fa fa-eye"></i> 0';
        }

    }
    if ($count <= '1') {
        $text = esc_html__('view', 'zk-erika');
        if ($show_text) {
            return '1' . ' ' . esc_html($text);
        } else {
            return '<i class="fa fa-eye"></i> 1';
        }
    } else {
        $text = esc_html__('views', 'zk-erika');
        $count = convert_unit_number($count);
        if ($show_text) {
            return '' . esc_attr($count) . ' ' . esc_html($text);
        } else {
            return '<i class="fa fa-eye"></i> ' . esc_attr($count);
        }
    }
}

function convert_unit_number($number)
{
    if (!is_numeric($number))
        return '0';
    $units = array(
        '1000'    => array(
            'add'      => 'K',
            'decimals' => 1,
        ),
        '1000000' => array(
            'add'      => 'M',
            'decimals' => 2
        )
    );
    $result = $number;
    foreach ($units as $unit => $option) {
        if ($number < $unit)
            break;
        $decimals_val = pow(10, $option['decimals']);
        $number_use = intval(($number / $unit) * $decimals_val);
        $result = $number_use / $decimals_val;
        $result .= $option['add'];
    }
    return $result;

}

/* core functions. */
require_once( get_template_directory() . '/inc/functions.php' );

/* add footer back to top. */
add_action('wp_footer', 'zkerika_back_to_top');

/**
 * Custom WooCommerce template function
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
if (class_exists('WooCommerce')) {
    /* Custom WooCommerce Hook  */
    require get_template_directory() . '/woocommerce/wc-template-hook.php';
}

/**
 * Change default woocommerce thumbnails size
 * This action need to do when active Woo, so it can not add in if(class_exists('Woocommerce'))
 * @since 1.0.0
 * @author Chinh Duong Manh
 */

add_action('init', 'zkerika_change_default_woo_thumb_size');
function zkerika_change_default_woo_thumb_size()
{
    register_activation_hook('woocommerce/woocommerce.php', 'zkerika_woo_image_dimensions');
}

function zkerika_woo_image_dimensions()
{
    global $pagenow;

    $catalog = array(
        'width'  => '570',    // px
        'height' => '570',    // px
        'crop'   => 1        // true
    );
    $single = array(
        'width'  => '570',    // px
        'height' => '570',    // px
        'crop'   => 1        // true
    );
    $thumbnail = array(
        'width'  => '120',    // px
        'height' => '120',    // px
        'crop'   => 1        // false
    );
    /* Image sizes */
    update_option('shop_catalog_image_size', $catalog);       /* Product category thumbs */
    update_option('shop_single_image_size', $single);         /* Single product image */
    update_option('shop_thumbnail_image_size', $thumbnail);   /* Image gallery thumbs */
}

/**
 * Define woocommerce thumbnails size after switch theme
 * This action need to do when active THEME, so it can not add in if(class_exists('Woocommerce'))
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_switch_theme_woo_image_dimensions()
{
    global $pagenow;

    if (!isset($_GET['activated']) || $pagenow != 'themes.php') {
        return;
    }
    $catalog = array(
        'width'  => '570',    // px
        'height' => '570',    // px
        'crop'   => 1        // true
    );
    $single = array(
        'width'  => '570',    // px
        'height' => '570',    // px
        'crop'   => 1        // true
    );
    $thumbnail = array(
        'width'  => '120',    // px
        'height' => '120',    // px
        'crop'   => 1        // false
    );
    // Image sizes
    update_option('shop_catalog_image_size', $catalog);        // Product category thumbs
    update_option('shop_single_image_size', $single);        // Single product image
    update_option('shop_thumbnail_image_size', $thumbnail);    // Image gallery thumbs
}

add_action('after_switch_theme', 'zkerika_switch_theme_woo_image_dimensions', 1);

/**
 * Call default WC single image gallery
 */
function zkerika_wc_single_gallery()
{
    global $zkerika_theme_options;
    if (isset($zkerika_theme_options['zkerika_wc_single_gallery']) && !empty($zkerika_theme_options['zkerika_wc_single_gallery'])) {
        $gal = $zkerika_theme_options['zkerika_wc_single_gallery'];
    } else {
        $gal = 3;
    }
    switch ($gal) {
        case '3':
            /* Zoom */
            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
            break;
        case '2':
            /* Slider and Lightbox */
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
            break;
        default:
            /* Lightbox Only*/
            add_theme_support('wc-product-gallery-lightbox');
            break;
    }
}
add_action('after_setup_theme', 'zkerika_wc_single_gallery');


/**
 * support shortcodes
 * @return array
*/
add_filter('cms-shorcode-list', 'zkerika_shortcodes');
function zkerika_shortcodes(){
	return array('ef4_cms_grid');
}