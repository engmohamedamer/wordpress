<?php

/**
 * GENERAL
 */

	// Document title
	add_filter( 'document_title_parts', 'lsvr_lore_bbpress_document_title' );
	if ( ! function_exists( 'lsvr_lore_bbpress_document_title' ) ) {
		function lsvr_lore_bbpress_document_title( $title ) {

			if ( is_post_type_archive( 'lsvr_faq' ) ) {
				$title['title'] = sanitize_text_field( lsvr_lore_get_bbpress_archive_title() );
			}

			return $title;

		}
	}

/**
 * HEADER
 */

	// Add search filters
	add_filter( 'lsvr_lore_header_search_filters', 'lsvr_lore_bbpress_header_search_filters' );
	if ( ! function_exists( 'lsvr_lore_bbpress_header_search_filters' ) ) {
		function lsvr_lore_bbpress_header_search_filters( $filters ) {

			$filters = array_merge( $filters, array(
				array(
					'post_type' => 'forum, topic',
					'label' => lsvr_lore_get_bbpress_archive_title(),
				),
			));

			return $filters;

		}
	}


/**
 * CORE
 */

	// Breadcrumbs
	add_filter( 'lsvr_lore_add_to_breadcrumbs', 'lsvr_lore_bbpress_breadcrumbs', 10, 2 );
	if ( ! function_exists( 'lsvr_lore_bbpress_breadcrumbs' ) ) {
		function lsvr_lore_bbpress_breadcrumbs( $breadcrumbs ) {

			if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {

				// Root
				if ( ! is_post_type_archive( 'forum' ) ) {
					$breadcrumbs = array(
						array(
							'url' => get_post_type_archive_link( bbp_get_forum_post_type() ),
							'label' => lsvr_lore_get_bbpress_archive_title(),
						),
					);
				}

				// Get ancestors
				if ( is_singular() || bbp_is_forum_edit() || bbp_is_topic_edit() || bbp_is_reply_edit() ) {
					$ancestors = array_reverse( (array) get_post_ancestors( get_the_ID() ) );
				}

				// Parse ancestors
				if ( ! empty( $ancestors ) ) {

					// Loop through parents
					foreach ( (array) $ancestors as $parent_id ) {

						// Parents
						$parent = get_post( $parent_id );

						// Skip parent if empty or error
						if ( empty( $parent ) || is_wp_error( $parent ) )
							continue;

						// Switch through post_type to ensure correct filters are applied
						switch ( $parent->post_type ) {

							// Forum
							case bbp_get_forum_post_type() :
								$breadcrumbs[] = array(
									'url' => bbp_get_forum_permalink( $parent->ID ),
									'label' => bbp_get_forum_title( $parent->ID ),
								);
								break;

							// Topic
							case bbp_get_topic_post_type() :
								$breadcrumbs[] = array(
									'url' => bbp_get_topic_permalink( $parent->ID ),
									'label' => bbp_get_topic_title( $parent->ID ),
								);
								break;

							// Reply
							case bbp_get_reply_post_type() :
								$breadcrumbs[] = array(
									'url' => bbp_get_reply_permalink( $parent->ID ),
									'label' => bbp_get_reply_title( $parent->ID ),
								);
								break;

							// WordPress Post/Page/Other
							default :
								$breadcrumbs[] = array(
									'url' => get_permalink( $parent->ID ),
									'label' => get_the_title( $parent->ID ),
								);
								break;
						}

					}

				}

			}

			return $breadcrumbs;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_lore_sidebar_position', 'lsvr_lore_bbpress_sidebar_position' );
	if ( ! function_exists( 'lsvr_lore_bbpress_sidebar_position' ) ) {
		function lsvr_lore_bbpress_sidebar_position( $sidebar_position ) {

			if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
				return get_theme_mod( 'bbpress_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_lore_sidebar_id', 'lsvr_lore_bbpress_sidebar_id' );
	if ( ! function_exists( 'lsvr_lore_bbpress_sidebar_id' ) ) {
		function lsvr_lore_bbpress_sidebar_id( $sidebar_id ) {

			if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
				return get_theme_mod( 'bbpress_sidebar_id', 'lsvr-lore-default-sidebar' );
			}

			return $sidebar_id;

		}
	}

?>