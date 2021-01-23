<?php

function my_enqueue_scripts(){
    
    wp_register_style('my_bootstrap', 
    plugins_url('/assets/css/bootstrap.css', MYRECIPE_PLUGIN_URL));

    wp_enqueue_style('my_bootstrap');
    
    wp_register_script('my_main', 
    plugins_url('/assets/js/main.js', MYRECIPE_PLUGIN_URL),
    ['jquery'],
    '1.0.0',
    true);

    wp_localize_script('my_main', 'myrecipe_obj', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);

    wp_enqueue_script('my_main');
}