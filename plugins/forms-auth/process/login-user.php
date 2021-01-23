<?php

function my_login_user(){
    $output = ['status' => 1];
    
    $nonce = isset($_POST['_wpnonce']) ? $_POST['_wpnonce'] : '';
    
    if(!wp_verify_nonce($nonce,'my_myrecipe_auth')){
        wp_send_json($output);
    }
    
    if(!isset($_POST['username'], $_POST['password'] ))
    {
        wp_send_json($output);
    }

    $user = wp_signon([
        'user_login' => sanitize_text_field($_POST['username']),
        'user_password' => sanitize_text_field($_POST['password']),
        'remember' => true,
    ],false);

    if(is_wp_error($user)){
        wp_send_json($output);
    }

    $output['status']= 2;
    wp_send_json($output);
}