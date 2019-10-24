<?php

// Archive class
if ( ! function_exists( 'lsvr_lore_the_faq_post_archive_class' ) ) {
	function lsvr_lore_the_faq_post_archive_class( $class = '' ) {

		// Defaults
		$class_arr = array( 'lsvr_faq-post-page post-archive lsvr_faq-post-archive' );

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_lore_faq_post_archive_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( trim( implode( ' ', $class_arr ) ) ) . '"';
		}

	}
}

// Archive list class
if ( ! function_exists( 'lsvr_lore_the_faq_post_archive_list_class' ) ) {
	function lsvr_lore_the_faq_post_archive_list_class( $class = '' ) {

		// Defaults
		$class_arr = array( 'post-archive__list' );

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_lore_faq_post_archive_list_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( trim( implode( ' ', $class_arr ) ) ) . '"';
		}

	}
}

?>