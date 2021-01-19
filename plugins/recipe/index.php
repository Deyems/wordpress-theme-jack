<?php
/**
* Plugin Name: Recipe
* Description: A simple WordPress plugin that allows user create recipes and rate those recipes
* Version: 1.0
* Author: Deyems
* Author URI: https://github.com/Deyems
* Text Domain: recipe
*/

if(!function_exists('add_action')) {
    echo "Hi, there! I'm a plugin not much to do directly";
    exit;
}

//Set ups


//Includes
require_once __DIR__ . "/includes/activate.php";
require_once __DIR__ . "/includes/init.php";
require_once __DIR__ . '/process/save-post.php';

//Hooks
register_activation_hook( __FILE__, 'r_activate_plugin' );
add_action( 'init', 'recipe_init');

//Flexible Save Post {Post_type} Hook.
add_action( 'save_post_recipes', 'r_save_post_admin', 10, 3 );

//Shortcodes
