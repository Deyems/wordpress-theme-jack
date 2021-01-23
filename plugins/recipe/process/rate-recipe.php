<?php 
function r_rate_recipe(){
   global $wpdb;
   $table_name = $wpdb->prefix . "recipe_ratings";

   $output = ['status' => 1];
   $postID = absint($_POST['rid']);
   $rating = round($_POST['rating'], 1);
   $user_IP = $_SERVER['REMOTE_ADDR'];

   //Perform Check to stop multiple submissions to Db
   $rating_count = $wpdb->get_var(
    "SELECT COUNT(*) FROM `". $table_name. "` 
    WHERE recipe_id='". $postID ."' AND user_ip= '". $user_IP . "'"
   );

   if($rating_count>0){
    wp_send_json($output);
   }
   
   //Insert Rating into DB
   $wpdb->insert( $table_name,
    [
        'recipe_id' => $postID,
        'rating' => $rating,
        'user_ip' => $user_IP
    ],
    [ '%d', '%f', '%s' ]
   );

   //Update Rating META VALUES
   $recipe_data = get_post_meta($postID,'recipe_data', true);

   $recipe_data['rating_count']++;
   $recipe_data['rating'] = round($wpdb->get_var(
    "SELECT AVG(`rating`) FROM `". $table_name. "` 
    WHERE recipe_id='". $postID ."'"
   ), 1);
    // echo "<pre>";
    // print_r($recipe_data);
    // print_r("At Update stage here");
    // echo "</pre>";

   update_post_meta($postID, 'recipe_data', $recipe_data);
   
   //Add actions to allow for other plugins to extend Plugin
   do_action('recipe_rated', [
        'post_id' => $postID,
        'rating' => $rating_count,
        'user_ip' => $user_IP
   ]);
   
   $output['status'] = 2;
   wp_send_json($output);
}