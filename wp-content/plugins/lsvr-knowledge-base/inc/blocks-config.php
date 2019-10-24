<?php

// Register blocks
add_action( 'init', 'lsvr_knowledge_base_register_blocks', 20 );
if ( ! function_exists( 'lsvr_knowledge_base_register_blocks' ) ) {
	function lsvr_knowledge_base_register_blocks() {

		if ( function_exists( 'register_block_type' ) && function_exists( 'lsvr_framework_register_shortcode_block' ) ) {

    		// KBA List Widget
			if ( class_exists( 'Lsvr_Shortcode_KBA_List_Widget' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-knowledge-base/kba-list-widget', array(
					'attributes' => Lsvr_Shortcode_KBA_List_Widget::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_KBA_List_Widget', 'shortcode' ),
				));
			}

    		// Featured KBA Widget
			if ( class_exists( 'Lsvr_Shortcode_KBA_Featured_Widget' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-knowledge-base/kba-featured-widget', array(
					'attributes' => Lsvr_Shortcode_KBA_Featured_Widget::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_KBA_Featured_Widget', 'shortcode' ),
				));
			}

		}

	}
}

// Register blocks JSON
add_filter( 'lsvr_framework_register_shortcode_blocks_json', 'lsvr_knowledge_base_register_blocks_json' );
if ( ! function_exists( 'lsvr_knowledge_base_register_blocks_json' ) ) {
	function lsvr_knowledge_base_register_blocks_json( $data = array() ) {

		$data = empty( $data ) ? array() : $data;

		if ( function_exists( 'register_block_type' ) && function_exists( 'lsvr_framework_register_shortcode_block_json' ) ) {

			// KBA List Widget
			if ( class_exists( 'Lsvr_Shortcode_KBA_List_Widget' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-knowledge-base/kba-list-widget',
					'tag' => 'lsvr_kba_list_widget',
					'title' => esc_html__( 'LSVR KB Articles Widget', 'lsvr-knowledge-base' ),
		        	'description' => esc_html__( 'List of KB posts', 'lsvr-knowledge-base' ),
		        	'category' => 'lsvr-widgets',
		        	'icon' => 'book',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-knowledge-base' ),
		        	'attributes' => Lsvr_Shortcode_KBA_List_Widget::lsvr_shortcode_atts(),
				)));
			}

			// Featured KBA Widget
			if ( class_exists( 'Lsvr_Shortcode_KBA_Featured_Widget' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-knowledge-base/kba-featured-widget',
					'tag' => 'lsvr_kba_featured_widget',
					'title' => esc_html__( 'LSVR Featured KB Article Widget', 'lsvr-knowledge-base' ),
		        	'description' => esc_html__( 'Single KB article', 'lsvr-knowledge-base' ),
		        	'category' => 'lsvr-widgets',
		        	'icon' => 'book',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-knowledge-base' ),
		        	'attributes' => Lsvr_Shortcode_KBA_Featured_Widget::lsvr_shortcode_atts(),
				)));
			}

		}

		return $data;

	}
}

?>