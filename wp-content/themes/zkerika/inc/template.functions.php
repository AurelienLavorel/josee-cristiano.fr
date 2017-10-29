<?php
function zkerika_direction(){
    $zkerika_direction = is_rtl() ? 'dir-right' : 'dir-left';
    return $zkerika_direction;
}

/* get pull left / right for RTL language */
function zkerika_pull_align(){
    $zkerika_pull_align = is_rtl() ? 'pull-right' : 'pull-left';
    return $zkerika_pull_align;
}
function zkerika_pull_align2(){
    $zkerika_pull_align = is_rtl() ? 'pull-left' : 'pull-right';
    return $zkerika_pull_align;
}

/* get text-align left / right for RTL language */
function zkerika_text_align(){
    $zkerika_text_align = is_rtl() ? 'right' : 'left';
    return $zkerika_text_align;
}
function zkerika_text_align2(){
    $zkerika_text_align = is_rtl() ? 'left' : 'right';
    return $zkerika_text_align;
}

/**
 * add theme class to body tag
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
add_filter( 'body_class', 'zkerika_body_class' );
function zkerika_body_class($class=''){
    global $zkerika_theme_options, $zkerika_meta_options;
    $class[] = 'cms-body';
    $class[] = is_rtl() ? 'rtl' : 'ltr';
    if(is_front_page()) $class[] = 'home';

    if(!isset($zkerika_theme_options) || empty($zkerika_theme_options['zkerika_header_layout'])) {
        $class[] = 'cms-header-default';
    }
    /* add header layout class. */
    if($zkerika_theme_options['zkerika_header_layout'])
        $class[] = 'cms-header-'.$zkerika_theme_options['zkerika_header_layout'];
    /* add header type class. */
    if($zkerika_theme_options['zkerika_header_ontop'] && !empty($zkerika_theme_options['zkerika_header_ontop_page']) && in_array(get_the_ID(), $zkerika_theme_options['zkerika_header_ontop_page'])){
        $class[] = ' header-ontop-next-no-padding';
    } elseif ($zkerika_theme_options['zkerika_header_ontop'] && empty($zkerika_theme_options['zkerika_header_ontop_page'])) {
        $class[] = '';
    } else {
        $class[] = '';
    }
    /* return body class */
    return $class;

}

/**
 * Page Loading .
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_page_loading() {
    global $zkerika_theme_options;
    if(!isset($zkerika_theme_options)) return; 
    if($zkerika_theme_options['zkerika_page_loading']){
        echo '<div id="cms-loading" style="height:100vh;">';
        switch ($zkerika_theme_options['zkerika_page_loading_style']){
            case '2':
                echo '<div class="spinner wave">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '3':
                echo '<div class="spinner circus">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '4':
                echo '<div class="spinner atom">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '5':
                echo '<div class="spinner fussion">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '6':
                echo '<div class="spinner mitosis">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '7':
                echo '<div class="spinner flower">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '8':
                echo '<div class="spinner clock">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '9':
                echo '<div class="spinner washing-machine">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            case '10':
                echo '<div class="spinner pulse">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
            default:
                echo '<div class="spinner newton">
                  <div class="ball ball-1"></div>
                  <div class="ball ball-2"></div>
                  <div class="ball ball-3"></div>
                  <div class="ball ball-4"></div>
                </div>';
                break;
        }
        echo '</div>';
    }
}

/**
 * Page Class
 * add html class to page
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_page_class($class = ''){
    global $zkerika_theme_options;
    $classes = array();
    $classes[] = 'cms-page';
    /* add boxed class */
    if($zkerika_theme_options['zkerika_body_layout']) $classes[] = 'cms-boxed';
    echo join(' ',$classes);
}

/**
 * get header layout.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_header_layout(){
    global $zkerika_theme_options, $zkerika_meta_options;

    if(empty($zkerika_theme_options)){
        get_template_part('inc/header/header', '');
        return;
    }

    if(is_page() && !empty($zkerika_meta_options['zkerika_page_header_layout']))
        $zkerika_theme_options['zkerika_header_layout'] = $zkerika_meta_options['zkerika_page_header_layout'];

    /* load custom header template. */
    get_template_part('inc/header/header', $zkerika_theme_options['zkerika_header_layout']);
}
/**
 * get header class.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_header_class($class = ''){
    global $zkerika_theme_options;
    $classes = array();
    $classes[] = 'cms-header';
    $ontop_page = array();
    if($zkerika_theme_options['zkerika_header_ontop']) {
        if(isset($zkerika_theme_options['zkerika_header_ontop_page'])) $ontop_page = $zkerika_theme_options['zkerika_header_ontop_page'];
        if(!isset($zkerika_theme_options['zkerika_header_ontop_page'])){
            $classes[] = 'header-ontop';
            if($zkerika_theme_options['zkerika_header_sticky']) $classes[] = 'header-ontop-sticky';
        } else {
            if(in_array(get_the_ID(), $ontop_page)) {
                $classes[] = 'header-ontop';
                if($zkerika_theme_options['zkerika_header_sticky']) $classes[] = 'header-ontop-sticky';
            } elseif (!in_array(get_the_ID(), $ontop_page)) {
                $classes[] = 'header-default';
            } elseif (empty($ontop_page)) {
                $classes[] = 'header-ontop';
                if($zkerika_theme_options['zkerika_header_sticky']) $classes[] = 'header-ontop-sticky';
            }
        }
    } 
    if($zkerika_theme_options['zkerika_header_sticky']) $classes[] = 'sticky-on';

    if(!$zkerika_theme_options['zkerika_header_ontop'] && !$zkerika_theme_options['zkerika_header_sticky']) $classes[] = 'header-default';
    $classes[] = $class;
    echo join(' ',$classes);
}

/**
 * get Header Slider .
 */
function zkerika_header_rev_slider() {
    global $zkerika_theme_options;
    if (!class_exists('RevSlider') || !$zkerika_theme_options['zkerika_show_header_slider'] || empty($zkerika_theme_options['zkerika_header_slider'])) return;
    if(empty($zkerika_theme_options['zkerika_header_slider_page'])){
    ?>
        <div class="cms-header-rev-slider">
            <?php echo do_shortcode('[rev_slider alias="'.$zkerika_theme_options['zkerika_header_slider'].'"]'); ?>
        </div>
    <?php
    } elseif(in_array(get_the_ID(), $zkerika_theme_options['zkerika_header_slider_page'])) {
    ?>
        <div class="cms-header-rev-slider">
            <?php echo do_shortcode('[rev_slider alias="'.$zkerika_theme_options['zkerika_header_slider'].'"]'); ?>
        </div>
    <?php
    }
}
/* Header top */
function zkerika_header_top(){
    global $zkerika_theme_options, $zkerika_meta_options;
    if (isset($zkerika_meta_options['zkerika_page_header_top']) && !empty($zkerika_meta_options['zkerika_page_header_top'])) $zkerika_theme_options['zkerika_header_top'] = $zkerika_meta_options['zkerika_page_header_top'];
    if(!$zkerika_theme_options['zkerika_header_top']) return;
?>
    <div id="cms-header-top" class="cms-header-top clearfix">
        <?php 
            $cls = 'col-md-12';
            if(is_active_sidebar( 'sidebar-header-top-1') && is_active_sidebar( 'sidebar-header-top-2')) $cls = 'col-md-6';  
            if(is_active_sidebar( 'sidebar-header-top-1')) {
                echo '<div class="'.esc_attr($cls).' text-sm-center">';
                    dynamic_sidebar( 'sidebar-header-top-1');
                echo '</div>';
            }
            if(is_active_sidebar( 'sidebar-header-top-2')) {
                echo '<div class="'.esc_attr($cls).' text-sm-center text-md-'.zkerika_text_align2().'">';
                    dynamic_sidebar( 'sidebar-header-top-2');
                echo '</div>';
            }
        ?>
    </div>
<?php 
}

/**
 * get theme logo.
 */
function zkerika_header_logo($class = '', $show_ontop_logo = true, $show_sticky_logo =  true){
    $classes = array();
    $classes[] = 'cms-header-logo';
    $classes[] = $class; 
    global $zkerika_theme_options, $zkerika_meta_options;
    if(isset($zkerika_theme_options) && $zkerika_theme_options['zkerika_logo_type'] == '2') $classes[] = 'logo-type-text';

    echo '<div id="cms-header-logo" class="'.join(' ',$classes).'">';
        if(isset($zkerika_theme_options)) {
            $logo_text = isset($zkerika_theme_options['zkerika_main_logo_text']) && !empty($zkerika_theme_options['zkerika_main_logo_text']) ? $zkerika_theme_options['zkerika_main_logo_text'] : get_bloginfo('name');
            $slogan = isset($zkerika_theme_options['zkerika_main_logo_slogan']) && !empty($zkerika_theme_options['zkerika_main_logo_slogan']) ? $zkerika_theme_options['zkerika_main_logo_slogan'] : get_bloginfo('description');
            $title = esc_html($logo_text).' - '.esc_html($slogan);

            if(is_page() && !empty($zkerika_meta_options['zkerika_page_header_layout'])) $zkerika_theme_options['zkerika_header_layout'] = $zkerika_meta_options['zkerika_page_header_layout'];

            $home = home_url('/');

            if(file_exists(get_template_directory().'/assets/images/logo'.$zkerika_theme_options['zkerika_header_layout'].'.png')){
                $_default_logo = get_template_directory_uri() . '/assets/images/logo'.$zkerika_theme_options['zkerika_header_layout'].'.png';
            } else {
                $_default_logo = get_template_directory_uri() . '/assets/images/logo.png';
            }

            $default_logo = !empty($zkerika_theme_options['zkerika_main_logo']['url']) ? $zkerika_theme_options['zkerika_main_logo']['url'] : $_default_logo;
            $ontop_logo = !empty($zkerika_theme_options['zkerika_header_ontop_logo']['url']) ? $zkerika_theme_options['zkerika_header_ontop_logo']['url'] : get_template_directory_uri() . '/assets/images/logo-ontop.png';
            $sticky_logo = !empty($zkerika_theme_options['zkerika_header_sticky_logo']['url']) ? $zkerika_theme_options['zkerika_header_sticky_logo']['url'] : $ontop_logo ;

            echo '<a href="' . esc_url($home) . '" title="'.esc_html($title).'" class="header-'.esc_attr($zkerika_theme_options['zkerika_header_layout']).'">';
                switch ($zkerika_theme_options['zkerika_logo_type']) {
                    case '2':
                        /* Logo Text */
                        echo '<div class="logo-text">'.esc_html($logo_text).'</div>'; 
                        echo '<div class="logo-slogan">'.esc_html($slogan).'</div>';
   
                    break;
                    
                    default:
                        /* Main Logo */
                        if(!empty($default_logo)) echo '<img class="main-logo" alt="' . esc_attr($title). '" src="' . esc_url($default_logo) . '"/>'; 
                        /* On Top Logo */
                        if(!empty($ontop_logo) && $show_ontop_logo) {
                            echo '<img class="ontop-logo" alt="' . esc_attr($title). '" src="' . esc_url($ontop_logo) . '"/>';
                        }
                        /* Sticky Logo */
                        if(!empty($sticky_logo) && $show_sticky_logo) echo '<img class="sticky-logo" alt="' . esc_attr($title). '" src="' . esc_url($sticky_logo) . '"/>';

                    break;
                }

            echo '</a>';
        } else {
            echo '<a class="default" href="' . esc_url(home_url('/')) . '" title="'.get_bloginfo('name').'"><img alt="' . get_bloginfo('name'). ' - '.get_bloginfo('description').'" src="' . get_template_directory_uri() . '/assets/images/logo.png"></a>';
        }
    echo '</div>';
}

/**
 * main navigation.
 */

function zkerika_header_navigation($class=''){
    global $zkerika_theme_options, $zkerika_meta_options;
    if(is_page_template('page-templates/page-maintenance.php') || is_page_template('page-templates/page-comingsoon.php')) return;
    $dir = is_rtl() ? 'dir-right' : 'dir-left';
    $attr = array(
        'menu_class'        => 'main-nav '.$dir, /* add class when have not existed menu, load page list only */
        'container_class'   => 'container_class cms-main-navigation clearfix', /* add class when have existed menu */
        'theme_location'    => 'primary',
        'link_before'       => '<span class="menu-title">',
        'link_after'        => '</span>',
        'fallback_cb'       => false /* Empty menu if menu doesn't exists */
    );
    if(is_page() && !empty($zkerika_meta_options['zkerika_page_header_menu'])){
        $zkerika_theme_options['zkerika_header_menu'] = $zkerika_meta_options['zkerika_page_header_menu'];
    }
    if(!empty($zkerika_theme_options['zkerika_header_menu'])){
        $attr['menu'] = $zkerika_theme_options['zkerika_header_menu'];
    } else {
        $attr['menu'] = 'all-pages';
    }
    $attr['menu_class'] .= ' menu-'.$attr['menu'];
    /* enable mega menu. */
    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }

    /* main nav. */
    echo '<nav id="cms-navigation" class="cms-navigation '.esc_attr($class).'">';
        wp_nav_menu( $attr );
    echo '</nav>';
}

/**
 * main navigation left.
 * used for header layout 2
 */

function zkerika_header_navigation_left($class=''){
    global $zkerika_theme_options, $zkerika_meta_options;
    if(is_page_template('page-templates/page-maintenance.php') || is_page_template('page-templates/page-comingsoon.php')) return;
    $dir = is_rtl() ? 'dir-right' : 'dir-left';
    $attr = array(
        'menu_class'        => 'main-nav cms-menu-left clearfix '.$dir, /* add class when have not existed menu, load page list only */
        'container_class'   => 'container_class cms-main-navigation', /* add class when have existed menu */
        'theme_location'    => 'primary',
        'link_before'       => '<span class="menu-title">',
        'link_after'        => '</span>',
        'fallback_cb'       => false /* Empty menu if menu doesn't exists */
    );
    if(is_page() && !empty($zkerika_meta_options['zkerika_page_header_menu_left'])){
        $zkerika_theme_options['zkerika_header_menu_left'] = $zkerika_meta_options['zkerika_page_header_menu_left'];
    }
    if(!empty($zkerika_theme_options['zkerika_header_menu_left'])){
        $attr['menu'] = $zkerika_theme_options['zkerika_header_menu_left'];
    } else {
        $attr['menu'] = 'short';
    }
    $attr['menu_class'] .= ' menu-'.$attr['menu'];
    /* enable mega menu. */
    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }

    /* main nav. */
    echo '<nav id="cms-navigation-left" class="cms-navigation '.esc_attr($class).'">';
        wp_nav_menu( $attr );
    echo '</nav>';
}
/**
 * main navigation right.
 * used for header layout 2
 */
function zkerika_header_navigation_right($class=''){
    global $zkerika_theme_options, $zkerika_meta_options;
    if(is_page_template('page-templates/page-maintenance.php') || is_page_template('page-templates/page-comingsoon.php')) return;
    $dir = is_rtl() ? 'dir-right' : 'dir-left';
    $attr = array(
        'menu_class'        => 'main-nav cms-menu-right clearfix '.$dir, /* add class when have not existed menu, load page list only */
        'container_class'   => 'container_class cms-main-navigation', /* add class when have existed menu */
        'theme_location'    => 'primary',
        'link_before'       => '<span class="menu-title">',
        'link_after'        => '</span>',
        'fallback_cb'       => false /* Empty menu if menu doesn't exists */
    );
    if(is_page() && !empty($zkerika_meta_options['zkerika_page_header_menu_right'])){
        $zkerika_theme_options['zkerika_header_menu_right'] = $zkerika_meta_options['zkerika_page_header_menu_right'];
    }
    if(!empty($zkerika_theme_options['zkerika_header_menu_right'])){
        $attr['menu'] = $zkerika_theme_options['zkerika_header_menu_right'];
    } else {
        $attr['menu'] = 'short';
    }
    $attr['menu_class'] .= ' menu-'.$attr['menu'];
    /* enable mega menu. */
    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }

    /* main nav. */
    echo '<nav id="cms-navigation-right" class="cms-navigation '.esc_attr($class).'">';
        wp_nav_menu( $attr );
    echo '</nav>';
}

/**
 * Header extra attributes search, tool menu, cart, ... icon
 * @since 1.0.0
 * @author Chinh Duong Manh
*/
function zkerika_header_extra($class = ''){
    $classes = array();
    $classes[] = $class;
    global $zkerika_theme_options;
    if ($zkerika_theme_options['zkerika_social_in_header'] || $zkerika_theme_options['zkerika_show_header_search'] || (isset($zkerika_theme_options['zkerika_show_header_wc_cart']) && $zkerika_theme_options['zkerika_show_header_wc_cart']) || $zkerika_theme_options['zkerika_show_header_tool'] || $zkerika_theme_options['zkerika_sidebar_menu'] ) { 
        $class .= ' has-extra';
    }
    echo '<div class="cms-nav-extra '.join(' ',$classes).'">';   
        echo '<div class="cms-header-popup clearfix">';
            zkerika_header_extra_attr_icon();
            zkerika_header_search();
            zkerika_header_wc_cart();
            zkerika_header_tools();
        echo '</div>';
    echo '</div>';
}

function zkerika_header_extra_attr_icon(){
    global $zkerika_theme_options, $woocommerce;

    if(is_page_template('page-templates/page-maintenance.php') || is_page_template('page-templates/page-comingsoon.php') ) return;
    echo '<div class="cms-nav-extra-icon">';
    /* Social icon list */
    zkerika_header_social();

    if (isset($zkerika_theme_options) && $zkerika_theme_options['zkerika_show_header_search']  ){
    ?>
        <a href="javascript:void(0)" class="header-icon cms-header-height" data-display=".cms-search" data-no-display=".cms-tools, .cms-cart, .mobile-nav"><span class="fa fa-search"></span></a>
    <?php }
    if ( isset($zkerika_theme_options) && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $zkerika_theme_options['zkerika_show_header_wc_cart'] ) {
    ?>
        <a href="javascript:void(0)" class="header-icon cms-header-height cart" data-display=".cms-cart" data-no-display=".cms-search, .cms-tools, .mobile-nav"><span class="fa fa-shopping-cart"><span class="cart_total"></span></span></a>
    <?php }

    if (isset($zkerika_theme_options) && $zkerika_theme_options['zkerika_show_header_tool'] && is_active_sidebar('header-tool')){
        $display = $zkerika_theme_options['zkerika_show_header_tool_screen'];
        $class = '';
        if(!in_array(1, $display)) $class .=' d-xs-none';
        if(!in_array(2, $display)) $class .=' d-sm-none';
        if(!in_array(3, $display)) $class .=' d-md-none';
        if(!in_array(4, $display)) $class .=' d-lg-none';
        if(!in_array(5, $display)) $class .=' d-xl-none';
        
    ?>
        <a href="javascript:void(0)" class="header-icon cms-header-height <?php echo esc_attr($class); ?>" data-display=".cms-tools" data-no-display=".cms-search, .cms-cart, .mobile-nav"><span class="tool-icon fa fa-cogs"></span></a>
    <?php }  
        /* Sidebar Menu Icon */
    if (isset($zkerika_theme_options) && $zkerika_theme_options['zkerika_sidebar_menu'] && is_active_sidebar('sidebar-menu')  ){
    ?>
        <a href="javascript:void(0)" class="header-icon cms-header-height" data-display=".sidebar-menu" data-no-display=".cms-search, .cms-tools, .cms-cart, .mobile-nav"><span class="fa fa-bars"></span></a>
    <?php }
        /* Mobile Menu Icon */  
        echo '<a id="cms-menu-mobile" class="header-icon cms-header-height d-xl-none" data-display=".mobile-nav" data-no-display=".cms-search, .cms-cart, .cms-tools" ><span class="fa fa-bars" title="'.esc_html__('Open Menu','zk-erika').'"></span></a>';
    echo '</div>';
}

/**
 * Add header Search icon
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_header_search() {
    global $zkerika_theme_options;
    if(!isset($zkerika_theme_options)) return;
    if(is_page_template('page-templates/page-maintenance.php') || is_page_template('page-templates/page-comingsoon.php') ) return;
    if ($zkerika_theme_options['zkerika_show_header_search']){
    ?>
        <div class="popup cms-search">
            <?php get_search_form(); ?>
        </div>
    <?php
    } 
}
/**
 * Add Header WooCommerce Cart 
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_header_wc_cart() { 
    global $zkerika_theme_options, $woocommerce;

    if(!isset($zkerika_theme_options) || !class_exists('WooCommerce')) return;
    if(is_page_template('page-templates/page-maintenance.php') || is_page_template('page-templates/page-comingsoon.php') ) return;
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $zkerika_theme_options['zkerika_show_header_wc_cart'] ) {
    ?>
        <div class="popup woocommerce cms-cart cms-mousewheel">
            <div class="cms-mousewheel-inner widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        </div>
    
    <?php
    }
}
add_filter('add_to_cart_fragments', 'zkerika_add_to_cart_fragment', 10, 1 );
if(!function_exists('zkerika_add_to_cart_fragment')){
    function zkerika_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
        <span class="cart_total"><?php echo (WC()->cart->cart_contents_count != '0') ? WC()->cart->cart_contents_count : ''; ?></span>
        <?php
        $fragments['.cart_total'] = ob_get_clean();
        return $fragments;
    }
}

/**
 * Add Header Tools icon
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_header_tools() { 
    global $zkerika_theme_options;
    if(is_page_template('page-templates/page-maintenance.php') || is_page_template('page-templates/page-comingsoon.php') ) return;
    if ($zkerika_theme_options['zkerika_show_header_tool'] && is_active_sidebar('header-tool')){
    ?>
        <div class="popup cms-tools">
            <?php dynamic_sidebar('header-tool'); ?>
        </div>
    <?php
    }
}
/**
 * Add Sidebar Menu
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_sidebar_menu() { 
    global $zkerika_theme_options;
    if(is_page_template('page-templates/page-maintenance.php') || is_page_template('page-templates/page-comingsoon.php') ) return;
    if ($zkerika_theme_options['zkerika_sidebar_menu'] && is_active_sidebar('sidebar-menu')){
    ?>
        <div class="sidebar-menu">
            <?php dynamic_sidebar('sidebar-menu'); ?>
        </div>
    <?php
    }
}

/**
 * Page Title 
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_page_title(){
    global $zkerika_theme_options, $zkerika_meta_options;
    $show_page_title = $layout = '1';
    /* default. */
    
    $content_align = '';
    $option = 'no-option';
    $page_title_containter_class = 'container';
    /* get theme options */
    if(isset($zkerika_theme_options)){
        $option = '';
        $content_align = $zkerika_theme_options['zkerika_page_title_align'];
        $show_page_title = $zkerika_theme_options['zkerika_page_title'];
    } 
    if(isset($zkerika_theme_options['zkerika_page_title_layout'])){
        $layout = $zkerika_theme_options['zkerika_page_title_layout'];
    }

    if(is_page() && isset($zkerika_meta_options['zkerika_page_title_bg']['background-image']) && !empty($zkerika_meta_options['zkerika_page_title_bg']['background-image'])) {
        $zkerika_theme_options['zkerika_page_title_bg']['background-image'] =  $zkerika_meta_options['zkerika_page_title_bg']['background-image'];
    }
    if(is_page() && isset($zkerika_meta_options['zkerika_page_title_bg']['background-color']) && !empty($zkerika_meta_options['zkerika_page_title_bg']['background-color'])) {
        $zkerika_theme_options['zkerika_page_title_bg']['background-color'] =  $zkerika_meta_options['zkerika_page_title_bg']['background-color'];
    }

    /* custom layout from page. */
    if(is_page() && !empty($zkerika_meta_options['zkerika_page_title_layout'])){
        $layout = $zkerika_meta_options['zkerika_page_title_layout'];
    } 

    $page_title_class = 'layout'.$layout.' '.$content_align.' '.$option;

    if(!$show_page_title || $layout == 'none' || is_404() ) return;
    ?>
    <div id="cms-page-title-wrapper" class="cms-page-title-wrapper <?php echo esc_attr($page_title_class);?>">
        <div class="cms-page-title-inner <?php echo esc_attr($page_title_containter_class); ?>">
        <div class="row">
        <?php switch ($layout){
            case 'none':
                break;
            case '1':
                ?>
                <div id="cms-page-title" class="col-md-12"><?php zkerika_get_page_title(); ?></div>
                <div class="space col-sm-12"></div>
                <?php if(!is_front_page()) { ?>
                    <div id="cms-breadcrumb" class="col-md-12"><?php zkerika_get_bread_crumb(); ?></div>
                <?php
                    }
                break;
            case '2':
                ?>
                <?php if(!is_front_page()) { ?>
                <div id="cms-breadcrumb" class="col-md-12"><?php zkerika_get_bread_crumb(); ?></div>
                <?php } ?>
                <div class="space col-sm-12"></div>
                <div id="cms-page-title" class="col-md-12"><?php zkerika_get_page_title();  ?></div>
                <?php
                break;
            case '3':
                ?>
                <div id="cms-page-title" class="col-lg-6 col-md-12"><?php zkerika_get_page_title(); ?></div>
                <div class="space col-sm-12"></div>
                <?php if(!is_front_page()) { ?>
                    <div id="cms-breadcrumb" class="col-lg-6 col-md-12"><?php zkerika_get_bread_crumb(); ?></div>
                <?php
                    }
                break;
            case '4':
                ?>
                <?php if(!is_front_page()) { ?>
                <div id="cms-breadcrumb" class="col-lg-6 col-md-12 offset-lg-6"><?php zkerika_get_bread_crumb(); ?></div>
                <?php } ?>
                <div class="space col-sm-12"></div>
                <div id="cms-page-title" class="col-lg-6 col-md-12 offset-lg-6"><?php zkerika_get_page_title();  ?></div>
                <?php
                break;
            case '5':
                ?>
                <div id="cms-page-title" class="col-lg-6"><?php zkerika_get_page_title(); ?></div>
                <?php if(!is_front_page()) { ?>
                <div id="cms-breadcrumb" class="cms-breadcrumb col-lg-6"><?php zkerika_get_bread_crumb(); ?></div>
                <?php
                    }
                break;
            case '6':
                ?>
                <?php if(!is_front_page()) { ?>
                <div id="cms-breadcrumb" class="cms-breadcrumb col-lg-6"><?php zkerika_get_bread_crumb(); ?></div>
                <?php } ?>
                <div id="cms-page-title" class="col-lg-6"><?php zkerika_get_page_title(); ?></div>
                <?php
                break;
            case '7':
                ?>
                <div id="cms-page-title" class="col-md-12"><?php zkerika_get_page_title(); ?></div>
                <?php
                break;
            case '8':
                ?>
                <div id="cms-breadcrumb" class="col-md-12"><?php zkerika_get_bread_crumb(); ?></div>
                <?php
                break;
        } ?>
        </div>
        </div>
    </div><!-- #page-title -->
    <?php
}

/**
 * page title text
 */
function zkerika_get_page_title(){
    global $zkerika_theme_options, $zkerika_meta_options;
    $options = '';
    if(!$zkerika_theme_options)  $options = 'no-option';
    echo '<h3 class="cms-page-title-text page-title-text '.esc_attr($options).'">';
    if (!is_archive()){
        /* page. */
        if(is_page()) :
            /* custom title. */
            if(!empty($zkerika_meta_options['zkerika_page_title_text'])):
                echo esc_html($zkerika_meta_options['zkerika_page_title_text']);
            else :
                the_title();
            endif;
            /* custom sub title. */
            if(!empty($zkerika_meta_options['zkerika_page_title_subtext'])):
                echo '<span>'.esc_html($zkerika_meta_options['zkerika_page_title_subtext']).'</span>';
            endif;
        elseif (is_front_page()):
            esc_html_e('Our Blog', 'zk-erika');
        /* search */
        elseif (is_search()):
            printf( esc_html__( 'Search Results for: %s', 'zk-erika' ), '<span>' . get_search_query() . '</span>' );
        /* 404 */
        elseif (is_404()):
            esc_html_e( '404 Page', 'zk-erika');
        /* Single Post */
        elseif(is_singular('post') ):
            echo esc_html__('Our Blog','zk-erika');
        /* Single Portfolio */
        elseif(is_singular('zkportfolio') ):
            echo esc_html__('Single Case','zk-erika');
         /* Single Portfolio */
        elseif(is_singular('product') ):
            echo esc_html__('Single Product','zk-erika');
        /* other */
        else :
            the_title();
        endif;
    } else {
        /* category. */
        if ( is_category() ) :
            single_cat_title();
        /* tag. */     
        elseif ( is_tag() ) : 
            single_tag_title();
        /* author. */
        elseif ( is_author() ) :
            printf( esc_html__( 'Author: %s', 'zk-erika' ), '<span class="vcard">' . get_the_author() . '</span>' );
        /* date */
        elseif ( is_day() ) :
            printf( esc_html__( 'Day: %s', 'zk-erika' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_month() ) :
            printf( esc_html__( 'Month: %s', 'zk-erika' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'zk-erika' ) ) . '</span>' );
        elseif ( is_year() ) :
            printf( esc_html__( 'Year: %s', 'zk-erika' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'zk-erika' ) ) . '</span>' );
        /* post format */
        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            esc_html_e( 'Asides', 'zk-erika' );
        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            esc_html_e( 'Galleries', 'zk-erika');
        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            esc_html_e( 'Images', 'zk-erika');
        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            esc_html_e( 'Videos', 'zk-erika' );
        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            esc_html_e( 'Quotes', 'zk-erika' );
        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            esc_html_e( 'Links', 'zk-erika' );
        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            esc_html_e( 'Statuses', 'zk-erika' );
        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            esc_html_e( 'Audios', 'zk-erika' );
        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            esc_html_e( 'Chats', 'zk-erika' );
        /* woocommerce */
        elseif (function_exists('is_woocommerce') && is_woocommerce()):
            woocommerce_page_title();
        /* Custom taxonomy */
        elseif(is_tax() ):
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            echo esc_html($term->name);
        /* Custom Post type */
        elseif(is_post_type_archive() ):
            post_type_archive_title();
        elseif(is_post_type_archive('zkevent') ):
            esc_html_e( 'All Events', 'zk-erika' );
        elseif(is_post_type_archive('zodonations') ):
            esc_html_e( 'Our Campaigns', 'zk-erika' );
        else :
            /* other */
            the_title();
        endif;
    }
    echo '</h3>';
}

/**
 * Breadcrumb NavXT
 *
 * @since 1.0.0
 */
function zkerika_get_bread_crumb() {
    if(!function_exists('bcn_display')) return;
    bcn_display();
}

/**
 * Main Class
 * add main content HTML class
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_main_class($class = ''){
    $classes = array();
    $classes[] = 'cms-main container';
    $classes[] = $class;
    echo join(' ', $classes);
}

/**
 * Main Content Layout
 * define page layout
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_main_content_class($sidebar = 'sidebar-1', $class = ''){
    global $zkerika_theme_options, $zkerika_meta_options;
    $classes = array();
    $classes[] = 'content-area';
    $classes[] = $class;
    if(is_active_sidebar($sidebar)){
        if(isset($zkerika_theme_options)){
            if(!is_archive()){
                if(is_page()){
                    $_sidebar = $zkerika_theme_options['zkerika_page_layout'];
                    if(isset($zkerika_meta_options['zkerika_page_layout']) && !empty($zkerika_meta_options['zkerika_page_layout'])){
                        $_sidebar = $zkerika_meta_options['zkerika_page_layout'];
                    }
                } elseif (is_front_page()){
                   $_sidebar = $zkerika_theme_options['zkerika_archive_layout'];
                }
                /* search */
                elseif (is_search()){
                   $_sidebar = $zkerika_theme_options['zkerika_archive_layout'];
                }
                /* 404 */
                elseif (is_404()){
                    $_sidebar = $zkerika_theme_options['zkerika_archive_layout'];
                }
                /* Single Post */
                elseif(is_singular('post') ){
                    $_sidebar = $zkerika_theme_options['zkerika_single_post_layout'];
                }
                /* Single product */
                elseif (is_singular('product') ){
                    $_sidebar = 'right';
                } else {
                    $_sidebar = 'full';
                }
            } else {
                $_sidebar = $zkerika_theme_options['zkerika_archive_layout'];
            }
        } else {
            $_sidebar = 'right';
        }
    } else {
        $_sidebar = 'full';
    }
    switch ($_sidebar) {
        case 'left':
            $classes[] = 'col-lg-8 left-sidebar';
            break;
        case 'right':
            $classes[] = 'col-lg-8'; 
            break;
        default:
            $classes[] = 'col-lg-12'; 
            break;
    }
    echo join(' ',$classes);
}
function zkerika_main_sidebar($sidebar = 'sidebar-1'){
    global $zkerika_theme_options, $zkerika_meta_options;
    $classes = array();
    $classes[] = 'sidebar-area col-lg-4';
    
    if(isset($zkerika_theme_options)){
        if(!is_archive()){
            if(is_page()){
                if(isset($zkerika_meta_options['zkerika_page_layout']) && !empty($zkerika_meta_options['zkerika_page_layout'])){
                    $_sidebar = $zkerika_meta_options['zkerika_page_layout'];
                } else {
                    $_sidebar = $zkerika_theme_options['zkerika_page_layout'];
                }
            } elseif (is_front_page()){
               $_sidebar = $zkerika_theme_options['zkerika_archive_layout'];
            }
            /* search */
            elseif (is_search()){
               $_sidebar = $zkerika_theme_options['zkerika_archive_layout'];
            }
            /* 404 */
            elseif (is_404()){
                $_sidebar = $zkerika_theme_options['zkerika_archive_layout'];
            }
            /* Single Post */
            elseif (is_singular('post') ){
                $_sidebar = $zkerika_theme_options['zkerika_single_post_layout'];
            } 
            /* Single Product */
            elseif (is_singular('product') ){
                $_sidebar = 'right';
            } else {
                $_sidebar = 'full';
            }
        } else {
            $_sidebar = $zkerika_theme_options['zkerika_archive_layout'];
        }
    } else {
        $_sidebar = 'right';
    }
    if($_sidebar == 'full' || !is_active_sidebar($sidebar)) return;
    ?>
    <div id="sidebar-area" class="<?php echo join(' ', $classes); ?>">
        <div class="sidebar-inner">
            <?php dynamic_sidebar( $sidebar ); ?>
        </div>
    </div>
<?php 
}

function zkerika_get_sidebar(){
    global $zkerika_theme_options, $zkerika_meta_options;
    
    if(!$zkerika_theme_options){
        $sidebar = 'sidebar-1';
    } else {
        if(is_archive()){
            if (function_exists('is_woocommerce') && is_woocommerce()){
                $sidebar = 'sidebar-shop';
            } else {
                $sidebar = $zkerika_theme_options['zkerika_archive_sidebar'];
            }
            
        } else {
            if(is_page()){
                if(isset($zkerika_meta_options['zkerika_page_sidebar']) && !empty($zkerika_meta_options['zkerika_page_sidebar'])) {
                    $sidebar = $zkerika_meta_options['zkerika_page_sidebar'];
                } else {
                    $sidebar = $zkerika_theme_options['zkerika_page_sidebar'];
                }
            } elseif(is_front_page()){
                $sidebar = $zkerika_theme_options['zkerika_archive_sidebar'];
                if(isset($zkerika_meta_options['zkerika_archive_sidebar'])) $sidebar = $zkerika_meta_options['zkerika_archive_sidebar'];
            } elseif(is_search()){
                $sidebar = $zkerika_theme_options['zkerika_archive_sidebar'];
                if(isset($zkerika_meta_options['zkerika_archive_sidebar'])) $sidebar = $zkerika_meta_options['zkerika_archive_sidebar'];
            } elseif (is_singular('post')) {
                if(isset($zkerika_theme_options['zkerika_single_post_sidebar'])) $sidebar = $zkerika_theme_options['zkerika_single_post_sidebar'];
            } elseif (function_exists('is_woocommerce') && is_woocommerce()){
                $sidebar = 'sidebar-shop';
            } else {
                $sidebar = '';
            }
        }
    }
    return $sidebar;
}
/**
 * Display post share icon
 * 
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
function zkerika_post_share($show_title = true, $before='', $after='', $pos = 'right'){
        global $post, $zkerika_theme_options;
        $url = get_the_permalink();
        $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
        $image = esc_attr($attachment_image[0]);
        $title = get_the_title();
        if($zkerika_theme_options['zkerika_archive_post_share'] || $zkerika_theme_options['zkerika_single_post_share']){
        echo wp_kses_post($before);
    ?>
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="<?php esc_html_e('Share this post to ?','zk-erika'); ?>" data-content='<?php zkerika_post_share_content(); ?>' data-html="true" data-placement="<?php echo esc_attr($pos); ?>"><i class="accent-color zmdi zmdi-share"></i><?php if($show_title) : ?><span class="share-title"><?php esc_html_e('Share this','zk-erika'); ?></span><?php endif; ?></a>        

    <?php 
        echo wp_kses_post($after);
    }  
}

function zkerika_post_share_content(){
    global $post;
    $url = get_the_permalink();
    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
    $image = esc_attr($attachment_image[0]);
    $title = get_the_title();
    ?>
    <ul class="entry-socials-share-list list-inline clearfix">
        <li>
            <a class="twitter" title="<?php esc_html_e('Share this article to Twitter','zk-erika'); ?>"  target="_blank" href="https://twitter.com/home?status=<?php echo esc_html__('Check out this article','zk-erika');?>:%20<?php echo esc_attr($title);?>%20-%20<?php echo esc_url($url);?>">
                <i class="fa fa-twitter"></i>
            </a>
        </li>
        <li>
            <a class="facebook" title="<?php esc_html_e('Share this article to Facebook','zk-erika'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($url);?>">
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        
        <li>
            <a class="google-plus" title="<?php esc_html_e('Share this article to GooglePlus','zk-erika'); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url($url);?>">
                <i class="fa fa-google-plus"></i>
            </a>
        </li>
        <li>
            <a class="linkedin" title="<?php esc_html_e('Share this article to Linkedin','zk-erika'); ?>" target="_blank" href="https://linkedin.com/shareArticle?url=<?php echo esc_url($url);?>">
                <i class="fa fa-linkedin"></i>
            </a>
        </li>
    </ul>
<?php
}

function zkerika_post_share_list(){
    global $post;
    $url = get_the_permalink();
    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
    $image = esc_attr($attachment_image[0]);
    $title = get_the_title();
    ?>
    <ul class="cms-social horizontal colored circle list-unstyled clearfix">
        <li>
            <a class="facebook" title="<?php esc_html_e('Share this article to Facebook','zk-erika'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($url);?>&t=<?php echo esc_html($title); ?>">
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        <li>
            <a class="twitter" title="<?php esc_html_e('Share this article to Twitter','zk-erika'); ?>"  target="_blank" href="https://twitter.com/home?status=<?php echo esc_html__('Check out this article','zk-erika');?>:%20<?php echo esc_attr($title);?>%20-%20<?php echo esc_url($url);?>">
                <i class="fa fa-twitter"></i>
            </a>
        </li>
        
        <li>
            <a class="google-plus" title="<?php esc_html_e('Share this article to GooglePlus','zk-erika'); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url($url);?>">
                <i class="fa fa-google-plus"></i>
            </a>
        </li>
        <li>
            <a class="linkedin" title="<?php esc_html_e('Share this article to Linkedin','zk-erika'); ?>" target="_blank" href="https://linkedin.com/shareArticle?url=<?php echo esc_url($url);?>">
                <i class="fa fa-linkedin"></i>
            </a>
        </li>
        <li>
            <a class="pinterest" title="<?php esc_html_e('Share this article to Pinterest','zk-erika'); ?>" target="_blank" href="https://www.pinterest.com/pin/create/bookmarklet/?media=<?php echo esc_url($image);?>&url=<?php echo esc_url($url);?>&title=<?php echo esc_html($title);?>&description=<?php echo get_the_excerpt();?>">
                <i class="fa fa-pinterest"></i>
            </a>
        </li>
    </ul>
<?php
}

/**
 * Extract and return the first image from passed content.
 *
 * @since 1.0.0
 * @link https://core.trac.wordpress.org/browser/trunk/wp-includes/media.php?rev=24240#L2223
 *
 * @param string  $content A string which might contain a URL.
 * @return string The found URL.
 */
function zkerika_get_image_in_content($content)
{
    $image = '';
    if (!empty($content) && preg_match('#' . get_tag_regex('img') . '#i', $content, $matches) && !empty($matches)) {
        // @todo Sanitize this.
        $image = $matches[0];
    }
    return $image;
}

/** 
 * Max character lenght 
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
*/
function zkerika_max_charlength($text = '', $charlength = '210', $show_tip = false) {
    $charlength++;
    if ( mb_strlen( $text ) > $charlength ) {
        $subex = mb_substr( $text, 0, $charlength ); 
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo esc_html($subex);
        }
        if($show_tip) echo '...';
    } else {
        echo esc_html($text);
    }
}
/**
 * Change default character lenght of the_excerpt().
 * the_excerpt
 */
function zkerika_excerpt_max_charlength($charlength, $show_tip = false) {
    $excerpt = strip_shortcodes(get_the_excerpt());
    $charlength++;
    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength ); 
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo esc_html($subex);
        }
        if($show_tip) echo '...';
    } else {
        echo esc_html($excerpt);
    }
}

/**
 * Display an optional post excerpt.
 * the_excerpt
 */
function zkerika_post_excerpt($charlength = 210, $show_tip = false, $class = ''){
    $post_format = get_post_format();
    ?>
    <div class="archive-summary <?php echo esc_attr($class);?>"><?php zkerika_excerpt_max_charlength($charlength, $show_tip); ?></div>
    <?php
}
/**
 * Display an optional post excerpt.
 * Limited excerpt lenght
 * the_excerpt
 * 
 */
add_filter( 'excerpt_length', 'zkerika_excerpt_length', 1 );
function zkerika_excerpt_length() {
    return 25;
}
/**
 * Change excerpt more text
**/
function zkerika_excerpt_more( $more ) {
    return '&nbsp;...';
}
add_filter('excerpt_more', 'zkerika_excerpt_more');
/**
 * Remove html tag from post excerpt.
 * Like shortcode gallery showing some css style in excerpt
 * the_excerpt
 */
add_filter( 'the_excerpt', 'zkerika_remove_tag_in_excerpt', 20 );
function zkerika_remove_tag_in_excerpt(){
    $excerpt = strip_tags(get_the_excerpt());
    return $excerpt;
}
/**
 * Remove shortcode from post excerpt.
 * if shortcode is not registered with wordpress function add_shortcode
 * ex: remove wpvideo from jetpack
 * the_excerpt
 */
add_filter( 'the_excerpt', 'remove_shortcodes_in_excerpt', 20 );
function remove_shortcodes_in_excerpt( $content){
    $content = strip_shortcodes($content);
    $tagnames = array('wpvideo');  /* add shortcode tag name [box]content[/box] tagname = box */
    $content = do_shortcodes_in_html_tags( $content, true, $tagnames );

    $pattern = get_shortcode_regex( $tagnames );
    $content = preg_replace_callback( "/$pattern/", 'strip_shortcode_tag', $content );
    return $content;
}
/**
 * Get shortcode from content.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_getShortcodeFromContent($shortcode = '', $content = ''){
    $shortcode = get_shortcode_regex();
    preg_match('/'. $shortcode .'/s', $content , $matches);
    return !empty($matches[0]) ? $matches[0] : null ;
}
/**
 * Get HTML tag from content.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_getHTMLTagFromContent($tag = '', $content = ''){
    preg_match('~<'.$tag.'>([\s\S]+?)</'.$tag.'>~', $content, $matches);
    return !empty($matches[0]) ? $matches[0] : null ;
}
/**
 * Display an optional post video.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_post_video($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-video">', $after = '</div>') {
    global $zkerika_theme_options, $zkerika_meta_options, $wp_embed;
    $content = apply_filters( 'the_content', get_the_content() );
    $media = $video = $video_in_content = $opt_video_type = '';
    /* Get video playlist in content */
    $playlists = has_shortcode(get_the_content(), 'playlist');
    if($playlists){
        $playlist = zkerika_getShortcodeFromContent('playlist',get_the_content());
        $video_in_content = apply_filters( 'the_content', $playlist );
    } else {
        /* Only get video from the content if a playlist isn't present. */
        if ( false === strpos( $content, 'wp-playlist-script' ) ) {
            $media = get_media_embedded_in_content( $content, array( 'video','audio', 'object', 'embed', 'iframe') );
        }
        if(!empty($media)) $video_in_content = $media[0];
    }
    /* get video from post option */
    if(isset($zkerika_meta_options)) {
        $opt_video_type = isset($zkerika_meta_options['zkerika_format_video_type']) ? $zkerika_meta_options['zkerika_format_video_type'] : '';
        /* Local video */
        if($opt_video_type === 'local' && !empty($zkerika_meta_options['zkerika_format_video_local']['id'])){
            /* get video meta */
            $opt_video_local = wp_get_attachment_metadata($zkerika_meta_options['zkerika_format_video_local']['id']);
            /* Get default video poster */
            $video_thumb = !empty(get_the_post_thumbnail_url($zkerika_meta_options['zkerika_format_video_local']['id'])) ? get_the_post_thumbnail_url($zkerika_meta_options['zkerika_format_video_local']['id'],'full') : get_the_post_thumbnail_url(get_the_ID(),'full');
            /* change poster */
            $poster = !empty($zkerika_meta_options['zkerika_format_video_local_thumb']['url']) ? $zkerika_meta_options['zkerika_format_video_local_thumb']['url'] : $video_thumb;
            /* Build video */            
            $atts = array(
                'src'    => esc_url($zkerika_meta_options['zkerika_format_video_local']['url']),
                'poster' => esc_url($poster),
                'width'  => esc_attr($zkerika_meta_options['zkerika_format_video_local']['width']),
                'height' => esc_attr($zkerika_meta_options['zkerika_format_video_local']['height'])
            );
            $video = wp_video_shortcode($atts);
        }
        /* Embed Video */
        elseif ($opt_video_type === 'embed' && !empty($zkerika_meta_options['zkerika_format_embed_video'])){
            $video = do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($zkerika_meta_options['zkerika_format_embed_video']).'[/embed]'));
        } 
        /* No option filled -> get video from content */
        elseif(!empty($video_in_content) && !is_singular()){
            $video = $video_in_content;
        }
    } 
    /* No option, get video from content */
    elseif( !empty($video_in_content) && !is_singular()) {
        $video = $video_in_content;
    }
    /* Show video */
    if(!empty($video)){
        echo wp_kses_post($before).$video.wp_kses_post($after);
    } else{
        zkerika_post_thumbnail($size, $default_thumb, $before, $after);
    }
}
/**
 * Display an optional post audio.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_post_audio($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-audio">', $after = '</div>') {
    global $zkerika_theme_options, $zkerika_meta_options, $wp_embed;
    $content = apply_filters( 'the_content', get_the_content() );
    $media = $audio = $audio_in_content = $opt_audio_type = '';
    /* Get video playlist in content */
    $playlists = has_shortcode(get_the_content(), 'playlist');
    /* Get soundcloud shortcode in content */
    $soundclouds = has_shortcode(get_the_content(), 'soundcloud');

    if($playlists){
        $playlist = zkerika_getShortcodeFromContent('playlist',get_the_content());
        $audio_in_content = apply_filters( 'the_content', $playlist );
    } elseif($soundclouds) {
        $soundcloud = zkerika_getShortcodeFromContent('soundcloud', get_the_content());
        $audio_in_content = apply_filters( 'the_content', $soundcloud );
    } else {
        /* Only get video from the content if a playlist isn't present. */
        if ( false === strpos( $content, 'wp-playlist-script' ) ) {
            $media = get_media_embedded_in_content( $content, array( 'video', 'audio', 'object', 'embed', 'iframe') );
        }
        if(!empty($media)) $audio_in_content = $media[0];
    }
    /* get audio from post option */
    if(isset($zkerika_meta_options)) {
        $opt_audio_type = isset($zkerika_meta_options['zkerika_format_audio_type']) ? $zkerika_meta_options['zkerika_format_audio_type'] : '';
        if($opt_audio_type === 'local' && !empty($zkerika_meta_options['zkerika_format_audio']['id'])){
            $audio_thumb = !empty(get_the_post_thumbnail_url($zkerika_meta_options['zkerika_format_audio']['id'])) ? get_the_post_thumbnail_url($zkerika_meta_options['zkerika_format_audio']['id'],'full') : get_the_post_thumbnail_url(get_the_ID(),'full');
            $atts = array(
                'src'    => esc_url($zkerika_meta_options['zkerika_format_audio']['url']),
            );
            $audio =  wp_audio_shortcode($atts);
        } 
        /* Embed Audio */
        elseif ($opt_audio_type === 'embed' && !empty($zkerika_meta_options['zkerika_format_embed_audio'])){
            $audio = do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($zkerika_meta_options['zkerika_format_embed_audio']).'[/embed]'));
        } 
        /* No option filled -> get audio from content */
        elseif(!empty($audio_in_content) && !is_singular()) {
            $audio = $audio_in_content;
        }
    } elseif(!empty($audio_in_content) && !is_singular()) {
        $audio = $audio_in_content;
    }
    /* Show Audio */
    if(!empty($audio)){
        echo wp_kses_post($before).$audio.wp_kses_post($after);
    } else {
        zkerika_post_thumbnail($size, $default_thumb, $before, $after);
    }
}

/**
 * Display an optional post gallery.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_post_gallery($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-gallery">', $after = '</div>'){
    global $zkerika_theme_options, $zkerika_meta_options;
    /* Get the gallery in content */
    $gallery_default = get_post_gallery();  
    $post_type = get_post_type();
    switch ($post_type) {
        case 'zkgallery':
            $gallery_opt = isset($zkerika_meta_options['zkerika_gallery_gallery_img']) ? $zkerika_meta_options['zkerika_gallery_gallery_img'] : array();
            break;
        default:
            $gallery_opt = isset($zkerika_meta_options['zkerika_format_gallery']) ? $zkerika_meta_options['zkerika_format_gallery'] : array();
            break;
    }
    /* no gallery. */
    if(empty($gallery_opt) && empty($gallery_default)) {
        zkerika_post_thumbnail($size, $default_thumb);
        return;
    }
    
    if(!empty($gallery_opt)){
        $array_id = explode(",", $gallery_opt);
        /* Load Pretty Photo (default of VC) */
        wp_enqueue_script('prettyphoto');
        wp_enqueue_style('prettyphoto');
        /* Start Gallery */
        echo wp_kses_post($before);
        ?>
        <div id="carousel-<?php the_ID();?>" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $i = 0; ?>
                <?php foreach ($array_id as $image_id): ?>
                    <?php
                    $attachment_image = wp_get_attachment_image_src($image_id, $size, false);
                    if (function_exists('wpb_getImageBySize')){
                        $img = wpb_getImageBySize( array( 'attach_id' => $image_id, 'thumb_size' => $size ) );
                        $thumbnail = $img['thumbnail'];
                        $large_img_src = $img['p_img_large'][0]; 
                    } else {
                        $thumbnail = '<img src="'.$attachment_image[0].'" alt="" />';
                        $large_img_src = $attachment_image[0];
                    }
                    if($attachment_image[0] != ''):?>
                        <a class="carousel-item prettyphoto text-center <?php if( $i == 0 ){ echo 'active'; } ?>" href="<?php echo esc_url($large_img_src);?>" data-gal="prettyPhoto[rel-<?php the_ID();?>]" title="<?php echo esc_html__('Click to view larger image!','zk-erika'); ?>">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </a>
                    <?php 
                    if($i==0) 
                    $i++; endif; ?>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carousel-<?php the_ID();?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#carousel-<?php the_ID();?>" role="button" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        <?php
        echo wp_kses_post($after);
    } elseif(!empty($gallery_default) && !is_singular()){
        echo wp_kses_post($before).get_post_gallery().wp_kses_post($after);
    }
}

/**
 * Display an optional post quote.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_post_quote($size = 'large', $default_thumb = true, $before = '<div class="entry-media entry-quote">', $after = '</div>') {
    global $zkerika_theme_options, $zkerika_meta_options;
    $quote_in_content = $opt_quote = '';
    /* get quote in content */
    $quote_in_content = zkerika_getHTMLTagFromContent('blockquote', get_the_content());
    /* get quote from meta */
    if(isset($zkerika_meta_options['zkerika_format_quote_content']) && !empty($zkerika_meta_options['zkerika_format_quote_content'])) $opt_quote = $zkerika_meta_options['zkerika_format_quote_content'];

    $thumbnail_url = get_the_post_thumbnail_url( '', $size );
    $styles = array();
    $styles[] = 'background-position: center center';
    $styles[] = 'background-size: cover';
    $styles[] = 'background-attachment: fixed';
    if($thumbnail_url) {
        $styles[] = 'background-image:url('.esc_url($thumbnail_url).')';
    } else {
        /*$styles[] = 'background-image:url('.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').')';*/
        $styles[] = '';
    }
    if ( ! empty( $styles ) ) {
        $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
    } else {
        $style = '';
    }
    /* has quote */
    $quote_title = !empty($zkerika_meta_options['zkerika_format_quote_title']) ? ' <cite>'.esc_html($zkerika_meta_options['zkerika_format_quote_title']).'</cite>' : '';
    if(!empty($opt_quote)){
        $quote_text = '<blockquote>'.wpautop($opt_quote).$quote_title.'</blockquote>';
    } elseif(!empty($quote_in_content) && !is_singular()) {
        $quote_text = $quote_in_content;
    }
    /* start show quote */
    if(!empty($quote_text)){
        echo wp_kses_post($before);
            echo '<div class="entry-quote-inner" ' . $style . '>';
                echo wp_kses_post($quote_text);
            echo '</div>';
        echo wp_kses_post($after);
    } else {
        zkerika_post_thumbnail($size, $default_thumb, $before, $after);
    }
}
/**
 * Display an optional post Link.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_post_link($size = 'large', $default_thumb = true, $before = '<div class="entry-media entry-link">', $after = '</div>') {
    global $zkerika_theme_options, $zkerika_meta_options;
    $opt_link = $link_title = $helltip = $inner_class = '';
    /* get quote from meta */
    if(isset($zkerika_meta_options['zkerika_format_link_url']) && !empty($zkerika_meta_options['zkerika_format_link_url'])) $opt_link = $zkerika_meta_options['zkerika_format_link_url'];

    $thumbnail_url = get_the_post_thumbnail_url( '', $size );
    $styles = array();
    $styles[] = 'background-position: center center';
    $styles[] = 'background-size: cover';
    $styles[] = 'background-attachment: fixed';
    if($thumbnail_url) {
        $styles[] = 'background-image:url('.esc_url($thumbnail_url).')';
        $inner_class = 'has-thumbnail';
    } else {
        $styles[] = '';
    }
    if ( ! empty( $styles ) ) {
        $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
    } else {
        $style = '';
    }
    /* has link */
    $link_title = !empty($zkerika_meta_options['zkerika_format_link_text']) ? $zkerika_meta_options['zkerika_format_link_text'] : $opt_link;
    if(strlen($link_title) > 34){
        $helltip = '...';
    }
    /* start show link */
    if(!empty($opt_link)){
        echo wp_kses_post($before);
            echo '<div class="entry-link-inner '.esc_attr($inner_class).'" '. $style . ' >';
            echo '<i class="icon-link-2 '.zkerika_pull_align2().'"></i><a href="'.esc_url($opt_link).'">'.esc_html(substr($link_title, 0, 34).$helltip).'</a>';
            echo '</div>';
        echo wp_kses_post($after);
    } else {
        zkerika_post_thumbnail($size, $default_thumb, $before, $after);
    }
}
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */

function zkerika_post_thumbnail($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-thumbnail">', $after = '</div>') {
    global $zkerika_theme_options, $zkerika_meta_options, $_wp_additional_image_sizes;
    $class = $thumbnail = $content_img = $img_caption = $content_caption = $content_img_caption = '';
    /* get an image in content */
    $content_img = zkerika_get_image_in_content(get_the_content());
    /* get an image caption shortcode in content */
    $img_caption = has_shortcode(get_the_content(), 'caption');
    if($img_caption){
        $content_caption = zkerika_getShortcodeFromContent('caption',get_the_content());
        $content_img_caption = apply_filters( 'the_content', $content_caption );
    }
    /* Gallery from Meta */
    switch (get_post_type()) {
        case 'zkgallery':
            /* Get the gallery in content */
            $gallery_default = get_post_gallery();
            $gallery        = isset($zkerika_meta_options['zkerika_gallery_gallery']) ? $zkerika_meta_options['zkerika_gallery_gallery'] : '';
            break;
        default:
            $gallery = '';
            break;
    }
    /* Check post has thumbnail*/
    if( has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size)){
        $class = ' has-thumbnail';
        if (function_exists('wpb_getImageBySize')){
            $img_id = get_post_thumbnail_id();
            $img = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
            $full_src = wp_get_attachment_image_src($img_id, 'full' );
            $thumbnail_src = $full_src[0];
        } else {
            $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
            $full_src = wp_get_attachment_image_src(get_the_ID(), 'full' );
            $thumbnail_src = $full_src[0];
        }
    } elseif (!empty($gallery)){
        $class = ' has-gallery';
        $gallery_ids = explode(',', $gallery);
        $img_id =  $gallery_ids[0];
        if (function_exists('wpb_getImageBySize')){
            $img = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
            $full_src = wp_get_attachment_image_src($img_id, 'full' );
            $thumbnail_src = $full_src[0];
        } else {
            $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
            $full_src = wp_get_attachment_image_src(get_the_ID(), 'full' );
            $thumbnail_src = $full_src[0];
        }
    } elseif(!empty($content_caption) && !is_singular()){
        $thumbnail = $content_img_caption;
        $thumbnail_src = '';
    } elseif(!empty($content_img) && !is_singular()){
        $thumbnail = $content_img;
        preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $thumbnail, $result);
        $thumbnail_src = array_pop($result);
    } elseif ($default_thumb){
        $class = ' no-image';
        $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'"  title="'.get_the_title().'" />';
        $thumbnail_src = get_template_directory_uri().'/assets/images/no-image.jpg';
    }
    if (!empty($thumbnail) || $default_thumb ) {
        echo wp_kses_post($before.$thumbnail.$after);
    }
}

/**
 * Display an optional post Media.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_post_media($size = 'large', $default_thumb = false, $before = '<div class="entry-media entry-thumbnail">', $after = '</div>') {
    switch (get_post_format()) {
        case 'gallery':
            zkerika_post_gallery($size, $default_thumb, $before, $after);
            break;
        case 'quote':
            zkerika_post_quote($size, $default_thumb, $before, $after);
            break;
        case 'video':
            zkerika_post_video($size, $default_thumb, $before, $after);
            break;
        case 'audio':
            zkerika_post_audio($size, $default_thumb, $before, $after);
            break;
        case 'link':
            zkerika_post_link($size, $default_thumb, $before, $after);
            break;
        default:
            zkerika_post_thumbnail($size, $default_thumb, $before, $after);
            break;
    }
}

/**
 * Display an optional archive post layout.
 */
function zkerika_archive_layout(){
    global $zkerika_theme_options;
    $layout = '';
    if(isset($zkerika_theme_options)){
        $layout = $zkerika_theme_options['zkerika_archive_content_layout'];
    }
    return $layout;
}


/**
 * Display an optional archice post header.
 */
function zkerika_archive_header($heading_tag = 'h3'){
    global $paged;
    $icon_sticky = '';
    if(is_sticky() && $paged == '0'){
        $icon_sticky = '<i class="fa fa-thumb-tack"></i>&nbsp;';
    } 
    ?>
    <header class="archive-header">
        <?php zkerika_archive_detail(); ?>
        <?php the_title( '<'.$heading_tag.' class="archive-title"><a href="' . esc_url( get_permalink() ) . '">'.$icon_sticky, '</a></'.$heading_tag.'>' ); ?>
    </header>
<?php 
}

 /**
 * Display an optional archice post detail.
 */
function zkerika_archive_detail(){
    global $zkerika_theme_options;
    $comment_open = comments_open();
    ?>
    <ul class="archive-meta entry-meta <?php echo zkerika_direction(); ?>">
        <?php if($zkerika_theme_options['zkerika_archive_post_date'] || !$zkerika_theme_options): ?>
            <li class="detail-date"><?php zkerika_post_meta_archive_date_url(); ?></li>
        <?php endif; ?>
        <?php if($zkerika_theme_options['zkerika_archive_post_author'] || !$zkerika_theme_options): ?>
            <li class="detail-author"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></li>
        <?php endif; ?>
        <?php if(has_category() && ($zkerika_theme_options['zkerika_archive_post_category'] || !$zkerika_theme_options)): ?>
            <li class="detail-categories"><i class="fa fa-folder-open"></i>  <?php the_terms( get_the_ID(), 'category', '', ' / ' ); ?></li>
        <?php endif; ?>
        <?php if($zkerika_theme_options['zkerika_archive_post_comment']  && $comment_open): ?>
            <li class="detail-comment"><i class="fa fa-comments-o"></i> <a class="cms-scroll" href="<?php the_permalink(); ?>#comments"><?php echo esc_html(comments_number('0','1','%')); ?> <?php esc_html_e('Comments', 'zk-erika'); ?></a></li>
        <?php endif; ?>
        <?php if($zkerika_theme_options['zkerika_archive_post_view']) : ?><li class="entry-view"><i class="fa fa-eye"></i> <?php echo zkerika_get_post_views(); ?></li><?php endif; ?>
        <?php if($zkerika_theme_options['zkerika_archive_post_like']) : ?><li class="entry-like"><i class="fa fa-heart-o"></i> <?php post_favorite();?></li><?php endif; ?>
        <?php if($zkerika_theme_options['zkerika_archive_post_share']) : ?><li class="entry-share"><i class="fa fa-share-alt-square"></i> <?php zkerika_post_share(); ?></li><?php endif; ?>
        <?php edit_post_link(esc_html__('Edit','zk-erika'),'<li class="detail-edit"><i class="fa fa-edit"></i> ','</a>','',''); ?>
    </ul>
    <?php
}

function zkerika_post_meta_list($show_author = '', $show_date = '',  $show_category = '', $show_comment = '', $show_view = '', $show_like = '', $show_share = '', $class = 'archive-meta'){
    global $zkerika_direction, $zkerika_pull_align;
    $comment_open = comments_open();
    $post_type = get_post_type();
    $taxo = '';
    switch ($post_type) {
        case 'zkportfolio':
            $taxo = 'zkportfolio_cat';
            break;
        case 'zkevent':
            $taxo = 'zkvent_cat';
            break;
        case 'zkcharixyemail':
            $taxo = '';
            break;
        case 'zodonations':
            $taxo = 'zodonationcategory';
            break;
        case 'product':
            $taxo = 'product_cat';
            break;
        default:
            $taxo = 'category';
            break;
    }
?>
    <?php if($show_author || $show_date || $show_category || $show_comment || $show_view || $show_like || $show_share) : ?>
    <ul class="entry-meta  <?php echo esc_attr($class.' '.zkerika_direction());?>">
        <?php if($show_author) : ?>
            <li class="detail-author"><?php the_author_posts_link(); ?></li>
        <?php endif; ?>
        <?php if($show_date) : ?>
        <li class="detail-date"><?php zkerika_post_meta_archive_date_url();?></li>
        <?php endif; ?>
        <?php if($show_category) the_terms( get_the_ID(), $taxo , '<li class="detail-categories">', ' / ','</li>' ); ?>
        <?php if($show_comment && $comment_open) : ?>
        <li class="detail-comment"><a class="cms-scroll" href="<?php the_permalink(); ?>#comments"><?php echo esc_html(comments_number('0','1','%')); ?> <?php esc_html_e('Comments', 'zk-erika'); ?></a></li>
        <?php endif; ?>
        <?php if($show_view) : ?><li class="entry-view"><?php echo zkerika_get_post_views(); ?></li><?php endif; ?>
        <?php if($show_like) : ?><li class="entry-like"><?php post_favorite();?></li><?php endif; ?>
        <?php if($show_share) : ?><li class="entry-share"><?php zkerika_post_share(); ?></li><?php endif; ?>
        <?php edit_post_link(esc_html__('Edit','zk-erika'),'<li class="detail-edit"><i class="zmdi zmdi-edit"></i>','</a>','',''); ?>
    </ul>
    <?php endif; ?>
<?php
}

function zkerika_post_meta_archive_date_url($echo = true, $link = true){   
    $post_type = get_post_type();
    $date = $archive_date_url = ''; 
    switch ($post_type) {
        case 'zkportfolio':
            $archive_date_url = '?post_type=zkportfolio&m='.get_the_time('Y').get_the_time('m').get_the_time('d');
            break;
        case 'product':
            $taxo = 'product_cat';
            $archive_date_url = '?post_type=product&m='.get_the_time('Y').get_the_time('m').get_the_time('d');
            break;
        default:
            $archive_date_url = get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d'));
            break;
    }
    if($echo){
        if($link) echo '<a href="'.esc_url($archive_date_url).'">';
        echo get_the_date(get_option('date_format'));
        if($link) echo '</a>';
    } else {
        if($link) $date .= '<a href="'.esc_url($archive_date_url).'">';
        $date  .= get_the_date(get_option('date_format'));
        if($link) $date .= '</a>';
        return $date;
    }
}

/**
 * Display an optional archive post footer.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_archive_footer(){
    global $zkerika_theme_options, $zkerika_meta_options;
    ?>
    <footer class="archive-footer">
        <?php if(has_tag() && $zkerika_theme_options['zkerika_archive_archive_post_tags'] || !$zkerika_theme_options ): ?>
            <div class="tag-links <?php echo zkerika_direction(); ?>"><?php the_tags('', '' ); ?></div>
        <?php endif; ?>

        <?php if($zkerika_theme_options['zkerika_archive_post_readmore'] || !$zkerika_theme_options) { ?>
        <a class="archive-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'zk-erika'); ?></a>
        <?php } ?>
    </footer>
<?php
}

/**
 * Display an optional Single post.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
/**
 * Display an optional single post header.
 */
function zkerika_single_header(){
    /**
     * zkerika_post_meta_list($show_author = '', $show_date = '',  $show_category = '', $show_comment = '', $show_view = '', $show_like = '', $show_share = '', $class = 'archive-meta')
    */
    global $zkerika_theme_options;
    $show_author   = isset($zkerika_theme_options['zkerika_single_post_author']) ? $zkerika_theme_options['zkerika_single_post_author'] : 'true';
    $show_date     = isset($zkerika_theme_options['zkerika_single_post_date']) ? $zkerika_theme_options['zkerika_single_post_date'] : 'true';
    $show_category = isset($zkerika_theme_options['zkerika_single_post_category']) ? $zkerika_theme_options['zkerika_single_post_category'] : '';
    $show_comment  = isset($zkerika_theme_options['zkerika_single_post_comment']) ? $zkerika_theme_options['zkerika_single_post_comment'] : '';
    $show_view     = isset($zkerika_theme_options['zkerika_single_post_view']) ? $zkerika_theme_options['zkerika_single_post_view'] : '';
    $show_like     = isset($zkerika_theme_options['zkerika_single_post_like']) ? $zkerika_theme_options['zkerika_single_post_like'] : '';
    $show_share    = isset($zkerika_theme_options['zkerika_single_post_share']) ? $zkerika_theme_options['zkerika_single_post_share'] : '';
    ?>
    <header class="single-header">
        <?php the_title( '<h2 class="single-title">', '</h2>' ); ?>
        <?php zkerika_post_meta_list($show_author, $show_date, $show_category, $show_comment, $show_view, $show_like, $show_share,'single-meta'); ?>
    </header>
<?php 
}
/**
 * Display an optional single post footer.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_single_footer(){
    global $zkerika_theme_options, $zkerika_meta_options;
    if($zkerika_theme_options['zkerika_single_post_tags'] || !$zkerika_theme_options ): ?>
        <?php the_tags( '<footer class="single-footer archive-footer"><div class="tag-links">', '', '</div></footer>' ); ?>
    <?php endif; ?>    
<?php
}


/**
* Display navigation to next/previous on single post/page
*
* @since 1.0.0
*/
function zkerika_post_nav() {
    global $zkerika_theme_options;
    if(!$zkerika_theme_options || !empty($zkerika_theme_options['zkerika_single_post_nav'])) the_post_navigation();
}

/**
 * Display single post Author.
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_author_info(){
    global $zkerika_theme_options;
    if(!$zkerika_theme_options) return;
    if($zkerika_theme_options['zkerika_single_post_author_info']){
        $user_info = get_userdata(get_the_author_meta('ID'));
?>    
    <div class="entry-author row text-xs-center clearfix">
        <div class="author-avatar col-sm-2">
            <?php 
                $default_avatar = get_template_directory_uri().'/assets/images/avatar.png';
                echo get_avatar(get_the_author_meta('ID'), 100, '', get_the_author(), array('class' => 'img-circle')); ?>
        </div>
        <div class="author-info col-sm-10">
            <h5 class="author-name"><?php the_author(); ?></h5>
            <h6 class="author-roles"><?php echo '' . implode(' / ', $user_info->roles); ?></h6>
            <div class="author-bio"><?php the_author_meta('description'); ?></div>
            <div class="author-email"><?php the_author_meta('email'); ?></div>
        </div>
    </div>
<?php   
    }
}

/**
 * Display single post related
 * 
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
function zkerika_post_related(){
    global $post, $zkerika_theme_options;
    if(!$zkerika_theme_options) return;
    //for use in the loop, list 2 posts related to first tag on current post
    $show_post_related = $zkerika_theme_options['zkerika_single_post_related'];
    $tag_tax_name = zkerika_get_custom_post_tag_taxonomy();
    $tags = get_the_terms($post->ID,$tag_tax_name);
    if ($tags && $show_post_related) {
        $_tag = array();
        foreach ($tags as $tag) {
            $_tag[] = $tag->slug;
        }        
        wp_enqueue_script('jquery.libs.min');
        wp_enqueue_script('imagesloaded', '', array('jquery'));

        $cms_carousel['cms-single-post-related'] = array(
            'loop'                  => 'true',
            'mouseDrag'             => 'true',
            'nav'                   => 'false',
            'dots'                  => 'false',
            'margin'                => '30',
            'autoplay'              => 'true',
            'autoplayTimeout'       => '1000',
            'smartSpeed'            => '1500',
            'autoplayHoverPause'    => 'true',
            'autoHeight'            => 'true',   
            'navText'               => array('<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'),
            'items'                 => '2',
            'responsive' => array(
                0 => array(
                    "items" => 1,
                ),
                768 => array(
                    "items" => 2,
                ),
                992 => array(
                    "items" => 2,
                ),
                1200 => array(
                    "items" => 2,
                )
            )
        );
        wp_localize_script('jquery.libs.min', "cmscarousel", $cms_carousel);

        $args=array(
            'post_type' => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'slug',
                    'terms'    => $_tag,
                ),
            ),
            'post__not_in'          => array($post->ID),
            'posts_per_page'        => 3,
            'ignore_sticky_posts'   => 1
        );

        $related_query = new WP_Query($args);
        if( $related_query->have_posts() ) {
            echo '<div class="entry-related">';
            echo '<h4 class="related-title">'.esc_html__('Related Posts','zk-erika').'</h4>';
            echo '<div class="cms-carousel owl-carousel" id="cms-single-post-related">';
            while ($related_query->have_posts()) : $related_query->the_post(); 
                get_template_part( 'single-templates/single/content-related', get_post_format() );
            endwhile;
            echo '</div></div>';
        }
        wp_reset_postdata();
    }
}
function zkerika_single_post_comment_list_form(){
    global $zkerika_theme_options;
    if(!isset($zkerika_theme_options)) {
        $show_comment = true;
    } else {
        $show_comment = $zkerika_theme_options['zkerika_single_post_comment_list_form'];
    }
    return $show_comment;
}
/* Comment List */
function zkerika_comment($comment, $args, $depth) {
    $add_below = 'comment';  
?>
    <div <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-inner">
            <div class="comment-avatar"><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
            <div class="comment-content">
                <div class="comment-header">
                    <h5 class="author-name"><?php comment_author_link(); ?></h5>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                     <div class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','zk-erika' ); ?></div>
                    <?php endif; ?>
                    <div class="comment-time small">
                    <?php
                    /* translators: 1: date, 2: time */
                    printf( esc_html__('%1$s at %2$s','zk-erika'), get_comment_date(),  get_comment_time() ); ?>
                    </div>
                </div>
                <div class="comment-text">
                <?php comment_text(); ?>
                </div>
                <div class="comment-footer">
                    <?php edit_comment_link( esc_html__( 'Edit','zk-erika' ), '', '' );?>
                    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
            </div>
        </div>
<?php
}

function zkerika_get_custom_post_tag_taxonomy()
{
    $post = get_post();
    $tax_names = get_object_taxonomies($post);
    $result = 'post_tag';
    if(is_array($tax_names))
    {
        foreach ($tax_names as $name)
            if(strpos($name,'tag') !== false)
            {
                $result = $name;
                break;
            }
    }
    return $result;
}

/* Custom Post Type 
 * All function used for custom post type used in this theme
*/

/**
 * Extra Option
 * @since 1.0.0
 * @author Chinh Duong Manh
*/
function zkerika_social($class = ''){
    global $zkerika_theme_options, $zkerika_meta_options;

    if(empty($zkerika_theme_options['zkerika_social_number']))
        return;
?>
    <aside class="cms-social <?php echo esc_attr($class);?>">
        <?php   
            for($i = 1 ; $i <= $zkerika_theme_options['zkerika_social_number'] ; $i++){
                if(!empty($zkerika_theme_options['zkerika_social_link_'.$i]) && !empty($zkerika_theme_options['zkerika_social_icon_'.$i]))
                echo '<a target="_blank" href="' . $zkerika_theme_options['zkerika_social_link_'.$i] . '"><i class="' . $zkerika_theme_options['zkerika_social_icon_'.$i] . '"></i></a>';
            }
        ?>
    </aside>
<?php 
}
function zkerika_header_social($class = ''){
    global $zkerika_theme_options, $zkerika_meta_options;

    if(empty($zkerika_theme_options['zkerika_social_number']) || !$zkerika_theme_options['zkerika_social_in_header'])
        return;
?>
    <?php   
        for($i = 1 ; $i <= $zkerika_theme_options['zkerika_social_number'] ; $i++){
            if(!empty($zkerika_theme_options['zkerika_social_link_'.$i]) && !empty($zkerika_theme_options['zkerika_social_icon_'.$i]))
            echo '<a class="header-icon social-icon cms-header-height '.esc_attr($class).'" target="_blank" href="' . $zkerika_theme_options['zkerika_social_link_'.$i] . '"><i class="' . $zkerika_theme_options['zkerika_social_icon_'.$i] . '"></i></a>';
        }
    ?>
<?php 
}

/**
 * footer layout
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_footer_class($class = ''){
    $classes = array();
    $classes[] = 'cms-footer';
    $classes[] = $class;
    global $zkerika_meta_options;
    echo  join( ' ', $classes );
}

/* Footer top */
function zkerika_footer_top($layout = 'layout1'){
    global $zkerika_theme_options, $zkerika_meta_options;
    /* Default theme option */
    if(!$zkerika_theme_options || empty($zkerika_theme_options['zkerika_footer_top_column'])) return;
    /* remove footer top section on some page */
    if(isset($zkerika_meta_options['zkerika_enable_page_footer_top']) && $zkerika_meta_options['zkerika_enable_page_footer_top']) return;
    /* layout */
    if(isset($zkerika_theme_options['zkerika_footer_top_layout'])) $layout = 'layout'.$zkerika_theme_options['zkerika_footer_top_layout'];

    if(is_page() && isset($zkerika_meta_options['zkerika_footer_top_layout']) && !empty($zkerika_meta_options['zkerika_footer_top_layout'])){
        $layout = 'layout'.$zkerika_meta_options['zkerika_footer_top_layout'];
    }
    
    $footer_bt_layout = '';
    if($zkerika_theme_options){
        $footer_bt_layout = $zkerika_theme_options['zkerika_footer_bottom_layout'];
    }

    $_class = "";
    $grid = round(12 / $zkerika_theme_options['zkerika_footer_top_column']);
    $_class = 'col-md-6 col-lg-'.$grid.' col-xl-'.$grid ;
    if ( is_active_sidebar( 'sidebar-footer-top-1') || is_active_sidebar('sidebar-footer-top-2') || is_active_sidebar('sidebar-footer-top-3') || is_active_sidebar('sidebar-footer-top-4' )  || is_active_sidebar('sidebar-footer-top-5' ) ) {
?>
    <div id="cms-footer-top" class="cms-footer-top <?php echo esc_attr($layout); ?>">
        <div class="container">
            <div class="row">
            <?php   
                switch ($layout) {
                    default:
                        for($i = 1 ; $i <= $zkerika_theme_options['zkerika_footer_top_column'] ; $i++){
                            if ( is_active_sidebar( 'sidebar-footer-top-' . $i ) ){
                                echo '<div class="' . esc_html($_class) . ' footer-top-wg column-'.$i.'">';
                                    dynamic_sidebar( 'sidebar-footer-top-' . $i );
                                echo "</div>";
                            }
                        }
                        break;
                }
                
            ?>
            </div>
        </div>
    </div>
<?php
    }
}


/** Footer Bottom 
*/
if (!function_exists('zkerika_footer_bottom')) {
function zkerika_footer_bottom( $class = ''){
    $classes = array();
    $classes[] = 'cms-footer-bottom';
    $classes[] = $class;
    $footer_bt_layout = '';
    global $zkerika_theme_options, $zkerika_meta_options;
    if($zkerika_theme_options){
        $footer_bt_layout = $zkerika_theme_options['zkerika_footer_bottom_layout'];
        $classes[] = 'layout'.$footer_bt_layout;
    }
    if(isset($zkerika_theme_options) && !$zkerika_theme_options['zkerika_footer_bottom']) return;
    ?>
     <div id="cms-footer-bottom" class="<?php echo join(' ', $classes); ?>">
        <?php switch ($footer_bt_layout) {
            default:
        ?>
            <div class="container text-center">
                <?php 
                    if(!isset($zkerika_theme_options)){
                        echo '<aside class="default text-sm-center">';
                            printf( esc_html__('&copy; %s %s by %s. All Rights Reserved.','zk-erika'), date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/zookastudio').'">'.esc_html__('Zooka Studio','zk-erika').'</a>');
                        echo '</aside>';
                    } else {
                        /* Social */
                        if ($zkerika_theme_options['zkerika_social_footer']){
                            zkerika_social();
                        }
                        /* Widget area */
                        dynamic_sidebar( 'sidebar-footer-bottom');
                        /* Copyright text */
                        echo '<aside class="copy-right">';
                            if(!empty($zkerika_theme_options['zkerika_footer_bottom_copyright'])) {
                                echo wp_kses_post($zkerika_theme_options['zkerika_footer_bottom_copyright']);
                            } else {
                                printf( esc_html__('&copy; %s %s by %s. All Rights Reserved.','zk-erika'), date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/zookastudio').'">'.esc_html__('Zooka Studio','zk-erika').'</a>');
                            }
                        echo '</aside>';
                    }
                ?>
            </div>
        <?php
                break;
        } ?>
        
    </div>
<?php }
}

function zkerika_back_to_top(){
    global $zkerika_theme_options;

    $_back_to_top = false;

    if(isset($zkerika_theme_options['zkerika_backtotop']))
        $_back_to_top = $zkerika_theme_options['zkerika_backtotop'];

    if($_back_to_top)
        echo '<a class="cms-backtotop cms-scroll d-xs-none" href="#cms-page"><i class="fa fa-angle-up"></i></a>';
}
/**
 * List of thumbnails size
 * @since 1.0.0
 * @author Chinh Duong Manh
 */
function zkerika_thumbnail_sizes() {
    $zkerika_thumbnail_sizes = $zkerika_default_thumbnail_sizes = $zkerika_shop_thumbnail_sizes = $zkerika_custom_thumbnail_sizes = array();
    $zkerika_default_thumbnail_sizes = array(
        esc_html__( 'Post Thumbnail', 'zk-erika' )             => 'post-thumbnail',
        esc_html__( 'Medium', 'zk-erika' )                     => 'medium',
        esc_html__( 'Large', 'zk-erika' )                      => 'large',
        esc_html__( 'Full', 'zk-erika' )                       => 'full',
        esc_html__( 'Thumbnail', 'zk-erika' )                  => 'thumbnail',
    );
    if(class_exists('WooCommerce')){
        $zkerika_shop_thumbnail_sizes = array(
            esc_html__( 'Shop Catalog', 'zk-erika' )              => 'shop_catalog',
            esc_html__( 'Shop Single', 'zk-erika' )               => 'shop_single',
            esc_html__( 'Shop Thumbnail', 'zk-erika' )            => 'shop_thumbnail',
        );
    }
    $zkerika_custom_thumbnail_sizes = array(
        esc_html__( 'Custom', 'zk-erika' )                 => 'custom',
    );

    $zkerika_thumbnail_sizes = $zkerika_default_thumbnail_sizes + $zkerika_shop_thumbnail_sizes + $zkerika_custom_thumbnail_sizes;

    return $zkerika_thumbnail_sizes;
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function zkerika_get_image_sizes() {
    global $_wp_additional_image_sizes;
    $sizes = array();
    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
            $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
            );
        }
    }
    return $sizes;
}

/**
 * Get size information for a specific image size.
 *
 * @uses   zkerika_get_image_sizes()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function zkerika_get_image_size( $size ) {
    $sizes = zkerika_get_image_sizes();

    if ( isset( $sizes[ $size ] ) ) {
        return $sizes[ $size ];
    }
    return false;
}

/**
 * Get the width of a specific image size.
 *
 * @uses   zkerika_get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Width of an image size or false if the size doesn't exist.
 */
function zkerika_get_image_width( $size ) {
    if ( ! $size = zkerika_get_image_size( $size ) ) {
        return false;
    }
    if ( isset( $size['width'] ) ) {
        return $size['width'];
    }
    return false;
}

/**
 * Get the height of a specific image size.
 *
 * @uses   zkerika_get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Height of an image size or false if the size doesn't exist.
 */
function zkerika_get_image_height( $size ) {
    if ( ! $size = zkerika_get_image_size( $size ) ) {
        return false;
    }
    if ( isset( $size['height'] ) ) {
        return $size['height'];
    }
    return false;
}

/* OWL Carousel Setting 
 * All option will use in element use OWL Carousel Libs
*/
function zkerika_owl_settings(){
    return $owl_settings;
}
/* Icon font libs */
function zkerika_icon_libs(){
    $zkerika_icon_libs = array(
        /* From VC */
        esc_html__( 'Font Awesome', 'zk-erika' )   => 'fontawesome',
        esc_html__( 'Open Iconic', 'zk-erika' )    => 'openiconic',
        esc_html__( 'Typicons', 'zk-erika' )       => 'typicons',
        esc_html__( 'Entypo', 'zk-erika' )         => 'entypo',
        esc_html__( 'Linecons', 'zk-erika' )       => 'linecons',
        esc_html__( 'Mono Social', 'zk-erika' )    => 'monosocial',
        esc_html__( 'Material', 'zk-erika' )       => 'material',
    );
    return $zkerika_icon_libs;
}
/* OWL Nav & Dots */
function zkerika_carousel_nav_style(){
    $zkerika_carousel_nav_style = array(
        esc_html__('Default','zk-erika')            => '',
    );
    return $zkerika_carousel_nav_style;
}

function zkerika_carousel_dots_style(){
    $zkerika_carousel_dots_style = array(
        esc_html__('Default','zk-erika')   => '',
        esc_html__('Thumbnail','zk-erika') => 'dots-thumbnail',
        esc_html__('Progress','zk-erika')  => 'dots-progress',
    );
    return $zkerika_carousel_dots_style;
}