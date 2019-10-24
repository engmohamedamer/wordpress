<?php

// Include additional files
require_once( get_template_directory() . '/inc/lsvr-faq/actions.php' );
require_once( get_template_directory() . '/inc/lsvr-faq/frontend-functions.php' );
require_once( get_template_directory() . '/inc/lsvr-faq/customizer-config.php' );

// Is FAQ page
if ( ! function_exists( 'lsvr_lore_is_faq' ) ) {
	function lsvr_lore_is_faq() {

		if ( is_post_type_archive( 'lsvr_faq' ) || is_tax( 'lsvr_faq_cat' ) || is_tax( 'lsvr_faq_tag' ) ||
			is_singular( 'lsvr_faq' ) ) {
			return true;
		} else {
			return false;
		}

	}
}

// Get FAQ archive title
if ( ! function_exists( 'lsvr_lore_get_faq_archive_title' ) ) {
	function lsvr_lore_get_faq_archive_title() {

		return get_theme_mod( 'lsvr_faq_archive_title', esc_html__( 'FAQ', 'lore' ) );

	}
}


?>