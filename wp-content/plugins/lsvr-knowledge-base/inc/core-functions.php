<?php

/**
 * Get article attachments
 *
 * @param int 		$post_id	lsvr_kba post ID.
 *
 * @return array 	Array with article attachments.
 */
if ( ! function_exists( 'lsvr_knowledge_base_get_kba_attachments' ) ) {
	function lsvr_knowledge_base_get_kba_attachments( $post_id ) {

		$return = array();

		// Local attachments
		$local_attachment_meta = get_post_meta( $post_id, 'lsvr_kba_local_attachments', true );
		$local_attachment_ids = ! empty( $local_attachment_meta ) ? array_map( 'intval', explode( ',', $local_attachment_meta ) ) : false;
		if ( ! empty( $local_attachment_ids ) ) {

			foreach ( $local_attachment_ids as $attachment_id ) {

				$filename = basename( get_attached_file( $attachment_id ) );
				$filesize = (int) filesize( get_attached_file( $attachment_id ) );
				$filesize = $filesize > 0 ? lsvr_knowledge_base_convert_filesize( $filesize ) : false;

				array_push( $return, array(
					'id' => $attachment_id,
					'title' => get_the_title( $attachment_id ),
					'filename' => $filename,
					'url' => wp_get_attachment_url( $attachment_id ),
					'extension' => pathinfo( $filename, PATHINFO_EXTENSION ),
					'filetype' => lsvr_knowledge_base_get_attachment_filetype( pathinfo( $filename, PATHINFO_EXTENSION ) ),
					'filesize' => $filesize,
					'external' => false,
				));

			}
		}

		// External attachments
		$external_attachments_meta = get_post_meta( $post_id, 'lsvr_kba_external_attachments', true );
		$external_attachment_urls = ! empty( $external_attachments_meta ) ? explode( '|', $external_attachments_meta ) : false;
		if ( ! empty( $external_attachment_urls ) ) {

			foreach ( $external_attachment_urls as $attachment_url ) {

				$filename = basename( $attachment_url );

				array_push( $return, array(
					'title' => $filename,
					'filename' => $filename,
					'url' => $attachment_url,
					'extension' => pathinfo( $filename, PATHINFO_EXTENSION ),
					'filetype' => lsvr_knowledge_base_get_attachment_filetype( pathinfo( $filename, PATHINFO_EXTENSION ) ),
					'external' => true,
				));

			}

		}

		return $return;

	}
}

/**
 * Get file type based on extension.
 *
 * @param string 	$extension	File extension.
 *
 * @return string 	File type.
 */
if ( ! function_exists( 'lsvr_knowledge_base_get_attachment_filetype' ) ) {
	function lsvr_knowledge_base_get_attachment_filetype( $extension ) {

		$image = array( 'gif', 'tiff', 'bmp', 'jpg', 'jpeg', 'png' );
		$audio = array( 'aac', 'ogg', 'm4a', 'flac', 'mp3', 'wav' );
		$video = array( 'mkv', 'webm', 'flv', 'wmv', 'mp4', 'mpg', 'mpeg', 'm4v', '3gp', 'avi', 'mov' );

		if ( in_array( $extension, $image ) ) {
			return 'image';
		}
		elseif ( in_array( $extension, $audio ) ) {
			return 'audio';
		}
		elseif ( in_array( $extension, $video ) ) {
			return 'video';
		}
		else {
			return $extension;
		}

	}
}

/**
 * Convert bytes
 *
 * @param int 		$bytes	Number of bytes.
 *
 * @return string 	Converted value.
 */
if ( ! function_exists( 'lsvr_knowledge_base_convert_filesize' ) ) {
	function lsvr_knowledge_base_convert_filesize( $bytes ) {

		$bytes = floatval( $bytes );
		$bytes_arr = array(
			0 => array(
				'unit' => esc_html__( '%s TB', 'lsvr-knowledge-base' ),
				'value' => pow( 1024, 4 )
			),
			1 => array(
				'unit' => esc_html__( '%s GB', 'lsvr-knowledge-base' ),
				'value' => pow( 1024, 3 )
			),
			2 => array(
				'unit' => esc_html__( '%s MB', 'lsvr-knowledge-base' ),
				'value' => pow( 1024, 2 )
			),
			3 => array(
				'unit' => esc_html__( '%s kB', 'lsvr-knowledge-base' ),
				'value' => 1024
			),
			4 => array(
				'unit' => esc_html__( '%s B', 'lsvr-knowledge-base' ),
				'value' => 1
			),
		);

		foreach( $bytes_arr as $item ) {
			if ( $bytes >= $item['value'] ) {
				$result = $bytes / $item['value'];
				$result = str_replace( '.', ',', strval( round( $result, 0 ) ) );
				$result = sprintf( $item['unit'], $result );
				break;
			}
		}
		return $result;

	}
}


/**
 * Abbreviate number
 *
 * @param int 	$number		Integer number.
 *
 * @return string 	Abgreviated number.
 */
if ( ! function_exists( 'lsvr_knowledge_base_abbreviate_number' ) ) {
	function lsvr_knowledge_base_abbreviate_number( $number ) {

		$postfixes = array( '%d', esc_html__( '%dk', 'lore' ), esc_html__( '%dM', 'lsvr-knowledge-base' ) );
		$sign = $number < 0 ? -1 : 1;
		$number = abs( (int) $number );

		if ( 0 !== $number ) {
			$postfix_index = abs( floor( log( $number, 1000 ) ) > 2 ? 2 : floor( log( $number, 1000 ) ) );
			$number = round( $number / pow( 1000, $postfix_index ), 1 );
			return sprintf( $postfixes[ $postfix_index ], $number * $sign );
		} else {
			return $number * $sign;
		}

	}
}

/**
 * Return article rating
 *
 * @param int 	$post_id		Post ID of lsvr_kba post.
 *
 * @return array 	Article rating data.
 */
if ( ! function_exists( 'lsvr_knowledge_base_get_kba_rating' ) ) {
	function lsvr_knowledge_base_get_kba_rating( $post_id ) {

		// Get article rating from meta
		return array(
			'likes' => (int) get_post_meta( $post_id, 'lsvr_kba_likes', true ),
			'likes_abb' => lsvr_knowledge_base_abbreviate_number( (int) get_post_meta( $post_id, 'lsvr_kba_likes', true ) ),
			'dislikes' => (int) get_post_meta( $post_id, 'lsvr_kba_dislikes', true ),
			'dislikes_abb' => lsvr_knowledge_base_abbreviate_number( (int) get_post_meta( $post_id, 'lsvr_kba_dislikes', true ) ),
			'sum' => (int) get_post_meta( $post_id, 'lsvr_kba_rating_sum', true ),
			'sum_abb' => lsvr_knowledge_base_abbreviate_number( (int) get_post_meta( $post_id, 'lsvr_kba_rating_sum', true ) ),
			'sum_abs_abb' => lsvr_knowledge_base_abbreviate_number( abs( (int) get_post_meta( $post_id, 'lsvr_kba_rating_sum', true ) ) ),
		);

	}
}

/**
 * Return list of related articles
 *
 * @param int 	$post_id		Post ID of lsvr_kba post.
 * @param int 	$random_limit			Number of random related articles.
 *
 * @return array 	List of related articles.
 */
if ( ! function_exists( 'lsvr_knowledge_base_get_kba_related_articles' ) ) {
	function lsvr_knowledge_base_get_kba_related_articles( $post_id, $random_limit = 5 ) {

    	$query_args = array(
    		'post_type' => 'lsvr_kba',
    		'suppress_filters' => false,
		);

		$related_articles_arr = array_map( 'trim', explode( ',', get_post_meta( $post_id, 'lsvr_kba_related_articles', true ) ) );

		// Convert slugs to IDs
		foreach ( $related_articles_arr as $index => $related_id ) {
			if ( ! is_numeric( $related_id ) ) {

				$post = get_page_by_path( $related_id, OBJECT, 'lsvr_kba' );

				if ( ! empty( $post->ID ) ) {
					$related_articles_arr[ $index ] = $post->ID;
				} else {
					unset( $related_articles_arr[ $index ] );
				}

			}
		}

		// Return chosen articles
		if ( ! empty( $related_articles_arr ) ) {
			$query_args['post__in'] = array_map( 'intval', $related_articles_arr );
		}

		// Return random articles from the same category
		else {

			$query_args['posts_per_page'] = (int) $random_limit < 1 ? 1000 : (int) $random_limit;
			$query_args['orderby'] = 'rand';
			$query_args['exclude'] = array( $post_id );

			$post_terms = wp_get_post_terms( $post_id, 'lsvr_kba_cat' );
			$post_term = ! empty( $post_terms ) ? reset( $post_terms ) : false;
			$post_term_id = ! empty( $post_term->term_id ) ? $post_term->term_id : false;
			if ( ! empty( $post_term_id ) ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'lsvr_kba_cat',
						'field' => 'id',
						'terms' => $post_term_id,
						'include_children' => false,
					),
				);
			}

		}

    	$posts = get_posts( $query_args );
    	$return = array();

    	// Parse posts
    	if ( ! empty( $posts ) ) {
    		foreach ( $posts as $post ) {

    			$return[ $post->ID ] = array(
    				'post_title' => $post->post_title,
    				'url' => get_permalink( $post->ID ),
    				'post_format' => ! empty( get_post_format( $post->ID ) ) ? get_post_format( $post->ID ) : 'default',
    				'rating' => lsvr_knowledge_base_get_kba_rating( $post->ID ),
				);

    		}
    	}

		return $return;

	}
}

?>