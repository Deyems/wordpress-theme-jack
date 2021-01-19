<?php

function r_enqueue_scripts(){
    wp_register_style('r_rateit', plugins_url('/assets/rateit/rateit.css'), );
    wp_enqueue_style('r_rateit');
    
    wp_register_script('r_rate_it', 
    plugins_url('/assets/rateit/jquery.rateit.min.js'),
    ['jquery'],
    '1.0.0',
    true);
    
    wp_register_script('r_main', 
    plugins_url('/assets/js/main.js'),
    ['jquery'],
    '1.0.0',
    true);

    wp_enqueue_script('r_rate_it');
    wp_enqueue_script('r_main');
}