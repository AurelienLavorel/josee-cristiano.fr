<?php
class ZKErika_Quick_Contact extends WP_Widget {
    function __construct() {
        parent::__construct(
            'ZKErika_quick_contact', // Base ID
            esc_html__('Erika Quick Contact', 'zk-erika'), // Name
            array('description' => esc_html__('Add simple contact info like: phone number, email.', 'zk-erika'),) // Args
        );
    }
    function widget($args, $instance) {
        extract($args);
		if (!empty($instance['title'])) {
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Quick Contact', 'zk-erika' ) : $instance['title'], $instance, $this->id_base);
        }
        $style = 'horizontal';
        if(!empty($instance['style'])){
            $style = $instance['style'];
        }

        $icon_add = isset($instance['icon_add']) ? (!empty($instance['icon_add']) ? $instance['icon_add']: '') : '';
        $text_add = isset($instance['text_add']) ? (!empty($instance['text_add']) ? $instance['text_add']: '14 Tottenham Courtten Road, London, England.') : '14 Tottenham Courtten Road, London, England.';
        $icon_phone = isset($instance['icon_phone']) ? (!empty($instance['icon_phone']) ? $instance['icon_phone']: '') : '';
        $text_phone = isset($instance['text_phone']) ? (!empty($instance['text_phone']) ? $instance['text_phone']: 'T / (102) 6666 8888') : 'T / (102) 6666 8888';
        $icon_mail = isset($instance['icon_mail']) ? (!empty($instance['icon_mail']) ? $instance['icon_mail']: '') : '';
        $text_mail = isset($instance['text_mail']) ? (!empty($instance['text_mail']) ? $instance['text_mail']: 'info@zooka.io') : 'info@zooka.io';
        $icon_site = isset($instance['icon_site']) ? (!empty($instance['icon_site']) ? $instance['icon_site']: '') : '';
        $text_site = isset($instance['text_site']) ? (!empty($instance['text_site']) ? $instance['text_site']: '') : '';

        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }
        echo balanceTags($before_widget);
            if (!empty($title))
                echo balanceTags($before_title . $title . $after_title);
                
            echo '<ul class="cms-quick-contact '.esc_attr($style).' list-unstyled clearfix">';
            if ( $text_add) {
                echo '<li>'.($icon_add ? '<i class="'.$icon_add.'"></i>&nbsp;' : '').esc_html($text_add).'</li>';
            }
            if ($text_mail) {
                echo '<li>'.($icon_mail ? '<i class="'.$icon_mail.'"></i>&nbsp;' : '').'<a href="mailto:'.esc_html($text_mail).'">'.esc_html($text_mail).'</a></li>';
            }
            if ($text_phone) {
                echo '<li>'.($icon_phone ? '<i class="'.$icon_phone.'"></i>&nbsp;' : '').esc_html($text_phone).'</li>';
            }
            if ($text_site) {
                echo '<li>'.($icon_site ? '<i class="'.$icon_site.'"></i>&nbsp;' : '').'<a href="'.esc_url($text_site).'">'.esc_html($text_site).'</a></li>';
            }
            echo "</ul>";
        echo balanceTags($after_widget);
    }
    function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['style'] = strip_tags($new_instance['style']);
         $instance['icon_add'] = strip_tags($new_instance['icon_add']);
         $instance['text_add'] = strip_tags($new_instance['text_add']);
         $instance['icon_phone'] = strip_tags($new_instance['icon_phone']);
         $instance['text_phone'] = strip_tags($new_instance['text_phone']);
         $instance['icon_mail'] = strip_tags($new_instance['icon_mail']);
         $instance['text_mail'] = strip_tags($new_instance['text_mail']);
         $instance['icon_site'] = strip_tags($new_instance['icon_site']);
         $instance['text_site'] = strip_tags($new_instance['text_site']);
         $instance['extra_class'] = $new_instance['extra_class'];
         return $instance;
    }
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $style = isset($instance['style']) ? esc_attr($instance['style']) : '';
        $icon_add = isset($instance['icon_add']) ? esc_attr($instance['icon_add']) : '';
        $text_add = isset($instance['text_add']) ? esc_attr($instance['text_add']) : '';

        $icon_phone = isset($instance['icon_phone']) ? esc_attr($instance['icon_phone']) : '';
        $text_phone = isset($instance['text_phone']) ? esc_attr($instance['text_phone']) : '';

        $icon_mail = isset($instance['icon_mail']) ? esc_attr($instance['icon_mail']) : '';
        $text_mail = isset($instance['text_mail']) ? esc_attr($instance['text_mail']) : '';

        $icon_site = isset($instance['icon_site']) ? esc_attr($instance['icon_site']) : '';
        $text_site = isset($instance['text_site']) ? esc_attr($instance['text_site']) : '';

        $extra_class = isset($instance['extra_class']) ? esc_attr($instance['extra_class']) : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php esc_html_e( 'Layout Mode:', 'zk-erika' ); ?></label>
         <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('style') ); ?>" name="<?php echo esc_attr( $this->get_field_name('style') ); ?>">
            <option value="horizontal"<?php if( $style == 'horizontal' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Horizontal', 'zk-erika'); ?></option>
            <option value="vertical"<?php if( $style == 'vertical' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Vertical', 'zk-erika'); ?></option>
         </select>
         </p>

        <p><label for="<?php echo esc_attr($this->get_field_id('icon_add')); ?>"><?php esc_html_e( 'Icon Address:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('icon_add') ); ?>" name="<?php echo esc_attr( $this->get_field_name('icon_add') ); ?>" type="text" value="<?php echo esc_attr( $icon_add ); ?>" placeholder="fa fa-map-marker"/></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('text_add')); ?>"><?php esc_html_e( 'Address:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_add') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_add') ); ?>" type="text" value="<?php echo esc_attr( $text_add ); ?>" placeholder="14 Tottenham Courtten Road, London, England."/></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('icon_phone')); ?>"><?php esc_html_e( 'Icon Phone:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('icon_phone') ); ?>" name="<?php echo esc_attr( $this->get_field_name('icon_phone') ); ?>" type="text" value="<?php echo esc_attr( $icon_phone ); ?>" placeholder="fa fa-phone"/></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('text_phone')); ?>"><?php esc_html_e( 'Phone Number:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_phone') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_phone') ); ?>" type="text" value="<?php echo esc_attr( $text_phone ); ?>" placeholder="T / (102) 6666 8888"/></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('icon_mail')); ?>"><?php esc_html_e( 'Icon Mail:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('icon_mail') ); ?>" name="<?php echo esc_attr( $this->get_field_name('icon_mail') ); ?>" type="text" value="<?php echo esc_attr( $icon_mail ); ?>" placeholder="fa fa-envelope" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('text_mail')); ?>"><?php esc_html_e( 'Your Email:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_mail') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_mail') ); ?>" type="text" value="<?php echo esc_attr( $text_mail ); ?>" placeholder="info@zooka.io" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('icon_site')); ?>"><?php esc_html_e( 'Icon Website:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('icon_site') ); ?>" name="<?php echo esc_attr( $this->get_field_name('icon_site') ); ?>" type="text" value="<?php echo esc_attr( $icon_site ); ?>" placeholder="fa fa-desktop" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('text_site')); ?>"><?php esc_html_e( 'Your Website:', 'zk-erika' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_site') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_site') ); ?>" type="text" value="<?php echo esc_attr( $text_site ); ?>" placeholder="www.zooka.io" /></p>

        <p>
        <label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>">Extra Class:</label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php echo esc_attr($extra_class); ?>" />
        </p>
    <?php
    }
}

/**
* Class CMS_Quick_Contact
*/
function ZKErika_qc_widget() {
    register_widget('ZKErika_Quick_Contact');
}
add_action('widgets_init', 'ZKErika_qc_widget');
?>