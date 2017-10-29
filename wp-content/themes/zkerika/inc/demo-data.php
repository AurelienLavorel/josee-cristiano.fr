<?php
/**
 * demo data.
 *
 * config.
 */
add_filter('ef3-theme-options-opt-name', 'zkerika_set_demo_opt_name');

function zkerika_set_demo_opt_name(){
    return 'zkerika_theme_options';
}

add_filter('ef3-replace-content', 'zkerika_replace_content', 10 , 2);

function zkerika_replace_content($replaces, $attachment){
    return array(
        '/tax_query:/' => 'remove_query:',
        '/categories:/' => 'remove_query:',
    );
}

add_filter('ef3-replace-theme-options', 'zkerika_replace_theme_options');

function zkerika_replace_theme_options(){
    return array(
        'dev_mode' => 0,
    );
}
add_filter('ef3-enable-create-demo', 'zkerika_enable_create_demo');

function zkerika_enable_create_demo(){
    return true;
}