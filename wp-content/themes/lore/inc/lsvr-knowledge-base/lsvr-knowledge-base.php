<?php

// Include additional files
require_once( get_template_directory() . '/inc/lsvr-knowledge-base/actions.php' );
require_once( get_template_directory() . '/inc/lsvr-knowledge-base/frontend-functions.php' );
require_once( get_template_directory() . '/inc/lsvr-knowledge-base/customizer-config.php' );
require_once( get_template_directory() . '/inc/lsvr-knowledge-base/ajax-kba-rating.php' );

// Is KB page
if ( ! function_exists( 'lsvr_lore_is_kba' ) ) {
	function lsvr_lore_is_kba() {

		if ( is_post_type_archive( 'lsvr_kba' ) || is_tax( 'lsvr_kba_cat' ) || is_tax( 'lsvr_kba_tag' ) ||
			is_singular( 'lsvr_kba' ) ) {
			return true;
		} else {
			return false;
		}

	}
}

// Get article archive title
if ( ! function_exists( 'lsvr_lore_get_kba_archive_title' ) ) {
	function lsvr_lore_get_kba_archive_title() {

		return get_theme_mod( 'lsvr_kba_archive_title', esc_html__( 'Knowledge Base', 'lore' ) );

	}
}

// Get top categories
if ( ! function_exists( 'lsvr_lore_get_kba_top_categories' ) ) {
	function lsvr_lore_get_kba_top_categories() {

		return get_terms( 'lsvr_kba_cat', array(
			'parent' => 0,
		));

	}
}

// Get subcategories
if ( ! function_exists( 'lsvr_lore_get_kba_subcategories' ) ) {
	function lsvr_lore_get_kba_subcategories( $term_id ) {

		return wp_list_filter( get_terms( 'lsvr_kba_cat', array(
			'child_of' => $term_id,
			'pad_counts' => true,
			)), array(
				'parent' => $term_id,
			)
		);

	}
}


// Get category articles
if ( ! function_exists( 'lsvr_lore_get_kba_category_posts' ) ) {
	function lsvr_lore_get_kba_category_posts( $term_id ) {

		// Prepare args
		$query_args = array(
			'post_type' => 'lsvr_kba',
			'posts_per_page' => (int) get_theme_mod( 'lsvr_kba_archive_posts_per_category', 10 ) > 0 ? get_theme_mod( 'lsvr_kba_archive_posts_per_category', 10 ) : 1000,
			'tax_query' => array(
				array(
					'taxonomy' => 'lsvr_kba_cat',
					'field' => 'id',
					'terms' => $term_id,
					'include_children' => false,
				)
			),
		);

		// Order
		if ( 'date_desc' == get_theme_mod( 'lsvr_kba_archive_order', 'default' ) ) {
			$query_args['order'] = 'DESC';
			$query_args['orderby'] = 'date';
		}
		elseif ( 'date_asc' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {
			$query_args['order'] = 'ASC';
			$query_args['orderby'] = 'date';
		}
		elseif ( 'title_asc' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {
			$query_args['order'] = 'ASC';
			$query_args['orderby'] = 'title';
		}
		elseif ( 'title_desc' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {
			$query_args['order'] = 'DESC';
			$query_args['orderby'] = 'title';
		}
		elseif ( 'random' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {
			$query_args['orderby'] = 'rand';
		}
		elseif ( 'rating' == get_theme_mod( 'lsvr_kba_archive_order', 'default' )  ) {

			$rating_type = get_theme_mod( 'lsvr_kba_rating_enable', 'disable' );
			if ( 'disable' !== $rating_type ) {

				$query_args['order'] = 'DESC';
				$query_args['orderby'] = 'meta_value_num date';

				if ( 'both' === $rating_type || 'sum' === $rating_type ) {
					$meta_query_key = 'lsvr_kba_rating_sum';
				}
				else {
					$meta_query_key = 'lsvr_kba_likes' ;
				}

				$query_args['meta_query'] = array(
						'relation' => 'OR',
  					array(
        				'key' => $meta_query_key,
        				'compare' => 'NOT EXISTS',
    				),
    				array(
        				'key' => $meta_query_key,
        				'compare' => 'EXISTS',
    				),
				);

			}

		}

		// Get posts
		return get_posts( $query_args );

	}
}

// Get article attachments
if ( ! function_exists( 'lsvr_lore_get_kba_attachments' ) ) {
	function lsvr_lore_get_kba_attachments( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_attachments' ) ) {

			return lsvr_knowledge_base_get_kba_attachments( $post_id );

		}
	}
}

// Has article attachments
if ( ! function_exists( 'lsvr_lore_has_kba_attachments' ) ) {
	function lsvr_lore_has_kba_attachments( $post_id ) {

		$attachments = lsvr_lore_get_kba_attachments( $post_id );
		return ! empty( $attachments ) ? true : false;

	}
}

// Abbreviate number
if ( ! function_exists( 'lsvr_lore_abbreviate_number' ) ) {
	function lsvr_lore_abbreviate_number( $number ) {
		if ( function_exists( 'lsvr_knowledge_base_abbreviate_number' ) ) {

			return lsvr_knowledge_base_abbreviate_number( $number );

		}
	}
}

// Get article likes
if ( ! function_exists( 'lsvr_lore_get_kba_likes' ) ) {
	function lsvr_lore_get_kba_likes( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_rating' ) ) {

			$rating = lsvr_knowledge_base_get_kba_rating( $post_id );
			return ! empty( $rating['likes'] ) ? (int) $rating['likes'] : 0;

		}
	}
}

// Get article abbreviated likes
if ( ! function_exists( 'lsvr_lore_get_kba_likes_abb' ) ) {
	function lsvr_lore_get_kba_likes_abb( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_rating' ) ) {

			$rating = lsvr_knowledge_base_get_kba_rating( $post_id );
			return ! empty( $rating['likes_abb'] ) ? $rating['likes_abb'] : 0;

		}
	}
}

// Get article dislikes
if ( ! function_exists( 'lsvr_lore_get_kba_dislikes' ) ) {
	function lsvr_lore_get_kba_dislikes( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_rating' ) ) {

			$rating = lsvr_knowledge_base_get_kba_rating( $post_id );
			return ! empty( $rating['dislikes'] ) ? $rating['dislikes'] : 0;

		}
	}
}

// Get article abbreviated dislikes
if ( ! function_exists( 'lsvr_lore_get_kba_dislikes_abb' ) ) {
	function lsvr_lore_get_kba_dislikes_abb( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_rating' ) ) {

			$rating = lsvr_knowledge_base_get_kba_rating( $post_id );
			return ! empty( $rating['dislikes_abb'] ) ? $rating['dislikes_abb'] : 0;

		}
	}
}

// Get article rating sum
if ( ! function_exists( 'lsvr_lore_get_kba_rating_sum' ) ) {
	function lsvr_lore_get_kba_rating_sum( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_rating' ) ) {

			$rating = lsvr_knowledge_base_get_kba_rating( $post_id );
			return ! empty( $rating['sum'] ) ? (int) $rating['sum'] : 0;

		}
	}
}

// Get article rating abbreviated sum
if ( ! function_exists( 'lsvr_lore_get_kba_rating_sum_abb' ) ) {
	function lsvr_lore_get_kba_rating_sum_abb( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_rating' ) ) {

			$rating = lsvr_knowledge_base_get_kba_rating( $post_id );
			return ! empty( $rating['sum_abb'] ) ? $rating['sum_abb'] : 0;

		}
	}
}

// Get article rating abbreviated absolute sum
if ( ! function_exists( 'lsvr_lore_get_kba_rating_sum_abs_abb' ) ) {
	function lsvr_lore_get_kba_rating_sum_abs_abb( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_rating' ) ) {

			$rating = lsvr_knowledge_base_get_kba_rating( $post_id );
			return ! empty( $rating['sum_abs_abb'] ) ? $rating['sum_abs_abb'] : 0;

		}
	}
}

// Get article related articles
if ( ! function_exists( 'lsvr_lore_get_kba_related' ) ) {
	function lsvr_lore_get_kba_related( $post_id ) {
		if ( function_exists( 'lsvr_knowledge_base_get_kba_related_articles' ) ) {

			$related = lsvr_knowledge_base_get_kba_related_articles( $post_id,get_theme_mod( 'lsvr_kba_single_related_limit', 5 ) );
			return ! empty( $related ) ? $related : false;

		}
	}
}

// Get category icon
if ( ! function_exists( 'lsvr_lore_get_kba_cat_icon' ) ) {
	function lsvr_lore_get_kba_cat_icon( $term_id ) {

		$category_meta = get_option( 'lsvr_kba_cat_term_' . $term_id . '_meta' );
    	return ! empty( $category_meta['icon'] ) ? $category_meta['icon'] : '';

	}
}

?>