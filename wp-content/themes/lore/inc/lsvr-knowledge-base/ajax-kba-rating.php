<?php

// Knowledge Base ajax post rating
add_action( 'wp_ajax_nopriv_lsvr-lore-ajax-kba-rating', 'lsvr_lore_kba_rating' );
add_action( 'wp_ajax_lsvr-lore-ajax-kba-rating', 'lsvr_lore_kba_rating' );
if ( ! function_exists( 'lsvr_lore_kba_rating' ) ) {
	function lsvr_lore_kba_rating() {

		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'lsvr-lore-ajax-kba-rating-nonce' ) ) {
			die ( esc_html__( 'You do not have permission to rate', 'lore' ) );
		}

		$post_id = $_POST['post_id'];
		$rating_type = isset( $_POST['rating_type'] ) && 'dislike' === $_POST['rating_type'] ? 'dislike' : 'like';

		// Get votes count for the current post
		$meta_likes = '' !== get_post_meta( $post_id, 'lsvr_kba_likes', true ) ? get_post_meta( $post_id, 'lsvr_kba_likes', true ) : 0;
		$meta_dislikes = '' !== get_post_meta( $post_id, 'lsvr_kba_dislikes', true ) ? get_post_meta( $post_id, 'lsvr_kba_dislikes', true ) : 0;

		// User has already voted ?
		if ( ! lsvr_lore_kba_already_rated( $post_id ) ) {

    		// Save the rating cookie
    		$cookie_expiration_date = get_theme_mod( 'lsvr_kba_rating_interval', 'month' );
    		switch ( $cookie_expiration_date ) {
				case '1hour':
					$cookie_expiration_date_seconds = 3600;
					break;
				case 'day':
					$cookie_expiration_date_seconds = 60*60*24;
					break;
				case 'week':
					$cookie_expiration_date_seconds = 60*60*24*7;
					break;
				case 'month':
					$cookie_expiration_date_seconds = 60*60*24*30;
					break;
				case 'threemonths':
					$cookie_expiration_date_seconds = 60*60*24*90;
					break;
				case 'sixmonths':
					$cookie_expiration_date_seconds = 60*60*24*180;
					break;
				case 'year':
					$cookie_expiration_date_seconds = 60*60*24*365;
					break;
				case 'tenyears':
					$cookie_expiration_date_seconds = 60*60*24*3650;
					break;
    		}
    		if ( empty( $cookie_expiration_date_seconds ) ) {
    			$cookie_expiration_date_seconds = 60*60*24*30;
    		}
    		setcookie( 'lsvr_lore_kba_rating_' . $post_id, $rating_type, time() + $cookie_expiration_date_seconds, COOKIEPATH, COOKIE_DOMAIN );

    		// Like
    		if ( 'like' === $rating_type ) {
    			update_post_meta( $post_id, 'lsvr_kba_likes', (int) ++$meta_likes );
    		}

    		// Dislike
    		else {
    			update_post_meta( $post_id, 'lsvr_kba_dislikes', (int) ++$meta_dislikes );
    		}

    		// Update sum
    		update_post_meta( $post_id, 'lsvr_kba_rating_sum', (int) ( $meta_likes - $meta_dislikes ) );

    		$json_reponse = array(
    			'status' => 'rating_saved',
			);

		} else {

			$json_reponse = array(
    			'status' => 'already_rated',
			);

		}

		$json_reponse = array_merge( $json_reponse, array(
			'likes' => $meta_likes,
			'dislikes' => $meta_dislikes,
            'sum' => (int) $meta_likes - (int) $meta_dislikes,
            'sum_abs' => abs( (int) $meta_likes - (int) $meta_dislikes ),
			'likes_abb' => lsvr_lore_abbreviate_number( $meta_likes ),
			'dislikes_abb' => lsvr_lore_abbreviate_number( $meta_dislikes ),
            'sum_abb' => lsvr_lore_abbreviate_number( (int) $meta_likes - (int) $meta_dislikes ),
            'sum_abs_abb' => lsvr_lore_abbreviate_number( abs( (int) $meta_likes - (int) $meta_dislikes ) ),
			'likes_btn_title' => sprintf( esc_html( '%d likes', 'lore' ), $meta_likes ),
			'dislikes_btn_title' => sprintf( esc_html( '%d dislikes', 'lore' ), $meta_dislikes ),
            'message_success' => esc_html__( 'Thanks for your rating', 'lore' ),
            'message_already_rated' => esc_html__( 'You have already rated this article', 'lore' ),
            'message_error' => esc_html( 'An error occured, please try again later', 'lore' ),
		));

		echo json_encode( $json_reponse );

		wp_die();

	}
}

// Function to check if user already rated
if ( ! function_exists( 'lsvr_lore_kba_already_rated' ) ) {
    function lsvr_lore_kba_already_rated( $post_id ) {

        if ( isset( $_COOKIE[ 'lsvr_lore_kba_rating_' . $post_id ] ) ) {
            return true;
        }

        return false;

    }
}

?>