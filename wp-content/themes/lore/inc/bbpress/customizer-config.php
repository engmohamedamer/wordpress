<?php

add_action( 'customize_register', 'lsvr_lore_bbpress_customize_register' );
if ( ! function_exists( 'lsvr_lore_bbpress_customize_register' ) ) {
    function lsvr_lore_bbpress_customize_register( $wp_customize ) {
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_lore_' );

            $lsvr_customizer->add_section( 'bbpress_settings', array(
                'title' => esc_html__( 'bbPress', 'lore' ),
                'priority' => 250,
            ));

                // Title
                $lsvr_customizer->add_field( 'bbpress_archive_title', array(
                    'section' => 'bbpress_settings',
                    'label' => esc_html__( 'Archive Title', 'lore' ),
                    'description' => esc_html__( 'This title will be used as the archive page headline and in breadcrumbs.', 'lore' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Forums', 'lore' ),
                    'priority' => 1010,
                ));

                // Sidebar position
                $lsvr_customizer->add_field( 'bbpress_sidebar_position', array(
                    'section' => 'bbpress_settings',
                    'label' => esc_html__( 'Sidebar Position', 'lore' ),
                    'description' => esc_html__( 'Choose sidebar position on bbPress pages.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'left' => esc_html__( 'Left', 'lore' ),
                        'right' => esc_html__( 'Right', 'lore' ),
                    ),
                    'priority' => 1040,
                    'default' => 'disable',
                ));

                // Archive right sidebar ID
                $lsvr_customizer->add_field( 'bbpress_sidebar_id', array(
                    'section' => 'bbpress_settings',
                    'label' => esc_html__( 'Sidebar', 'lore' ),
                    'description' => esc_html__( 'Choose sidebar to display on bbPress pages.', 'lore' ),
                    'type' => 'select',
                    'choices' => lsvr_lore_get_sidebars(),
                    'priority' => 1050,
                    'default' => 'lsvr-lore-default-sidebar',
                    'required' => array(
                        'setting' => 'bbpress_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

        }
    }
}

?>