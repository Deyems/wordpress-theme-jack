<?php
if(!function_exists('ju_plugin_activated_check')){
    function ju_plugin_activated_check($plugin_file_name){
        require_once (ABSPATH. 'wp-admin/includes/plugin.php');
        return is_plugin_active($plugin_file_name);
    }
}