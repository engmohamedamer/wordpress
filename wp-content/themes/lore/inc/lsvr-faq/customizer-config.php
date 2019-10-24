<?php

add_action( 'customize_register', 'lsvr_lore_faq_customize_register' );
if ( ! function_exists( 'lsvr_lore_faq_customize_register' ) ) {
    function lsvr_lore_faq_customize_register( $wp_customize ) {
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_lore_' );

            $lsvr_customizer->add_section( 'lsvr_faq_settings', array(
                'title' => esc_html__( 'FAQ', 'lore' ),
                'priority' => 190,
            ));

                // Header background image
                $lsvr_customizer->add_field( 'lsvr_faq_header_background_image', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Header Background Image', 'lore' ),
                    'description' => esc_html__( 'Header background image for all FAQ pages. Optimal resolution is about 2000x1000px or more.', 'lore' ),
                    'type' => 'image',
                    'priority' => 1010,
                ));

                // Title
                $lsvr_customizer->add_field( 'lsvr_faq_archive_title', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'FAQ Archive Title', 'lore' ),
                    'description' => esc_html__( 'This title will be used as the archive page headline and in breadcrumbs.', 'lore' ),
                    'type' => 'text',
                    'default' => esc_html__( 'FAQ', 'lore' ),
                    'priority' => 1020,
                ));

                // Archive layout
                $lsvr_customizer->add_field( 'lsvr_faq_archive_layout', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Archive Layout', 'lore' ),
                    'description' => esc_html__( 'Change the layout of FAQ post archive page. The "Narrow" layout does not support sidebars.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lore' ),
                        'narrow' => esc_html__( 'Narrow', 'lore' ),
                    ),
                    'default' => 'default',
                    'priority' => 1040,
                ));

                // Archive posts per page
                $lsvr_customizer->add_field( 'lsvr_faq_archive_posts_per_page', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Posts Per Page', 'lore' ),
                    'description' => esc_html__( 'How many FAQ posts should be displayed per page. Set to 0 to display all.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ),
                    'default' => 10,
                    'priority' => 1120,
                ));

                // Archive order
                $lsvr_customizer->add_field( 'lsvr_faq_archive_order', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Archive Order', 'lore' ),
                    'description' => esc_html__( 'Change the posts order. Leave it on Default if you want to use 3rd party plugin to set the order.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lore' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lore' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lore' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lore' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lore' ),
                        'random' => esc_html__( 'Random', 'lore' ),
                    ),
                    'default' => 'default',
                    'priority' => 1130,
                ));

                // Expandable
                $lsvr_customizer->add_field( 'lsvr_faq_archive_expandable_enable', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Expandable Posts', 'lore' ),
                    'description' => esc_html__( 'Make FAQ posts on archive expandable (closed by default).', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1140,
                ));

                // Show category
                $lsvr_customizer->add_field( 'lsvr_faq_archive_category_enable', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Archive Post Category', 'lore' ),
                    'description' => esc_html__( 'Display post category on the archive page.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1150,
                ));

                // Show permalink
                $lsvr_customizer->add_field( 'lsvr_faq_archive_permalink_enable', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Show Permalink', 'lore' ),
                    'description' => esc_html__( 'Show post permalink on archive.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1160,
                ));

                // Archive sidebar position
                $lsvr_customizer->add_field( 'lsvr_faq_archive_sidebar_position', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Archive Sidebar Position', 'lore' ),
                    'description' => esc_html__( 'Change the FAQ post archive sidebar position.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'left' => esc_html__( 'Left', 'lore' ),
                        'right' => esc_html__( 'Right', 'lore' ),
                    ),
                    'default' => 'disable',
                    'priority' => 1500,
                    'required' => array(
                        'setting' => 'lsvr_faq_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Archive sidebar ID
                $lsvr_customizer->add_field( 'lsvr_faq_archive_sidebar_id', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Archive Sidebar', 'lore' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'lore' ),
                    'type' => 'select',
                    'choices' => lsvr_lore_get_sidebars(),
                    'priority' => 1510,
                    'required' => array(
                        array(
                            'setting' => 'lsvr_faq_archive_layout',
                            'operator' => '==',
                            'value' => 'default',
                        ),
                        array(
                            'setting' => 'lsvr_faq_archive_sidebar_position',
                            'operator' => '==',
                            'value' => 'left,right',
                        ),
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'lsvr_faq_separator_2', array(
                    'section' => 'lsvr_faq_settings',
                    'priority' => 2000,
                ));

                // Single layout
                $lsvr_customizer->add_field( 'lsvr_faq_single_layout', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Detail Layout', 'lore' ),
                    'description' => esc_html__( 'Change the layout of FAQ post detail page. The "Narrow" layout does not support sidebars.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lore' ),
                        'narrow' => esc_html__( 'Narrow', 'lore' ),
                    ),
                    'default' => 'default',
                    'priority' => 2010,
                ));

                // Enable post detail navigation
                $lsvr_customizer->add_field( 'lsvr_faq_single_navigation_enable', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Enable FAQ Detail Navigation', 'lore' ),
                    'description' => esc_html__( 'Display links to previous and next posts at the bottom of the current FAQ.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2030,
                ));

                // Single sidebar position
                $lsvr_customizer->add_field( 'lsvr_faq_single_sidebar_position', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Detail Sidebar Position', 'lore' ),
                    'description' => esc_html__( 'Change the FAQ post detail sidebar position.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'left' => esc_html__( 'Left', 'lore' ),
                        'right' => esc_html__( 'Right', 'lore' ),
                    ),
                    'default' => 'disable',
                    'priority' => 2040,
                    'required' => array(
                        'setting' => 'lsvr_faq_single_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Single sidebar ID
                $lsvr_customizer->add_field( 'lsvr_faq_single_sidebar_id', array(
                    'section' => 'lsvr_faq_settings',
                    'label' => esc_html__( 'Detail Sidebar', 'lore' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'lore' ),
                    'type' => 'select',
                    'choices' => lsvr_lore_get_sidebars(),
                    'priority' => 2050,
                    'required' => array(
                        array(
                            'setting' => 'lsvr_faq_single_layout',
                            'operator' => '==',
                            'value' => 'default',
                        ),
                        array(
                            'setting' => 'lsvr_faq_single_sidebar_position',
                            'operator' => '==',
                            'value' => 'left,right',
                        ),
                    ),
                ));

        }
    }
}

?>