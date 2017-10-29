<?php
/**
 * WooCommerce Template Hooks
 *
 * Action/filter hooks used for WooCommerce functions/templates.
 *
 * @author      Chinh Duong Manh
 * @category    Core
 * @package     WooCommerce/Templates
 * @version     3.1.x
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Remove all default css style
 * add_filter('woocommerce_enqueue_styles', '__return_empty_array');
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/* Remove style of plugin WooCommerce Quantity Increment */
add_action('wp_enqueue_scripts', 'wcqi_dequeue_quantity');
function wcqi_dequeue_quantity()
{
    wp_dequeue_style('wcqi-css');
}

/**
 * Shop Title .
 * this theme removed it from woocommerce_before_main_content
 */
add_filter('woocommerce_show_page_title', '__return_false');

/**
 * Breadcrumbs.
 * this theme removed Breadcrumbs from woocommerce_before_main_content
 * if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
 * @see woocommerce_breadcrumb()
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/**
 * Change placeholder image path
 * @since 1.0.0
 * @author Chinh Duong Manh
 * add_action( 'init', 'zkerika_woo_placeholder_thumbnail' );
 **/

function zkerika_woo_placeholder_thumbnail()
{
    /*add_filter('woocommerce_placeholder_img_src', 'zkerika_custom_woo_thumbnail_src');*/
    function zkerika_custom_woo_thumbnail_src($src)
    {
        $src = get_template_directory_uri() . '/assets/images/wc-no-image.jpg';
        return $src;
    }
}

/* Shop Loop Items */
/**
 * add custom colomns before shop loop start
 * @since 1.0.0
 * @author Chinh Duong Manh
 * add_action('woocommerce_before_shop_loop','zkerika_wc_before_shop_loop',99999999999);
 * add_action('woocommerce_after_shop_loop','zkerika_wc_after_shop_loop',99999999999);
 **/
if (!function_exists('zkerika_wc_before_shop_loop')) {
    function zkerika_wc_before_shop_loop()
    {
        echo '<div class="woocommerce columns-' . loop_columns() . '">';
    }
}

if (!function_exists('zkerika_wc_after_shop_loop')) {
    function zkerika_wc_after_shop_loop()
    {
        echo '</div>';
    }
}

/**
 * Remove Counter / Sort order
 * remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
 * remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
 */
function zkerika_wc_loop_header_start()
{
    echo '<div class="wc-count-order-wrap clearfix">';
}

function zkerika_wc_loop_header_end()
{
    echo '</div>';
}

add_action('woocommerce_before_shop_loop', 'zkerika_wc_loop_header_start', 0);
add_action('woocommerce_before_shop_loop', 'zkerika_wc_loop_header_end', 9999999);
/**
 * Change number of products per page to 9
 * @since 1.0.0
 * @author Chinh Duong Manh
 **/
function zkerika_loop_shop_per_page()
{
    global $zkerika_theme_options;
    if (isset($_REQUEST['loop_shop_per_page']) && !empty($_REQUEST['loop_shop_per_page'])) {
        return $_REQUEST['loop_shop_per_page'];
    } elseif (!isset($_REQUEST['loop_shop_per_page']) && (isset($_REQUEST['column']) && $_REQUEST['column'] === '4')) {
        return '12';
    } else {
        return isset($zkerika_theme_options['zkerika_wc_archive_per_page']) ? $zkerika_theme_options['zkerika_wc_archive_per_page'] : '9';
    }
}

add_filter('loop_shop_per_page', create_function('$cols', 'return zkerika_loop_shop_per_page();'), zkerika_loop_shop_per_page());

/**
 * Change number of products per row
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
if (!function_exists('loop_columns')) {
    function loop_columns()
    {
        global $zkerika_theme_options;
        if (isset($_REQUEST['column']) && !empty($_REQUEST['column'])) {
            $cols = $_REQUEST['column'];
        } else {
            $cols = isset($zkerika_theme_options['zkerika_wc_archive_column']) ? $zkerika_theme_options['zkerika_wc_archive_column'] : '3';
        }
        return $cols;
    }
}
add_filter('loop_shop_columns', 'loop_columns');

/* add div wrap loop product */
if (!function_exists('zkerika_wc_loop_open')) {
    function zkerika_wc_loop_open()
    {
        echo '<div class="overlay-wrap text-center">';
    }
}
add_action('woocommerce_before_shop_loop_item', 'zkerika_wc_loop_open', 0);

if (!function_exists('zkerika_wc_loop_close')) {
    function zkerika_wc_loop_close()
    {
        echo '</div>';
    }
}
add_action('woocommerce_after_shop_loop_item', 'zkerika_wc_loop_close', 99999);

/* add class to products loop */
/**
 * Adds extra post classes for products.
 *
 * @since 2.1.0
 * @param array $classes
 * @param string|array $class
 * @param int $post_id
 * @return array
 */

function zkerika_wc_product_post_class($class = array(), $post_id = '')
{
    if (!is_singular('product') && in_array(get_post_type($post_id), array('product', 'product_variation'))) {
        $class[] = 'custom-wc-loop-class';
    }
    return $class;
}

add_filter('post_class', 'zkerika_wc_product_post_class', 20, 4);

/* add div wrap image */
if (!function_exists('zkerika_wc_loop_image_open')) {
    function zkerika_wc_loop_image_open()
    {
        echo '<div class="wc-img-wrap">';
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'zkerika_wc_loop_image_open', 0);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 1);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close');
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11);

/**
 * Add div wrap content in image
 * @since 1.0.0
 * @author Chinh Duong Manh
 **/
if (!function_exists('zkerika_wc_loop_image_content_wrap')) {
    function zkerika_wc_loop_image_content_wrap()
    {
        echo '<div class="overlay text-center animated fadeOutDown" style="background: rgba(255,255,255,0);" data-item-animation-in="fadeInDown" data-item-animation-out="fadeOutDown"><div class="overlay-inner vertical-align">';
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'zkerika_wc_loop_image_content_wrap', 12);


add_action('woocommerce_before_shop_loop_item_title', 'zkerika_wc_loop_image_content_icon_open', 13);
if (!function_exists('zkerika_wc_loop_image_content_icon_open')) {
    function zkerika_wc_loop_image_content_icon_open()
    {
        echo '<div class="btn-group">';
    }
}
/* add add to cart to image */
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 13);

add_action('woocommerce_before_shop_loop_item_title', 'zkerika_wc_loop_image_content_icon_close', 9996);
if (!function_exists('zkerika_wc_loop_image_content_icon_close')) {
    function zkerika_wc_loop_image_content_icon_close()
    {
        echo '</div>';
    }
}
/* change position of rating */
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 9997);

if (!function_exists('zkerika_wc_loop_image_close')) {
    function zkerika_wc_loop_image_close()
    {
        echo '</div></div>';
        echo '</div>';
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'zkerika_wc_loop_image_close', 9999);

/* add short description */
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
/* remove add to cart after link closed */
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

/* custom sale flash */
if (!function_exists('zkerika_wc_sale_flash')) {
    function zkerika_wc_sale_flash()
    {
        echo '<span class="wc-onsale accent-bg img-circle">' . esc_html__('Sale', 'zk-erika') . '</span>';
    }
}
add_filter('woocommerce_sale_flash', 'zkerika_wc_sale_flash');
/**
 * Change title structure
 * woocommerce_after_shop_loop_item hook.
 *
 * @hooked zkerika_woocommerce_template_loop_product_title - 10
 */
if (!function_exists('zkerika_woocommerce_template_loop_product_title')) {
    function zkerika_woocommerce_template_loop_product_title()
    {
        the_title('<h4 class="wc-loop-title"><a href="' . esc_url(get_the_permalink()) . '">', '</a></h4>');
    }
}
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'zkerika_woocommerce_template_loop_product_title', 10);


/* Single Product */
/* add div wrap image / summary */
add_action('woocommerce_before_single_product_summary', 'woo_wrap_image_summary_open', 0);
if (!function_exists('woo_wrap_image_summary_open')) {
    function woo_wrap_image_summary_open()
    {
        echo '<div class="img-summary-wrap clearfix">';
    }
}
add_action('woocommerce_after_single_product_summary', 'woo_wrap_image_summary_close', 0);
if (!function_exists('woo_wrap_image_summary_close')) {
    function woo_wrap_image_summary_close()
    {
        echo '</div>';
    }
}
add_action('woocommerce_before_single_product_summary', 'woo_wrap_image_open', 1);
add_action('woocommerce_before_single_product_summary', 'woo_wrap_image_close', 999999);
if (!function_exists('woo_wrap_image_open')) {
    function woo_wrap_image_open()
    {
        echo '<div class="wc-single-img-wrap clearfix">';
    }
}
if (!function_exists('woo_wrap_image_close')) {
    function woo_wrap_image_close()
    {
        echo '</div>';
    }
}
/*
* Custom image gallery Style
*/
if (!function_exists('zkerika_custom_wc_single_gallery')) {
    function zkerika_custom_wc_single_gallery()
    {
        $options = array(
            'rtl'            => is_rtl(),
            'animation'      => 'slide',
            'smoothHeight'   => true,
            'directionNav'   => true,
            'controlNav'     => 'thumbnails',
            'slideshow'      => false,
            'animationSpeed' => 500,
            'animationLoop'  => false, // Breaks photoswipe pagination if true.
        );
        return $options;
    }
}
add_filter('woocommerce_single_product_carousel_options', 'zkerika_custom_wc_single_gallery');

/* Change title structure */
if (!function_exists('woocommerce_template_single_title')) {
    /**
     * Output the product title.
     *
     * @subpackage  Product
     */
    function woocommerce_template_single_title()
    {
        the_title('<h2 class="product-title">', '</h2>');
    }
}
/* Change postion rating/price to price/rating */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 9);
/* Change product attribute none option text */
if (!function_exists('zkerika_wc_pa_option_none')) {
    function zkerika_wc_pa_option_none($args)
    {
        $variation_tax = get_taxonomy($args['attribute']);
        if (!empty($variation_tax)) {
            $args['show_option_none'] = sprintf(esc_html__('Choose %s', 'zk-erika'), $variation_tax->labels->singular_name);
        } else {
            $args['show_option_none'] = esc_html__('Choose an option', 'zk-erika');
        }
        return $args;
    }
}
add_filter('woocommerce_dropdown_variation_attribute_options_args', 'zkerika_wc_pa_option_none', 10);

/**
 * Add theme share
 * add_action('woocommerce_product_meta_end', 'zkerika_post_share_list', 0);
 */


/* Custom product tab heading */
add_filter('woocommerce_product_tabs', 'zkerika_wc_rename_tabs', 98);
function zkerika_wc_rename_tabs($tabs)
{
    global $product;
    if ($product->has_attributes() || $product->has_dimensions() || $product->has_weight()) { // Check if product has attributes, dimensions or weight
        $tabs['additional_information']['title'] = esc_html__('Additional info', 'zk-erika');   // Rename the additional information tab
    }
    return $tabs;
}

/* Remove tab description heading */
add_filter('woocommerce_product_description_heading', 'woo_remove_description_heading');
function woo_remove_description_heading()
{
    return '';
}

/* Remove tab additional heading */
add_filter('woocommerce_product_additional_information_heading', 'woo_remove_additional_heading');
function woo_remove_additional_heading()
{
    return '';
}

/** Change number of upsells output
 * Hooked woocommerce_after_single_product_summary
 */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15);

if (!function_exists('woocommerce_output_upsells')) {
    function woocommerce_output_upsells()
    {
        woocommerce_upsell_display(loop_columns(), loop_columns());
    }
}
/** Change related product column, number output
 * Filter woocommerce_output_related_products_args
 */
add_filter('woocommerce_output_related_products_args', 'zkerika_related_products_args');
function zkerika_related_products_args($args)
{
    $args['posts_per_page'] = loop_columns();
    $args['columns'] = loop_columns();
    return $args;
}

/* Cart Page */

/* Change number of cross-sell product to show */
add_filter('woocommerce_cross_sells_columns', 'zkerika_cross_sells_columns');
if (!function_exists('zkerika_cross_sells_columns')) {
    function zkerika_cross_sells_columns()
    {
        return loop_columns();
    }
}
add_filter('woocommerce_cross_sells_total', 'zkerika_cross_sells_per_page');
if (!function_exists('zkerika_cross_sells_per_page')) {
    function zkerika_cross_sells_per_page()
    {
        return loop_columns();
    }
}

/* Move woocommerce_cross_sell_display to after cart total */
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 11);

/**
 * Checkout Page
 * Custom some element on Checkout Page
 */
/**
 * Remove field label
 * add_filter( 'woocommerce_form_field_args' , 'zkerika_override_woocommerce_form_field' );
 */
function zkerika_override_woocommerce_form_field($args)
{
    $args['label'] = false;
    return $args;
}

/* Reordering Checkout form field */
add_filter("woocommerce_default_address_fields", "zkerika_order_fields");
function zkerika_order_fields($fields)
{
    $fields['country']['priority'] = 1;
    return $fields;
}

/* Archive switch view
 * add switch view to WC Archive page
 * @since 1.0.0
 * @author Chinh Duong Manh
*/
if (!function_exists('zkerika_archive_switch_view')) {
    function zkerika_archive_switch_view()
    {
        global
        $zkerika_theme_options,
        $zkerika_meta_options,
        $product;
        ?>
        <div class="wc-archive-switch-view d-xs-none">
            <a id="grid" class="active" href="#"><i class="fa fa-th"></i></a>
            <a id="list" href="#"><i class="fa fa-bars"></i></a>
        </div>
        <?php
    }
}
add_action('woocommerce_before_shop_loop', 'zkerika_archive_switch_view', 31);

/**
 * New Icon 
 * Add new field for add NEW icon in loop
 * @since 1.0.0
 * @author Chinh Duong Manh
*/
add_filter('woocommerce_general_settings', 'add_order_number_start_setting');
function add_order_number_start_setting($settings)
{
    $updated_settings = array();
    foreach ($settings as $section) {
        // at the bottom of the General Options section
        if (isset($section['id']) && 'general_options' == $section['id'] &&
            isset($section['type']) && 'sectionend' == $section['type']
        ) {
            $updated_settings[] = array(
                'name'     => esc_html__('New product follow day numbers', 'zk-erika'),
                'desc_tip' => esc_html__('The number day for post new products.', 'zk-erika'),
                'id'       => 'new_product_day',
                'type'     => 'select',
                'css'      => 'min-width:100px;',
                'options'  => array(
                    '1' => esc_html__('1', 'zk-erika'),
                    '2' => esc_html__('2', 'zk-erika'),
                    '3' => esc_html__('3', 'zk-erika'),
                    '4' => esc_html__('4', 'zk-erika'),
                    '5' => esc_html__('5', 'zk-erika'),
                    '6' => esc_html__('10', 'zk-erika'),
                    '7' => esc_html__('15', 'zk-erika'),
                    '8' => esc_html__('20', 'zk-erika'),
                    '9' => esc_html__('30', 'zk-erika')
                ),
                'std'      => '1',  // WC < 2.0
                'default'  => '1',  // WC >= 2.0
                'desc'     => esc_html__('show flag new for product be posted from selected time to current', 'zk-erika'),
            );
        }
        $updated_settings[] = $section;
    }
    return $updated_settings;
}

function zkerika_wc_new_flash()
{
    global $post, $product;
    $new_number_days = get_option('new_product_day');
    $date1 = date_create("now");
    $date2 = date_create(get_the_date("Y-m-d"));
    $diff = date_diff($date1, $date2);
    $new_days = (int)$diff->format('%a');
    $sale_cls = '';
    $new_cls = '';
    if ($product->is_on_sale()) {
        $sale_cls = 'has-sale';
    }
    if ($new_days <= (int)$new_number_days) {
        $new_cls = 'has-new';
    }

    if ($new_days <= (int)$new_number_days) {
        echo apply_filters('zkerika_wc_new_flash', '<span class="wc-new accent-bg img-circle">' . esc_html__('New', 'zk-erika') . '</span>', $post, $product);
    }
}

function zkerika_wc_new_flash_start()
{
    echo '<div class="loop-new-flash">';
}

function zkerika_wc_new_flash_end()
{
    echo '</div>';
}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item_title', 'zkerika_wc_new_flash_start', 6);
add_action('woocommerce_before_shop_loop_item_title', 'zkerika_wc_new_flash', 7);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 8);
add_action('woocommerce_before_shop_loop_item_title', 'zkerika_wc_new_flash_end', 9);