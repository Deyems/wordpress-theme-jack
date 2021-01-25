<?php

function r_recipe_creator_shortcode(){
    //Converting file_get_contents to wp_remote_get function
    $creator_tpl_res = wp_remote_get(
        plugins_url('includes/shortcodes/creator-template.php', RECIPE_PLUGIN_URL)
    );
    $creatorHTML = wp_remote_retrieve_body($creator_tpl_res);
    $editorHTML = r_generate_content_editor();
    $creatorHTML = str_replace('CONTENT_EDITOR', $editorHTML, $creatorHTML);
    return $creatorHTML;
}

function r_generate_content_editor(){
    ob_start();
    wp_editor('', 'recipecontenteditor');
    $editor_contents = ob_get_clean();
    return $editor_contents;
}