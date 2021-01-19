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
    WHERE recipe_id='". $postID ."' AND user_ip= '". $user_IP. "'"
   );

   if($rating_count>0){
    wp_send_json($output);
   }
   
   $wpdb->insert( $table_name,
    [
        'recipe_id' => $postID,
        'rating' => $rating,
        'user_ip' => $user_IP
    ],
    [ '%d', '%f', '%s' ]
   );
   $output['status'] = 2;
   wp_send_json($output);
}