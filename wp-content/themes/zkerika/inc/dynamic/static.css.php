<?php

/**
 * Auto create .css file from Theme Options
 * @author Chinh Duong Manh
 * @version 1.0.0
 */
class zkerika_StaticCss
{

    public $scss;
    
    function __construct()
    {
        if(!class_exists('scssc'))
            return;

        /* scss */
        $this->scss = new scssc();
        
        /* set paths scss */
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');
             
        /* generate css over time */
		add_action('wp', array($this, 'generate_over_time'));
        
        /* save option generate css */
       	add_action("redux/options/zkerika_theme_options/saved", array($this,'generate_file'));
    }
	
    public function generate_over_time(){
    	
    	global $zkerika_theme_options;

    	if (!empty($zkerika_theme_options) && $zkerika_theme_options['zkerika_dev_mode']){
    	    $this->generate_file();
    	}
    }
    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    {
        global $zkerika_theme_options, $wp_filesystem;
        if (empty($wp_filesystem) || !isset($zkerika_theme_options))
            return;
            
        $options_scss = get_template_directory() . '/assets/scss/options.scss';

        /* delete files options.scss */
        $wp_filesystem->delete($options_scss);

        /* write options to scss file */
        $wp_filesystem->put_contents($options_scss, $this->css_render(), FS_CHMOD_FILE); // Save it

        /* minimize CSS styles */
        if (!$zkerika_theme_options['zkerika_dev_mode'])
            $this->scss->setFormatter('scss_formatter_compressed');

        /* compile scss to css */
        $css = $this->scss_render();

        $file = "static.css";

        $file = get_template_directory() . '/assets/css/' . $file;

        /* delete files static.css */
        $wp_filesystem->delete($file);

        /* write static.css file */
        $wp_filesystem->put_contents($file, $css, FS_CHMOD_FILE); // Save it
    }
    
    /**
     * scss compile
     * 
     * @since 1.0.0
     * @return string
     */
    public function scss_render(){
        /* compile scss to css */
        return $this->scss->compile('@import "master.scss"');
    }
    
    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $zkerika_theme_options, $zkerika_meta_options;
        $primary_color         = '#202020';
        $accent_color          = '#AFDAE2';
        $accent_color_hover    = $accent_color;
        $accent_color_active   = $accent_color;

        $body_color            = '#868686'; 
        $body_font_family      = 'Open Sans';
        $extra_font            = 'Playfair Display';
        $body_font_size        = '15px'; 

        $header_height         = '100px';
        $header_width          = '300px';
        $header_top_bg         = 'transparent';
        $logo_w                = '200px';
        $dropdown_mobile_bg    = '#ffffff';
        $dropdown_mobile_color = $primary_color;
        $dropdown_mobile_color_hover = '#979797';
        $dropdown_mobile_color_active = '#979797';
        /* Button */
        $btn_bg                = $primary_color;
        $btn_bg_hover          = $accent_color;
        $btn_primary_bg        = $accent_color;
        $btn_primary_bg_hover  = $primary_color;
        $btn_color             = '#FFFFFF';
        $btn_color_hover       = '#FFFFFF';
        $btn_border_style      = 'none';
        $btn_border_width      = '0';
        $btn_border_color      = 'transparent';
        $btn_radius            = '0';

        ob_start();
        /* Boxed width */
        echo '$boxed_width:'.(!empty($zkerika_theme_options['zkerika_body_width']['width']) ? esc_attr($zkerika_theme_options['zkerika_body_width']['width']) : '1200px').';';

        /* Theme Color */
        echo '$primary_color:'.(!empty($zkerika_theme_options['zkerika_primary_color']['regular']) ? esc_attr($zkerika_theme_options['zkerika_primary_color']['regular']) : $primary_color).';';
        echo '$accent_color:'.(!empty($zkerika_theme_options['zkerika_accent_color']['regular']) ? esc_attr($zkerika_theme_options['zkerika_accent_color']['regular']) : $accent_color) .';';
        /* Typography */
        echo '$body_font_family:'.(!empty($zkerika_theme_options['zkerika_font_body']['font-family']) ? $zkerika_theme_options['zkerika_font_body']['font-family'] : $body_font_family).';';
        echo '$body_font_color:'.(!empty($zkerika_theme_options['zkerika_font_body']['color']) ? esc_attr($zkerika_theme_options['zkerika_font_body']['color']) : $body_color).';';
        echo '$body_font_size:'.(!empty($zkerika_theme_options['zkerika_font_body']['font-size']) ? esc_attr($zkerika_theme_options['zkerika_font_body']['font-size']) : $body_font_size).';';

        echo '$extra_font:'.(!empty($zkerika_theme_options['zkerika_extra_font']['font-family']) ? $zkerika_theme_options['zkerika_extra_font']['font-family'] : $extra_font).';';
        echo '$extra_font2:'.(!empty($zkerika_theme_options['zkerika_extra_font2']['font-family']) ? $zkerika_theme_options['zkerika_extra_font2']['font-family'] : $body_font_family).';';
        /* Header */
        echo '$zkerika_header_height:'.(!empty($zkerika_theme_options['zkerika_header_height']['height']) ? esc_attr($zkerika_theme_options['zkerika_header_height']['height']) : $header_height).';';
        echo '$zkerika_header_width:'.(!empty($zkerika_theme_options['zkerika_header_width']['width']) ? esc_attr($zkerika_theme_options['zkerika_header_width']['width']) : $header_width).';';

        echo '$zkerika_header_logo_w:'.((!empty($zkerika_theme_options['zkerika_logo_size']['width']) && $zkerika_theme_options['zkerika_logo_size']['width']!='px') ? esc_attr($zkerika_theme_options['zkerika_logo_size']['width']) : $logo_w).';';       

        /* Default */
        echo '$menu_default_link_color:'.(!empty($zkerika_theme_options['zkerika_header_fl_color']['regular']) ? esc_attr($zkerika_theme_options['zkerika_header_fl_color']['regular']) : $primary_color).';';
        echo '$menu_default_link_color_hover:'.(!empty($zkerika_theme_options['zkerika_header_fl_color']['hover']) ? esc_attr($zkerika_theme_options['zkerika_header_fl_color']['hover']) : '#979797').';' ;
        echo '$menu_default_link_color_active:'.(!empty($zkerika_theme_options['zkerika_header_fl_color']['active']) ? esc_attr($zkerika_theme_options['zkerika_header_fl_color']['active']) : '#979797').';';
        /* On Top */
        echo '$menu_ontop_link_color:'.(!empty($zkerika_theme_options['zkerika_header_ontop_fl_color']['regular']) ? esc_attr($zkerika_theme_options['zkerika_header_ontop_fl_color']['regular']) : '#ffffff').';';
        echo '$menu_ontop_link_color_hover:'.(!empty($zkerika_theme_options['zkerika_header_ontop_fl_color']['hover']) ? esc_attr($zkerika_theme_options['zkerika_header_ontop_fl_color']['hover']) : $accent_color).';' ;
        echo '$menu_ontop_link_color_active:'.(!empty($zkerika_theme_options['zkerika_header_ontop_fl_color']['active']) ? esc_attr($zkerika_theme_options['zkerika_header_ontop_fl_color']['active']) : $accent_color_active).';';
        /* Sticky  */
        echo '$menu_sticky_link_color:'.(!empty($zkerika_theme_options['zkerika_header_sticky_fl_color']['regular']) ? esc_attr($zkerika_theme_options['zkerika_header_sticky_fl_color']['regular']) : '#ffffff').';';
        echo '$menu_sticky_link_color_hover:'.(!empty($zkerika_theme_options['zkerika_header_sticky_fl_color']['hover']) ? esc_attr($zkerika_theme_options['zkerika_header_sticky_fl_color']['hover']) : $accent_color).';' ;
        echo '$menu_sticky_link_color_active:'.(!empty($zkerika_theme_options['zkerika_header_sticky_fl_color']['active']) ? esc_attr($zkerika_theme_options['zkerika_header_sticky_fl_color']['active']) : $accent_color_active).';';
        /* Menu Mobile */
            echo '$dropdown_bg_color:'.(!empty($zkerika_theme_options['zkerika_header_dropdown_mobile_bg']['background-color']) ? esc_attr($zkerika_theme_options['zkerika_header_dropdown_mobile_bg']['background-color']) : $dropdown_mobile_bg) .';';

            echo '$dropdown_link_color:'.(!empty($zkerika_theme_options['zkerika_header_dropdown_mobile_color']['regular']) ? esc_attr($zkerika_theme_options['zkerika_header_dropdown_mobile_color']['regular']) : $dropdown_mobile_color ) .';';
            echo '$dropdown_link_color_hover:'.(!empty($zkerika_theme_options['zkerika_header_dropdown_mobile_color']['hover']) ? $zkerika_theme_options['zkerika_header_dropdown_mobile_color']['hover'] : $dropdown_mobile_color_hover).';';
            echo '$dropdown_link_color_active:'.(!empty($zkerika_theme_options['zkerika_header_dropdown_mobile_color']['active']) ? $zkerika_theme_options['zkerika_header_dropdown_mobile_color']['active'] : $dropdown_mobile_color_active).';';
        /* Page Title */
            echo '$page_title_color:'.(!empty($zkerika_theme_options['zkerika_pagetitle_typo']['color']) ? esc_attr($zkerika_theme_options['zkerika_pagetitle_typo']['color']) : '#ffffff' ) .';';
        /* Button Default */
        echo '$btn_default_color:'.(!empty($zkerika_theme_options['zkerika_btn_default_color']['regular']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_color']['regular']) : $btn_color) .';';

        echo '$btn_default_color_hover:'.(!empty($zkerika_theme_options['zkerika_btn_default_color']['hover']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_color']['hover']) : $btn_color_hover) .';';

        echo '$btn_default_border_width:'.(!empty($zkerika_theme_options['zkerika_btn_default_border']['border-top']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_border']['border-top']) : $btn_border_width) .' '.(!empty($zkerika_theme_options['zkerika_btn_default_border']['border-right']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_border']['border-right']) : $btn_border_width).' '.(!empty($zkerika_theme_options['zkerika_btn_default_border']['border-bottom']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_border']['border-bottom']) : $btn_border_width).' '.(!empty($zkerika_theme_options['zkerika_btn_default_border']['border-left']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_border']['border-left']) : $btn_border_width).';';

        echo '$btn_default_border_style:'.(isset($zkerika_theme_options['zkerika_btn_default_border']['border-style']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_border']['border-style']) : $btn_border_style) .';';
        
        echo '$btn_default_border_color:'.(isset($zkerika_theme_options['zkerika_btn_default_border']['border-color']) && !empty($zkerika_theme_options['zkerika_btn_default_border']['border-color']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_border']['border-color']) : $btn_border_color) .';';

        echo '$btn_default_border_radius:'.(!empty($zkerika_theme_options['zkerika_btn_default_border_radius']['width']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_border_radius']['width']) : $btn_radius) .';';

        echo '$btn_default_bg:'.(!empty($zkerika_theme_options['zkerika_btn_default_bg']['background-color']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_bg']['background-color']) : $btn_bg) .';';
        
        echo '$btn_default_bg_hover:'.(!empty($zkerika_theme_options['zkerika_btn_default_bg_hover']['background-color']) ? esc_attr($zkerika_theme_options['zkerika_btn_default_bg_hover']['background-color']) : $btn_bg_hover) .';';
       
        /* Button Primary */
        echo '$btn_primary_color:'.(!empty($zkerika_theme_options['zkerika_btn_primary_color']['regular']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_color']['regular']) : $btn_color) .';';

        echo '$btn_primary_color_hover:'.(!empty($zkerika_theme_options['zkerika_btn_primary_color']['hover']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_color']['hover']) : $btn_color_hover) .';';

        echo '$btn_primary_border_width:'.(!empty($zkerika_theme_options['zkerika_btn_primary_border']['border-top']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_border']['border-top']) : $btn_border_width) .' '.(!empty($zkerika_theme_options['zkerika_btn_primary_border']['border-right']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_border']['border-right']) : $btn_border_width).' '.(!empty($zkerika_theme_options['zkerika_btn_primary_border']['border-bottom']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_border']['border-bottom']) : $btn_border_width).' '.(!empty($zkerika_theme_options['zkerika_btn_primary_border']['border-left']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_border']['border-left']) : $btn_border_width).';';

        echo '$btn_primary_border_style:'.(isset($zkerika_theme_options['zkerika_btn_primary_border']['border-style']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_border']['border-style']) : $btn_border_style) .';';

        echo '$btn_primary_border_color:'.(isset($zkerika_theme_options['zkerika_btn_primary_border']['border-color']) && !empty($zkerika_theme_options['zkerika_btn_primary_border']['border-color']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_border']['border-color']) : $btn_border_color) .';';

        echo '$btn_primary_border_radius:'.(!empty($zkerika_theme_options['zkerika_btn_primary_border_radius']['width']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_border_radius']['width']) : $btn_radius) .';';

        echo '$btn_primary_bg:'.(!empty($zkerika_theme_options['zkerika_btn_primary_bg']['background-color']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_bg']['background-color']) : $btn_primary_bg) .';';
        
        echo '$btn_primary_bg_hover:'.(!empty($zkerika_theme_options['zkerika_btn_primary_bg_hover']['background-color']) ? esc_attr($zkerika_theme_options['zkerika_btn_primary_bg_hover']['background-color']) : $btn_primary_bg_hover) .';';

        return ob_get_clean();
    }
}

new zkerika_StaticCss();