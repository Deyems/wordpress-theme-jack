<?php

function ju_buddypress_profile_tabs(){
    global $bp;

    bp_core_new_nav_item( [
        'name' => esc_html__('Recipes', 'udemy'),
        'slug' => 'recipes',
        'position' => 100,
        'screen_function' => 'ju_recent_recipes_tab',
        'show_for_displayed_user' => true,
        'item_css_id' => 'ju_user_recipes',
        'default_subnav_slug' => 'recipes'
    ]);

}