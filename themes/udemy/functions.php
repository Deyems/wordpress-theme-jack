<?php

//Setups

//Includes
include (get_theme_file_path('/includes/front/enqueue.php'));

//Hooks
add_action('wp_enqueue_scripts', 'ju_enqueue');
//Shortcodes
