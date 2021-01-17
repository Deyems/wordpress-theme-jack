<?php

function ju_misc_customizer_section($wp_customize){
    $wp_customize->add_setting('ju_header_show_search', [
        'default' => 'yes',
        'transport' => 'postMessage',
    ]);

    $wp_customize->add_setting('ju_header_show_cart', [
        'default' => 'yes',
        'transport' => 'postMessage',
    ]);

    $wp_customize->add_setting('ju_footer_copyright_text', [
        'default' => 'Copyrights &copy; 2019 All Rights Reserved'
    ]);

    $wp_customize->add_setting('ju_footer_tos_page', [
        'default' => 0,
    ]);
    
    $wp_customize->add_setting('ju_read_more_color', [
        'default' => '#1ABC9C',
    ]);
    
    $wp_customize->add_setting('ju_report_file', [
        'default' => '',
    ]);

    $wp_customize->add_setting('ju_footer_privacy_page', [
        'default' => 0,
    ]);

    //Add Sections
    $wp_customize->add_section('ju_misc_section', [
        'title' => __('Template Misc Settings', 'udemy'),
        'priority' => 20,
        'panel' => 'deyems'
    ]);

    //Add Controls
    //Show Search Button at the Top Section
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'ju_header_show_search_input',
        [
            'label' => __('Show Search Button in Header', 'udemy'),
            'section' => 'ju_misc_section',
            'settings' => 'ju_header_show_search',
            'type' => 'checkbox',
            'choices' => [
                'yes' => 'Yes'
            ]
        ]
    ));
    
    //Show Cart at the Top Section
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'ju_header_show_cart_button',
        [
            'label' => __('Show Shop Cart Button in Header', 'udemy'),
            'section' => 'ju_misc_section',
            'settings' => 'ju_header_show_cart',
            'type' => 'checkbox',
            'choices' => [
                'yes' => 'Yes'
            ]
        ]
    ));

    //Show Copyright at the Footer Section
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'ju_show_footer_copyright_input',
        [
            'label' => __('Copyright text at Footer', 'udemy'),
            'section' => 'ju_misc_section',
            'settings' => 'ju_footer_copyright_text',
        ]
    ));
    
    //Show Footer TOS
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'ju_footer_tos_page_input',
        [
            'label' => __('Footer TOS Page', 'udemy'),
            'section' => 'ju_misc_section',
            'settings' => 'ju_footer_tos_page',
            'type' => 'dropdown-pages'
        ]
    ));
    
    //Show Privacy page
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'ju_footer_privacy_page_input',
        [
            'label' => __('Footer Privacy Policy Page', 'udemy'),
            'section' => 'ju_misc_section',
            'settings' => 'ju_footer_privacy_page',
            'type' => 'dropdown-pages'
        ]
    ));
    
    //Show Privacy page
    $wp_customize->add_control(
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'ju_read_more_color_input', 
            [
                'label'      => __( 'Read more link color', 'udemy' ),
                'section'    => 'ju_misc_section',
                'settings'   => 'ju_read_more_color',
            ] 
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Upload_Control(
            $wp_customize,
            'ju_report_file_input',
            [
                'label'      => __( 'File Report', 'udemy' ),
                'section'    => 'ju_misc_section',
                'settings'   => 'ju_report_file',
            ] 
        ) 
    );
}