<?php

function r_enqueue_scripts(){
    wp_register_style('r_rateit', 
    plugins_url('/assets/rateit/rateit.css', RECIPE_PLUGIN_URL));

    wp_register_style('ju_bootstrap', 
    plugins_url('/assets/css/bootstrap.css', RECIPE_PLUGIN_URL));

    wp_enqueue_style('r_rateit');
    wp_enqueue_style('ju_bootstrap');
    
    wp_register_script('r_rate_it', 
    plugins_url('/assets/rateit/jquery.rateit.min.js', RECIPE_PLUGIN_URL),
    ['jquery'],
    '1.0.0',
    true);
    
    wp_register_script('r_main', 
    plugins_url('/assets/js/main.js', RECIPE_PLUGIN_URL),
    ['jquery'],
    '1.0.0',
    true);

    wp_localize_script('r_main', 'recipe_obj', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wp_rest'),
    ]);

    wp_enqueue_script('r_rate_it');
    wp_enqueue_script('r_main');
}