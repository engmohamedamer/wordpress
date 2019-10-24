<?php
/**
 * Main function to retrieve FAQ.
 *
 * @param array $args {
 *		Optional. An array of arguments. If not defined, function will return all FAQ
 *
 *		@type int|array		$faq_id			Single ID or array of IDs of lsvr_faq post(s).
 *											Only these FAQ will be returned.
 *											Leave blank to retrieve all lsvr_faq posts.
 *
 *		@type int			$limit			Max number of FAQ to retrieve.
 *
  *		@type int|array		$category		Category or categories from which to retrieve FAQ.
 *
 *		@type string		$orderby		Set how to order FAQ.
 *											Accepts standard values for orderby argument in WordPress get_posts function.
 *
 *		@type string		$order			Set order of returned FAQ as ascending or descending.
 *											Default 'DESC'. Accepts 'ASC', 'DESC'.
 * }
 * @return array 	Array with all FAQ posts.
 */
if ( ! function_exists( 'lsvr_faq_get' ) ) {
	function lsvr_faq_get( $args = array() ) {

		// FAQ ID
		if ( ! empty( $args['faq_id'] ) ) {
			if ( is_array( $args['faq_id'] ) ) {
				$faq_id = array_map( 'intval', $args['faq_id'] );
			} else {
				$faq_id = array( (int) $args['faq_id'] );
			}
		} else {
			$faq_id = false;
		}

		// Get number of FAQ
		if ( ! empty( $args['limit'] ) && is_numeric( $args['limit'] ) ) {
			$limit = (int) $args['limit'];
		} else {
			$limit = 1000;
		}

		// Get category
		if ( ! empty( $args['category'] ) ) {
			if ( is_array( $args['category'] ) ) {
				$category = array_map( 'intval', $args['category'] );
			} else {
				$category = array( (int) $args['category'] );
			}
		} else {
			$category = false;
		}

		// Get orderby of FAQ
		if ( ! empty( $args['orderby'] ) ) {
			$orderby = esc_attr( $args['orderby'] );
		} else {
			$orderby = 'date';
		}

		// Get order of FAQ
		$order = ! empty( $args['order'] ) && 'ASC' === strtoupper( $args['order'] ) ? 'ASC' : 'DESC';

		// Tax query
		if ( ! empty( $category ) ) {
			$tax_query = array(
				array(
					'taxonomy' => 'lsvr_faq_cat',
					'field' => 'term_id',
					'terms' => $category,
				),
			);
		} else {
			$tax_query = false;
		}

		// Get all FAQ posts
		$faq_posts = get_posts(array(
			'post_type' => 'lsvr_faq',
			'post__in' => $faq_id,
			'posts_per_page' => $limit,
			'orderby' => $orderby,
			'order' => $order,
			'tax_query' => $tax_query,
			'suppress_filters' => false,
		));

		// Add FAQ posts to $return
		if ( ! empty( $faq_posts ) ) {
			$return = array();
			foreach ( $faq_posts as $faq_post ) {
				if ( ! empty( $faq_post->ID ) ) {
					$return[ $faq_post->ID ]['post'] = $faq_post;
				}
			}
		}

		// Return FAQ
		return ! empty( $return ) ? $return : false;

	}
}

?>