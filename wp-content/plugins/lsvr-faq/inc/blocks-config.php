<?php

// Register blocks
add_action( 'init', 'lsvr_faq_register_blocks', 20 );
if ( ! function_exists( 'lsvr_faq_register_blocks' ) ) {
	function lsvr_faq_register_blocks() {

		if ( function_exists( 'register_block_type' ) && function_exists( 'lsvr_framework_register_shortcode_block' ) ) {

    		// FAQ List Widget
			if ( class_exists( 'Lsvr_Shortcode_FAQ_List_Widget' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-faq/faq-list-widget', array(
					'attributes' => Lsvr_Shortcode_FAQ_List_Widget::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_FAQ_List_Widget', 'shortcode' ),
				));
			}

    		// Featured FAQ Widget
			if ( class_exists( 'Lsvr_Shortcode_FAQ_Featured_Widget' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-faq/faq-featured-widget', array(
					'attributes' => Lsvr_Shortcode_FAQ_Featured_Widget::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_FAQ_Featured_Widget', 'shortcode' ),
				));
			}

		}

	}
}

// Register blocks JSON
add_filter( 'lsvr_framework_register_shortcode_blocks_json', 'lsvr_faq_register_blocks_json' );
if ( ! function_exists( 'lsvr_faq_register_blocks_json' ) ) {
	function lsvr_faq_register_blocks_json( $data = array() ) {

		$data = empty( $data ) ? array() : $data;

		if ( function_exists( 'register_block_type' ) && function_exists( 'lsvr_framework_register_shortcode_block_json' ) ) {

			// FAQ List Widget
			if ( class_exists( 'Lsvr_Shortcode_FAQ_List_Widget' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-faq/faq-list-widget',
					'tag' => 'lsvr_faq_list_widget',
					'title' => esc_html__( 'LSVR FAQ Widget', 'lsvr-faq' ),
		        	'description' => esc_html__( 'List of FAQ posts', 'lsvr-faq' ),
		        	'category' => 'lsvr-widgets',
		        	'icon' => 'lightbulb',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-faq' ),
		        	'attributes' => Lsvr_Shortcode_FAQ_List_Widget::lsvr_shortcode_atts(),
				)));
			}

			// Featured FAQ Widget
			if ( class_exists( 'Lsvr_Shortcode_FAQ_Featured_Widget' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-faq/faq-featured-widget',
					'tag' => 'lsvr_faq_featured_widget',
					'title' => esc_html__( 'LSVR Featured FAQ Widget', 'lsvr-faq' ),
		        	'description' => esc_html__( 'Single FAQ post', 'lsvr-faq' ),
		        	'category' => 'lsvr-widgets',
		        	'icon' => 'lightbulb',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-faq' ),
		        	'attributes' => Lsvr_Shortcode_FAQ_Featured_Widget::lsvr_shortcode_atts(),
				)));
			}

		}

		return $data;

	}
}

?>