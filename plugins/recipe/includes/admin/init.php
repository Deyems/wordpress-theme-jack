<?php

//Includes

function recipe_admin_init(){
    require_once __DIR__ . '/column.php';
    add_filter('manage_recipes_posts_columns', 'r_add_new_recipe_columns');
    add_action('manage_recipes_posts_custom_columns', 'r_manage_recipe_columns', 10, 2);
}
