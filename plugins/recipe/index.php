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
define('RECIPE_PLUGIN_URL', __FILE__);

//Includes
require_once __DIR__ . '/includes/activate.php';
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/process/save-post.php';
require_once __DIR__ . '/process/filter-content.php';
require_once __DIR__ . '/includes/front/enqueue-script.php';
require_once __DIR__ . '/process/rate-recipe.php';
require_once __DIR__ . '/includes/admin/init.php';
require_once __DIR__ . '/blocks/enqueue.php';
// Note something to findout if everything doesn't work out here
require_once __DIR__ . '/includes/widgets.php';
// require_once dirname(RECIPE_PLUGIN_URL) . '/includes/widgets.php';
require_once __DIR__ . '/includes/widgetsClass/daily-recipe.php';
require_once __DIR__ . '/includes/cron.php';
require_once __DIR__ . '/includes/deactivate.php';
require_once __DIR__ . '/includes/utility.php';
require_once __DIR__ . '/includes/shortcodes/creator.php';
require_once __DIR__ . '/process/submit-user-recipe.php';
require_once __DIR__ . '/includes/shortcodes/auth-alt-form.php';
require_once __DIR__ . '/includes/front/logout-link.php';
require_once __DIR__ . '/includes/admin/dashboard-widgets.php';
require_once __DIR__ . '/includes/shortcodes/twitter-follow.php';
require_once __DIR__ . '/includes/admin/menus.php';
require_once __DIR__ . '/includes/admin/options-page.php';
require_once __DIR__ . '/process/save-options.php';
require_once __DIR__ . '/includes/admin/origin-fields.php';
require_once __DIR__ . '/process/save-origin.php';

//Hooks
register_activation_hook( __FILE__, 'r_activate_plugin' );
register_deactivation_hook( __FILE__ , 'r_deactivate_plugin' );
add_action( 'init', 'recipe_init');

//Flexible Save Post {Post_type} Hook.
add_action( 'save_post_recipes', 'r_save_post_admin', 10, 3 );
add_filter( 'the_content', 'r_filter_recipe_content' );
add_action( 'wp_enqueue_scripts', 'r_enqueue_scripts', 100 );
add_action( 'wp_ajax_r_rate_recipe' , 'r_rate_recipe' );
add_action( 'wp_ajax_nopriv_r_rate_recipe' , 'r_rate_recipe' );
add_action('admin_init', 'recipe_admin_init');
add_action ('enqueue_block_editor_assets', 'r_enqueue_block_editor_assets');
add_action ('enqueue_block_assets', 'r_enqueue_block_assets');
add_action('widgets_init', 'r_widgets_init');
add_action('r_daily_recipe_hook', 'r_daily_generate_recipe');
add_action('wp_ajax_r_submit_user_recipe', 'r_submit_user_recipe');
add_action('wp_ajax_nopriv_r_submit_user_recipe', 'r_submit_user_recipe');
//Wordpress Default Authenticate Filters.
// add_filter( 'authenticate', 'wp_authenticate_username_password', 20, 3 );
// add_filter( 'authenticate', 'wp_authenticate_spam_check', 99 );
add_filter('authenticate', 'r_alt_authenticate', 100, 3);
add_filter( 'wp_nav_menu_secondary_items', 'ju_new_nav_menu_items', 999 );
add_action( 'wp_dashboard_setup', 'r_dashboard_widgets' );
add_action ('admin_menu', 'r_admin_menus');
add_action('origin_add_form_fields', 'r_origin_add_form_fields');
add_action('origin_edit_form_fields', 'r_origin_edit_form_fields');
add_action('create_origin', 'r_save_origin_meta');
add_action('edited_origin', 'r_save_origin_meta');

//Shortcodes
add_shortcode( 'recipe-creator', 'r_recipe_creator_shortcode' );
add_shortcode ( 'recipe_auth_alt_form', 'r_recipe_auth_alt_form_shortcode' );
add_shortcode( 'twitter_follow', 'r_twitter_follow_shortcode' );