<?php

function r_get_random_recipe(){
    global $wpdb;
    //This method is slow. It can still be optimized
    $wpdb->get_var("SELECT `ID` FROM `". $wpdb->posts ."`
                    WHERE post_status='publish' AND post_type='recipe'
                    ORDER BY rand() LIMIT 1");
}