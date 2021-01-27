<?php
function r_admin_enqueue(){
    if(!isset($_GET['page']) || $_GET['page'] != 'r_plugin_opts'){
        return;
    }
    //Bootstrap added
    wp_register_style('r_bootstrap', 
    plugins_url('/assets/css/bootstrap.css', RECIPE_PLUGIN_URL));

    wp_enqueue_style('r_bootstrap');
}