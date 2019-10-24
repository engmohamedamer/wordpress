<?php


// Archive class
if ( ! function_exists( 'lsvr_lore_the_kba_post_archive_class' ) ) {
	function lsvr_lore_the_kba_post_archive_class( $class = '' ) {

		// Defaults
		$class_arr = array( 'lsvr_kba-post-page post-archive lsvr_kba-post-archive' );

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_lore_kba_post_archive_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( trim( implode( ' ', $class_arr ) ) ) . '"';
		}

	}
}

// Archive list class
if ( ! function_exists( 'lsvr_lore_the_kba_post_archive_list_class' ) ) {
	function lsvr_lore_the_kba_post_archive_list_class( $class = '' ) {

		// Defaults
		$class_arr = array( 'post-archive__list' );

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Category view layout
		if ( is_post_type_archive( 'lsvr_kba' ) && 'category-view' === get_theme_mod( 'lsvr_kba_archive_layout', 'default' ) ) {

			$number_of_columns = ! empty( get_theme_mod( 'lsvr_kba_archive_grid_columns', 3 ) ) ? (int) get_theme_mod( 'lsvr_kba_archive_grid_columns', 3 ) : 3;
			$span = 12 / $number_of_columns;
			$md_cols = $span > 2 ? 2 : $span;
			$sm_cols = $span > 2 ? 2 : $span;
			array_push( $class_arr, 'lsvr-grid lsvr-grid--' . $number_of_columns . '-cols lsvr-grid--md-' . $md_cols . '-cols lsvr-grid--sm-' . $sm_cols . '-cols' );

			// Masonry
			if ( true === get_theme_mod( 'lsvr_kba_archive_masonry_enable', true ) ) {
				array_push( $class_arr, 'post-archive__list--masonry' );
			}

		}

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_lore_kba_post_archive_list_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( trim( implode( ' ', $class_arr ) ) ) . '"';
		}

	}
}

// Archive grid column class
if ( ! function_exists( 'lsvr_lore_the_kba_post_archive_grid_column_class' ) ) {
	function lsvr_lore_the_kba_post_archive_grid_column_class( $class = '' ) {

		// Defaults
		$class_arr = array( 'post-archive__item' );

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Columns
		$number_of_columns = ! empty( get_theme_mod( 'lsvr_kba_archive_grid_columns', 3 ) ) ? (int) get_theme_mod( 'lsvr_kba_archive_grid_columns', 3 ) : 3;
		$span = 12 / $number_of_columns;
		$span_md_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--md-span-6' : '';
		$span_sm_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--sm-span-6' : '';
		array_push( $class_arr, 'lsvr-grid__col lsvr-grid__col--span-' . $span . $span_md_class . $span_sm_class );

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_lore_kba_post_archive_grid_column_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"';
		}

	}
}

?>