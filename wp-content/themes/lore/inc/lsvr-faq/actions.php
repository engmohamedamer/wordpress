<?php

/**
 * GENERAL
 */

	// Document title
	add_filter( 'document_title_parts', 'lsvr_lore_faq_document_title' );
	if ( ! function_exists( 'lsvr_lore_faq_document_title' ) ) {
		function lsvr_lore_faq_document_title( $title ) {

			if ( is_post_type_archive( 'lsvr_faq' ) ) {
				$title['title'] = sanitize_text_field( lsvr_lore_get_faq_archive_title() );
			}

			return $title;

		}
	}

/**
 * HEADER
 */

	// FAQ header background
	add_filter( 'lsvr_lore_header_background_image_url', 'lsvr_lore_faq_header_background_image_url' );
	if ( ! function_exists( 'lsvr_lore_faq_header_background_image_url' ) ) {
		function lsvr_lore_faq_header_background_image_url( $image_url ) {

			if ( lsvr_lore_is_faq() && ! empty( get_theme_mod( 'lsvr_faq_header_background_image', '' ) ) ) {
				$image_url = get_theme_mod( 'lsvr_faq_header_background_image', '' );
			}

			return $image_url;

		}
	}

	// Add search filters
	add_filter( 'lsvr_lore_header_search_filters', 'lsvr_lore_faq_header_search_filters', 5 );
	if ( ! function_exists( 'lsvr_lore_faq_header_search_filters' ) ) {
		function lsvr_lore_faq_header_search_filters( $filters ) {

			$filters = array_merge( $filters, array(
				array(
					'post_type' => 'lsvr_faq',
					'label' => lsvr_lore_get_faq_archive_title(),
				),
			));

			return $filters;

		}
	}


/**
 * CORE
 */

	// Archive title
	add_filter( 'lsvr_lore_faq_archive_title', 'lsvr_lore_faq_archive_title' );
	if ( ! function_exists( 'lsvr_lore_faq_archive_title' ) ) {
		function lsvr_lore_faq_archive_title( $title ) {

			// Category archive
			if ( is_tax( 'lsvr_faq_cat' ) ) {
				$title = single_term_title( '', false );
			}

			// Tag archive
			elseif ( is_tax( 'lsvr_faq_tag' ) ) {
				$title = sprintf( esc_html__( 'Tag: %s', 'lore' ), single_term_title( '', false ) );
			}

			return $title;

		}
	}

	// Set narrow layout
	add_filter( 'lsvr_lore_narrow_layout_enable', 'lsvr_lore_faq_narrow_layout_enable' );
	if ( ! function_exists( 'lsvr_lore_faq_narrow_layout_enable' ) ) {
		function lsvr_lore_faq_narrow_layout_enable( $enable ) {

			if ( ( is_singular( 'lsvr_faq' ) && 'narrow' === get_theme_mod( 'lsvr_faq_single_layout', 'default' ) ) ||
				( lsvr_lore_is_faq() && ! is_singular( 'lsvr_faq' ) && 'narrow' === get_theme_mod( 'lsvr_faq_archive_layout', 'default' ) ) ) {
				return true;
			}

			return $enable;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_lore_add_to_breadcrumbs', 'lsvr_lore_faq_breadcrumbs' );
	if ( ! function_exists( 'lsvr_lore_faq_breadcrumbs' ) ) {
		function lsvr_lore_faq_breadcrumbs( $breadcrumbs ) {

			if ( lsvr_lore_is_faq() && ! is_post_type_archive( 'lsvr_faq' ) ) {
				return array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_faq' ),
						'label' => lsvr_lore_get_faq_archive_title(),
					),
				);
			}

			return $breadcrumbs;

		}
	}

	// Archive pre_get_posts actions
	add_action( 'pre_get_posts', 'lsvr_lore_faq_archive_pre_get_posts' );
	if ( ! function_exists( 'lsvr_lore_faq_archive_pre_get_posts' ) ) {
		function lsvr_lore_faq_archive_pre_get_posts( $query ) {

			if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'lsvr_faq' ) ||
				$query->is_tax( 'lsvr_faq_cat' ) || $query->is_tax( 'lsvr_faq_tag' ) ) ) {

				// Posts per page
				if ( 0 === (int) get_theme_mod( 'lsvr_faq_archive_posts_per_page', 10 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'lsvr_faq_archive_posts_per_page', 10 ) ) );
				}

				// Order
				if ( 'date_desc' == get_theme_mod( 'lsvr_faq_archive_order', 'default' ) ) {
					$query->set( 'order', 'DESC' );
					$query->set( 'orderby', 'date' );
				}
				elseif ( 'date_asc' == get_theme_mod( 'lsvr_faq_archive_order', 'default' )  ) {
					$query->set( 'order', 'ASC' );
					$query->set( 'orderby', 'date' );
				}
				elseif ( 'title_asc' == get_theme_mod( 'lsvr_faq_archive_order', 'default' )  ) {
					$query->set( 'order', 'ASC' );
					$query->set( 'orderby', 'title' );
				}
				elseif ( 'title_desc' == get_theme_mod( 'lsvr_faq_archive_order', 'default' )  ) {
					$query->set( 'order', 'DESC' );
					$query->set( 'orderby', 'title' );
				}
				elseif ( 'random' == get_theme_mod( 'lsvr_faq_archive_order', 'default' )  ) {
					$query->set( 'orderby', 'rand' );
				}
				elseif ( class_exists( 'Hicpo' ) ) { // Intuitive CPO fix
					$query->set( 'orderby', 'menu_order' );
					$query->set( 'order', 'ASC' );
				}

			}

		}
	}

	// Make posts on archive expandable
	add_filter( 'lsvr_lore_faq_post_archive_class', 'lsvr_lore_faq_archive_expandable_enable' );
	if ( ! function_exists( 'lsvr_lore_faq_archive_expandable_enable' ) ) {
		function lsvr_lore_faq_archive_expandable_enable( $class ) {

			if ( lsvr_lore_is_faq() && true === get_theme_mod( 'lsvr_faq_archive_expandable_enable', true ) ) {
				return 'lsvr_faq-post-archive--is-expandable';
			}

			return $class;

		}
	}

	// Enable post single navigation
	add_filter( 'lsvr_lore_post_single_navigation_enable', 'lsvr_lore_faq_single_post_navigation_enable' );
	if ( ! function_exists( 'lsvr_lore_faq_single_post_navigation_enable' ) ) {
		function lsvr_lore_faq_single_post_navigation_enable( $enabled ) {

			if ( lsvr_lore_is_faq() && true === get_theme_mod( 'lsvr_faq_single_navigation_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_lore_sidebar_position', 'lsvr_lore_faq_sidebar_position' );
	if ( ! function_exists( 'lsvr_lore_faq_sidebar_position' ) ) {
		function lsvr_lore_faq_sidebar_position( $sidebar_position ) {

			// Is single
			if ( is_singular( 'lsvr_faq' ) ) {
				return get_theme_mod( 'lsvr_faq_single_sidebar_position', 'disable' );
			}

			// Is archive
			elseif ( lsvr_lore_is_faq() ) {
				return get_theme_mod( 'lsvr_faq_archive_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_lore_sidebar_id', 'lsvr_lore_faq_sidebar_id' );
	if ( ! function_exists( 'lsvr_lore_faq_sidebar_id' ) ) {
		function lsvr_lore_faq_sidebar_id( $sidebar_id ) {

			// Is single
			if ( is_singular( 'lsvr_faq' ) ) {
				return get_theme_mod( 'lsvr_faq_single_sidebar_id', 'lsvr-lore-default-sidebar' );
			}

			// Is archive
			elseif ( lsvr_lore_is_faq() ) {
				return get_theme_mod( 'lsvr_faq_archive_sidebar_id', 'lsvr-lore-default-sidebar' );
			}

			return $sidebar_id;

		}
	}

?>