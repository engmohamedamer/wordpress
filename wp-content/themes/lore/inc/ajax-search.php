<?php

// Ajax search
add_action( 'wp_ajax_nopriv_lsvr-lore-ajax-search', 'lsvr_lore_ajax_search' );
add_action( 'wp_ajax_lsvr-lore-ajax-search', 'lsvr_lore_ajax_search' );
if ( ! function_exists( 'lsvr_lore_ajax_search' ) ) {
	function lsvr_lore_ajax_search() {

		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'lsvr-lore-ajax-search-nonce' ) ) {
			die ( esc_html__( 'You do not have permission to do this action.', 'lore' ) );
		}

		// Get search query
		if ( isset( $_POST['search_query'] ) && ! empty( $_POST['search_query'] ) ) {
			$search_query = sanitize_text_field( $_POST['search_query'] );
		} else {
			$search_query = '';
		}

		// Get post type
		if ( isset( $_POST['post_type'] ) && ! empty( $_POST['post_type'] ) ) {
			$post_type = array_filter( array_map( 'sanitize_key', explode( ',', $_POST['post_type'] ) ) );
		} else {
			$post_type = 'any';
		}

		if ( ! empty( $search_query ) ) {

			// Search query args
			$args = array(
				'posts_per_page' => (int) get_theme_mod( 'header_search_ajax_limit', 10 ) + 1,
				'post_type' => $post_type,
				's' => $search_query,
			);

			// Do search query
			$search_results = get_posts( $args );

			// If has results
			if ( ! empty( $search_results ) ) {

				$search_results_sliced = array_slice( $search_results, 0, get_theme_mod( 'header_search_ajax_limit', 10 ) );
				$search_results_parsed = [];
				foreach ( $search_results_sliced as $result ) {

					$result_details = array(
						'ID' => $result->ID,
						'post_title' => $result->post_title,
						'permalink' => get_permalink( $result->ID ),
						'post_type' => $result->post_type,
					);

					// If it is a KBA post, attach rating
					if ( 'lsvr_kba' === $result->post_type && true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true )
						&& 'disable' !== get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) {

						$result_details['rating_likes_abb'] = lsvr_lore_get_kba_likes_abb( $result->ID );
						$result_details['rating_dislikes_abb'] = lsvr_lore_get_kba_dislikes_abb( $result->ID );
						$result_details['rating_sum_abb'] = lsvr_lore_get_kba_rating_sum_abs_abb( $result->ID );
						$result_details['rating_sum'] = lsvr_lore_get_kba_rating_sum( $result->ID );

					}

					// If post is a bbPress reply CPT, we need to get title of its parent topic
					if ( function_exists( 'bbp_get_reply_topic_title' ) && 'reply' === $result->post_type ) {
						$topic_title = bbp_get_reply_topic_title( $result->ID );
						$result_details['post_title'] = sprintf( esc_html__( 'Reply To: %s', 'lore' ), $topic_title );
					}

					$search_results_parsed[] = $result_details;

				}

				// Prepare array with search results
				if ( ! empty( $search_results_parsed ) ) {

					$response = array(
	        			'status' => 'ok',
	        			'results' => $search_results_parsed,
	    			);

	    			// Add rating type
	    			if ( 'disable' !== get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) {
	    				$response['rating_type'] = get_theme_mod( 'lsvr_kba_rating_enable', 'disable' );
	    			}

					// Add "more link" to response if needed
	    			if ( count( $search_results ) > get_theme_mod( 'header_search_ajax_limit', 10 ) ) {
	    				$response['more_label'] =  'رؤية جميع النتائج';
	    				$response['more_link'] = esc_url( add_query_arg( array(
	    					's' => $search_query,
	    					'lsvr-search-filter-serialized' => implode( ',', $post_type ),
						), home_url( '/' ) ) );
	    			}

				}

				// No results
				else {
					$response = array(
	        			'status' => 'noresults',
        				'message' => 'لا توجد نتائج لبحثك',
	    			);
				}

    			// echo JSON response
				echo json_encode( $response );

			}

			// If no results
			else {

				echo json_encode(array(
        			'status' => 'noresults',
							'message' => 'لا توجد نتائج لبحثك',
    			));

			}

		}

		wp_die();

	}
}

?>
