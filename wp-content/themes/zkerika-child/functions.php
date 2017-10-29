<?php
function my_theme_enqueue_styles() {

    $parent_style = 'zkerika-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Custom
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
                            printf( esc_html__('&copy; %s %s. All Rights Reserved.'), date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/zookastudio').'">'.esc_html__('Zooka Studio','zk-erika').'</a>');
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