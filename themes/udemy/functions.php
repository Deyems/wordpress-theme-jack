<?php

//Setups
define('JU_DEV_MODE', true);

//Includes
require_once (get_theme_file_path('/includes/front/enqueue.php'));
require_once (get_theme_file_path('/includes/setup.php'));
require_once (get_theme_file_path('includes/custom-nav-walker.php'));
require_once (get_theme_file_path('includes/widgets.php'));
require_once (get_theme_file_path('includes/theme-customizer.php'));
require_once (get_theme_file_path('includes/customizer/social.php'));
require_once (get_theme_file_path('includes/customizer/misc.php'));
require_once (get_theme_file_path('includes/customizer/enqueue.php'));
require_once (get_theme_file_path('includes/buddypress/profile-tabs.php'));
require_once (get_theme_file_path('includes/utility.php'));

//Hooks
add_action('wp_enqueue_scripts', 'ju_enqueue');
add_action('after_setup_theme', 'ju_setup_theme');
add_action('widgets_init', 'ju_widgets');
add_action('customize_register', 'ju_customize_register');
add_action( 'customize_preview_init' , 'ju_customize_preview_init' );

//Hooks for BuddyPress
add_action( 'bp_setup_nav', 'ju_buddypress_profile_tabs' );
//Shortcodes
