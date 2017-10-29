<?php
/**
 * Auto create css from Meta Options.
 * 
 * @author Chinh Duong Manh
 * @version 1.0.0
 */
class zkerika_DynamicCss
{

    function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {
        $_dynamic_css = $this->css_render();

        wp_add_inline_style('zkerika_static', $_dynamic_css);
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $zkerika_theme_options, $zkerika_meta_options;

        ob_start();

        /* custom Page css. */
        if(is_page()){
            /* Page Title */
            if(isset($zkerika_meta_options['zkerika_page_title_layout']) && ($zkerika_meta_options['zkerika_page_title_layout'] != '' || $zkerika_meta_options['zkerika_page_title_layout'] != 'none')){
                /* Overlay color */
                if(!empty($zkerika_meta_options['zkerika_page_title_bg_overlay'])){ 
                    $page_title_style_overlay = '#cms-page #cms-page-title-wrapper:before{';
                    $page_title_style_overlay .= 'background-color:'.$zkerika_meta_options['zkerika_page_title_bg_overlay']['rgba'].';';
                    $page_title_style_overlay .= '}';
                    echo esc_html($page_title_style_overlay);
                }
                /* background */
                if(!empty($zkerika_meta_options['zkerika_page_title_bg'])){
                    
                    $page_title_style = '#cms-page #cms-page-title-wrapper{';
                    $page_title_style .= !empty($zkerika_meta_options['zkerika_page_title_bg']['background-color']) ? 'background-color:'.$zkerika_meta_options['zkerika_page_title_bg']['background-color']. ';' : '' ;
                    $page_title_style .= !empty($zkerika_meta_options['zkerika_page_title_bg']['background-image']) ? 'background-image:url('.$zkerika_meta_options['zkerika_page_title_bg']['background-image'].');' : '';
                    $page_title_style .= !empty($zkerika_meta_options['zkerika_page_title_bg']['background-position']) ? 'background-position:'.$zkerika_meta_options['zkerika_page_title_bg']['background-position'].';' : '';
                    $page_title_style .= !empty($zkerika_meta_options['zkerika_page_title_bg']['background-size']) ? 'background-size:'.$zkerika_meta_options['zkerika_page_title_bg']['background-size'].';' : '';
                    $page_title_style .= !empty($zkerika_meta_options['zkerika_page_title_bg']['background-repeat']) ? 'background-repeat:'.$zkerika_meta_options['zkerika_page_title_bg']['background-repeat'].';' : '';
                    $page_title_style .= !empty($zkerika_meta_options['zkerika_page_title_bg']['background-attachment']) ? 'background-attachment:'.$zkerika_meta_options['zkerika_page_title_bg']['background-attachment'].';' : '';
                    $page_title_style .= '}';

                    echo esc_html($page_title_style);
                }
                /* Padding */
                if(!empty($zkerika_meta_options['zkerika_page_title_padding'])){
                    $page_title_style_padding = '#cms-page #cms-page-title-wrapper{';
                    if(!empty($zkerika_meta_options['zkerika_page_title_padding']['padding-top'])) $page_title_style_padding .= 'padding-top:'.$zkerika_meta_options['zkerika_page_title_padding']['padding-top'].';';
                    if(!empty($zkerika_meta_options['zkerika_page_title_padding']['padding-right'])) $page_title_style_padding .= 'padding-right:'.$zkerika_meta_options['zkerika_page_title_padding']['padding-right'].';';
                    if(!empty($zkerika_meta_options['zkerika_page_title_padding']['padding-bottom'])) $page_title_style_padding .= 'padding-bottom:'.$zkerika_meta_options['zkerika_page_title_padding']['padding-bottom'].';';
                    if(!empty($zkerika_meta_options['zkerika_page_title_padding']['padding-left'])) $page_title_style_padding .= 'padding-left:'.$zkerika_meta_options['zkerika_page_title_padding']['padding-left'].';';
                    $page_title_style_padding .= '}';
                    echo esc_html($page_title_style_padding);
                }
                /* Margin */
                if(!empty($zkerika_meta_options['zkerika_page_title_margin'])){
                    $page_title_style_margin = '#cms-page #cms-page-title-wrapper{';
                    if($zkerika_meta_options['zkerika_page_title_margin']['margin-top']!='') $page_title_style_margin .= 'margin-top:'.$zkerika_meta_options['zkerika_page_title_margin']['margin-top'].';';
                    if($zkerika_meta_options['zkerika_page_title_margin']['margin-right']!='') $page_title_style_margin .= 'margin-right:'.$zkerika_meta_options['zkerika_page_title_margin']['margin-right'].';';
                    if($zkerika_meta_options['zkerika_page_title_margin']['margin-bottom']!='') $page_title_style_margin .= 'margin-bottom:'.$zkerika_meta_options['zkerika_page_title_margin']['margin-bottom'].';';
                    if($zkerika_meta_options['zkerika_page_title_margin']['margin-left']!='') $page_title_style_margin .= 'margin-left:'.$zkerika_meta_options['zkerika_page_title_margin']['margin-left'].';';
                    $page_title_style_margin .= '}';
                    echo esc_html($page_title_style_margin);
                }
            }
            /* Footer */
                /* Margin */
                if(!empty($zkerika_meta_options['zkerika_page_footer_margin'])){

                    $page_footer_margin = '#cms-page #cms-footer{';
                    if($zkerika_meta_options['zkerika_page_footer_margin']['margin-top']!='') $page_footer_margin .= 'margin-top:'.$zkerika_meta_options['zkerika_page_footer_margin']['margin-top'].';';
                    if($zkerika_meta_options['zkerika_page_footer_margin']['margin-right']!='') $page_footer_margin .= 'margin-right:'.$zkerika_meta_options['zkerika_page_footer_margin']['margin-right'].';';
                    if($zkerika_meta_options['zkerika_page_footer_margin']['margin-bottom']!='') $page_footer_margin .= 'margin-bottom:'.$zkerika_meta_options['zkerika_page_footer_margin']['margin-bottom'].';';
                    if($zkerika_meta_options['zkerika_page_footer_margin']['margin-left']!='') $page_footer_margin .= 'margin-left:'.$zkerika_meta_options['zkerika_page_footer_margin']['margin-left'].';';
                    $page_footer_margin .= '}';
                    echo esc_html($page_footer_margin);
                }
        }
        ?>

        <?php
        
        return ob_get_clean();
    }
}

new zkerika_DynamicCss();