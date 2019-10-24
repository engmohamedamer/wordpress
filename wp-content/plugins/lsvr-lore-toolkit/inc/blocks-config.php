<?php

// Register custom category
add_filter( 'block_categories', 'lsvr_lore_toolkit_register_blocks_category' );
if ( ! function_exists( 'lsvr_lore_toolkit_register_blocks_category' ) ) {
	function lsvr_lore_toolkit_register_blocks_category( $categories ) {

	    return array_merge( $categories, array(
	        array(
	            'slug' => 'lsvr-lore-toolkit',
	            'title' => esc_html__( 'Lore', 'lsvr-lore-toolkit' ),
	        ),
	    ));

	}
}

// Register blocks
add_action( 'init', 'lsvr_lore_toolkit_register_blocks', 20 );
if ( ! function_exists( 'lsvr_lore_toolkit_register_blocks' ) ) {
	function lsvr_lore_toolkit_register_blocks() {

		if ( function_exists( 'register_block_type' ) && function_exists( 'lsvr_framework_register_shortcode_block' ) ) {

    		// CTA Widget
			if ( class_exists( 'Lsvr_Shortcode_Lore_CTA_Widget' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-lore-toolkit/cta-widget', array(
					'attributes' => Lsvr_Shortcode_Lore_CTA_Widget::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Lore_CTA_Widget', 'shortcode' ),
				));
			}

    		// FAQ
			if ( class_exists( 'Lsvr_Shortcode_Lore_FAQ' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-lore-toolkit/faq', array(
					'attributes' => Lsvr_Shortcode_Lore_FAQ::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Lore_FAQ', 'shortcode' ),
				));
			}

    		// KB Category Widget
			if ( class_exists( 'Lsvr_Shortcode_Lore_KBA_Category_Widget' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-lore-toolkit/kba-category-widget', array(
					'attributes' => Lsvr_Shortcode_Lore_KBA_Category_Widget::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Lore_KBA_Category_Widget', 'shortcode' ),
				));
			}

    		// Knowledge Base
			if ( class_exists( 'Lsvr_Shortcode_Lore_Knowledge_Base' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-lore-toolkit/knowledge-base', array(
					'attributes' => Lsvr_Shortcode_Lore_Knowledge_Base::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Lore_Knowledge_Base', 'shortcode' ),
				));
			}

    		// Posts
			if ( class_exists( 'Lsvr_Shortcode_Lore_Posts' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-lore-toolkit/posts', array(
					'attributes' => Lsvr_Shortcode_Lore_Posts::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Lore_Posts', 'shortcode' ),
				));
			}

    		// Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Lore_Sidebar' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-lore-toolkit/sidebar', array(
					'attributes' => Lsvr_Shortcode_Lore_Sidebar::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Lore_Sidebar', 'shortcode' ),
				));
			}

    		// Sitemap
			if ( class_exists( 'Lsvr_Shortcode_Lore_Sitemap' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-lore-toolkit/sitemap', array(
					'attributes' => Lsvr_Shortcode_Lore_Sitemap::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Lore_Sitemap', 'shortcode' ),
				));
			}

    		// Table of contents
			if ( class_exists( 'Lsvr_Shortcode_Lore_TOC' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-lore-toolkit/toc', array(
					'attributes' => Lsvr_Shortcode_Lore_TOC::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Lore_TOC', 'shortcode' ),
				));
			}

		}

	}
}

// Register blocks JSON
add_filter( 'lsvr_framework_register_shortcode_blocks_json', 'lsvr_lore_toolkit_register_blocks_json' );
if ( ! function_exists( 'lsvr_lore_toolkit_register_blocks_json' ) ) {
	function lsvr_lore_toolkit_register_blocks_json( $data = array() ) {

		$data = empty( $data ) ? array() : $data;

		if ( function_exists( 'register_block_type' ) && function_exists( 'lsvr_framework_register_shortcode_block_json' ) ) {

			// CTA Widget
			if ( class_exists( 'Lsvr_Shortcode_Lore_CTA_Widget' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-lore-toolkit/cta-widget',
					'tag' => 'lsvr_lore_cta_widget',
					'title' => esc_html__( 'Lore CTA Widget', 'lsvr-lore-toolkit' ),
		        	'description' => esc_html__( 'Block with title, text and link', 'lsvr-lore-toolkit' ),
		        	'category' => 'lsvr-lore-toolkit',
		        	'icon' => 'align-center',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-lore-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Lore_CTA_Widget::lsvr_shortcode_atts(),
				)));
			}

			// FAQ
			if ( class_exists( 'Lsvr_Shortcode_Lore_FAQ' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-lore-toolkit/faq',
					'tag' => 'lsvr_lore_faq',
					'title' => esc_html__( 'Lore FAQ', 'lsvr-lore-toolkit' ),
		        	'description' => esc_html__( 'List of FAQ posts', 'lsvr-lore-toolkit' ),
		        	'category' => 'lsvr-lore-toolkit',
		        	'icon' => 'lightbulb',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-lore-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Lore_FAQ::lsvr_shortcode_atts(),
				)));
			}

			// KB Category Widget
			if ( class_exists( 'Lsvr_Shortcode_Lore_KBA_Category_Widget' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-lore-toolkit/kba-category-widget',
					'tag' => 'lsvr_lore_kba_category_widget',
					'title' => esc_html__( 'Lore KB Category Widget', 'lsvr-lore-toolkit' ),
		        	'description' => esc_html__( 'KB category with articles', 'lsvr-lore-toolkit' ),
		        	'category' => 'lsvr-lore-toolkit',
		        	'icon' => 'book',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-lore-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Lore_KBA_Category_Widget::lsvr_shortcode_atts(),
				)));
			}

			// Knowledge Base
			if ( class_exists( 'Lsvr_Shortcode_Lore_Knowledge_Base' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-lore-toolkit/knowledge-base',
					'tag' => 'lsvr_lore_knowledge_base',
					'title' => esc_html__( 'Lore Knowledge Base', 'lsvr-lore-toolkit' ),
		        	'description' => esc_html__( 'Grid of categorized KB articles', 'lsvr-lore-toolkit' ),
		        	'category' => 'lsvr-lore-toolkit',
		        	'icon' => 'book',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-lore-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Lore_Knowledge_Base::lsvr_shortcode_atts(),
				)));
			}

			// Posts
			if ( class_exists( 'Lsvr_Shortcode_Lore_Posts' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-lore-toolkit/posts',
					'tag' => 'lsvr_lore_posts',
					'title' => esc_html__( 'Lore Posts', 'lsvr-lore-toolkit' ),
		        	'description' => esc_html__( 'List of posts', 'lsvr-lore-toolkit' ),
		        	'category' => 'lsvr-lore-toolkit',
		        	'icon' => 'admin-post',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-lore-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Lore_Posts::lsvr_shortcode_atts(),
				)));
			}

			// Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Lore_Sidebar' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-lore-toolkit/sidebar',
					'tag' => 'lsvr_lore_sidebar',
					'title' => esc_html__( 'Lore Sidebar', 'lsvr-lore-toolkit' ),
		        	'description' => esc_html__( 'Sidebar with widgets', 'lsvr-lore-toolkit' ),
		        	'category' => 'lsvr-lore-toolkit',
		        	'icon' => 'screenoptions',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-lore-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Lore_Sidebar::lsvr_shortcode_atts(),
				)));
			}

			// Sitemap
			if ( class_exists( 'Lsvr_Shortcode_Lore_Sitemap' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-lore-toolkit/sitemap',
					'tag' => 'lsvr_lore_sitemap',
					'title' => esc_html__( 'Lore Sitemap', 'lsvr-lore-toolkit' ),
		        	'description' => esc_html__( 'Custom menu', 'lsvr-lore-toolkit' ),
		        	'category' => 'lsvr-lore-toolkit',
		        	'icon' => 'networking',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-lore-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Lore_Sitemap::lsvr_shortcode_atts(),
				)));
			}

			// Table of contents
			if ( class_exists( 'Lsvr_Shortcode_Lore_TOC' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-lore-toolkit/toc',
					'tag' => 'lsvr_lore_toc',
					'title' => esc_html__( 'Lore Table of Contents', 'lsvr-lore-toolkit' ),
		        	'description' => esc_html__( 'List of anchored headings', 'lsvr-lore-toolkit' ),
		        	'category' => 'lsvr-lore-toolkit',
		        	'icon' => 'list-view',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-lore-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Lore_TOC::lsvr_shortcode_atts(),
				)));
			}

		}

		return $data;

	}
}

?>