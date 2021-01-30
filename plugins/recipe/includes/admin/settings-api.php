<?php
function r_settings_api(){
    register_setting( 'r_opts_group', 'r_opts', 'r_opts_sanitize');
    add_settings_section(
        'recipe_settings',
        'Recipe Settings',
        'r_settings_section',
        'r_opts_sections'
    );

    add_settings_field(
        'rating_login_required',
        'User login required for rating recipes',
        'rating_login_required_input_cb',
        'r_opts_sections',
        'recipe_settings'
    );
    
    add_settings_field(
        'recipe_submission_login_required',
        'User login required for submitting recipes',
        'recipe_submission_login_required_input_cb',
        'r_opts_sections',
        'recipe_settings'
    );

}

function r_settings_section(){
    echo '<p>You can change recipe settings here.</p>';
}

function rating_login_required_input_cb(){
    $recipe_opts = get_option('r_opts');
    ?>
    <select id="rating_login_required" name="r_opts[rating_login_required]">
        <option value="1">No</option>
        <option value="2" <?php echo $recipe_opts['rating_login_required'] == 2 ? 'SELECTED' : '' ; ?>>Yes</option>
    </select>
    <?php
}

function recipe_submission_login_required_input_cb(){
    $recipe_opts = get_option('r_opts');
    ?>
    <select id="recipe_submission_login_required" name="r_opts[recipe_submission_login_required]">
        <option value="1">No</option>
        <option value="2" <?php echo $recipe_opts['recipe_submission_login_required'] == 2 ? 'SELECTED' : '' ; ?>>Yes</option>
    </select>
    <?php
}

function r_opts_sanitize( $input ){
    $input['rating_login_required'] = abint($input['rating_login_required']);
    $input['recipe_submission_login_required'] = absint($input['recipe_submission_login_required']);
    return $input;
}