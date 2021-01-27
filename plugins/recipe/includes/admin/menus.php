<?php
function r_admin_menus(){
    add_menu_page(
        'Recipe Options',
        'Recipe Options',
        'edit_theme_options',
        'r_plugin_opts',
        'r_plugin_opts_page'
    );
}