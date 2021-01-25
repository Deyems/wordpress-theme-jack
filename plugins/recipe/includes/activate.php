<?php
function r_activate_plugin(){
    if(version_compare(get_bloginfo('version'), '5.0', '<')){
        wp_die(__("You must update this version of wordpress to use this Plugin", 'recipe'));
    }
    recipe_init();
    flush_rewrite_rules();

    global $wpdb;
    $table_name = $wpdb->prefix. "recipe_ratings";
    $createSQL = "
    CREATE TABLE `" . $table_name ."` (
    `ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `recipe_id` BIGINT(20) UNSIGNED NOT NULL,
    `rating` FLOAT(3,2) UNSIGNED NOT NULL,
    `user_ip` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB " . $wpdb->get_charset_collate() . ";";

    require (ABSPATH. "/wp-admin/includes/upgrade.php");

    dbDelta($createSQL);
    //Activate your Cron Scheduler Hook
    wp_schedule_event(time(), 'daily', 'r_daily_recipe_hook');

    $recipe_opts = get_option('r_opts');
    if(!$recipe_opts){
        $opts = [
            'rating_login_required' => 1,
            'recipe_submission_login_required' => 1
        ];
        add_option('r_opts', $opts);
    }

}