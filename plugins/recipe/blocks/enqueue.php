<?php

function r_enqueue_block_editor_assets(){
    wp_register_script(
        'r_blocks_bundle', 
        plugins_url('/blocks/dist/bundle.js', RECIPE_PLUGIN_URL),
        ['wp-i18n', 'wp-element', 'wp-blocks', 
        'wp-components','wp-editor', 'wp-api'],
        filemtime(plugin_dir_path(RECIPE_PLUGIN_URL) . '/blocks/dist/bundle.js')
    );
    wp_enqueue_script('r_blocks_bundle');
}

function r_enqueue_block_assets(){
    wp_register_style('r_blocks',
    plugins_url('/blocks/dist/blocks-main.css', RECIPE_PLUGIN_URL),
    [],
    filemtime(plugin_dir_path(RECIPE_PLUGIN_URL) . '/blocks/dist/blocks-main.css')
    );
    wp_enqueue_style('r_blocks');
    
    wp_register_style('r_web_fonts',
    'https://fonts.googleapis.com/css2?family=Lato&display=swap',
    ['https://fonts.gstatic.com'],
    filemtime(plugin_dir_path(RECIPE_PLUGIN_URL) . '/blocks/dist/blocks-main.css')
    );
    wp_enqueue_style('r_web_fonts');
}