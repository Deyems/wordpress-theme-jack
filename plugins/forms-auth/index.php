<?php
/**
* Plugin Name: Authorize Users
* Description: Override the WP Login and Regiser Forms
* Version: 1.0
* Author: Deyems
* Author URI: https://github.com/Deyems
* Text Domain: myrecipe
*/

if(!function_exists('add_action')){
    echo "This is just a plugin to override the Login and Registration Forms Nothing MUCH";
    exit;
}

//Set ups
define('MYRECIPE_PLUGIN_URL', __FILE__);

//Includes
require_once __DIR__ . '/includes/shortcodes/auth-form.php';
require_once __DIR__ . '/includes/front/enqueue.php';
require_once __DIR__ . '/process/register-user.php';
require_once __DIR__ . '/process/login-user.php';

//Hooks
add_action('wp_enqueue_scripts', 'my_enqueue_scripts', 100);
add_action('wp_ajax_nopriv_my_register_user','my_register_user');
add_action('wp_ajax_nopriv_my_login_user','my_login_user');

//Shortcodes
add_shortcode('myrecipe_auth_form', 'my_myrecipe_auth_form_shortcode');
