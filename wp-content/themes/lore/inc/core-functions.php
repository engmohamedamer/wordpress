<?php

/**
 * GENERAL
 */

	// Get languages
	if ( ! function_exists( 'lsvr_lore_get_languages' ) ) {
		function lsvr_lore_get_languages() {

			$languages = array();

			// WPML Generated
			if ( 'wpml' == get_theme_mod( 'language_switcher', 'disable' ) ) {

				$wpml_languages = apply_filters( 'wpml_active_languages', false, 'skip_missing=0&orderby=id&order=desc' );

				if ( is_array( $wpml_languages ) && count( $wpml_languages ) > 1 ) {
					foreach ( $wpml_languages as $lang ) {

						$language = array();
						$language['label'] = ! empty( $lang['language_code'] ) ? $lang['language_code'] : '';
						$language['url'] = ! empty( $lang['url'] ) ? $lang['url'] : '';
						$language['active'] = isset( $lang['active'] ) && true === (bool) $lang['active'] ? true : false;
						array_push( $languages, $language );

					}
				}

			}

			// Custom links
			elseif ( 'custom' == get_theme_mod( 'language_switcher', 'disable' ) ) {

				for ( $i = 1; $i <= 4; $i++) {
					if ( ! empty( get_theme_mod( 'language_custom' . $i . '_label', '' ) ) &&
						! empty( get_theme_mod( 'language_custom' . $i . '_url', '' ) ) ) {

						$language = array();
						$language['label'] = get_theme_mod( 'language_custom' . $i . '_label', '' );
						$language['url'] = get_theme_mod( 'language_custom' . $i . '_url', '' );
						if ( ! empty( get_theme_mod( 'language_custom' . $i . '_code', '' ) ) &&
							get_locale() === get_theme_mod( 'language_custom' . $i . '_code', '' ) ) {

							$language['active'] = true;

						} else {
							$language['active'] = false;
						}

						array_push( $languages, $language );

					}
				}

			}

			return ! empty( $languages ) ? $languages : false;

		}
	}

	// Get active language
	if ( ! function_exists( 'lsvr_lore_get_active_language' ) ) {
		function lsvr_lore_get_active_language() {

			$languages = lsvr_lore_get_languages();
			if ( ! empty( $languages ) ) {
				foreach ( $languages as $language ) {
					if ( ! empty( $language['active'] ) ) {
						$active_language = $language;
					}
				}
				$active_language = empty( $active_language ) ? reset( $languages ) : $active_language;
			}

			return ! empty( $active_language ) ? $active_language : false;

		}
	}

	// Has languages
	if ( ! function_exists( 'lsvr_lore_has_languages' ) ) {
		function lsvr_lore_has_languages() {

			$languages = lsvr_lore_get_languages();
			return ! empty( $languages ) ? true : false;

		}
	}

	// Get active search filter
	if ( ! function_exists( 'lsvr_lore_get_active_search_filter' ) ) {
		function lsvr_lore_get_active_search_filter() {

			if ( isset( $_GET['search-filter'] ) ) {
				return  array_map( 'esc_attr', $_GET['search-filter'] );
			} elseif ( isset( $_GET['search-filter-serialized'] ) ) {
				return explode( ',', esc_attr( $_GET['search-filter-serialized'] ) );
			} else {
				return array();
			}

		}
	}

	// Get pages
	if ( ! function_exists( 'lsvr_lore_get_pages' ) ) {
		function lsvr_lore_get_pages() {

			$pages = get_pages();
			$return = array();

			if ( ! empty( $pages ) ) {

				foreach ( $pages as $page ) {
					if ( ! empty( $page->ID ) && ! empty( $page->post_title ) ) {
						$return[ $page->ID ] = $page->post_title;
					}
				}

			}

			return $return;

		}
	}

	// Get parents of taxonomy term
	if ( ! function_exists( 'lsvr_lore_get_term_parents' ) ) {
		function lsvr_lore_get_term_parents( $term_id, $taxonomy, $max_limit = 5 ) {

			$term = get_term( $term_id, $taxonomy );
			if ( 0 !== $term->parent ) {

				$parents_arr = [];
				$counter = 0;
				$parent_id = $term->parent;

				while ( 0 !== $parent_id && $counter < $max_limit ) {
					array_unshift( $parents_arr, $parent_id );
					$parent = get_term( $parent_id, $taxonomy );
					$parent_id = $parent->parent;
					$counter++;
				}
				return $parents_arr;

			}
			else {
				return false;
			}

		}
	}

	// Get sidebars
	if ( ! function_exists( 'lsvr_lore_get_sidebars' ) ) {
		function lsvr_lore_get_sidebars() {

			$sidebar_list = array(
				'lsvr-lore-default-sidebar' => esc_html__( 'Default Sidebar', 'lore'  ),
			);
			$custom_sidebars = lsvr_lore_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) ) {
				$sidebar_list = array_merge( $sidebar_list, $custom_sidebars );
			}

            return $sidebar_list;

		}
	}

	// Get custom sidebars
	if ( ! function_exists( 'lsvr_lore_get_custom_sidebars' ) ) {
		function lsvr_lore_get_custom_sidebars() {

			$return = array();

			$custom_sidebars = get_theme_mod( 'custom_sidebars' );
			if ( ! empty( $custom_sidebars ) && '{' === substr( $custom_sidebars, 0, 1 ) ) {

				$custom_sidebars = (array) json_decode( $custom_sidebars );
				if ( ! empty( $custom_sidebars['sidebars'] ) ) {
					$custom_sidebars = $custom_sidebars['sidebars'];
					foreach ( $custom_sidebars as $sidebar ) {
						$sidebar = (array) $sidebar;
						if ( ! empty( $sidebar['id'] ) ) {

							$sidebar_label = ! empty( $sidebar['label'] ) ? $sidebar['label'] : sprintf( esc_html__( 'Custom Sidebar %d', 'lore' ), (int) $sidebar['id'] );
							$return[ 'lsvr-lore-custom-sidebar-' . $sidebar['id'] ] = $sidebar_label;

						}
					}
				}

			}

			return $return;

		}
	}

	// Get image URL
	if ( ! function_exists( 'lsvr_lore_get_image_url' ) ) {
		function lsvr_lore_get_image_url( $image_id, $size = 'full' ) {

			$image_src = wp_get_attachment_image_src( $image_id, $size );
			return ! empty( $image_src[0] ) ? $image_src[0] : '';

		}
	}

	// Get image width
	if ( ! function_exists( 'lsvr_lore_get_image_width' ) ) {
		function lsvr_lore_get_image_width( $image_id, $size = 'full' ) {

			$image_src = wp_get_attachment_image_src( $image_id, $size );
			return ! empty( $image_src[1] ) ? $image_src[1] : '';

		}
	}

	// Get image height
	if ( ! function_exists( 'lsvr_lore_get_image_height' ) ) {
		function lsvr_lore_get_image_height( $image_id, $size = 'full' ) {

			$image_src = wp_get_attachment_image_src( $image_id, $size );
			return ! empty( $image_src[2] ) ? $image_src[2] : '';

		}
	}

	// Get image title
	if ( ! function_exists( 'lsvr_lore_get_image_title' ) ) {
		function lsvr_lore_get_image_title( $image_id ) {

			$image_title = get_the_title( $image_id );
			return ! empty( $image_title ) ? $image_title : '';

		}
	}

	// Get image alt
	if ( ! function_exists( 'lsvr_lore_get_image_alt' ) ) {
		function lsvr_lore_get_image_alt( $image_id ) {

			$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			return ! empty( $image_alt ) ? $image_alt : '';

		}
	}

	// Get social links
	if ( ! function_exists( 'lsvr_lore_get_social_links' ) ) {
		function lsvr_lore_get_social_links() {

			$social_links = array();
			$custom_social_links = array();

			// Custom social links
			for ( $i = 1; $i <= 3; $i++ ) {

				$custom_social_link_arr = array();
				$custom_social_link_icon = get_theme_mod( 'custom_social_link' . $i . '_icon', '' );
				$custom_social_link_url = get_theme_mod( 'custom_social_link' . $i . '_url', '' );
				$custom_social_link_label = get_theme_mod( 'custom_social_link' . $i . '_label', '' );
				$custom_social_link_name = 'custom' . $i;

				if ( ! empty( $custom_social_link_icon ) && ! empty( $custom_social_link_url ) ) {

					$custom_social_link_arr[ 'icon' ] = $custom_social_link_icon;
					$custom_social_link_arr[ 'url' ] = $custom_social_link_url;
					$custom_social_link_arr[ 'name' ] = $custom_social_link_name;

					if ( ! empty( $custom_social_link_label ) ) {
						$custom_social_link_arr[ 'label' ] = $custom_social_link_label;
					}

					array_push( $custom_social_links, (array) $custom_social_link_arr );

				}

			}

			// Predefined social links
			$predefined_social_links = ! empty( get_theme_mod( 'social_links', '' ) ) ? (array) @json_decode( get_theme_mod( 'social_links', '' ) ) : '';
			if ( ! empty( $predefined_social_links ) ) {
				foreach ( $predefined_social_links as $name => $predefined_social_link_arr ) {
					array_push( $social_links, (array) $predefined_social_link_arr + array( 'name' => $name )  );
				}
			}

			// Merge custom and predefined
			$custom_social_links = array_merge( $custom_social_links, apply_filters( 'lsvr_lore_add_custom_social_links', array() ) );
			$social_links = true === apply_filters( 'lsvr_lore_custom_social_links_before_predefined', true ) ? array_merge( $custom_social_links, $social_links ) : array_merge( $social_links, $custom_social_links );

			return $social_links;

		}
	}

	// Get post terms names
	if ( ! function_exists( 'lsvr_lore_get_post_term_names' ) ) {
		function lsvr_lore_get_post_term_names( $post_id, $taxonomy ) {

			$terms = get_the_terms( $post_id, $taxonomy );
			$term_names = array();

			if ( ! empty( $terms ) && is_array( $terms ) ) {
				foreach ( $terms as $tag ) {
					array_push( $term_names, $tag->name );
				}
			}
			return ! empty( $term_names ) ? $term_names : false;

		}
	}

	// Has post terms
	if ( ! function_exists( 'lsvr_lore_has_post_terms' ) ) {
		function lsvr_lore_has_post_terms( $post_id, $taxonomy ) {

			$terms = get_the_terms( $post_id, $taxonomy );
			return ! empty( $terms ) ? true : false;

		}
	}

	// Has previous post
	if ( ! function_exists( 'lsvr_lore_has_previous_post' ) ) {
		function lsvr_lore_has_previous_post() {

			$previous_post = get_adjacent_post( false, '', false );
			return ! empty( $previous_post ) ? true : false;

		}
	}

	// Has previous post thumb
	if ( ! function_exists( 'lsvr_lore_has_previous_post_thumb' ) ) {
		function lsvr_lore_has_previous_post_thumb() {

			$previous_post = get_adjacent_post( false, '', false );
			return ! empty( $previous_post->ID ) && has_post_thumbnail( $previous_post->ID ) ? true : false;

		}
	}

	// Get previous post thumb URL
	if ( ! function_exists( 'lsvr_lore_get_previous_post_thumb_url' ) ) {
		function lsvr_lore_get_previous_post_thumb_url() {

			$previous_post = get_adjacent_post( false, '', false );
			return ! empty( $previous_post->ID ) && has_post_thumbnail( $previous_post->ID ) ? get_the_post_thumbnail_url( $previous_post->ID, 'thumbnail' ) : false;

		}
	}

	// Get previous post URL
	if ( ! function_exists( 'lsvr_lore_get_previous_post_url' ) ) {
		function lsvr_lore_get_previous_post_url() {

			$previous_post = get_adjacent_post( false, '', false );
			return ! empty( $previous_post->ID ) ? get_permalink( $previous_post->ID ) : false;

		}
	}

	// Get previous post title
	if ( ! function_exists( 'lsvr_lore_get_previous_post_title' ) ) {
		function lsvr_lore_get_previous_post_title() {

			$previous_post = get_adjacent_post( false, '', false );
			return ! empty( $previous_post->post_title ) ? $previous_post->post_title : false;

		}
	}

	// Has next post
	if ( ! function_exists( 'lsvr_lore_has_next_post' ) ) {
		function lsvr_lore_has_next_post() {

			$next_post = get_adjacent_post( false, '', true );
			return ! empty( $next_post ) ? true : false;

		}
	}

	// Has next post thumb
	if ( ! function_exists( 'lsvr_lore_has_next_post_thumb' ) ) {
		function lsvr_lore_has_next_post_thumb() {

			$next_post = get_adjacent_post( false, '', true );
			return ! empty( $next_post->ID ) && has_post_thumbnail( $next_post->ID ) ? true : false;

		}
	}

	// Get next post thumb URL
	if ( ! function_exists( 'lsvr_lore_get_next_post_thumb_url' ) ) {
		function lsvr_lore_get_next_post_thumb_url() {

			$next_post = get_adjacent_post( false, '', true );
			return ! empty( $next_post->ID ) && has_post_thumbnail( $next_post->ID ) ? get_the_post_thumbnail_url( $next_post->ID, 'thumbnail' ) : false;

		}
	}

	// Get next post URL
	if ( ! function_exists( 'lsvr_lore_get_next_post_url' ) ) {
		function lsvr_lore_get_next_post_url() {

			$next_post = get_adjacent_post( false, '', true );
			return ! empty( $next_post->ID ) ? get_permalink( $next_post->ID ) : false;

		}
	}

	// Get next post title
	if ( ! function_exists( 'lsvr_lore_get_next_post_title' ) ) {
		function lsvr_lore_get_next_post_title() {

			$next_post = get_adjacent_post( false, '', true );
			return ! empty( $next_post->post_title ) ? $next_post->post_title : false;

		}
	}

	// Get post comments count
	if ( ! function_exists( 'lsvr_lore_get_post_comments_count' ) ) {
		function lsvr_lore_get_post_comments_count( $post_id = false ) {

			$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();

            $comments_count = get_comment_count( $post_id );
            $approved_count = ! empty( $comments_count['approved'] ) ? (int) $comments_count['approved'] : false;

			return ! empty( $approved_count ) ? $approved_count : 0;

		}
	}

	// Has post comments
	if ( ! function_exists( 'lsvr_lore_has_post_comments' ) ) {
		function lsvr_lore_has_post_comments( $post_id = false ) {

			$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();

            $comments_count = get_comment_count( $post_id );
            $approved_count = ! empty( $comments_count['approved'] ) ? (int) $comments_count['approved'] : false;

			return ! empty( $approved_count ) ? true : false;

		}
	}

	// Author display name
	if ( ! function_exists( 'lsvr_lore_get_author_archive_name' ) ) {
		function lsvr_lore_get_author_archive_name() {

			$author = ! empty( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
			return ! empty( $author->display_name ) ? $author->display_name : false;

		}
	}

	// Escape CSS class
	if ( ! function_exists( 'lsvr_lore_esc_css_class' ) ) {
		function lsvr_lore_esc_css_class( $class ) {

			return preg_replace( '/\W+/', '', strtolower( strip_tags( $class ) ) );

		}
	}

	// Convert hex color to RGB
	if ( ! function_exists( 'lsvr_lore_hex2rgb' ) ) {
		function lsvr_lore_hex2rgb( $hex ) {

			$hex = ltrim( $hex, '#' );
			$rgb = array();
			if ( 6 === strlen( $hex ) ) {
				array_push( $rgb, substr( $hex, 0, 2 ) );
				array_push( $rgb, substr( $hex, 2, 2 ) );
				array_push( $rgb, substr( $hex, 4, 2 ) );
				return array_map( 'hexdec', $rgb );
			}

		}
	}

	// Custom colors CSS
	if ( ! function_exists( 'lsvr_lore_get_custom_colors_css' ) ) {
		function lsvr_lore_get_custom_colors_css( $is_editor = false ) {

			$custom_colors = array(
				'accent1' => get_theme_mod( 'colors_custom_accent1', '#74aa7b' ),
				'body-link' => get_theme_mod( 'colors_custom_link', '#1565c0' ),
				'body-font' => get_theme_mod( 'colors_custom_text', '#575863' ),
			);

			$theme_version = wp_get_theme( 'lore' );
			$theme_version = $theme_version->Version;

			// Check if CSS with same colors doesn't exists in DB
			$saved_colors = get_option( 'lsvr_lore_custom_colors' );
			$saved_css = get_option( 'lsvr_lore_custom_colors_css' );
			$saved_editor_css = get_option( 'lsvr_lore_custom_editor_colors_css' );
			$saved_version = get_option( 'lsvr_lore_custom_colors_version' );

			if ( ! empty( $saved_colors ) && ! empty( $saved_css ) && ! empty( $saved_editor_css ) && $saved_colors === $custom_colors && $theme_version === $saved_version ) {
				if ( true === $is_editor ) {
					return $saved_editor_css;
				} else {
					return $saved_css;
				}
			}

			// If there is no CSS for selected colors, generate it
			else {

				$css_template = lsvr_lore_get_custom_colors_template();
				$css_editor_template = lsvr_lore_get_editor_custom_colors_template();

				if ( ! empty( $css_template ) ) {

					// Get RGB accents
					$accent1_rgb = implode( ', ', lsvr_lore_hex2rgb( $custom_colors[ 'accent1' ] ) );

					// Replace RGBA first
					$custom_css = str_replace(
						array( 'rgba( $accent1' ),
						array( 'rgba( ' . $accent1_rgb ),
						$css_template
					);
					$custom_editor_css = str_replace(
						array( 'rgba( $accent1' ),
						array( 'rgba( ' . $accent1_rgb ),
						$css_editor_template
					);

					// Replace the rest
					$custom_css = str_replace(
						array( '$accent1', '$body-link', '$body-font', "\r", "\n", "\t" ),
						array( $custom_colors[ 'accent1' ], $custom_colors[ 'body-link' ], $custom_colors[ 'body-font' ], '', '', '' ),
						$custom_css
					);
					$custom_editor_css = str_replace(
						array( '$accent1', '$body-link', '$body-font', "\r", "\n", "\t" ),
						array( $custom_colors[ 'accent1' ], $custom_colors[ 'body-link' ], $custom_colors[ 'body-font' ], '', '', '' ),
						$custom_editor_css
					);

					// Save colors and CSS to DB
					update_option( 'lsvr_lore_custom_colors', $custom_colors );
					update_option( 'lsvr_lore_custom_colors_css', $custom_css );
					update_option( 'lsvr_lore_custom_editor_colors_css', $custom_editor_css );
					update_option( 'lsvr_lore_custom_colors_version', $theme_version );

					if ( true === $is_editor ) {
						return $custom_editor_css;
					} else {
						return $custom_css;
					}

				} else {
					return '';
				}

			}

		}
	}


/**
 * HEADER
 */

	// Header search ID
	if ( ! function_exists( 'lsvr_lore_get_header_search_form_id' ) ) {
		function lsvr_lore_get_header_search_form_id() {

			global $lsvr_lore_header_search_form_id_counter;

			if ( ! isset( $lsvr_lore_header_search_form_id_counter ) ) {
				$lsvr_lore_header_search_form_id_counter = 1;
			} else {
				$lsvr_lore_header_search_form_id_counter += 1;
			}

			return $lsvr_lore_header_search_form_id_counter;

		}
	}


/**
 * CORE
 */

	// Is blog page
	if ( ! function_exists( 'lsvr_lore_is_blog' ) ) {
		function lsvr_lore_is_blog() {

			if ( is_home() || is_post_type_archive( 'post' ) || is_category() || is_singular( 'post' ) ||
				is_tag() || is_day() || is_month() || is_year() || is_author() ) {
				return true;
			} else {
				return false;
			}

		}
	}

	// Get blog archive title
	if ( ! function_exists( 'lsvr_lore_get_blog_archive_title' ) ) {
		function lsvr_lore_get_blog_archive_title() {

			if ( get_option( 'page_for_posts' ) ) {
				return esc_html( get_the_title( get_option( 'page_for_posts' ) ) );
			} else {
				return esc_html__( 'Blog', 'lore' );
			}

		}
	}


/**
 * FOOTER
 */

	// Has footer social links
	if ( ! function_exists( 'lsvr_lore_has_footer_social_links' ) ) {
		function lsvr_lore_has_footer_social_links() {

			$social_links = lsvr_lore_get_social_links();
			return ! empty( $social_links ) && true === get_theme_mod( 'footer_social_links_enable', true ) ? true : false;

		}
	}

	// Footer widgets before widget
	if ( ! function_exists( 'lsvr_lore_get_footer_widgets_before_widget' ) ) {
		function lsvr_lore_get_footer_widgets_before_widget() {

			$columns = (int) get_theme_mod( 'footer_widgets_columns', 3 );
			$span = 12 / $columns;
			$span_lg = $columns >= 2 ? 6 : 12;
			$span_md = $columns >= 2 ? 6 : 12;

			$return = '<div class="footer-widgets__column lsvr-grid__col lsvr-grid__col--span-' . esc_attr( $span );
			$return .= ' lsvr-grid__col--md lsvr-grid__col--md-span-' . esc_attr( $span_md );
			$return .= ' lsvr-grid__col--lg lsvr-grid__col--lg-span-' . esc_attr( $span_lg ) . '">';
			$return .= '<div class="footer-widgets__column-inner"><div id="%1$s" class="widget %2$s"><div class="widget__inner">';

			return $return;

		}
	}

	// Footer widgets after widget
	if ( ! function_exists( 'lsvr_lore_get_footer_widgets_after_widget' ) ) {
		function lsvr_lore_get_footer_widgets_after_widget() {

			return '</div></div></div></div>';

		}
	}

?>