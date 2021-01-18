<?php
function r_activate_plugin(){
    if(version_compare(get_bloginfo('version'), '5.0', '<')){
        wp_die(__("You must update this version of wordpress to use this Plugin", 'recipe'));
    }
}