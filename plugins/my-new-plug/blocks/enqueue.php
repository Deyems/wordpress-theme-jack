<?php

function r_enqueue_editor_block_assets() {
    wp_register_script(
        'r_blocks_bundle', 
        plugins_url('/blocks/dist/bundle.js', __FILE__),
        ['wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor', 'wp-api']
    );
}