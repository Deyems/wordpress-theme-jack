<?php

function ju_widgets(){
    register_sidebar([
        'name' => __( 'Deyems Theme Side Bar', 'udemy' ),
        'id' => 'ju_sidebar',
        'description' => __( 'Sidebar for theme Deyems Udemy', 'udemy' ),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ]);
}