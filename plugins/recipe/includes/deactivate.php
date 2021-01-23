<?php
function r_deactivate_plugin(){
    //From Wordpress Docs
    $timestamp = wp_next_scheduled( 'r_daily_recipe_hook' );
    wp_unschedule_event( $timestamp, 'r_daily_recipe_hook' );
    
    //From Video Tutorial
    // wp_clear_scheduled_hook('r_daily_recipe_hook');
}