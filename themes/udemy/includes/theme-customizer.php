<?php 

function ju_customize_register($wp_customize){
    ju_social_customizer_section($wp_customize);
    ju_misc_customizer_section($wp_customize);
}