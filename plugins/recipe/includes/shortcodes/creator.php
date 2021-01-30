<?php

function r_recipe_creator_shortcode(){
    $recipe_options = get_option('r_opts');
    if(!is_user_logged_in() && $recipe_options['recipe_submission_login_required'] == 2){
        return 'You must be logged in to submit a recipe';
    }
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