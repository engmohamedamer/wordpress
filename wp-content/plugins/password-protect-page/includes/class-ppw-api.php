<?php
/**
 * Created by PhpStorm.
 * User: gaupoit
 * Date: 8/28/19
 * Time: 20:25
 */

if ( ! class_exists( 'PPW_API' ) ) {
	/**
	 * API definitions
	 */
	class PPW_API {

		/**
		 * Register rest routes
		 */
		public function register_rest_routes() {
			register_rest_route(
				'wppp/v1',
				'check-content-password/(?P<id>\d+)',
				array(
					'methods'  => 'POST',
					'callback' => array(
						$this,
						'ppwp_check_content_password',
					),
				)
			);
		}

		/**
		 * Checking the content passwords
		 *
		 * @param array $data Post data.
		 *
		 * @return bool
		 */
		public function ppwp_check_content_password( $data ) {

			do_action( PPW_Constants::HOOK_RESTRICT_CONTENT_BEFORE_CHECK_PWD, $data );

			$result = array(
				'isValid' => false,
				'message' => apply_filters( PPW_Constants::HOOK_RESTRICT_CONTENT_ERROR_MESSAGE, PPW_Constants::DEFAULT_WRONG_PASSWORD_MESSAGE ),
			);

			if ( ! $this->is_valid_data_content_password( $data ) ) {
				return wp_send_json(
					$result,
					400
				);
			}

			$post = get_post( $data['id'] );

			if ( is_null( $post ) ) {
				return wp_send_json(
					$result,
					400
				);
			}

			if ( ! has_shortcode( $post->post_content, PPW_Constants::PPW_HOOK_SHORT_CODE_NAME ) ) {
				return wp_send_json(
					$result,
					400
				);
			}

			if ( function_exists( 'generate_postdata' ) ) {
				$postdata = generate_postdata( $post );
				$pages    = $postdata['pages'];
			} else {
				$postdata = setup_postdata( $post );
				global $pages;
			}

			if ( false === $postdata ) {
				return wp_send_json(
					$result,
					400
				);
			}

			$matches = $this->search_shortcode_content( $pages[ $data['page'] - 1 ] );
			$matches = $this->filter_short_code_matches( $matches, PPW_Constants::PPW_HOOK_SHORT_CODE_NAME );


			if ( ! isset( $matches[ $data['idx'] ] ) ) {
				return wp_send_json(
					$result,
					400
				);
			}

			$shortcode = $matches[ $data['idx'] ];

			if ( $this->is_valid_password( $shortcode, $data['pss'] ) ) {
				$result['isValid'] = true;
				$result['message'] = '';
				do_action( PPW_Constants::HOOK_RESTRICT_CONTENT_AFTER_VALID_PWD, $post, $data['pss'] );
			}

			return wp_send_json(
				$result,
				200
			);
		}

		/**
		 * Validate input data.
		 *
		 * @param array $data POST data.
		 *
		 * @return bool
		 */
		private function is_valid_data_content_password( $data ) {
			return isset( $data['id'] ) && isset( $data['page'] );
		}

		/**
		 * Checking the password is valid in short code attribute.
		 * Sample data:
		 * Array
		 * (
		 *   [0] => [ppwp passwords="123456 123"]This is the content under Group2[/ppwp]
		 *   [1] =>
		 *   [2] => ppwp
		 *   [3] =>  passwords="123456 123"
		 *   [4] =>
		 *   [5] => This is the content under Group2
		 *   [6] =>
		 *  ).
		 *
		 * @param array $shortcode The found short codes in the content.
		 *
		 * @param string $password Password from request.
		 *
		 * @return bool
		 */
		private function is_valid_password( $shortcode, $password ) {
			if ( PPW_Constants::PPW_HOOK_SHORT_CODE_NAME !== $shortcode[2] ) {
				return false;
			}

			$atts      = $this->get_attributes( trim( $shortcode[3] ) );
			$passwords = array_filter( $atts['passwords'], 'strlen' );
			if ( in_array( $password, $passwords, true ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Search shortcode content
		 *
		 * @param string $content The post content.
		 *
		 * @return mixed
		 */
		private function search_shortcode_content( $content ) {
			preg_match_all( '/' . get_shortcode_regex() . '/', $content, $matches, PREG_SET_ORDER );

			return $matches;
		}

		/**
		 * Get attributes from shortcode
		 *
		 * @param string $atts Shortcode attributes in string type.
		 *
		 * @return array
		 */
		private function get_attributes( $atts ) {
			$parsed_atts = shortcode_parse_atts( $atts );
			if ( ! array_key_exists( 'passwords', $parsed_atts ) ) {
				$parsed_atts['passwords'] = [];

				return $parsed_atts;
			}

			$parsed_atts['passwords'] = array_map(
				function ( $p ) {
					return wp_specialchars_decode( $p );
				},
				explode( ' ', $parsed_atts['passwords'] )
			);

			return $parsed_atts;
		}

		/**
		 * Filter short code result by name
		 *
		 * @param array $result The result need to filter.
		 * @param string $shortcode_name Short code name.
		 *
		 * @return array
		 */
		private function filter_short_code_matches( $result, $shortcode_name ) {
			return array_values(
				array_filter(
					$result,
					function ( $match ) use ( $shortcode_name ) {
						return isset( $match[2] ) && $shortcode_name === $match[2];
					}
				)
			);
		}

		/**
		 * Generate post data.
		 *
		 * @since 5.2.0
		 *
		 * @param WP_Post|object|int $post WP_Post instance or Post ID/object.
		 *
		 * @return array|bool $elements Elements of post or false on failure.
		 */
		private function generate_postdata( $post ) {

			if ( ! ( $post instanceof WP_Post ) ) {
				$post = get_post( $post );
			}

			if ( ! $post ) {
				return false;
			}

			$id = (int) $post->ID;

			$authordata = get_userdata( $post->post_author );

			$currentday   = mysql2date( 'd.m.y', $post->post_date, false );
			$currentmonth = mysql2date( 'm', $post->post_date, false );
			$numpages     = 1;
			$multipage    = 0;
			$page         = $this->get( 'page' );
			if ( ! $page ) {
				$page = 1;
			}

			/*
			 * Force full post content when viewing the permalink for the $post,
			 * or when on an RSS feed. Otherwise respect the 'more' tag.
			 */
			if ( $post->ID === get_queried_object_id() && ( is_page() || is_single() ) ) {
				$more = 1;
			} elseif ( is_feed() ) {
				$more = 1;
			} else {
				$more = 0;
			}

			$content = $post->post_content;
			if ( false !== strpos( $content, '<!--nextpage-->' ) ) {
				$content = str_replace( "\n<!--nextpage-->\n", '<!--nextpage-->', $content );
				$content = str_replace( "\n<!--nextpage-->", '<!--nextpage-->', $content );
				$content = str_replace( "<!--nextpage-->\n", '<!--nextpage-->', $content );

				// Remove the nextpage block delimiters, to avoid invalid block structures in the split content.
				$content = str_replace( '<!-- wp:nextpage -->', '', $content );
				$content = str_replace( '<!-- /wp:nextpage -->', '', $content );

				// Ignore nextpage at the beginning of the content.
				if ( 0 === strpos( $content, '<!--nextpage-->' ) ) {
					$content = substr( $content, 15 );
				}

				$pages = explode( '<!--nextpage-->', $content );
			} else {
				$pages = array( $post->post_content );
			}

			/**
			 * Filters the "pages" derived from splitting the post content.
			 *
			 * "Pages" are determined by splitting the post content based on the presence
			 * of `<!-- nextpage -->` tags.
			 *
			 * @since 4.4.0
			 *
			 * @param string[] $pages Array of "pages" from the post content split by `<!-- nextpage -->` tags.
			 * @param WP_Post $post Current post object.
			 */
			$pages = apply_filters( 'content_pagination', $pages, $post );

			$numpages = count( $pages );

			if ( $numpages > 1 ) {
				if ( $page > 1 ) {
					$more = 1;
				}
				$multipage = 1;
			} else {
				$multipage = 0;
			}

			$elements = compact( 'id', 'authordata', 'currentday', 'currentmonth', 'page', 'pages', 'multipage', 'more', 'numpages' );

			return $elements;
		}
	}
}
