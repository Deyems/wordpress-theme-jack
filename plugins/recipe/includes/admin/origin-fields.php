<?php

function r_origin_add_form_fields(){
    ?>
    <div class="form-field">
        <label for=""><?php _e('More info url', 'recipe') ?></label>
        <input type="text" name="r_more_info_url">
        <p class="description">
            <?php esc_html_e('A url a user can click to learn more about this origin', 'recipe') ?>
        </p>
    </div>
    <?php
}

function r_origin_edit_form_fields(){
    ?>
    
    <?php
}