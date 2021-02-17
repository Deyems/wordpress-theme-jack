<?php

function ju_setup_theme(){
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', [
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
        'style',
        'script'
        ]
    );

    add_theme_support('starter-content', [
        'widgets' => [
            'ju_sidebar' => [
                'text_business_info', 'search', 'text_about'
            ],
        ],

        // Use a page template with the predefined about page
        'posts' => [
            'home' => [
                'thumbnail' => '{{image-about}}',
            ],
            'about' => [
                'thumbnail' => '{{image-about}}',
            ],
            'contact' => [
                'thumbnail' => '{{image-about}}',
            ],
            'blog' => [
                'thumbnail' => '{{image-about}}',
            ],
            'custom' => [
                'post_type' => 'page',
                'post_title' => 'Custom Page here',
                'thumbnail' => '{{featured-image-logo}}',
            ],
        ],

        'attachments' => [
            'image-about' => [
                'post_title' => __('About', 'udemy'),
                'post_content' => __('About Image Description'),
                'post_excerpt' => __('About Attachment Caption'),
                'file' => 'assets/images/about/1.jpg',
            ],
            'featured-image-logo' => [
                'post_title' => __('Logo', 'udemy'),
                'post_content' => __('Logo Attachment Description'),
                'post_excerpt' => __('Logo Attachment Caption'),
                'file' => 'assets/images/icons/map-icon.png',
            ],
        ],

        // Use a page template with the predefined about page
        'options' => [
            'show_on_front' => 'page',
            'page_on_front' => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ],

        // Use a page template with the predefined about page
        'theme_mods' => [
            'ju_facebook_handle' => 'udemy',
            'ju_twitter_handle' => 'udemy',
            'ju_instagram_handle' => 'udemy',
            'ju_email' => 'udemy',
            'ju_phone_number' => 'udemy',
            'ju_header_show_search' => 'yes',
            'ju_header_show_cart' => 'yes',
        ],
        
        'nav_menus' => [
            'primary' => [
                'name' => __('Primary Menu', 'udemy'),
                'items' => [
                    'link_home',
                    'page_about',
                    'page_blog',
                    'page_contact'
                ],
            ],
            'secondary' => [
                'name' => __('Secondary Menu', 'udemy'),
                'items' => [
                    'link_home',
                    'page_about',
                    'page_blog',
                    'page_contact'
                ],
            ],
        ],

    

    ]);
    add_theme_support('woocommerce');
    register_nav_menu( 'primary', __( 'Primary Menu', 'udemy' ) );
    register_nav_menu( 'secondary', __( 'Secondary Menu', 'udemy' ) );

    if (function_exists('quads_register_ad')){
        quads_register_ad([
            'location' => 'udemy_header',
            'description' => 'Udemy Header position'
        ]);
    }

}