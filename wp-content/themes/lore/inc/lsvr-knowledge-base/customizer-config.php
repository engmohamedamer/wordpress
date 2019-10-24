<?php

add_action( 'customize_register', 'lsvr_lore_knowledge_base_customize_register' );
if ( ! function_exists( 'lsvr_lore_knowledge_base_customize_register' ) ) {
    function lsvr_lore_knowledge_base_customize_register( $wp_customize ) {
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_lore_' );

            $lsvr_customizer->add_section( 'lsvr_kba_settings', array(
                'title' => esc_html__( 'Knowledge Base', 'lore' ),
                'priority' => 140,
            ));

                // Header background image
                $lsvr_customizer->add_field( 'lsvr_kba_header_background_image', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Header Background Image', 'lore' ),
                    'description' => esc_html__( 'Header background image for all Knowledge Base pages. Optimal resolution is about 2000x1000px or more.', 'lore' ),
                    'type' => 'image',
                    'priority' => 1010,
                ));

                // Title
                $lsvr_customizer->add_field( 'lsvr_kba_archive_title', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Article Archive Title', 'lore' ),
                    'description' => esc_html__( 'This title will be used as the archive page headline and in breadcrumbs.', 'lore' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Knowledge Base', 'lore' ),
                    'priority' => 1020,
                ));

                // Archive layout
                $lsvr_customizer->add_field( 'lsvr_kba_archive_layout', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Archive Layout', 'lore' ),
                    'description' => esc_html__( 'Change the layout of article archive page. This applies only to main archive page. Category archive pages are always displayed as Article View.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Article View', 'lore' ),
                        'category-view' => esc_html__( 'Category View', 'lore' ),
                    ),
                    'default' => 'default',
                    'priority' => 1040,
                ));

                // Archive order
                $lsvr_customizer->add_field( 'lsvr_kba_archive_order', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Archive Order', 'lore' ),
                    'description' => esc_html__( 'Change the articles order. Leave it on Default if you want to use 3rd party plugin to set the order.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lore' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lore' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lore' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lore' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lore' ),
                        'rating' => esc_html__( 'By rating', 'lore' ),
                        'random' => esc_html__( 'Random', 'lore' ),
                    ),
                    'default' => 'default',
                    'priority' => 1050,
                ));

                // Archive posts per page
                $lsvr_customizer->add_field( 'lsvr_kba_archive_posts_per_page', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Posts Per Page', 'lore' ),
                    'description' => esc_html__( 'How many articles should be displayed per archive page in article view. Set to 0 to display all.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ),
                    'default' => 10,
                    'priority' => 1060,
                ));

                // Category view articles limit
                $lsvr_customizer->add_field( 'lsvr_kba_archive_posts_per_category', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Category View Post Limit', 'lore' ),
                    'description' => esc_html__( 'How many articles should be displayed per category in the category view. Set to 0 to display all.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ),
                    'default' => 10,
                    'priority' => 1070,
                    'required' => array(
                        'setting' => 'lsvr_kba_archive_layout',
                        'operator' => '==',
                        'value' => 'category-view',
                    ),
                ));

                // Category view columns
                $lsvr_customizer->add_field( 'lsvr_kba_archive_grid_columns', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Category View Columns', 'lore' ),
                    'description' => esc_html__( 'Separate the category view into multiple columns.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 4,
                        'step' => 1,
                    ),
                    'default' => 3,
                    'priority' => 1080,
                    'required' => array(
                        'setting' => 'lsvr_kba_archive_layout',
                        'operator' => '==',
                        'value' => 'category-view',
                    ),
                ));

                // Enable archive masonry
                $lsvr_customizer->add_field( 'lsvr_kba_archive_masonry_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Enable Masonry', 'lore' ),
                    'description' => esc_html__( 'Display category view layout using Masonry.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1110,
                    'required' => array(
                        'setting' => 'lsvr_kba_archive_layout',
                        'operator' => '==',
                        'value' => 'category-view',
                    ),
                ));

                // Enable archive date
                $lsvr_customizer->add_field( 'lsvr_kba_archive_date_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Archive Post Date', 'lore' ),
                    'description' => esc_html__( 'Show post date on archive (not in category view).', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1120,
                ));

                // Enable archive rating
                $lsvr_customizer->add_field( 'lsvr_kba_archive_rating_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Archive Post Rating', 'lore' ),
                    'description' => esc_html__( 'Show post rating on archive (not in category view).', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1130,
                    'required' => array(
                        'setting' => 'lsvr_kba_rating_enable',
                        'operator' => '==',
                        'value' => 'likes,both,sum',
                    ),
                ));

                // Archive sidebar position
                $lsvr_customizer->add_field( 'lsvr_kba_archive_sidebar_position', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Archive Sidebar Position', 'lore' ),
                    'description' => esc_html__( 'Change the articles archive sidebar position (not in category view).', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'left' => esc_html__( 'Left', 'lore' ),
                        'right' => esc_html__( 'Right', 'lore' ),
                    ),
                    'default' => 'disable',
                    'priority' => 1500,
                ));

                // Archive sidebar ID
                $lsvr_customizer->add_field( 'lsvr_kba_archive_sidebar_id', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Archive Sidebar', 'lore' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'lore' ),
                    'type' => 'select',
                    'choices' => lsvr_lore_get_sidebars(),
                    'priority' => 1510,
                    'required' => array(
                        'setting' => 'lsvr_kba_archive_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'lsvr_kba_separator_2', array(
                    'section' => 'lsvr_kba_settings',
                    'priority' => 2000,
                ));

                // Show author
                $lsvr_customizer->add_field( 'lsvr_kba_single_author_name_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Article Author Name On Detail', 'lore' ),
                    'description' => esc_html__( 'Display name of post author on the detail page near post date.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2020,
                ));

                // Show author bio
                $lsvr_customizer->add_field( 'lsvr_kba_single_author_bio_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Article Author Bio On Detail', 'lore' ),
                    'description' => esc_html__( 'Display post author bio at the bottom of the post.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 2030,
                ));

                // Show last modification date
                $lsvr_customizer->add_field( 'lsvr_kba_single_last_update_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Last Modification Date On Detail', 'lore' ),
                    'description' => esc_html__( 'Show date of last modification of post on its detail page. The last modification date will be displayed only if it is different from publish date.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 2040,
                ));

                // Enable post detail navigation
                $lsvr_customizer->add_field( 'lsvr_kba_single_navigation_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Enable Article Detail Navigation', 'lore' ),
                    'description' => esc_html__( 'Display links to previous and next posts at the bottom of the post detail page.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2050,
                ));

                // Enable related articles
                $lsvr_customizer->add_field( 'lsvr_kba_single_related_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Show Random Related Articles', 'lore' ),
                    'description' => esc_html__( 'Display random post from the same category on the post detail page. Can be overridden by Related Articles option in the Article Settings of an individual post.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2060,
                ));

                // Related articles limit
                $lsvr_customizer->add_field( 'lsvr_kba_single_related_limit', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Number of Related Articles', 'lore' ),
                    'description' => esc_html__( 'How many related articles to display.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ),
                    'default' => 5,
                    'priority' => 2070,
                    'required' => array(
                        'setting' => 'lsvr_kba_single_related_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Single sidebar position
                $lsvr_customizer->add_field( 'lsvr_kba_single_sidebar_position', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Detail Sidebar Position', 'lore' ),
                    'description' => esc_html__( 'Change the article detail sidebar position.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'left' => esc_html__( 'Left', 'lore' ),
                        'right' => esc_html__( 'Right', 'lore' ),
                    ),
                    'default' => 'disable',
                    'priority' => 2110,
                ));

                // Single sidebar ID
                $lsvr_customizer->add_field( 'lsvr_kba_single_sidebar_id', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Detail Sidebar', 'lore' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'lore' ),
                    'type' => 'select',
                    'choices' => lsvr_lore_get_sidebars(),
                    'priority' => 2120,
                    'required' => array(
                        'setting' => 'lsvr_kba_single_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'lsvr_kba_separator_3', array(
                    'section' => 'lsvr_kba_settings',
                    'priority' => 3000,
                ));

                // Enable article rating
                $lsvr_customizer->add_field( 'lsvr_kba_rating_enable', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Allow Article Rating', 'lore' ),
                    'description' => esc_html__( 'Allow visitors to rate Knowledge Base articles.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'likes' => esc_html__( 'Likes only', 'lore' ),
                        'both' => esc_html__( 'Likes and dislikes', 'lore' ),
                        'sum' => esc_html__( 'Likes and dislikes (display sum)', 'lore' ),
                    ),
                    'default' => 'disable',
                    'priority' => 3010,
                ));

                // Rating interval
                $lsvr_customizer->add_field( 'lsvr_kba_rating_interval', array(
                    'section' => 'lsvr_kba_settings',
                    'label' => esc_html__( 'Rating Interval', 'lore' ),
                    'description' => esc_html__( 'How often can a visitor rate single article. Once per:', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        '1hour' => esc_html__( 'Hour', 'lore' ),
                        'day' => esc_html__( 'Day', 'lore' ),
                        'week' => esc_html__( 'Week', 'lore' ),
                        'month' => esc_html__( 'Month', 'lore' ),
                        'threemonths' => esc_html__( 'Three Months', 'lore' ),
                        'sixmonths' => esc_html__( 'Six Months', 'lore' ),
                        'year' => esc_html__( 'Year', 'lore' ),
                        'tenyears' => esc_html__( 'Ten Years', 'lore' ),
                    ),
                    'default' => 'month',
                    'priority' => 3020,
                    'required' => array(
                        'setting' => 'lsvr_kba_rating_enable',
                        'operator' => '==',
                        'value' => 'likes,both,sum',
                    ),
                ));

        }
    }
}

?>