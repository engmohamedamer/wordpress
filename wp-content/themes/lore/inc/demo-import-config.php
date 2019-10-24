<?php

// One Click Demo Import plugin is required for this functionality to work
// https://wordpress.org/plugins/one-click-demo-import/
add_filter( 'pt-ocdi/import_files', 'lsvr_lore_demo_import' );
if ( ! function_exists( 'lsvr_lore_demo_import' ) ) {
	function lsvr_lore_demo_import() {

	    return array(
	        array(
	            'import_file_name' => esc_html__( 'Lore Content', 'lore' ),
	            'local_import_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/content.xml',
	            'import_notice' => esc_html__( 'Please note that demo images are not included.', 'lore' ),
	        ),
	        array(
	            'import_file_name' => esc_html__( 'Lore Customizer', 'lore' ),
	            'local_import_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/content-blank.xml',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/customizer.dat',
	            'import_notice' => esc_html__( 'Please note that demo images are not included.', 'lore' ),
	        ),
	        array(
	            'import_file_name' => esc_html__( 'Lore Widgets', 'lore' ),
	            'local_import_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/content-blank.xml',
	            'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/widgets.wie',
	            'import_notice' => esc_html__( 'Please note that demo images are not included.', 'lore' ),
	        ),
	    );

	}
}

add_action( 'pt-ocdi/after_import', 'lsvr_lore_after_import_setup' );
if ( ! function_exists( 'lsvr_lore_after_import_setup' ) ) {
	function lsvr_lore_after_import_setup() {

	    // Set menus
	    $header_menu = get_term_by( 'name', 'Header Menu', 'nav_menu' );
	    $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
	    if ( ! empty( $header_menu->term_id ) && ! empty( $footer_menu->term_id ) ) {
		    set_theme_mod( 'nav_menu_locations', array(
		            'lsvr-lore-header-menu' => $header_menu->term_id,
		            'lsvr-lore-footer-menu' => $footer_menu->term_id,
		        )
		    );
		}

	    // Assign front page and posts page (blog page).
	    update_option( 'show_on_front', 'page' );
	    $front_page_id = get_page_by_title( 'Classic Home' );
	    if ( ! empty( $front_page_id->ID ) ) {
	    	update_option( 'page_on_front', $front_page_id->ID );
		}
	    $blog_page_id  = get_page_by_title( 'Blog' );
		if ( ! empty( $blog_page_id->ID ) ) {
	    	update_option( 'page_for_posts', $blog_page_id->ID );
		}

	}
}

?>