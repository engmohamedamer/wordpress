<?php

/**
 * GENERAL
 */

	// Alert message
	if ( ! function_exists( 'lsvr_lore_the_alert_message' ) ) {
		function lsvr_lore_the_alert_message( $message ) {

			echo '<p class="c-alert-message">' . esc_html( $message ) . '</p>';

		}
	}

 	// Post terms
	if ( ! function_exists( 'lsvr_lore_the_post_terms' ) ) {
		function lsvr_lore_the_post_terms( $post_id, $taxonomy, $template = '%s', $separator = ', ', $limit = 0 ) {

			if ( 'post_tag' === $taxonomy && true === apply_filters( 'lsvr_lore_the_post_terms_the_tags_enable', false ) ) {
				the_tags();
			}

			else {

				$terms = wp_get_object_terms( $post_id, $taxonomy );
				$terms_parsed = array();
				if ( ! empty( $terms ) ) {
					foreach ( $terms as $term ) {
						array_push( $terms_parsed, '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '" class="post__term-link">' . esc_html( $term->name ) . '</a>' );
					}
					if ( $limit > 0 && count( $terms_parsed ) > $limit ) {
						$terms_parsed = array_slice( $terms_parsed, 0, $limit );
					}
				}

				if ( ! empty( $terms_parsed ) ) { ?>

					<span class="post__terms post__terms--<?php echo esc_attr( $taxonomy ); ?>">
						<?php echo sprintf( $template, implode( $separator, $terms_parsed ) ); ?>
					</span>

				<?php }

			}

		}
	}


/**
 * HEADER
 */

	// Header class
	if ( ! function_exists( 'lsvr_lore_the_header_class' ) ) {
		function lsvr_lore_the_header_class( $class = '' ) {

			$class_arr = ! empty( $class ) ? explode( ' ', $class ) : array();

			// Sticky header
			if ( true === get_theme_mod( 'header_sticky_navbar_enable', false ) ) {
				array_push( $class_arr, 'header--sticky' );
			}

			// Has languages
			if ( ! empty( lsvr_lore_get_languages() ) ) {
				array_push( $class_arr, 'header--has-languages' );
			}

			// Filter
			if ( ! empty( apply_filters( 'lsvr_lore_header_class', '' ) ) ) {
				array_push( $class_arr, apply_filters( 'lsvr_lore_header_class', '' ) );
			}

			// Echo
			if ( ! empty( $class_arr ) ) {
				echo ' class="' . trim( esc_attr( implode( ' ', $class_arr ) ) ) . '"';
			}

		}
	}

	// Header background image
	if ( ! function_exists( 'lsvr_lore_the_header_background_image' ) ) {
		function lsvr_lore_the_header_background_image() {

			$image_url = apply_filters( 'lsvr_lore_header_background_image_url', get_theme_mod( 'header_background_image', '' ) );
			if ( ! empty( $image_url )  ) {
				echo ' style="background-image: url( \'' . esc_url( $image_url ) . '\' );"';
			}

		}
	}

	// Header background overlay
	if ( ! function_exists( 'lsvr_lore_the_header_overlay' ) ) {
		function lsvr_lore_the_header_overlay() {

			$overlay_opacity = (int) get_theme_mod( 'header_background_overlay_opacity', 50 );
			if ( $overlay_opacity > 0 ) {
				$opacity_css = 'opacity: ' . $overlay_opacity / 100 . ';'; // For modern browsers
				$opacity_filter_css = 'filter: alpha(opacity=' . $overlay_opacity . ');'; // For IE
				echo '<div class="header__overlay" style="' . esc_attr( $opacity_css . ' ' . $opacity_filter_css ) . '"></div>';
			}

		}
	}

	// Header search form class
	if ( ! function_exists( 'lsvr_lore_the_header_search_form_class' ) ) {
		function lsvr_lore_the_header_search_form_class( $class = '' ) {

			$class_arr = array( 'header-search-form' );

			// Passed
			if ( ! empty( $class ) ) {
				$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
			}

			// Has ajax search
			if ( true === get_theme_mod( 'header_search_ajax_enable', true ) ) {
				array_push( $class_arr, 'header-search-form--ajax' );
			}

			// Has search filter
			if ( true === get_theme_mod( 'header_search_filter_enable', true ) ) {
				array_push( $class_arr, 'header-search-form--has-search-filter' );
			}

			// Has suggested keywords
			if ( ! empty( get_theme_mod( 'header_search_keywords', '' ) ) ) {
				array_push( $class_arr, 'header-search-form--has-keywords' );
			}

			// Has rating
			if ( true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) ) {
				array_push( $class_arr, 'header-search-form--has-rating' );
				array_push( $class_arr, 'header-search-form--rating-type-' . get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) );
			}

			// Filter
			if ( ! empty( apply_filters( 'lsvr_lore_header_search_form_class', '' ) ) ) {
				array_push( $class_arr, apply_filters( 'lsvr_lore_header_search_form_class', '' ) );
			}

			// Echo
			if ( ! empty( $class_arr ) ) {
				echo ' class="' . trim( esc_attr( implode( ' ', $class_arr ) ) ) . '"';
			}

		}
	}


/**
 * CORE
 */

	// Core class
	if ( ! function_exists( 'lsvr_lore_core_class' ) ) {
		function lsvr_lore_core_class( $class = '' ) {

			$class_arr = ! empty( $class ) ? explode( ' ', $class ) : array();

			// Narrow layout
			if ( true === apply_filters( 'lsvr_lore_narrow_layout_enable', false ) ) {
				array_push( $class_arr, 'core--narrow' );
			}

			// Wide layout
			if ( true === apply_filters( 'lsvr_lore_wide_layout_enable', false ) ) {
				array_push( $class_arr, 'core--wide' );
			}

			// Filter
			if ( ! empty( apply_filters( 'lsvr_lore_core_class', '' ) ) ) {
				array_push( $class_arr, apply_filters( 'lsvr_lore_core_class', '' ) );
			}

			// Echo
			if ( ! empty( $class_arr ) ) {
				echo ' class="' . esc_attr( trim( implode( ' ', $class_arr ) ) ) . '"';
			}

		}
	}

	// Blog Archive class
	if ( ! function_exists( 'lsvr_lore_the_blog_post_archive_class' ) ) {
		function lsvr_lore_the_blog_post_archive_class( $class = '' ) {

			// Defaults
			$class_arr = array( 'blog-post-page post-archive blog-post-archive' );

			// Passed
			if ( ! empty( $class ) ) {
				$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
			}

			// Filter
			array_push( $class_arr, apply_filters( 'lsvr_lore_blog_post_archive_class', '' ) );

			// Echo
			if ( ! empty( $class_arr ) ) {
				echo ' class="' . esc_attr( trim( implode( ' ', $class_arr ) ) ) . '"';
			}

		}
	}

	// Archive list class
	if ( ! function_exists( 'lsvr_lore_the_blog_post_archive_list_class' ) ) {
		function lsvr_lore_the_blog_post_archive_list_class( $class = '' ) {

			// Defaults
			$class_arr = array( 'post-archive__list' );

			// Passed
			if ( ! empty( $class ) ) {
				$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
			}

			// Filter
			array_push( $class_arr, apply_filters( 'lsvr_lore_blog_post_archive_list_class', '' ) );

			// Echo
			if ( ! empty( $class_arr ) ) {
				echo ' class="' . esc_attr( trim( implode( ' ', $class_arr ) ) ) . '"';
			}

		}
	}


/**
 * FOOTER
 */

	// Footer class
	if ( ! function_exists( 'lsvr_lore_the_footer_class' ) ) {
		function lsvr_lore_the_footer_class( $class = '' ) {

			$class_arr = ! empty( $class ) ? explode( ' ', $class ) : array();

			// Filter
			if ( ! empty( apply_filters( 'lsvr_lore_footer_class', '' ) ) ) {
				array_push( $class_arr, apply_filters( 'lsvr_lore_footer_class', '' ) );
			}

			// Echo
			if ( ! empty( $class_arr ) ) {
				echo ' class="' . trim( esc_attr( implode( ' ', $class_arr ) ) ) . '"';
			}

		}
	}

	// Footer widgets grid class
	if ( ! function_exists( 'lsvr_lore_the_footer_widgets_list_class' ) ) {
		function lsvr_lore_the_footer_widgets_list_class() {

			$classes = array( 'lsvr-grid' );
			$columns = get_theme_mod( 'footer_widgets_columns', 3 );

			// Cols
			array_push( $classes, 'lsvr-grid--' . $columns . '-cols' );

			// Cols lg
			if ( $columns >= 2 ) {
				array_push( $classes, 'lsvr-grid--lg-2-cols' );
			}

			// Cols md
			if ( $columns >= 2 ) {
				array_push( $classes, 'lsvr-grid--md-2-cols' );
			}

			if ( ! empty( $classes ) ) {
				echo ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';
			}

		}
	}

?>