<?php
/**
 * WordPress customizer settings
 */
add_action( 'customize_register', 'lsvr_lore_customize_register' );
if ( ! function_exists( 'lsvr_lore_customize_register' ) ) {
    function lsvr_lore_customize_register( $wp_customize ) {

        // Init the LSVR Customizer object
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_lore_' );

            // Change order of default sections
            $wp_customize->get_section( 'static_front_page' )->priority = 117;
            $wp_customize->get_section( 'custom_css' )->priority = 300;

            // Header
            $lsvr_customizer->add_section( 'header_settings', array(
                'title' => esc_html__( 'Header', 'lore' ),
                'priority' => 101,
            ));

                // Header background image
                $lsvr_customizer->add_field( 'header_background_image', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Header Background Image', 'lore' ),
                    'description' => esc_html__( 'Optimal resolution is about 2000x1000px or more.', 'lore' ),
                    'type' => 'image',
                    'priority' => 1010,
                ));

                // Background overlay opacity
                $lsvr_customizer->add_field( 'header_background_overlay_opacity', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Header Overlay Opacity', 'lore' ),
                    'description' => esc_html__( 'Set to 0 for invisible overlay and to 100 for solid color.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ),
                    'default' => 50,
                    'priority' => 1110,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'header_separator_2', array(
                    'section' => 'header_settings',
                    'priority' => 2000,
                ));

                // Max logo width
                $lsvr_customizer->add_field( 'header_logo_max_width', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Logo Max Width', 'lore' ),
                    'description' => esc_html__( 'Set maximum width of your header logo. You can upload your site logo under Customizer / Site Identity.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 30,
                        'max' => 300,
                        'step' => 1,
                    ),
                    'default' => 50,
                    'priority' => 2010,
                ));

                // Site title enable
                $lsvr_customizer->add_field( 'header_site_title_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Display Site Title', 'lore' ),
                    'description' => esc_html__( 'Show your site title in the header near logo. It can be changed under Customizer / Site Identity.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2020,
                ));

                // Site description enable
                $lsvr_customizer->add_field( 'header_site_tagline_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Display Site Tagline', 'lore' ),
                    'description' => esc_html__( 'Show your site description in the header near logo. It can be changed under Customizer / Site Identity.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2030,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'header_separator_3', array(
                    'section' => 'header_settings',
                    'priority' => 3000,
                ));

                // Header search enable
                $lsvr_customizer->add_field( 'header_search_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Enable Header Search', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3010,
                ));

                // Header search large
                $lsvr_customizer->add_field( 'header_search_large_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Large Header Search', 'lore' ),
                    'description' => esc_html__( 'Choose where to display large version of header search. The compact version (in the form of header menu icon) will be displayed on pages where this large version is disabled.' , 'lore' ),
                    'type' => 'radio',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'everywhere' => esc_html__( 'Display Everywhere', 'lore' ),
                        'front-kb' => esc_html__( 'Knowledge Base and Front Page Only', 'lore' ),
                        'front' => esc_html__( 'Front Page Only', 'lore' ),
                        'kb' => esc_html__( 'Knowledge Base Only', 'lore' ),
                    ),
                    'default' => 'front',
                    'priority' => 3020,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Search filter enable
                $lsvr_customizer->add_field( 'header_search_filter_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Enable Search Filter', 'lore' ),
                    'description' => esc_html__( 'Display post types filter.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3110,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Search filter label
                $lsvr_customizer->add_field( 'header_search_filter_label', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Search Filter Label', 'lore' ),
                    'description' => esc_html__( 'Label for the search filter.', 'lore' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Search in:', 'lore' ),
                    'priority' => 3120,
                    'required' => array(
                        array(
                            'setting' => 'header_search_filter_enable',
                            'operator' => '==',
                            'value' => true,
                        ),
                        array(
                            'setting' => 'header_search_enable',
                            'operator' => '==',
                            'value' => true,
                        ),
                    ),
                ));

                // Ajax search enable
                $lsvr_customizer->add_field( 'header_search_ajax_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Enable Ajax Search', 'lore' ),
                    'description' => esc_html__( 'Return search results without refreshing the site.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3210,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Number of ajax search results
                $lsvr_customizer->add_field( 'header_search_ajax_limit', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Max Ajax Search Results', 'lore' ),
                    'description' => esc_html__( 'Maximum number of search results to display in ajax search.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'default' => 10,
                    'priority' => 3220,
                    'required' => array(
                        array(
                            'setting' => 'header_search_enable',
                            'operator' => '==',
                            'value' => true,
                        ),
                        array(
                            'setting' => 'header_search_ajax_enable',
                            'operator' => '==',
                            'value' => true,
                        ),
                    ),
                ));

                // Search input placeholder
                $lsvr_customizer->add_field( 'header_search_input_placeholder', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Search Input Placeholder', 'lore' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Search the Knowledge Base', 'lore' ),
                    'priority' => 3310,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Suggested search label
                $lsvr_customizer->add_field( 'header_search_keywords_label', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Suggested Search Label', 'lore' ),
                    'description' => esc_html__( 'Label for the suggested keywords.', 'lore' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Suggested Search:', 'lore' ),
                    'priority' => 3410,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Suggested search keywords
                $lsvr_customizer->add_field( 'header_search_keywords', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Suggested Search Keywords', 'lore' ),
                    'description' => esc_html__( 'List of suggested keywords separated by comma. For example: "installation, demo import, translation" (without quotes). Leave blank to hide.', 'lore' ),
                    'type' => 'text',
                    'priority' => 3420,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'header_separator_4', array(
                    'section' => 'header_settings',
                    'priority' => 4000,
                ));

                // Sticky navbar
                $lsvr_customizer->add_field( 'header_sticky_navbar_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Enable Sticky Navbar', 'lore' ),
                    'description' => esc_html__( 'Make navigation bar stick to the top of the page on desktop devices.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 4010,
                ));


            // Footer settings
            $lsvr_customizer->add_section( 'footer_settings', array(
                'title' => esc_html__( 'Footer', 'lore' ),
                'priority' => 102,
            ));

                // Footer widgets columns
                $lsvr_customizer->add_field( 'footer_widgets_columns', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Widget Columns', 'lore' ),
                    'description' => esc_html__( 'How many columns should be used to display widgets in the footer. You can populate the footer with widgets under Appearance / Widgets.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 4,
                        'step' => 1,
                    ),
                    'default' => 3,
                    'priority' => 1010,
                ));

                // Footer text
                $lsvr_customizer->add_field( 'footer_text', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Footer Text', 'lore' ),
                    'description' => esc_html__( 'Ideal for copyright info. You can use A, EM, BR, P and STRONG tags here. For example: &amp;copy; 2018 &lt;a href="http://mysite.com"&gt;MySite&lt;/a&gt;', 'lore' ),
                    'type' => 'textarea',
                    'default'  => '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ),
                    'priority' => 2010,
                ));

                // Enable social links
                $lsvr_customizer->add_field( 'footer_social_links_enable', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Display Social Links', 'lore' ),
                    'description' => esc_html__( 'You can manage your social links under Social Links.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3010,
                ));

                // Enable scroll to top button
                $lsvr_customizer->add_field( 'footer_scroll_top_enable', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Display Scroll To To Button', 'lore' ),
                    'description' => esc_html__( 'Show "scroll to top" button which will scroll the page to the very top after clicking.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 4010,
                ));


            // Sidebar settings
            $lsvr_customizer->add_section( 'sidebar_settings', array(
                'title' => esc_html__( 'Custom Sidebars', 'lore' ),
                'priority' => 115,
            ));

                // Custom sidebars
                $lsvr_customizer->add_field( 'custom_sidebars', array(
                    'section' => 'sidebar_settings',
                    'label' => esc_html__( 'Manage Custom Sidebars', 'lore' ),
                    'description' => esc_html__( 'Here you can manage your custom sidebars. You can populate them with widgets under Appearance / Widgets. To assign a sidebar to a page, set its page template to "Sidebar on the Left" or "Sidebar on the Right" and then choose the sidebar under Sidebar Settings of that page. You can assign sidebars to post type pages (directory, events, galleries, etc.) in the Customizer.', 'lore' ),
                    'type' => 'lsvr-sidebars',
                    'priority' => 1010,
                ));


            // Blog settings
            $lsvr_customizer->add_section( 'blog_settings', array(
                'title' => esc_html__( 'Standard Posts', 'lore' ),
                'priority' => 120,
            ));

                // Header background image
                $lsvr_customizer->add_field( 'blog_header_background_image', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Header Background Image', 'lore' ),
                    'description' => esc_html__( 'Header background image for all blog pages. Optimal resolution is about 2000x1000px or more.', 'lore' ),
                    'type' => 'image',
                    'priority' => 1010,
                ));

                // Show categories
                $lsvr_customizer->add_field( 'blog_archive_categories_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Post Categories', 'lore' ),
                    'description' => esc_html__( 'Display post categories on the archive page.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1020,
                ));

                // Show tags
                $lsvr_customizer->add_field( 'blog_archive_tags_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Post Tags', 'lore' ),
                    'description' => esc_html__( 'Display post tags on the archive page.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1030,
                ));

                // Show comments
                $lsvr_customizer->add_field( 'blog_archive_comments_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Post Comments', 'lore' ),
                    'description' => esc_html__( 'Display post comments count on the archive page.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1030,
                ));

                // Show author name
                $lsvr_customizer->add_field( 'blog_archive_author_name_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Post Author Name', 'lore' ),
                    'description' => esc_html__( 'Display name of post author on the archive page near post date.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1050,
                ));

                // Archive sidebar position
                $lsvr_customizer->add_field( 'blog_archive_sidebar_position', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Sidebar Position', 'lore' ),
                    'description' => esc_html__( 'Change the post archive sidebar position.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'left' => esc_html__( 'Left', 'lore' ),
                        'right' => esc_html__( 'Right', 'lore' ),
                    ),
                    'default' => 'right',
                    'priority' => 1510,
                ));

                // Archive sidebar ID
                $lsvr_customizer->add_field( 'blog_archive_sidebar_id', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Sidebar', 'lore' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'lore' ),
                    'type' => 'select',
                    'choices' => lsvr_lore_get_sidebars(),
                    'priority' => 1520,
                    'default' => 'lsvr-lore-default-sidebar',
                    'required' => array(
                        'setting' => 'blog_archive_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'blog_separator_1', array(
                    'section' => 'blog_settings',
                    'priority' => 2000,
                ));

                // Show author name
                $lsvr_customizer->add_field( 'blog_single_author_name_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Detail Post Author Name', 'lore' ),
                    'description' => esc_html__( 'Display name of post author on the detail page near post date.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2010,
                ));

                // Show author bio
                $lsvr_customizer->add_field( 'blog_single_author_bio_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Detail Article Author Bio', 'lore' ),
                    'description' => esc_html__( 'Display post author bio at the bottom of the post.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 2020,
                ));

                // Enable post detail navigation
                $lsvr_customizer->add_field( 'blog_single_post_navigation_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Enable Post Detail Navigation', 'lore' ),
                    'description' => esc_html__( 'Display links to previous and next posts at the bottom of the current post.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2030,
                ));

                // Single sidebar position
                $lsvr_customizer->add_field( 'blog_single_sidebar_position', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Detail Sidebar Position', 'lore' ),
                    'description' => esc_html__( 'Change the post detail sidebar position.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'left' => esc_html__( 'Left', 'lore' ),
                        'right' => esc_html__( 'Right', 'lore' ),
                    ),
                    'default' => 'right',
                    'priority' => 2110,
                ));

                // Single sidebar ID
                $lsvr_customizer->add_field( 'blog_single_sidebar_id', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Detail Sidebar', 'lore' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'lore' ),
                    'type' => 'select',
                    'choices' => lsvr_lore_get_sidebars(),
                    'priority' => 2120,
                    'default' => 'lsvr-lore-default-sidebar',
                    'required' => array(
                        'setting' => 'blog_single_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));


            // Typography
            $lsvr_customizer->add_section( 'typography_settings', array(
                'title' => esc_html__( 'Typography', 'lore' ),
                'priority' => 200,
            ));

                // Enable Google Fonts
                $lsvr_customizer->add_field( 'typography_google_fonts_enable', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Enable Google Fonts', 'lore' ),
                    'description' => esc_html__( 'If you disable Google Fonts, default sans-serif font will be used for all text.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1010,
                ));

                // Primary font
                $lsvr_customizer->add_field( 'typography_primary_font', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Primary Font', 'lore' ),
                    'description' => esc_html__( 'This font will be used for almost all text except some headlines and titles.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'Alegreya' => 'Alegreya',
                        'Alegreya+Sans' => 'Alegreya Sans',
                        'Archivo+Narrow' => 'Archivo Narrow',
                        'Assistant' => 'Assistant',
                        'Exo+2' => 'Exo 2',
                        'Fira+Sans' => 'Fira Sans',
                        'Hind' => 'Hind',
                        'Inconsolata' => 'Inconsolata',
                        'Karla' => 'Karla',
                        'Lato' => 'Lato',
                        'Libre+Baskerville' => 'Libre Baskerville',
                        'Lora' => 'Lora',
                        'Merriweather' => 'Merriweather',
                        'Montserrat' => 'Montserrat',
                        'Nunito+Sans' => 'Nunito Sans',
                        'Open+Sans' => 'Open Sans',
                        'PT+Serif' => 'PT Serif',
                        'Playfair+Display' => 'Playfair Display',
                        'Roboto' => 'Roboto',
                        'Roboto+Slab' => 'Roboto Slab',
                        'Source+Sans+Pro' => 'Source Sans Pro',
                        'Source+Serif+Pro' => 'Source Serif Pro',
                        'Work+Sans' => 'Work Sans',
                    ),
                    'default' => 'Open+Sans',
                    'priority' => 1020,
                    'required' => array(
                        'setting' => 'typography_google_fonts_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Secondary font
                $lsvr_customizer->add_field( 'typography_secondary_font', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Secondary Font', 'lore' ),
                    'description' => esc_html__( 'This font will be used for most headlines.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'Alegreya' => 'Alegreya',
                        'Alegreya+Sans' => 'Alegreya Sans',
                        'Archivo+Narrow' => 'Archivo Narrow',
                        'Assistant' => 'Assistant',
                        'Exo+2' => 'Exo 2',
                        'Fira+Sans' => 'Fira Sans',
                        'Hind' => 'Hind',
                        'Inconsolata' => 'Inconsolata',
                        'Karla' => 'Karla',
                        'Lato' => 'Lato',
                        'Libre+Baskerville' => 'Libre Baskerville',
                        'Lora' => 'Lora',
                        'Merriweather' => 'Merriweather',
                        'Montserrat' => 'Montserrat',
                        'Nunito+Sans' => 'Nunito Sans',
                        'Open+Sans' => 'Open Sans',
                        'PT+Serif' => 'PT Serif',
                        'Playfair+Display' => 'Playfair Display',
                        'Roboto' => 'Roboto',
                        'Roboto+Slab' => 'Roboto Slab',
                        'Source+Sans+Pro' => 'Source Sans Pro',
                        'Source+Serif+Pro' => 'Source Serif Pro',
                        'Work+Sans' => 'Work Sans',
                    ),
                    'default' => 'Merriweather',
                    'priority' => 1030,
                    'required' => array(
                        'setting' => 'typography_google_fonts_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Base font size
                $lsvr_customizer->add_field( 'typography_base_font_size', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Base Font Size', 'lore' ),
                    'description' => esc_html__( 'Font size of basic content text. All other font sizes will also be calculated from this value. Default font size is 16px.', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        '12' => esc_html__( '12px', 'lore' ),
                        '13' => esc_html__( '13px', 'lore' ),
                        '14' => esc_html__( '14px', 'lore' ),
                        '15' => esc_html__( '15px', 'lore' ),
                        '16' => esc_html__( '16px', 'lore' ),
                        '17' => esc_html__( '17px', 'lore' ),
                        '18' => esc_html__( '18px', 'lore' ),
                    ),
                    'default' => '16',
                    'priority' => 1040,
                ));

                // Font subsets
                $lsvr_customizer->add_field( 'typography_font_subsets', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Font Subsets', 'lore' ),
                    'description' => esc_html__( 'Only the Latin subset is loaded by default. If your site is in any other language than English, you may need to load an additional font subset. Please note that not all font families support all font subsets.', 'lore' ),
                    'type' => 'lsvr-multicheck',
                    'choices' => array(
                        'latin-ext' => esc_html__( 'Latin Extended', 'lore' ),
                        'greek' => esc_html__( 'Greek', 'lore' ),
                        'greek-ext' => esc_html__( 'Greek Extended', 'lore' ),
                        'vietnamese' => esc_html__( 'Vietnamese', 'lore' ),
                        'cyrillic' => esc_html__( 'Cyrillic', 'lore' ),
                        'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'lore' ),
                    ),
                    'priority' => 1050,
                    'required' => array(
                        'setting' => 'typography_google_fonts_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));


            // Colors
            $lsvr_customizer->add_section( 'colors_settings', array(
                'title' => esc_html__( 'Colors', 'lore' ),
                'priority' => 210,
            ));

                // Colors method
                $lsvr_customizer->add_field( 'colors_method', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Set Colors By', 'lore' ),
                    'type' => 'radio',
                    'choices' => array(
                        'predefined' => esc_html__( 'Predefined Scheme', 'lore' ),
                        'custom-colors' => esc_html__( 'Custom Colors', 'lore' ),
                        'custom-skin' => esc_html__( 'Custom Scheme', 'lore' ),
                    ),
                    'default' => 'predefined',
                    'priority' => 1010,
                ));

                // Predefined skin
                $lsvr_customizer->add_field( 'colors_predefined_skin', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Choose Predefined Skin', 'lore' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Green', 'lore' ),
                        'cyan' => esc_html__( 'Cyan', 'lore' ),
                        'orange' => esc_html__( 'Orange', 'lore' ),
                        'yellow' => esc_html__( 'Yellow', 'lore' ),
                    ),
                    'default' => 'default',
                    'priority' => 2010,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'predefined',
                    ),
                ));

                // Accent 1
                $lsvr_customizer->add_field( 'colors_custom_accent1', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Accent', 'lore' ),
                    'type' => 'color',
                    'default' => '#74aa7b',
                    'priority' => 3010,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-colors',
                    ),
                ));

                // Link
                $lsvr_customizer->add_field( 'colors_custom_link', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Link', 'lore' ),
                    'type' => 'color',
                    'default' => '#1565c0',
                    'priority' => 3030,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-colors',
                    ),
                ));

                // Text
                $lsvr_customizer->add_field( 'colors_custom_text', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Text', 'lore' ),
                    'type' => 'color',
                    'default' => '#575863',
                    'priority' => 3040,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-colors',
                    ),
                ));

                // Child theme's style.csss
                $lsvr_customizer->add_info( 'colors_info_skin', array(
                    'section' => 'colors_settings',
                    'label' => esc_html( 'About Custom Scheme', 'lore' ),
                    'description' => esc_html__( 'Please refer to the documentation on how to generate your custom color scheme. Put your generated code into child theme\'s style.css file (you can access it via Appearance / Editor).', 'lore' ),
                    'priority' => 4010,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-skin',
                    ),
                ));


            // Social settings
            $lsvr_customizer->add_section( 'social_settings', array(
                'title' => esc_html__( 'Social Links', 'lore' ),
                'priority' => 220,
            ));

                // About
                $lsvr_customizer->add_info( 'social_links_info', array(
                    'section' => 'social_settings',
                    'label' => esc_html( 'Info', 'lore' ),
                    'description' => esc_html__( 'You can add your social links either by using custom fields, predefined fields or combination of both.', 'lore' ),
                    'priority' => 1000,
                ));

                // Custom Social Link 1 Icon
                $lsvr_customizer->add_field( 'custom_social_link1_icon', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 1 Icon', 'lore' ),
                    'description' => esc_html__( 'Add icon class here. Please refer to the documentation to learn more about icons.', 'lore' ),
                    'type' => 'text',
                    'priority' => 1110,
                ));

                // Custom Social Link 1 URL
                $lsvr_customizer->add_field( 'custom_social_link1_url', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 1 URL', 'lore' ),
                    'description' => esc_html__( 'Absolute URL to your social profile.', 'lore' ),
                    'type' => 'text',
                    'priority' => 1120,
                ));

                // Custom Social Link 1 Label
                $lsvr_customizer->add_field( 'custom_social_link1_label', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 1 Label', 'lore' ),
                    'description' => esc_html__( 'This label will appear when you hover over the icon.', 'lore' ),
                    'type' => 'text',
                    'priority' => 1130,
                ));

                // Custom Social Link 2 Icon
                $lsvr_customizer->add_field( 'custom_social_link2_icon', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 2 Icon', 'lore' ),
                    'type' => 'text',
                    'priority' => 1210,
                ));

                // Custom Social Link 2 URL
                $lsvr_customizer->add_field( 'custom_social_link2_url', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 2 URL', 'lore' ),
                    'type' => 'text',
                    'priority' => 1220,
                ));

                // Custom Social Link 2 Label
                $lsvr_customizer->add_field( 'custom_social_link2_label', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 2 Label', 'lore' ),
                    'type' => 'text',
                    'priority' => 1230,
                ));

                // Custom Social Link 3 Icon
                $lsvr_customizer->add_field( 'custom_social_link3_icon', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 3 Icon', 'lore' ),
                    'type' => 'text',
                    'priority' => 1310,
                ));

                // Custom Social Link 3 URL
                $lsvr_customizer->add_field( 'custom_social_link3_url', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 3 URL', 'lore' ),
                    'type' => 'text',
                    'priority' => 1320,
                ));

                // Custom Social Link 3 Label
                $lsvr_customizer->add_field( 'custom_social_link3_label', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 3 Label', 'lore' ),
                    'type' => 'text',
                    'priority' => 1330,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'social_links_separator_1', array(
                    'section' => 'social_settings',
                    'priority' => 2000,
                ));

                // Predefined Social Links
                $lsvr_customizer->add_field( 'social_links', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Predefined Social Links', 'lore' ),
                    'description' => esc_html__( 'Insert URLs into inputs of social networks which you want to display. You can drag and drop items to change the order.', 'lore' ),
                    'type' => 'lsvr-social-links',
                    'choices' => array(
                        'email' => array(
                            'label' => esc_html__( 'Email', 'lore' ),
                            'icon' => 'icon-envelope-o',
                        ),
                        '500px' => array(
                            'label' => esc_html__( '500px', 'lore' ),
                            'icon' => 'icon-500px',
                        ),
                        'bandcamp' => array(
                            'label' => esc_html__( 'Bandcamp', 'lore' ),
                            'icon' => 'icon-bandcamp',
                        ),
                        'behance' => array(
                            'label' => esc_html__( 'Behance', 'lore' ),
                            'icon' => 'icon-behance',
                        ),
                        'bitbucket' => array(
                            'label' => esc_html__( 'Bitbucket', 'lore' ),
                            'icon' => 'icon-bitbucket',
                        ),
                        'codepen' => array(
                            'label' => esc_html__( 'CodePen', 'lore' ),
                            'icon' => 'icon-codepen',
                        ),
                        'deviantart' => array(
                            'label' => esc_html__( 'DeviantArt', 'lore' ),
                            'icon' => 'icon-deviantart',
                        ),
                        'dribbble' => array(
                            'label' => esc_html__( 'Dribbble', 'lore' ),
                            'icon' => 'icon-dribbble',
                        ),
                        'dropbox' => array(
                            'label' => esc_html__( 'Dropbox', 'lore' ),
                            'icon' => 'icon-dropbox',
                        ),
                        'etsy' => array(
                            'label' => esc_html__( 'Etsy', 'lore' ),
                            'icon' => 'icon-etsy',
                        ),
                        'facebook' => array(
                            'label' => esc_html__( 'Facebook', 'lore' ),
                            'icon' => 'icon-facebook',
                        ),
                        'flickr' => array(
                            'label' => esc_html__( 'Flickr', 'lore' ),
                            'icon' => 'icon-flickr',
                        ),
                        'foursquare' => array(
                            'label' => esc_html__( 'Foursquare', 'lore' ),
                            'icon' => 'icon-foursquare',
                        ),
                        'github' => array(
                            'label' => esc_html__( 'Github', 'lore' ),
                            'icon' => 'icon-github',
                        ),
                        'google-plus' => array(
                            'label' => esc_html__( 'Google+', 'lore' ),
                            'icon' => 'icon-google-plus',
                        ),
                        'instagram' => array(
                            'label' => esc_html__( 'Instagram', 'lore' ),
                            'icon' => 'icon-instagram',
                        ),
                        'lastfm' => array(
                            'label' => esc_html__( 'last.fm', 'lore' ),
                            'icon' => 'icon-lastfm',
                        ),
                        'linkedin' => array(
                            'label' => esc_html__( 'LinkedIn', 'lore' ),
                            'icon' => 'icon-linkedin',
                        ),
                        'odnoklassniki' => array(
                            'label' => esc_html__( 'Odnoklassniki', 'lore' ),
                            'icon' => 'icon-odnoklassniki',
                        ),
                        'pinterest' => array(
                            'label' => esc_html__( 'Pinterest', 'lore' ),
                            'icon' => 'icon-pinterest',
                        ),
                        'qq' => array(
                            'label' => esc_html__( 'QQ', 'lore' ),
                            'icon' => 'icon-qq',
                        ),
                        'reddit' => array(
                            'label' => esc_html__( 'Reddit', 'lore' ),
                            'icon' => 'icon-reddit',
                        ),
                        'skype' => array(
                            'label' => esc_html__( 'Skype', 'lore' ),
                            'icon' => 'icon-skype',
                        ),
                        'slack' => array(
                            'label' => esc_html__( 'Slack', 'lore' ),
                            'icon' => 'icon-slack',
                        ),
                        'snapchat' => array(
                            'label' => esc_html__( 'Snapchat', 'lore' ),
                            'icon' => 'icon-snapchat',
                        ),
                        'tripadvisor' => array(
                            'label' => esc_html__( 'TripAdvisor', 'lore' ),
                            'icon' => 'icon-tripadvisor',
                        ),
                        'tumblr' => array(
                            'label' => esc_html__( 'Tumblr', 'lore' ),
                            'icon' => 'icon-tumblr',
                        ),
                        'twitch' => array(
                            'label' => esc_html__( 'Twitch', 'lore' ),
                            'icon' => 'icon-twitch',
                        ),
                        'twitter' => array(
                            'label' => esc_html__( 'Twitter', 'lore' ),
                            'icon' => 'icon-twitter',
                        ),
                        'vimeo' => array(
                            'label' => esc_html__( 'Vimeo', 'lore' ),
                            'icon' => 'icon-vimeo',
                        ),
                        'vk' => array(
                            'label' => esc_html__( 'VK', 'lore' ),
                            'icon' => 'icon-vk',
                        ),
                        'yahoo' => array(
                            'label' => esc_html__( 'Yahoo', 'lore' ),
                            'icon' => 'icon-yahoo',
                        ),
                        'yelp' => array(
                            'label' => esc_html__( 'Yelp', 'lore' ),
                            'icon' => 'icon-yelp',
                        ),
                        'youtube' => array(
                            'label' => esc_html__( 'YouTube', 'lore' ),
                            'icon' => 'icon-youtube',
                        ),
                    ),
                    'priority' => 2100,
                ));


            // Language settings
            $lsvr_customizer->add_section( 'language_settings', array(
                'title' => esc_html__( 'Languages', 'lore' ),
                'priority' => 230,
            ));

                // About
                $lsvr_customizer->add_info( 'language_info', array(
                    'section' => 'language_settings',
                    'label' => esc_html( 'Info', 'lore' ),
                    'description' => esc_html__( 'The following settings are useful if you want to run your site in more than one language. If you just want to translate the theme to a single language, please check out the documentation on how to do that.', 'lore' ),
                    'priority' => 1000,
                ));

                // Language switcher
                $lsvr_customizer->add_field( 'language_switcher', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language Switcher', 'lore' ),
                    'description' => esc_html__( 'Display links to other language versions. WPML plugin is required for "WPML Generated" option to work.', 'lore' ),
                    'type' => 'radio',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lore' ),
                        'wpml' => esc_html__( 'WPML Generated', 'lore' ),
                        'custom' => esc_html__( 'Custom Links', 'lore' ),
                    ),
                    'default' => 'disable',
                    'priority' => 1010,
                ));

                // Custom lang 1 label
                $lsvr_customizer->add_field( 'language_custom1_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 1 Label', 'lore' ),
                    'description' => esc_html__( 'For example "EN", "DE" or "ES".', 'lore' ),
                    'type' => 'text',
                    'priority' => 1020,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 1 code
                $lsvr_customizer->add_field( 'language_custom1_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 1 Code', 'lore' ),
                    'description' => esc_html__( 'It will be used to determine the active language. For example "en_US", "de_DE" or "es_ES".', 'lore' ),
                    'type' => 'text',
                    'priority' => 1030,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 1 URL
                $lsvr_customizer->add_field( 'language_custom1_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 1 URL', 'lore' ),
                    'description' => esc_html__( 'For example "http://mysite.com/en".', 'lore' ),
                    'type' => 'text',
                    'priority' => 1040,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 2 label
                $lsvr_customizer->add_field( 'language_custom2_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 2 Label', 'lore' ),
                    'type' => 'text',
                    'priority' => 1050,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 2 code
                $lsvr_customizer->add_field( 'language_custom2_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 2 Code', 'lore' ),
                    'type' => 'text',
                    'priority' => 1060,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 2 URL
                $lsvr_customizer->add_field( 'language_custom2_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 2 URL', 'lore' ),
                    'type' => 'text',
                    'priority' => 1070,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 3 label
                $lsvr_customizer->add_field( 'language_custom3_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 3 Label', 'lore' ),
                    'type' => 'text',
                    'priority' => 1080,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 3 code
                $lsvr_customizer->add_field( 'language_custom3_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 3 Code', 'lore' ),
                    'type' => 'text',
                    'priority' => 1090,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 3 URL
                $lsvr_customizer->add_field( 'language_custom3_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 3 URL', 'lore' ),
                    'type' => 'text',
                    'priority' => 1100,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 4 label
                $lsvr_customizer->add_field( 'language_custom4_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 4 Label', 'lore' ),
                    'type' => 'text',
                    'priority' => 1100,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 4 code
                $lsvr_customizer->add_field( 'language_custom4_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 4 Code', 'lore' ),
                    'type' => 'text',
                    'priority' => 1120,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 4 URL
                $lsvr_customizer->add_field( 'language_custom4_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 4 URL', 'lore' ),
                    'type' => 'text',
                    'priority' => 1130,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));


            // Misc settings
            $lsvr_customizer->add_section( 'misc_settings', array(
                'title' => esc_html__( 'Misc', 'lore' ),
                'priority' => 240,
            ));

                // Search results posts per page
                $lsvr_customizer->add_field( 'search_results_posts_per_page', array(
                    'section' => 'misc_settings',
                    'label' => esc_html__( 'Search Results Per Page', 'lore' ),
                    'description' => esc_html__( 'Number of search results per page. Set to 0 to display all.', 'lore' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ),
                    'default' => 10,
                    'priority' => 1030,
                ));

                 // Search results excerpt
                $lsvr_customizer->add_field( 'search_results_excerpt_enable', array(
                    'section' => 'misc_settings',
                    'label' => __( 'Search Results Excerpt', 'lore' ),
                    'description' => esc_html__( 'Display post excerpt on search results page.', 'lore' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1040,
                ));

        }

	}
}

?>