<?php

/**
 * GENERAL
 */

	// Document title
	add_filter( 'document_title_parts', 'lsvr_lore_kba_document_title' );
	if ( ! function_exists( 'lsvr_lore_kba_document_title' ) ) {
		function lsvr_lore_kba_document_title( $title ) {

			if ( is_post_type_archive( 'lsvr_kba' ) ) {
				$title['title'] = sanitize_text_field( lsvr_lore_get_kba_archive_title() );
			}
			return $title;

		}
	}

	// Load KB JS files
	add_action( 'lsvr_lore_load_assets', 'lsvr_lore_load_ajax_kba_rating_js' );
	if ( ! function_exists( 'lsvr_lore_load_ajax_kba_rating_js' ) ) {
		function lsvr_lore_load_ajax_kba_rating_js() {

			// Load ajax KB rating JS files
			if ( 'disable' !== get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) && is_singular( 'lsvr_kba' ) ) {

				$version = wp_get_theme( 'lore' );
				$version = $version->Version;
				$suffix = defined( 'WP_DEBUG' ) && true == WP_DEBUG ? '' : '.min';

				wp_enqueue_script( 'lsvr-lore-ajax-kba-rating', get_template_directory_uri() . '/assets/js/lore-ajax-kba-rating' . $suffix . '.js', array( 'jquery' ), $version, true );
				wp_localize_script( 'lsvr-lore-ajax-kba-rating', 'lsvr_lore_ajax_kba_rating_var', array(
		    		'url' => admin_url( 'admin-ajax.php' ),
		    		'nonce' => wp_create_nonce( 'lsvr-lore-ajax-kba-rating-nonce' )
				));
			}

			// Category view Masonry grid
			if ( is_post_type_archive( 'lsvr_kba' ) && 'category-view' === get_theme_mod( 'lsvr_kba_archive_layout', 'default' )
				&& true === get_theme_mod( 'lsvr_kba_archive_masonry_enable', true ) ) {

				wp_enqueue_script( 'masonry' );

			}

		}
	}

	// Add post formats support
	add_action( 'load-post.php', 'lsvr_lore_kba_add_post_format_support' );
	add_action( 'load-post-new.php', 'lsvr_lore_kba_add_post_format_support' );
	if ( ! function_exists( 'lsvr_lore_kba_add_post_format_support' ) ) {
		function lsvr_lore_kba_add_post_format_support( $post ) {

    		$screen = get_current_screen();
    		$post_type = $screen->post_type;

    		if ( $post_type == 'lsvr_kba' ) {
        		add_theme_support( 'post-formats', array( 'gallery', 'link', 'image', 'video', 'audio' ) );
    		}

		}
	}

	// Set rating type
	add_filter( 'lsvr_knowledge_base_kba_rating_type', 'lsvr_lore_kba_rating_type' );
	if ( ! function_exists( 'lsvr_lore_kba_rating_type' ) ) {
		function lsvr_lore_kba_rating_type() {

			return get_theme_mod( 'lsvr_kba_rating_enable', 'disable' );

		}
	}

	// Body class
	add_filter( 'body_class', 'lsvr_lore_kba_body_class' );
	if ( ! function_exists( 'lsvr_lore_kba_body_class' ) ) {
		function lsvr_lore_kba_body_class( $class ) {

			if ( is_post_type_archive( 'lsvr_kba' ) && 'category-view' === get_theme_mod( 'lsvr_kba_archive_layout', 'default' ) ) {
				array_push( $class, 'post-type-archive-lsvr_kba--category-view' );
			}

			return $class;

		}
	}


/**
 * HEADER
 */

	// Knowledge Base header background
	add_filter( 'lsvr_lore_header_background_image_url', 'lsvr_lore_kba_header_background_image_url' );
	if ( ! function_exists( 'lsvr_lore_kba_header_background_image_url' ) ) {
		function lsvr_lore_kba_header_background_image_url( $image_url ) {

			if ( lsvr_lore_is_kba() && ! empty( get_theme_mod( 'lsvr_kba_header_background_image', '' ) ) ) {
				$image_url = get_theme_mod( 'lsvr_kba_header_background_image', '' );
			}

			return $image_url;

		}
	}

	// Add search filters
	add_filter( 'lsvr_lore_header_search_filters', 'lsvr_lore_kba_header_search_filters', 5 );
	if ( ! function_exists( 'lsvr_lore_kba_header_search_filters' ) ) {
		function lsvr_lore_kba_header_search_filters( $filters ) {

			$filters = array_merge( $filters, array(
				array(
					'post_type' => 'lsvr_kba',
					'label' => lsvr_lore_get_kba_archive_title(),
				),
			));

			return $filters;

		}
	}


/**
 * CORE
 */

	// Archive title
	add_filter( 'lsvr_lore_kba_archive_title', 'lsvr_lore_kba_archive_title' );
	if ( ! function_exists( 'lsvr_lore_kba_archive_title' ) ) {
		function lsvr_lore_kba_archive_title( $title ) {

			// Category archive
			if ( is_tax( 'lsvr_kba_cat' ) ) {
				$title = single_term_title( '', false );
			}

			// Tag archive
			elseif ( is_tax( 'lsvr_kba_tag' ) ) {
				$title = sprintf( esc_html__( 'Tag: %s', 'lore' ), single_term_title( '', false ) );
			}

			return $title;

		}
	}

	// Set archive layout
	add_filter( 'lsvr_lore_kba_archive_layout', 'lsvr_lore_kba_archive_layout' );
	if ( ! function_exists( 'lsvr_lore_kba_archive_layout' ) ) {
		function lsvr_lore_kba_archive_layout() {

			// Enable the Category view layout only on main archive page
			if ( is_post_type_archive( 'lsvr_kba' ) && 'category-view' === get_theme_mod( 'lsvr_kba_archive_layout', 'default' ) ) {

				return 'category-view';

			} else {

				return 'default';

			}

		}
	}

	// Set narrow layout
	add_filter( 'lsvr_lore_wide_layout_enable', 'lsvr_lore_kba_wide_layout_enable' );
	if ( ! function_exists( 'lsvr_lore_kba_wide_layout_enable' ) ) {
		function lsvr_lore_kba_wide_layout_enable( $enable ) {

			if ( is_post_type_archive( 'lsvr_kba' ) && 'category-view' === get_theme_mod( 'lsvr_kba_archive_layout', 'default' ) ) {
				return true;
			}

			return $enable;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_lore_add_to_breadcrumbs', 'lsvr_lore_kba_breadcrumbs' );
	if ( ! function_exists( 'lsvr_lore_kba_breadcrumbs' ) ) {
		function lsvr_lore_kba_breadcrumbs( $breadcrumbs ) {

			// Taxonomy
			if ( lsvr_lore_is_kba() && ! is_post_type_archive( 'lsvr_kba' ) && ! is_singular( 'lsvr_kba' ) ) {
				return array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_kba' ),
						'label' => lsvr_lore_get_kba_archive_title(),
					),
				);
			}

			// Single
			if ( is_singular( 'lsvr_kba' ) ) {

				global $post;
				$return = array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_kba' ),
						'label' => lsvr_lore_get_kba_archive_title(),
					),
				);

				$post_terms = wp_get_post_terms( $post->ID, 'lsvr_kba_cat' );

				// Get category path
	            if ( is_array( $post_terms ) && count( $post_terms ) > 0 ) {

	            	$current_term = reset( $post_terms );

	            	// Get parents
	                if ( is_object( $current_term ) && property_exists( $current_term, 'term_id' ) ) {

	                	$term_parents = lsvr_lore_get_term_parents( $current_term->term_id, 'lsvr_kba_cat' );

						if ( ! empty( $term_parents ) ) {
							foreach( $term_parents as $term_id ) {

								$term = get_term_by( 'id', $term_id, 'lsvr_kba_cat' );
								$return[] = array(
									'url' => get_term_link( $term_id, 'lsvr_kba_cat' ),
									'label' => $term->name,
								);

							}
						}

	                }

	                // Get immediate parent
					$term = get_term_by( 'id', $current_term->term_id, 'lsvr_kba_cat' );
					$return[] = array(
						'url' => get_term_link( $current_term->term_id, 'lsvr_kba_cat' ),
						'label' => $term->name,
					);

	            }

				return $return;

			}

			return $breadcrumbs;

		}
	}

	// Archive pre_get_posts actions
	add_action( 'pre_get_posts', 'lsvr_lore_kba_archive_pre_get_posts' );
	if ( ! function_exists( 'lsvr_lore_kba_archive_pre_get_posts' ) ) {
		function lsvr_lore_kba_archive_pre_get_posts( $query ) {

			// Alter the archive query
			if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'lsvr_kba' ) ||
				$query->is_tax( 'lsvr_kba_cat' ) || $query->is_tax( 'lsvr_kba_tag' ) ) ) {

				// Posts per page
				if ( 0 === (int) get_theme_mod( 'lsvr_kba_archive_posts_per_page', 10 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'lsvr_kba_archive_posts_per_page', 10 ) ) );
				}

				// Order
				if ( 'date_desc' == get_theme_mod( 'lsvr_kba_archive_order', 'default' ) ) {
					$query->set( 'order', 'DESC' );
					$query->set( 'orderby', 'date' );
				}
				elseif ( 'date_asc' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {
					$query->set( 'order', 'ASC' );
					$query->set( 'orderby', 'date' );
				}
				elseif ( 'title_asc' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {
					$query->set( 'order', 'ASC' );
					$query->set( 'orderby', 'title' );
				}
				elseif ( 'title_desc' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {
					$query->set( 'order', 'DESC' );
					$query->set( 'orderby', 'title' );
				}
				elseif ( 'random' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {
					$query->set( 'orderby', 'rand' );
				}
				elseif ( 'rating' == get_theme_mod( 'lsvr_kba_archive_order', 'default' ) ) {

					$rating_type = get_theme_mod( 'lsvr_kba_rating_enable', 'disable' );
					if ( 'disable' !== $rating_type ) {

						$query->set( 'order', 'DESC' );
						$query->set( 'orderby', 'meta_value_num date' );

						if ( 'both' === $rating_type || 'sum' === $rating_type ) {
							$meta_query_key = 'lsvr_kba_rating_sum';
						}
						else {
							$meta_query_key = 'lsvr_kba_likes' ;
						}

						$query->set( 'meta_query', array(
	   						'relation' => 'OR',
	      					array(
	            				'key' => $meta_query_key,
	            				'compare' => 'NOT EXISTS',
	        				),
	        				array(
	            				'key' => $meta_query_key,
	            				'compare' => 'EXISTS',
	        				)
	    				));

					}

				}
				elseif ( class_exists( 'Hicpo' ) ) { // Intuitive CPO fix
					$query->set( 'orderby' ,'menu_order' );
					$query->set( 'order' ,'ASC' );
				}

			}

			// Include KB articles on author archive page
    		if ( $query->is_author() ) {
    			$query->set( 'post_type', array( 'post', 'lsvr_kba' ) );
			}

			// Show only direct child articles of current category
			if ( ! is_admin() && $query->is_main_query() && $query->is_tax( 'lsvr_kba_cat' ) ) {

				$current_term = get_queried_object();

				if ( ! empty( $current_term ) ) {

					$query->set( 'tax_query', array(
						array(
							'taxonomy' => 'lsvr_kba_cat',
							'field' => 'id',
							'terms' => $current_term->term_id,
							'include_children' => false,
						),
					));

				}

			}

		}
	}

	// Add to archive post class
	add_filter( 'post_class', 'lsvr_lore_kba_archive_post_class' );
	if ( ! function_exists( 'lsvr_lore_kba_archive_post_class' ) ) {
		function lsvr_lore_kba_archive_post_class( $classes ) {

			if ( ( ( lsvr_lore_is_kba() && ! is_singular( 'lsvr_lore' ) ) || ( is_author() && 'lsvr_kba' === get_post_type() ) || ( is_search() && 'lsvr_kba' === get_post_type() ) ) ) {

				if ( true === get_theme_mod( 'lsvr_kba_archive_date_enable', true ) ) {
					$classes[] = 'post--has-date';
				}

				if ( true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) && 'disable' !== get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) {
					$classes[] = 'post--has-rating';
				}

			}

			return $classes;

		}
	}

	// Author bio
	add_filter( 'lsvr_lore_post_single_author_bio_enable', 'lsvr_lore_kba_post_single_author_bio_enable' );
	if ( ! function_exists( 'lsvr_lore_kba_post_single_author_bio_enable' ) ) {
		function lsvr_lore_kba_post_single_author_bio_enable( $enable ) {

			if ( is_singular( 'lsvr_kba' ) && true === get_theme_mod( 'lsvr_kba_single_author_bio_enable', false ) ) {
				return true;
			}

			return $enable;

		}
	}

	// Enable post single navigation
	add_filter( 'lsvr_lore_post_single_navigation_enable', 'lsvr_lore_kba_single_post_navigation_enable' );
	if ( ! function_exists( 'lsvr_lore_kba_single_post_navigation_enable' ) ) {
		function lsvr_lore_kba_single_post_navigation_enable( $enabled ) {

			if ( lsvr_lore_is_kba() && true === get_theme_mod( 'lsvr_kba_single_navigation_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_lore_sidebar_position', 'lsvr_lore_kba_sidebar_position' );
	if ( ! function_exists( 'lsvr_lore_kba_sidebar_position' ) ) {
		function lsvr_lore_kba_sidebar_position( $sidebar_position ) {

			// Is single
			if ( is_singular( 'lsvr_kba' ) ) {
				return get_theme_mod( 'lsvr_kba_single_sidebar_position', 'disable' );
			}

			// Is archive
			elseif ( lsvr_lore_is_kba() ) {
				return get_theme_mod( 'lsvr_kba_archive_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_lore_sidebar_id', 'lsvr_lore_kba_sidebar_id' );
	if ( ! function_exists( 'lsvr_lore_kba_sidebar_id' ) ) {
		function lsvr_lore_kba_sidebar_id( $sidebar_id ) {

			// Is single
			if ( is_singular( 'lsvr_kba' ) ) {
				return get_theme_mod( 'lsvr_kba_single_sidebar_id', 'lsvr-lore-default-sidebar' );
			}

			// Is archive
			elseif ( lsvr_lore_is_kba() ) {
				return get_theme_mod( 'lsvr_kba_archive_sidebar_id', 'lsvr-lore-default-sidebar' );
			}

			return $sidebar_id;

		}
	}

?>