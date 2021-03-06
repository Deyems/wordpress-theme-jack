<?php

//Includes

function recipe_admin_init(){
    require_once __DIR__ . '/column.php';
    require_once __DIR__ . '/enqueue.php';
    // require_once __DIR__ . '/settings-api.php';

    add_filter('manage_recipes_posts_columns', 'r_add_new_recipe_columns');
    add_action('manage_recipes_posts_custom_columns', 'r_manage_recipe_columns', 10, 2);
    add_action('admin_enqueue_scripts', 'r_admin_enqueue');
    add_action('admin_post_r_save_options', 'r_save_options');
    // r_settings_api();
}
