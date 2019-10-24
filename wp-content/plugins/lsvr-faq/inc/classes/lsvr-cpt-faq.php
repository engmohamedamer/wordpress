<?php
/**
 * FAQ post type
 */
if ( ! class_exists( 'Lsvr_CPT_FAQ' ) && class_exists( 'Lsvr_CPT' ) ) {
    class Lsvr_CPT_FAQ extends Lsvr_CPT {

		public function __construct() {

			parent::__construct( array(
				'id' => 'lsvr_faq',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'FAQ', 'lsvr-faq' ),
						'singular_name' => esc_html__( 'FAQ', 'lsvr-faq' ),
						'add_new' => esc_html__( 'Add New FAQ', 'lsvr-faq' ),
						'add_new_item' => esc_html__( 'Add New FAQ', 'lsvr-faq' ),
						'edit_item' => esc_html__( 'Edit FAQ', 'lsvr-faq' ),
						'new_item' => esc_html__( 'Add New FAQ', 'lsvr-faq' ),
						'view_item' => esc_html__( 'View FAQ', 'lsvr-faq' ),
						'search_items' => esc_html__( 'Search FAQ', 'lsvr-faq' ),
						'not_found' => esc_html__( 'No FAQ found', 'lsvr-faq' ),
						'not_found_in_trash' => esc_html__( 'No FAQ found in trash', 'lsvr-faq' ),
					),
					'exclude_from_search' => false,
					'public' => true,
					'supports' => array( 'title', 'editor', 'custom-fields', 'revisions', 'excerpt', 'author' ),
					'capability_type' => 'post',
					'rewrite' => array( 'slug' => 'faq' ),
					'menu_position' => 5,
					'has_archive' => true,
					'show_in_nav_menus' => true,
					'show_in_rest' => true,
					'menu_icon' => 'dashicons-lightbulb',
				),
			));

			// Add Category taxonomy
			$this->add_taxonomy(array(
				'id' => 'lsvr_faq_cat',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'FAQ Categories', 'lsvr-faq' ),
						'singular_name' => esc_html__( 'FAQ Category', 'lsvr-faq' ),
						'search_items' => esc_html__( 'Search FAQ Categories', 'lsvr-faq' ),
						'popular_items' => esc_html__( 'Popular FAQ Categories', 'lsvr-faq' ),
						'all_items' => esc_html__( 'All FAQ Categories', 'lsvr-faq' ),
						'parent_item' => esc_html__( 'Parent FAQ Category', 'lsvr-faq' ),
						'parent_item_colon' => esc_html__( 'Parent FAQ Category:', 'lsvr-faq' ),
						'edit_item' => esc_html__( 'Edit FAQ Category', 'lsvr-faq' ),
						'update_item' => esc_html__( 'Update FAQ Category', 'lsvr-faq' ),
						'add_new_item' => esc_html__( 'Add New FAQ Category', 'lsvr-faq' ),
						'new_item_name' => esc_html__( 'New FAQ Category Name', 'lsvr-faq' ),
						'separate_items_with_commas' => esc_html__( 'Separate FAQ categories by comma', 'lsvr-faq' ),
						'add_or_remove_items' => esc_html__( 'Add or remove FAQ categories', 'lsvr-faq' ),
						'choose_from_most_used' => esc_html__( 'Choose from the most used FAQ categories', 'lsvr-faq' ),
						'menu_name' => esc_html__( 'FAQ Categories', 'lsvr-faq' )
					),
					'public' => true,
					'show_in_nav_menus' => true,
					'show_ui' => true,
					'show_admin_column' => true,
					'show_tagcloud' => true,
					'hierarchical' => true,
					'rewrite' => array( 'slug' => 'faq-category' ),
					'query_var' => true,
					'show_in_rest' => true,
				),
				'args' => array(
					'admin_tax_filter' => true,
				),
			));

			// Add Tag taxonomy
			$this->add_taxonomy(array(
				'id' => 'lsvr_faq_tag',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'FAQ Tags', 'lsvr-faq' ),
						'singular_name' => esc_html__( 'FAQ Tag', 'lsvr-faq' ),
						'search_items' => esc_html__( 'Search FAQ', 'lsvr-faq' ),
						'popular_items' => esc_html__( 'Popular FAQ Tags', 'lsvr-faq' ),
						'all_items' => esc_html__( 'All FAQ Tags', 'lsvr-faq' ),
						'parent_item' => esc_html__( 'Parent FAQ Tag', 'lsvr-faq' ),
						'parent_item_colon' => esc_html__( 'Parent FAQ Tag:', 'lsvr-faq' ),
						'edit_item' => esc_html__( 'Edit FAQ Tag', 'lsvr-faq' ),
						'update_item' => esc_html__( 'Update FAQ Tag', 'lsvr-faq' ),
						'add_new_item' => esc_html__( 'Add New FAQ Tag', 'lsvr-faq' ),
						'new_item_name' => esc_html__( 'New FAQ Tag Name', 'lsvr-faq' ),
						'separate_items_with_commas' => esc_html__( 'Separate FAQ tags by comma', 'lsvr-faq' ),
						'add_or_remove_items' => esc_html__( 'Add or remove FAQ tags', 'lsvr-faq' ),
						'choose_from_most_used' => esc_html__( 'Choose from the most used FAQ tags', 'lsvr-faq' ),
						'menu_name' => esc_html__( 'FAQ Tags', 'lsvr-faq' )
					),
					'public' => true,
					'show_in_nav_menus' => true,
					'show_ui' => true,
					'show_admin_column' => true,
					'show_tagcloud' => true,
					'hierarchical' => false,
					'rewrite' => array( 'slug' => 'faq-tag' ),
					'query_var' => true,
					'show_in_rest' => true,
				),
				'args' => array(
					'admin_tax_filter' => true,
				),
			));

		}

	}
}

?>