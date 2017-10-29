<?php
/**
 * get terms
 *
 * @param string $taxonomy
 * @param bool $slug
 * @param array $options
 * @return array
 */
function zkerika_get_terms($taxonomy = 'category', $slug = true, $options = array()){
    $_terms = get_terms($taxonomy, $options);
    $terms = array();
    if(empty( $_terms ) || is_wp_error( $_terms ))
        return $terms;
    foreach ($_terms as $_term){
        if($slug){
            $terms[$_term->slug] = $_term->name;
        } else {
            $terms[$_term->term_id] = $_term->name;
        }
    }
    return $terms;
}

/**
 * get list menu.
 * @return array
 */
function zkerika_get_nav_menu(){
    $menus = array();
    $obj_menus = wp_get_nav_menus();
    /*$menus['none'] = esc_html__('None','zk-erika');*/
    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->slug] = $obj_menu->name;
    }
    return $menus;
}

/**
 * Get RevSlider List 
 * @author Chinh Duong Manh
 * @since 1.0.0
*/
function zkerika_get_list_rev_slider() {
    if (class_exists('RevSlider')) {
        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();
        $revsliders = array();
        if ($arrSliders) {
            foreach ($arrSliders as $slider) {
                /* @var $slider RevSlider */
                $revsliders[$slider->getAlias()] = $slider->getTitle();
            }
        } else {
            $revsliders[0] = esc_html__('No sliders found', 'zk-erika');
        }
        return $revsliders;
    }
}
/**
 * Get Contact Form 7 List 
 * @author Chinh Duong Manh
 * @since 1.0.0
*/
function zkerika_get_list_cf7() {
    if (class_exists('WPCF7')) {
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

        $contact_forms = array();
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->post_title ] = $cform->ID;
            }
        } else {
            $contact_forms[ esc_html__( 'No contact forms found', 'zk-erika' ) ] = 0;
        }
        return $contact_forms;
    }
}

/* Include the TGM_Plugin_Activation class.*/
require_once ( get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php' );

/* load list plugins */
require_once( get_template_directory() . '/inc/options/require.plugins.php' );

/* load demo data setting */
require_once( get_template_directory() . '/inc/demo-data.php' );

/* lip font-awesome */
require_once get_template_directory() . '/inc/libs/font-awesome.php';

/* load mega menu. */
require_once( get_template_directory() . '/inc/mega-menu/functions.php' );

/* load theme options. */
require_once( get_template_directory() . '/inc/options/function.options.php' );

/* load mata options */
require_once(get_template_directory() . '/inc/options/meta-options.php');

/* load taxonomy options */
/*require_once( get_template_directory() . '/inc/options/meta-taxonomy.php' );
*/
/* load template functions */
require_once( get_template_directory() . '/inc/template.functions.php' );

/* load template functions : Post Favorite */
require_once( get_template_directory() . '/inc/post_favorite.php' );

/* load static css. */
require_once( get_template_directory() . '/inc/dynamic/static.css.php' );

/* load dynamic css*/
require_once( get_template_directory() . '/inc/dynamic/dynamic.css.php' );