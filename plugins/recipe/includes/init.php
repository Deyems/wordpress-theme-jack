<?php

function recipe_init(){
    $labels = [
        'name'                  => _x( 'Recipes', 'Post type general name', 'recipe' ),
        'singular_name'         => _x( 'Recipe', 'Post type singular name', 'recipe' ),
        'menu_name'             => _x( 'Recipes', 'Admin Menu text', 'recipe' ),
        'name_admin_bar'        => _x( 'Recipe', 'Add New on Toolbar', 'recipe' ),
        'add_new'               => __( 'Add New', 'recipe' ),
        'add_new_item'          => __( 'Add New Recipe', 'recipe' ),
        'new_item'              => __( 'New Recipe', 'recipe' ),
        'edit_item'             => __( 'Edit Recipe', 'recipe' ),
        'view_item'             => __( 'View Recipe', 'recipe' ),
        'all_items'             => __( 'All Recipes', 'recipe' ),
        'search_items'          => __( 'Search Recipes', 'recipe' ),
        'parent_item_colon'     => __( 'Parent Recipes:', 'recipe' ),
        'not_found'             => __( 'No Recipes found.', 'recipe' ),
        'not_found_in_trash'    => __( 'No Recipes found in Trash.', 'recipe' ),
        'featured_image'        => _x( 'Recipe Cover Image', 'Overrides the “Featured Image” phrase for this post type.', 'recipe' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type.', 'recipe' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type.', 'recipe' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type.', 'recipe' ),
        'archives'              => _x( 'Recipe archives', 'The post type archive label used in nav menus. Default “Post Archives”.', 'recipe' ),
        'insert_into_item'      => _x( 'Insert into Recipe', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post).', 'recipe' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Recipe', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post).', 'recipe' ),
        'filter_items_list'     => _x( 'Filter Recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”.', 'recipe' ),
        'items_list_navigation' => _x( 'Recipes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”', 'recipe' ),
        'items_list'            => _x( 'Recipes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”.', 'recipe' ),
    ];
 
    $args = [
        'labels'          => $labels,
        'desription'      => 'A custom post type for recipes',
        'public'          => true,
        'publicly_queryable' => true,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'query_var'       => true,
        'rewrite'         => [ 'slug' => 'recipe' ],
        'capability_type' => 'post',
        'has_archive'     => true,
        'hierarchical'  => false,
        'menu_position' => 20,
        'supports'  => [ 'title', 'editor', 'author', 'thumbnail' ],
        'taxonomies' => ['category', 'post_tag'],
        'show_in_rest' => true,
    ];

    register_post_type( 'recipes', $args );
}