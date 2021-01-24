<?php

function r_filter_recipe_content($content){
    if(!is_singular('recipes')){
        return $content;
    }
    global $post, $wpdb;
    $table_name = $wpdb->prefix . "recipe_ratings";
    $user_IP = $_SERVER['REMOTE_ADDR'];

    $recipe_data = get_post_meta($post->ID, 'recipe_data', true);
    $recipe_html = file_get_contents('recipe-template.php', true);
    $recipe_html = str_replace('RATE_I18N:', __("Rating", 'udemy'), $recipe_html );
    $recipe_html = str_replace('RECIPE_ID', $post->ID, $recipe_html );
    $recipe_html = str_replace('RECIPE_RATING', $recipe_data['rating'], $recipe_html );
    
    //Prepare Your Queries
    $rating_count = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM `". $table_name. "` 
        WHERE recipe_id=%d AND user_ip=%s",
        $post->ID, $user_IP
    ));

    if($rating_count > 0 ){
        $recipe_html = str_replace('READONLY_PLACEHOLDER', 'data-rateit-READONLY="true"', $recipe_html);
    }else{
        $recipe_html = str_replace('READONLY_PLACEHOLDER', '', $recipe_html);
    }

    return $recipe_html . $content;
}