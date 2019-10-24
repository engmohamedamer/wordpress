<?php

/**
 * GENERAL
 */

	// Load Google Fonts
	add_action( 'lsvr_lore_load_assets', 'lsvr_lore_load_google_fonts_css' );
	if ( ! function_exists( 'lsvr_lore_load_google_fonts_css' ) ) {
		function lsvr_lore_load_google_fonts_css() {

			if ( true === get_theme_mod( 'typography_google_fonts_enable', true ) ) {

				// Prepare query params
				$primary_font = get_theme_mod( 'typography_primary_font', 'Open+Sans' );
				$primary_font_variants = '400,400italic,600,600italic,700,700italic';
				$secondary_font = get_theme_mod( 'typography_secondary_font', 'Merriweather' );
				$secondary_font_variants = '400,400italic,900,900italic';
				$family_param = $primary_font !== $secondary_font ? $primary_font . ':' . $primary_font_variants . '|' . $secondary_font . ':' . $secondary_font_variants : $primary_font . ':' . $primary_font_variants;
				$subset = get_theme_mod( 'typography_font_subsets' );
				$subset_param = ! empty( $subset ) && is_string( $subset ) ? $subset : '';

				// Create query
				$query_args = array(
					'family' => $family_param,
					'subset' => $subset_param,
				);
				$query_args = array_filter( $query_args );

				// Enqueue fonts
				if ( ! empty( $query_args ) ) {
					wp_enqueue_style( 'lsvr-lore-google-fonts', add_query_arg( $query_args, '//fonts.googleapis.com/css' ) );
				}

				// Primary font style
				$primary_font_elements = array( 'body', 'input', 'textarea', 'select', 'button', '#cancel-comment-reply-link');
				$primary_font_family = str_replace( '+', ' ', $primary_font );
				$primary_font_css = implode( ', ', $primary_font_elements ) . ' { font-family: \'' . esc_attr( $primary_font_family ) . '\', Arial, sans-serif; }';
				wp_add_inline_style( 'lsvr-lore-main-style', $primary_font_css );
				wp_add_inline_style( 'lsvr-lore-main-style', 'html, body { font-size: ' . esc_attr( get_theme_mod( 'typography_base_font_size', '16' ) ) . 'px; }' );

				// Secondary font style
				if ( $primary_font !== $secondary_font ) {
					$secondary_font_elements = array( 'h1', 'h2', '.is-secondary-font' );
					$secondary_font_family = str_replace( '+', ' ', $secondary_font );
					$secondary_font_css = implode( ', ', $secondary_font_elements ) . ' { font-family: \'' . esc_attr( $secondary_font_family ) . '\', Arial, sans-serif; }';
					wp_add_inline_style( 'lsvr-lore-main-style', $secondary_font_css );
				}

			}

		}
	}

	// Load editor Google Fonts
	add_action( 'lsvr_lore_load_editor_assets', 'lsvr_lore_load_editor_google_fonts_css' );
	if ( ! function_exists( 'lsvr_lore_load_editor_google_fonts_css' ) ) {
		function lsvr_lore_load_editor_google_fonts_css() {

			if ( true === get_theme_mod( 'typography_google_fonts_enable', true ) ) {

				// Prepare query params
				$primary_font = get_theme_mod( 'typography_primary_font', 'Source+Sans+Pro' );
				$primary_font_variants = '400,400italic,600,600italic,700,700italic';
				$secondary_font = get_theme_mod( 'typography_secondary_font', 'Merriweather' );
				$secondary_font_variants = '400,400italic,700,700italic';
				$family_param = $primary_font !== $secondary_font ? $primary_font . ':' . $primary_font_variants . '|' . $secondary_font . ':' . $secondary_font_variants : $primary_font . ':' . $primary_font_variants;
				$subset = get_theme_mod( 'typography_font_subsets' );
				$subset_param = ! empty( $subset ) && is_string( $subset ) ? $subset : '';

				// Create query
				$query_args = array(
					'family' => $family_param,
					'subset' => $subset_param,
				);
				$query_args = array_filter( $query_args );

				// Enqueue fonts
				if ( ! empty( $query_args ) ) {
					wp_enqueue_style( 'lsvr-lore-google-fonts', add_query_arg( $query_args, '//fonts.googleapis.com/css' ) );
				}

				// Primary font style
				$primary_font_elements = array( 'body .editor-styles-wrapper', '.editor-styles-wrapper', '.editor-styles-wrapper button' );
				$primary_font_family = str_replace( '+', ' ', $primary_font );
				$primary_font_css = implode( ', ', $primary_font_elements ) . ' { font-family: \'' . esc_attr( $primary_font_family ) . '\', Arial, sans-serif; }';
				wp_add_inline_style( 'lsvr-lore-editor-style', $primary_font_css );
				wp_add_inline_style( 'lsvr-lore-editor-style', 'body .editor-styles-wrapper, .editor-styles-wrapper { font-size: ' . esc_attr( get_theme_mod( 'typography_base_font_size', '16' ) ) . 'px; }' );

				// Secondary font style
				if ( $primary_font !== $secondary_font ) {
					$secondary_font_elements = array( '.editor-styles-wrapper h1', '.editor-styles-wrapper h2', '.editor-styles-wrapper .is-secondary-font' );
					$secondary_font_family = str_replace( '+', ' ', $secondary_font );
					$secondary_font_css = implode( ', ', $secondary_font_elements ) . ' { font-family: \'' . esc_attr( $secondary_font_family ) . '\', Arial, sans-serif; }';
					wp_add_inline_style( 'lsvr-lore-editor-style', $secondary_font_css );
				}

			}

		}
	}

	// Set logo dimensions
	add_action( 'lsvr_lore_load_assets', 'lsvr_lore_set_logo_dimensions' );
	if ( ! function_exists( 'lsvr_lore_set_logo_dimensions' ) ) {
		function lsvr_lore_set_logo_dimensions() {

			$max_width = get_theme_mod( 'header_logo_max_width', 50 );
			if ( ! empty( $max_width ) ) {
				wp_add_inline_style( 'lsvr-lore-main-style', '.header-logo__link { max-width: ' . esc_attr( $max_width ) . 'px; }' );
			}

		}
	}

	// Load skin CSS
	add_action( 'lsvr_lore_load_assets', 'lsvr_lore_load_skin_css' );
	if ( ! function_exists( 'lsvr_lore_load_skin_css' ) ) {
		function lsvr_lore_load_skin_css() {

			$version = wp_get_theme( 'lore' );
			$version = $version->Version;

			// Load predefined color skin
			if ( 'predefined' === get_theme_mod( 'colors_method', 'predefined' ) || 'custom-colors' === get_theme_mod( 'colors_method', 'predefined' ) ) {
				$skin_file = get_theme_mod( 'colors_predefined_skin', 'default' );
				wp_enqueue_style( 'lsvr-lore-color-scheme', get_template_directory_uri() . '/assets/css/skins/' . esc_attr( $skin_file ) . '.css', array( 'lsvr-lore-main-style' ), $version );
			}

			// Generate CSS from custom colors
			if ( 'custom-colors' === get_theme_mod( 'colors_method', 'predefined' ) ) {
				wp_add_inline_style( 'lsvr-lore-color-scheme', lsvr_lore_get_custom_colors_css() );
			}

		}
	}

	// Load editor skin CSS
	add_action( 'lsvr_lore_load_editor_assets', 'lsvr_lore_load_editor_skin_css' );
	if ( ! function_exists( 'lsvr_lore_load_editor_skin_css' ) ) {
		function lsvr_lore_load_editor_skin_css() {

			$version = wp_get_theme( 'lore' );
			$version = $version->Version;

			// Load predefined editor color skin
			if ( 'predefined' === get_theme_mod( 'colors_method', 'predefined' ) || 'custom-colors' === get_theme_mod( 'colors_method', 'predefined' ) ) {
				$skin_file = get_theme_mod( 'colors_predefined_skin', 'default' );
				wp_enqueue_style( 'lsvr-lore-editor-color-scheme', get_template_directory_uri() . '/assets/css/skins/' . esc_attr( $skin_file ) . '.editor.css', array( 'lsvr-lore-editor-style' ), $version );
			}

			// Generate CSS from custom colors
			if ( 'custom-colors' === get_theme_mod( 'colors_method', 'predefined' ) ) {
				wp_add_inline_style( 'lsvr-lore-editor-color-scheme', lsvr_lore_get_custom_colors_css( true ) );
			}

		}
	}

	// Load ajax search JS files
	add_action( 'lsvr_lore_load_assets', 'lsvr_lore_load_ajax_search_js' );
	if ( ! function_exists( 'lsvr_lore_load_ajax_search_js' ) ) {
		function lsvr_lore_load_ajax_search_js() {

			if ( true === get_theme_mod( 'header_search_enable', true ) && true === get_theme_mod( 'header_search_ajax_enable', true ) ) {

				$version = wp_get_theme( 'lore' );
				$version = $version->Version;
				$suffix = defined( 'WP_DEBUG' ) && true == WP_DEBUG ? '' : '.min';

				wp_enqueue_script( 'lsvr-lore-ajax-search', get_template_directory_uri() . '/assets/js/lore-ajax-search' . $suffix . '.js', array( 'jquery' ), $version, true );
				wp_localize_script( 'lsvr-lore-ajax-search', 'lsvr_lore_ajax_search_var', array(
		    		'url' => admin_url( 'admin-ajax.php' ),
		    		'nonce' => wp_create_nonce( 'lsvr-lore-ajax-search-nonce' )
				));
			}

		}
	}

	// Load JS labels
	add_action( 'lsvr_lore_load_assets', 'lsvr_lore_load_js_labels' );
	if ( ! function_exists( 'lsvr_lore_load_js_labels' ) ) {
		function lsvr_lore_load_js_labels() {

			$js_labels = array(
				'expand' => esc_html__( 'Expand', 'lore' ),
				'collapse' => esc_html__( 'Collapse', 'lore' ),
			);

			// Magnific popup JS labels
			if ( true === apply_filters( 'lsvr_lore_default_lightbox_enable', true ) ) {
				$js_labels[ 'magnific_popup' ] = array(
					'mp_tClose' => esc_html__( 'Close (Esc)', 'lore' ),
					'mp_tLoading' => esc_html__( 'Loading...', 'lore' ),
					'mp_tPrev' => esc_html__( 'Previous (Left arrow key)', 'lore' ),
					'mp_tNext' => esc_html__( 'Next (Right arrow key)', 'lore' ),
					'mp_image_tError' => esc_html__( 'The image could not be loaded.', 'lore' ),
					'mp_ajax_tError' => esc_html__( 'The content could not be loaded.', 'lore' ),
				);
			}

			// Apply filters
			$js_labels = array_merge( $js_labels, apply_filters( 'lsvr_lore_add_js_labels', array() ) );

			// Convert to JS
			if ( ! empty( $js_labels ) ) {
				wp_add_inline_script( 'lsvr-lore-main-scripts', 'var lsvr_lore_js_labels = ' . json_encode( $js_labels ) );
			}

		}
	}


/**
 * HEADER
 */

	// Header background
	add_filter( 'lsvr_lore_header_background_image_url', 'lsvr_lore_header_background_image_url' );
	if ( ! function_exists( 'lsvr_lore_header_background_image_url' ) ) {
		function lsvr_lore_header_background_image_url( $image_url ) {

			global $post;

			if ( lsvr_lore_is_blog() && ! empty( get_theme_mod( 'blog_header_background_image', '' ) ) ) {
				$image_url = get_theme_mod( 'blog_header_background_image', '' );
			}

			elseif ( is_page() && has_post_thumbnail( $post->ID ) ) {
				$image_url = get_the_post_thumbnail_url( $post, 'fullsize' );
			}

			return $image_url;

		}
	}

	// Enable header navbar search
	add_filter( 'lsvr_lore_header_navbar_search_enable', 'lsvr_lore_header_navbar_search_enable' );
	if ( ! function_exists( 'lsvr_lore_header_navbar_search_enable' ) ) {
		function lsvr_lore_header_navbar_search_enable( $enable ) {

			// Has large search
			if ( true === get_theme_mod( 'header_search_enable', true ) &&
				( 'everywhere' === get_theme_mod( 'header_search_large_enable', 'front' ) ||
				( 'front-kb' === get_theme_mod( 'header_search_large_enable', 'front' ) && ( is_front_page() || is_post_type_archive( 'lsvr_kba' ) || is_tax( 'lsvr_kba_cat' ) ) ) ||
				( 'front' === get_theme_mod( 'header_search_large_enable', 'front' ) && is_front_page() ) ||
				( 'kb' === get_theme_mod( 'header_search_large_enable', 'front' ) && ( is_post_type_archive( 'lsvr_kba' ) || is_tax( 'lsvr_kba_cat' ) ) ) ||
				( isset( $_GET['large-header-search'] ) && 'true' === $_GET['large-header-search'] ) ) ) {

				return false;

			}
			elseif ( true === get_theme_mod( 'header_search_enable', true ) ) {
				return true;
			}

			return $enable;

		}
	}

	// Header class
	add_filter( 'lsvr_lore_header_class', 'lsvr_lore_header_class' );
	if ( ! function_exists( 'lsvr_lore_header_class' ) ) {
		function lsvr_lore_header_class( $class ) {

			// Large search
			if ( true === get_theme_mod( 'header_search_enable', true ) &&
				( 'everywhere' === get_theme_mod( 'header_search_large_enable', 'front' ) ||
				( 'front-kb' === get_theme_mod( 'header_search_large_enable', 'front' ) && ( is_front_page() || is_post_type_archive( 'lsvr_kba' ) || is_tax( 'lsvr_kba_cat' ) ) ) ||
				( 'front' === get_theme_mod( 'header_search_large_enable', 'front' ) && is_front_page() ) ||
				( 'kb' === get_theme_mod( 'header_search_large_enable', 'front' ) && ( is_post_type_archive( 'lsvr_kba' ) || is_tax( 'lsvr_kba_cat' ) ) ) ||
				( isset( $_GET['large-header-search'] ) && 'true' === $_GET['large-header-search'] ) ) ) {

				return $class . ' header--has-large-search';

			}
			elseif ( true === get_theme_mod( 'header_search_enable', true ) ) {
				return $class . ' header--has-search';
			}

			return $class;

		}
	}

	// Add sticky navbar placeholder
	add_action( 'lsvr_lore_header_navbar_after', 'lsvr_lore_sticky_navbar_placeholder' );
	if ( ! function_exists( 'lsvr_lore_sticky_navbar_placeholder' ) ) {
		function lsvr_lore_sticky_navbar_placeholder() {

		    if ( true === get_theme_mod( 'header_sticky_navbar_enable', false ) ) {
		        echo '<div class="header-navbar__placeholder"></div>';
		    }

		}
	}

	// Add search filters
	add_filter( 'lsvr_lore_header_search_filters', 'lsvr_lore_header_search_filters' );
	if ( ! function_exists( 'lsvr_lore_header_search_filters' ) ) {
		function lsvr_lore_header_search_filters( $filters ) {

			$filters = array_merge( $filters, array(
				array(
					'post_type' => 'post',
					'label' => get_the_title( get_option( 'page_for_posts' ) ),
				),
				array(
					'post_type' => 'page',
					'label' => esc_html__( 'Pages', 'lore' ),
				),
			));

			return $filters;

		}
	}


/**
 * CORE
 */

	// Archive title
	add_filter( 'lsvr_lore_blog_archive_title', 'lsvr_lore_blog_archive_title' );
	if ( ! function_exists( 'lsvr_lore_blog_archive_title' ) ) {
		function lsvr_lore_blog_archive_title( $title ) {

			// Category archive
			if ( is_category() || is_tax() ) {
				$title = single_term_title( '', false );
			}

			// Tag archive
			elseif ( is_tag() ) {
				$title = sprintf( esc_html__( 'Tag: %s', 'lore' ), single_term_title( '', false ) );;
			}

			// Post archive
			elseif ( lsvr_lore_is_blog() && ! is_singular( 'post' ) ) {
				$title = lsvr_lore_get_blog_archive_title();
			}

			// Search results
			elseif ( is_search() ) {
				$title = esc_html__( 'Search Results', 'lore' );
			}

			// 404
			elseif ( is_404() ) {
				$title = esc_html__( 'Page Not Found', 'lore' );
			}

			// Default
			else {
				$title = get_the_title();
			}

			return $title;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_lore_breadcrumbs', 'lsvr_lore_breadcrumbs' );
	if ( ! function_exists( 'lsvr_lore_breadcrumbs' ) ) {
		function lsvr_lore_breadcrumbs() {

			global $wp_query, $post;
			$breadcrumbs = [];

			// Home link
			$breadcrumbs[] = array(
				'url' => esc_url( home_url( '/' ) ),
				'label' => esc_html__( 'الرئيسية', 'lore' ),
			);

			// Blog root for blog pages
			if ( get_option( 'page_for_posts' ) ) {
				$blog_root = array(
					'url' => get_permalink( get_option( 'page_for_posts' ) ),
					'label' => get_the_title( get_option( 'page_for_posts' ) ),
				);
			}
			else {
				$blog_root = array(
					'url' => esc_url( home_url( '/' ) ),
					'label' => esc_html__( 'Blog', 'lore' ),
				);
			}

			// Blog
			if ( is_tag() || is_day() || is_month() || is_year() || is_author() || is_singular( 'post' ) ) {
				array_push( $breadcrumbs, $blog_root );
			}

			// Blog category
			else if ( is_category() ) {
				$breadcrumbs[] = $blog_root;
				$current_term = $wp_query->queried_object;
				$current_term_id = $current_term->term_id;
				$parent_ids = lsvr_lore_get_term_parents( $current_term_id, 'category' );
				if ( ! empty( $parent_ids ) ) {
					foreach( $parent_ids as $parent_id ){
						$parent = get_term( $parent_id, 'category' );
						$breadcrumbs[] = array(
							'url' => get_term_link( $parent, 'category' ),
							'label' => $parent->name,
						);
					}
				}
			}

			// Regular page
			else if ( is_page() ) {
				$parent_id = $post->post_parent;
				$parents_arr = [];
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$parents_arr[] = array(
						'url' => get_permalink( $page->ID ),
						'label' => get_the_title( $page->ID ),
					);
					$parent_id = $page->post_parent;
				}
				$parents_arr = array_reverse( $parents_arr );
				foreach ( $parents_arr as $parent ) {
					$breadcrumbs[] = $parent;
				}
			}

			// Apply filters
			if ( ! empty( apply_filters( 'lsvr_lore_add_to_breadcrumbs', array() ) ) ) {
				$breadcrumbs = array_merge( $breadcrumbs, apply_filters( 'lsvr_lore_add_to_breadcrumbs', array() ) );
			}

			// Taxonomy
			if ( is_tax() ) {

				$taxonomy = get_query_var( 'taxonomy' );
				$term_parents = lsvr_lore_get_term_parents( get_queried_object_id(), $taxonomy );
				if ( ! empty( $term_parents ) ) {
					foreach( $term_parents as $term_id ) {

						$term = get_term_by( 'id', $term_id, $taxonomy );
						$breadcrumbs[] = array(
							'url' => get_term_link( $term_id, $taxonomy ),
							'label' => $term->name,
						);

					}
				}
			}

			// Return breadcrumbs
			return $breadcrumbs;

		}
	}

	// Set narrow layout for author archive and search results
	add_filter( 'lsvr_lore_narrow_layout_enable', 'lsvr_lore_general_archive_narrow_layout_enable' );
	if ( ! function_exists( 'lsvr_lore_general_archive_narrow_layout_enable' ) ) {
		function lsvr_lore_general_archive_narrow_layout_enable( $enable ) {

			if ( is_author() || is_search() ) {
				return true;
			}

			return $enable;

		}
	}

	// Author bio
	add_filter( 'lsvr_lore_post_single_author_bio_enable', 'lsvr_lore_blog_post_single_author_bio_enable' );
	if ( ! function_exists( 'lsvr_lore_blog_post_single_author_bio_enable' ) ) {
		function lsvr_lore_blog_post_single_author_bio_enable( $enable ) {

			if ( is_singular( 'post' ) && true === get_theme_mod( 'blog_single_author_bio_enable', false ) ) {
				return true;
			}

			return $enable;

		}
	}

	// Enable post single navigation
	add_filter( 'lsvr_lore_post_single_navigation_enable', 'lsvr_blore_blog_single_post_navigation_enable' );
	if ( ! function_exists( 'lsvr_blore_blog_single_post_navigation_enable' ) ) {
		function lsvr_blore_blog_single_post_navigation_enable( $enabled ) {

			if ( lsvr_lore_is_blog() && true === get_theme_mod( 'blog_single_post_navigation_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Set page sidebar position
	add_filter( 'lsvr_lore_sidebar_position', 'lsvr_lore_sidebar_position' );
	if ( ! function_exists( 'lsvr_lore_sidebar_position' ) ) {
		function lsvr_lore_sidebar_position( $sidebar_position ) {

			// Is blog single
			if ( is_singular( 'post' ) ) {
				return get_theme_mod( 'blog_single_sidebar_position', 'right' );
			}

			// Is blog archive
			elseif ( lsvr_lore_is_blog() ) {
				return get_theme_mod( 'blog_archive_sidebar_position', 'right' );
			}

			return $sidebar_position;

		}
	}

	// Set page sidebar ID
	add_filter( 'lsvr_lore_sidebar_id', 'lsvr_lore_sidebar_id' );
	if ( ! function_exists( 'lsvr_lore_sidebar_id' ) ) {
		function lsvr_lore_sidebar_id( $sidebar_id ) {

			// Page
			if ( is_page() ) {
				$page_id = ! empty( $page_id ) ? $page_id : get_the_ID();
				$sidebar_id = ! empty( $page_id ) ? get_post_meta( $page_id, 'lsvr_lore_page_sidebar', true ) : false;

				if ( ! empty( $sidebar_id ) ) {
					$sidebar_id = $sidebar_id;
				} else {
					$sidebar_id = 'lsvr-lore-default-sidebar';
				}
			}

			// Is blog single
			elseif ( is_singular( 'post' ) ) {
				$sidebar_id = get_theme_mod( 'blog_single_sidebar_id', 'lsvr-lore-default-sidebar' );
			}

			// Is blog archive
			elseif ( lsvr_lore_is_blog() ) {
				$sidebar_id = get_theme_mod( 'blog_archive_sidebar_id', 'lsvr-lore-default-sidebar' );
			}

			// Default
			else {
				$sidebar_id = 'lsvr-lore-default-sidebar';
			}

			return ! empty( $sidebar_id ) ? $sidebar_id : 'lsvr-lore-default-sidebar';

		}
	}

	// Disable sidebars for narrow or wide layouts
	add_filter( 'lsvr_lore_sidebar_position', 'lsvr_lore_narrow_layout_sidebar_position_disable', 20 );
	if ( ! function_exists( 'lsvr_lore_narrow_layout_sidebar_position_disable' ) ) {
		function lsvr_lore_narrow_layout_sidebar_position_disable( $sidebar_position ) {

			if ( true === apply_filters( 'lsvr_lore_narrow_layout_enable', false ) || true === apply_filters( 'lsvr_lore_wide_layout_enable', false ) ) {
				return 'disable';
			}

			return $sidebar_position;

		}
	}

 	// Search filter for non-Ajax search
	add_action( 'pre_get_posts', 'lsvr_lore_search_filter' );
	if ( ! function_exists( 'lsvr_lore_search_filter' ) ) {
		function lsvr_lore_search_filter( $query ) {

			// Search results
			if ( is_search() && $query->is_main_query() ) {

				// Search filter
				if ( isset( $_GET['search-filter'] ) || isset( $_GET['search-filter-serialized'] ) ) {

					if ( isset( $_GET['search-filter'] ) ) {
						$post_type_arr = array_map( 'esc_attr', $_GET['search-filter'] );
					} else if ( isset( $_GET['search-filter-serialized'] ) ) {
						$post_type_arr = explode( ',', esc_attr( $_GET['search-filter-serialized'] ) );
					}

					$query->set( 'post_type', $post_type_arr );

				}

				// Posts per page
				if ( 0 === (int) get_theme_mod( 'search_results_posts_per_page', 10 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'search_results_posts_per_page', 10 ) ) );
				}

			}

		}
	}


/**
 * META DATA
 */

	// Add breadcrumbs meta
	add_action( 'lsvr_lore_breadcrumbs_bottom', 'lsvr_lore_add_breadcrumbs_meta' );
	if ( ! function_exists( 'lsvr_lore_add_breadcrumbs_meta' ) ) {
		function lsvr_lore_add_breadcrumbs_meta() { ?>

			<!-- BREADCRUMBS META DATA : begin -->
			<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement" : [
					<?php $i = 1;
					$breadcrumbs = apply_filters( 'lsvr_lore_breadcrumbs', '' );
					foreach ( $breadcrumbs as $breadcrumb ) : ?>
					{
						"@type": "ListItem",
						"position": <?php echo esc_js( $i ); ?>,
						"item": {
							"@id": "<?php echo esc_url( $breadcrumb['url'] ); ?>",
							"name": "<?php echo esc_js( $breadcrumb['label'] ); ?>"
						}
					}<?php if ( $breadcrumb !== end( $breadcrumbs ) ) { echo ','; } ?>
					<?php $i++; endforeach; ?>
				]
			}
			</script>
			<!-- BREADCRUMBS META DATA : end -->

		<?php }
	}

	// Add blog post meta data
	add_action( 'lsvr_lore_blog_single_bottom', 'lsvr_lore_add_blog_single_meta' );
	if ( ! function_exists( 'lsvr_lore_add_blog_single_meta' ) ) {
		function lsvr_lore_add_blog_single_meta() { ?>

			<script type="application/ld+json">
			{
				"@context" : "http://schema.org",
				"@type" : "NewsArticle",
				"headline": "<?php echo esc_js( get_the_title() ); ?>",
				"url" : "<?php echo esc_url( get_permalink() ); ?>",
				"mainEntityOfPage" : "<?php echo esc_url( get_permalink() ); ?>",
			 	"datePublished": "<?php echo esc_js( get_the_time( 'c' ) ); ?>",
			 	"dateModified": "<?php echo esc_js( get_the_modified_date( 'c' ) ); ?>",
			 	"description": "<?php echo esc_js( get_the_excerpt() ); ?>",
			 	"author": {
			 		"@type" : "person",
			 		"name" : "<?php echo esc_js( get_the_author() ); ?>",
			 		"url" : "<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
			 	},
			 	"publisher" : {
			 		"@id" : "<?php echo esc_url( home_url() ); ?>#WebSitePublisher"
			 	}

			 	<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'post_tag' ) ) : ?>
				,"keywords": "<?php echo esc_js( implode( ',', lsvr_lore_get_post_term_names( get_the_ID(), 'post_tag' ) ) ); ?>"
			 	<?php endif; ?>

				<?php if ( has_post_thumbnail() ) : ?>
			 	,"image": {
			 		"@type" : "ImageObject",
			 		"url" : "<?php the_post_thumbnail_url( 'full' ); ?>",
			 		"width" : "<?php echo esc_js( lsvr_lore_get_image_width( get_post_thumbnail_id( get_the_ID() ), 'full' ) ); ?>",
			 		"height" : "<?php echo esc_js( lsvr_lore_get_image_height( get_post_thumbnail_id( get_the_ID() ), 'full' ) ); ?>",
			 		"thumbnailUrl" : "<?php the_post_thumbnail_url( 'thumbnail' ); ?>"
			 	}
			 	<?php endif; ?>

			}
			</script>

		<?php }
	}

	// Add site meta data
	add_action( 'wp_footer', 'lsvr_lore_add_site_meta' );
	if ( ! function_exists( 'lsvr_lore_add_site_meta' ) ) {
		function lsvr_lore_add_site_meta() { ?>

			<?php // Get URLs of social links and email address
			$social_links = lsvr_lore_get_social_links();
			if ( ! empty( $social_links->email ) ) {
				$email = ! empty( $social_links->email->url ) ? $social_links->email->url : '';
				unset( $social_links->email );
			} ?>

			<script type="application/ld+json">
			{
				"@context" : "http://schema.org",
				"@type" : "WebSite",
				"name" : "<?php bloginfo( 'name' ); ?>",
				"url" : "<?php echo esc_url( home_url() ); ?>",
				"description" : "<?php bloginfo( 'description' ); ?>",
			 	"publisher" : {

			 		"@id" : "<?php echo esc_url( home_url() ); ?>#WebSitePublisher",
			 		"@type" : "Organization",
			 		"name" : "<?php echo esc_js( get_bloginfo('name') ); ?>",
			 		"url" : "<?php echo esc_url( home_url() ); ?>"

					<?php if ( ! empty( $email ) ) : ?>
					,"contactPoint": {
				 		"@type": "ContactPoint",
				 		"contactType": "customer service",
				 		"url": "<?php echo esc_url( home_url() ); ?>",
				 		"email": "<?php echo esc_js( $email ); ?>"
				 	}
					<?php endif; ?>

			 		<?php if ( has_custom_logo() ) : ?>
			 		,"logo" : {
			 			"@type" : "ImageObject",
			 			"url" : "<?php echo esc_url( lsvr_lore_get_image_url( get_theme_mod( 'custom_logo' ) ) ); ?>",
						"width" : "<?php echo esc_attr( lsvr_lore_get_image_width( get_theme_mod( 'custom_logo' ) ) ); ?>",
						"height" : "<?php echo esc_attr( lsvr_lore_get_image_height( get_theme_mod( 'custom_logo' ) ) ); ?>"
			 		}
			 		<?php endif; ?>

					<?php if ( ! empty( $social_links ) ) : ?>
					,"sameAs" : [
						<?php foreach( $social_links as $social ) : if ( ! empty( $social->url ) ) : ?>
				    		"<?php echo esc_url( $social->url ); ?>"<?php if ( $social !== end( $social_links ) ) { echo ','; } ?>
						<?php endif; endforeach; ?>
				  	]
				  	<?php endif; ?>

			 	},
			 	"potentialAction": {
			    	"@type" : "SearchAction",
			    	"target" : "<?php echo esc_url( home_url() ); ?>/?s={search_term}",
			    	"query-input": "required name=search_term"
			    }
			}
			</script>

		<?php }
	}

?>
