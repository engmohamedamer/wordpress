<?php
/**
 * Created by PhpStorm.
 * User: gaupoit
 * Date: 5/6/19
 * Time: 21:04
 */

if ( ! class_exists( 'PPW_Password_Services' ) ) {
	class PPW_Password_Services implements PPW_Service_Interfaces {

		/**
		 * Check content is protected
		 *
		 * @param $post_id
		 *
		 * @return array|bool
		 */
		public function is_protected_content( $post_id ) {
			$result = $this->get_passwords( $post_id );
			if ( ! $result['has_global_passwords'] && ! $result['has_role_passwords'] ) {
				return false;
			}

			return $result;
		}

		/**
		 * Check password is valid
		 *
		 * @param $password
		 * @param $post_id
		 * @param $current_roles
		 *
		 * @return bool
		 */
		public function is_valid_password( $password, $post_id, $current_roles ) {
			if ( $this->check_password_type_is_global( $post_id, $password ) ) {
				$this->set_password_to_cookie( $password . $post_id, PPW_Constants::COOKIE_NAME . $post_id );

				return true;
			}

			if ( ! is_user_logged_in() ) {
				return false;
			}

			$role_meta       = get_post_meta( $post_id, PPW_Constants::POST_PROTECTION_ROLES, true );
			$protected_roles = ppw_free_fix_serialize_data( $role_meta );

			if ( empty( $protected_roles ) ) {
				return false;
			}

			return $this->check_password_type_is_roles( $current_roles, $protected_roles, $password, $post_id );
		}

		/**
		 * Set password to cookie
		 *
		 * @param $password
		 * @param $cookie_name
		 */
		public function set_password_to_cookie( $password, $cookie_name ) {
			$password_hashed         = wp_hash_password( $password );
			$expire                  = apply_filters( PPW_Constants::HOOK_COOKIE_EXPIRED, time() + 7 * DAY_IN_SECONDS );
			$password_cookie_expired = ppw_core_get_setting_type_string( PPW_Constants::COOKIE_EXPIRED );
			if ( ! empty( $password_cookie_expired ) ) {
				$time = explode( " ", $password_cookie_expired )[0];
				$unit = ppw_core_get_unit_time( $password_cookie_expired );
				if ( $unit !== 0 ) {
					$expire = apply_filters( PPW_Constants::HOOK_COOKIE_EXPIRED, time() + (int) $time * $unit );
				}
			}

			$referer = wp_get_referer();
			if ( $referer ) {
				$secure = ( 'https' === parse_url( $referer, PHP_URL_SCHEME ) );
			} else {
				$secure = false;
			}

			return setcookie( $cookie_name . COOKIEHASH, $password_hashed, $expire, COOKIEPATH, COOKIE_DOMAIN, $secure );
		}

		/**
		 * Check whether the current cookie is valid.
		 *
		 * @param $post_id
		 * @param $passwords
		 * @param $cookie_name
		 *
		 * @return bool
		 */
		public function is_valid_cookie( $post_id, $passwords, $cookie_name ) {
			if ( ! isset( $_COOKIE[ $cookie_name . $post_id . COOKIEHASH ] ) ) {
				return false;
			}

			$cookie = sanitize_text_field( $_COOKIE[ $cookie_name . $post_id . COOKIEHASH ] );
			$hash   = wp_unslash( $cookie );
			if ( 0 !== strpos( $hash, '$P$B' ) ) {
				return false;
			}

			$roles = ppw_core_get_current_role();
			foreach ( $passwords as $password ) {
				if ( wp_check_password( $password . $post_id, $hash ) ) {
					return true;
				}

				foreach ( $roles as $role ) {
					if ( wp_check_password( $password . $role . $post_id, $hash ) ) {
						return true;
					}
				}
			}

			return false;
		}

		/**
		 * Redirect after enter password
		 *
		 * @param $is_valid
		 */
		public function handle_redirect_after_enter_password( $is_valid ) {
			$params_in_referer = ppw_core_get_param_in_url( wp_get_referer() );

			if ( $is_valid ) {
				$url_redirect = preg_replace( '/[&?]' . PPW_Constants::WRONG_PASSWORD_PARAM . '=true/', '', wp_get_referer() );
				$params       = apply_filters( PPW_Constants::HOOK_PARAM_PASSWORD_SUCCESS, array(
					'name'  => PPW_Constants::PASSWORD_PARAM_NAME,
					'value' => PPW_Constants::PASSWORD_PARAM_VALUE
				) );

				if ( array_key_exists( $params['name'], $params_in_referer ) && '1' === $params_in_referer[ $params['name'] ] ) {
					wp_safe_redirect( $url_redirect );
					exit();
				}

				$params_in_redirect = ppw_core_get_param_in_url( $url_redirect );
				$new_param          = empty( $params_in_redirect ) ? "?" . $params['name'] . '=' . $params['value'] : "&" . $params['name'] . '=' . $params['value'];
				wp_safe_redirect( $url_redirect . $new_param );
				exit();
			}

			if ( array_key_exists( PPW_Constants::WRONG_PASSWORD_PARAM, $params_in_referer ) && 'true' === $params_in_referer[ PPW_Constants::WRONG_PASSWORD_PARAM ] ) {
				wp_safe_redirect( wp_get_referer() );
				exit();
			}

			$new_param = empty( $params_in_referer ) ? "?" . PPW_Constants::WRONG_PASSWORD_PARAM . "=true" : "&" . PPW_Constants::WRONG_PASSWORD_PARAM . "=true";
			wp_safe_redirect( wp_get_referer() . $new_param );
			exit();
		}

		/**
		 * Handle and check condition before create new password
		 *
		 * @param $id
		 * @param $role_selected
		 * @param $new_global_passwords
		 * @param $new_role_password
		 *
		 * @return array|mixed
		 */
		public function create_new_password( $id, $role_selected, $new_global_passwords, $new_role_password ) {
			$post_meta                = get_post_meta( $id, PPW_Constants::POST_PROTECTION_ROLES, true );
			$current_roles_password   = ppw_free_fix_serialize_data( $post_meta );
			$current_global_passwords = get_post_meta( $id, PPW_Constants::GLOBAL_PASSWORDS, true );

			if ( 'global' === $role_selected ) {
				return $this->create_password_type_global( $id, $new_global_passwords, $current_global_passwords, $current_roles_password, $role_selected );
			}

			return $this->create_password_type_role( $id, $role_selected, $new_role_password, $current_global_passwords, $current_roles_password );
		}

		/**
		 * Check condition before create new password type global
		 *
		 * @param $id
		 * @param $new_global_passwords
		 * @param $current_global_passwords
		 * @param $current_roles_password
		 * @param $role_selected
		 *
		 * @return mixed
		 */
		public function create_password_type_global( $id, $new_global_passwords, $current_global_passwords, $current_roles_password, $role_selected ) {
			// Validate global password(check bad request)
			if ( $this->global_passwords_is_bad_request( $new_global_passwords ) ) {
				wp_send_json(
					array(
						'is_error' => true,
						'message'  => PPW_Constants::BAD_REQUEST_MESSAGE,
					),
					400
				);
				wp_die();
			}

			// Validate global password(empty and duplicate)
			ppw_free_validate_password_type_global( $new_global_passwords, $current_global_passwords, $current_roles_password );
			update_post_meta( $id, PPW_Constants::GLOBAL_PASSWORDS, $new_global_passwords );

			// Handle cache for page/post have password type is global with Super Cache plugin
//			$free_cache = new PPW_Cache_Services();
//			$free_cache->handle_cache_for_password_type_global_with_super_cache( $new_global_passwords, $id, $current_roles_password );
			$current_roles_password[ $role_selected ] = implode( "\n", $new_global_passwords );

			return $current_roles_password;
		}

		/**
		 * Check bad request with data type is global passwords
		 *
		 * @param array $passwords Global passwords.
		 *
		 * @return bool
		 */
		private function global_passwords_is_bad_request( $passwords ) {
			foreach ( $passwords as $password ) {
				if ( strpos( $password, ' ' ) !== false ) {
					return true;
				}
			}

			// Check element unique in array
			return count( $passwords ) !== count( array_unique( $passwords ) );
		}

		/**
		 * Check condition before create new password type role
		 *
		 * @param $id
		 * @param $role_selected
		 * @param $new_role_password
		 * @param $current_global_passwords
		 * @param $current_roles_password
		 *
		 * @return mixed
		 */
		public function create_password_type_role( $id, $role_selected, $new_role_password, $current_global_passwords, $current_roles_password ) {
			// Validate role password(check bad request)
			if ( $this->role_password_is_bad_request( $new_role_password ) ) {
				wp_send_json(
					array(
						'is_error' => true,
						'message'  => PPW_Constants::BAD_REQUEST_MESSAGE,
					),
					400
				);
				wp_die();
			}

			// Validate role password(empty and duplicate)
			ppw_free_validate_password_type_role( $role_selected, $new_role_password, $current_global_passwords, $current_roles_password );
			$current_roles_password[ $role_selected ] = $new_role_password;
			delete_post_meta( $id, PPW_Constants::POST_PROTECTION_ROLES );
			add_post_meta( $id, PPW_Constants::POST_PROTECTION_ROLES, $current_roles_password );

			// Handle cache for page/post have password type is role with Super Cache plugin
//			$free_cache = new PPW_Cache_Services();
//			$free_cache->handle_cache_for_password_type_role_with_super_cache( $new_role_password, $id, $current_roles_password, $current_global_passwords );
			if ( ! empty( $current_global_passwords ) ) {
				$current_roles_password['global'] = implode( "\n", $current_global_passwords );
			}

			return $current_roles_password;
		}

		/**
		 * Check bad request with data type is role password
		 *
		 * @param string $password Role password.
		 *
		 * @return bool
		 */
		private function role_password_is_bad_request( $password ) {
			return strpos( $password, ' ' ) !== false;
		}

		/**
		 * Get all passwords
		 *
		 * @param $post_id
		 *
		 * @return array
		 */
		public function get_passwords( $post_id ) {
			// 1. Get all passwords.
			$global_passwords     = get_post_meta( $post_id, PPW_Constants::GLOBAL_PASSWORDS, true );
			$global_passwords     = ! empty( $global_passwords ) ? $global_passwords : array();
			$has_global_passwords = ! empty( $global_passwords ) && is_array( $global_passwords );
			$raw_data             = get_post_meta( $post_id, PPW_Constants::POST_PROTECTION_ROLES, true );
			$protected_roles      = ppw_free_fix_serialize_data( $raw_data );

			$filtered_protected_roles  = array_filter(
				$protected_roles,
				function ( $pass ) {
					if ( ! empty( $pass ) ) {
						return $pass;
					}
				}
			);
			$has_role_passwords        = ! empty( $filtered_protected_roles );
			$has_current_role_password = false;
			if ( $has_role_passwords ) {
				$roles = ppw_core_get_current_role();
				foreach ( $roles as $role ) {
					if ( array_key_exists( $role, $filtered_protected_roles ) ) {
						$has_current_role_password = true;
						array_push( $global_passwords, $protected_roles[ $role ] );
					}
				}
			}

			$result = array(
				'passwords'                 => $global_passwords,
				'has_role_passwords'        => $has_role_passwords,
				'has_current_role_password' => $has_current_role_password,
				'has_global_passwords'      => $has_global_passwords,
			);

			return $result;
		}

		/**
		 * Check password type is global
		 *
		 * @param $post_id
		 * @param $password
		 *
		 * @return bool
		 */
		public function check_password_type_is_global( $post_id, $password ) {
			$global_passwords = get_post_meta( $post_id, PPW_Constants::GLOBAL_PASSWORDS, true );
			if ( empty( $global_passwords ) || ! is_array( $global_passwords ) ) {
				return false;
			}

			foreach ( $global_passwords as $pass ) {
				if ( $password === $pass ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Check password type is roles
		 *
		 * @param $current_roles
		 * @param $protectedRoles
		 * @param $password
		 * @param $post_id
		 *
		 * @return bool
		 */
		public function check_password_type_is_roles( $current_roles, $protectedRoles, $password, $post_id ) {
			foreach ( $current_roles as $role ) {
				if ( ! array_key_exists( $role, $protectedRoles ) || empty( $protectedRoles[ $role ] ) || $protectedRoles[ $role ] !== $password ) {
					continue;
				}

				$this->set_password_to_cookie( $password . $role . $post_id, PPW_Constants::COOKIE_NAME . $post_id );

				return true;
			}

			return false;
		}

		/**
		 * Migrate default password and update post password of Wordpress for free version
		 * TODO: need to revamp the logic.
		 */
		function migrate_default_password() {
			$posts = ppw_core_get_posts_password_protected_by_wp();
			error_log( '[Migrate Default PWD]Things to migrate: ' . wp_json_encode( $posts ) );
			error_log( sprintf( '[Migrate Default PWD]Total: %d', count( $posts ) ) );
			foreach ( $posts as $post ) {
				$post_id = $post->ID;
				error_log( sprintf( '[Migrate Default PWD]Migrating password for post %d', $post_id ) );
				$global_password = get_post_meta( $post_id, PPW_Constants::GLOBAL_PASSWORDS, true );
				$global_password = ! empty( $global_password ) ? $global_password : array();
				$raw_data        = get_post_meta( $post->ID, PPW_Constants::POST_PROTECTION_ROLES, true );

				// 1. Update password for role
				$protected_roles = ppw_free_fix_serialize_data( $raw_data );
				foreach ( $protected_roles as $key => $value ) {
					if ( str_replace( " ", "", $post->post_password ) === $value ) {
						$protected_roles[ $key ] = '';
						update_post_meta( $post_id, PPW_Constants::POST_PROTECTION_ROLES, $protected_roles );
					}
				}

				// 2. Update password for global
				if ( ! in_array( str_replace( " ", "", $post->post_password ), $global_password ) ) {
					array_push( $global_password, str_replace( " ", "", $post->post_password ) );
				}

				update_post_meta( $post_id, PPW_Constants::GLOBAL_PASSWORDS, $global_password );

				// 3. Update default password for Wordpress
				wp_update_post( array(
					'ID'            => $post_id,
					'post_password' => '',
				) );
			}
		}

		public function get_pw_meta( $post_id = false ) {
			global $wpdb;
			$table_name = $wpdb->prefix . "postmeta";
			$global_key = PPW_Constants::GLOBAL_PASSWORDS;
			$role_key   = PPW_Constants::POST_PROTECTION_ROLES;

			$query = "SELECT * FROM $table_name where ( meta_key IN ( '$global_key', '$role_key' ) )";

			if ( $post_id ) {
				$query = $wpdb->prepare( $query . ' AND post_id = %d', $post_id );
			}

			return $wpdb->get_results( $query );
		}


		public function get_data_to_migrate() {
			$ids    = $this->get_protected_post_ids();
			$result = [];
			foreach ( $ids as $post_id ) {
				$passwords = $this->get_pw_meta( $post_id );
				$result[]  = [
					'post_id'   => $post_id,
					'passwords' => $this->massage_pw_from_post_meta( $passwords ),
				];
			}
			$old = get_option( 'ppw_data_checksum', false );
			if ( false === $old ) {
				update_option( 'ppw_data_checksum', $result );

				return $result;
			}
			$diff = $this->check_sum_migrate_data( $result, $old );
			update_option( 'ppw_data_checksum', $result );

			return $diff;
		}

		public function check_sum_migrate_data( $current, $old ) {
			if ( count( $current ) > count( $old ) ) {
				$large = $current;
				$small = $old;
			} else {
				$large = $old;
				$small = $current;
			}

			$post_ids = array_column( $small, 'post_id' );
			$result   = [];
			foreach ( $large as $cur ) {
				$post_id     = $cur['post_id'];
				$found_index = array_search( $post_id, $post_ids );
				if ( false === $found_index ) {
					$result[] = $cur;
					continue;
				}

				$found = $small[ $found_index ];

				if ( ! isset ( $found['passwords'] ) ) {
					continue;
				}

				if ( $this->compare_passwords( $cur, $found ) ) {
					$result[] = $found;
				}
			}

			return $result;
		}

		/**
		 * Massage password from post meta
		 *
		 * @param array $meta post meta from DB.
		 *
		 * @return array
		 */
		public function massage_pw_from_post_meta( $meta ) {
			$result = array(
				'global' => array(),
				'role'   => array(),
			);
			foreach ( $meta as $val ) {
				if ( PPW_Constants::GLOBAL_PASSWORDS === $val->meta_key ) {
					$meta_value       = ppw_free_fix_serialize_data( $val->meta_value );
					$result['global'] = array_merge( $result['global'], $meta_value );
				} elseif ( PPW_Constants::POST_PROTECTION_ROLES === $val->meta_key ) {
					$meta_value     = ppw_free_fix_serialize_data( @unserialize( $val->meta_value ) );
					$result['role'] = $this->massage_pw_for_roles_from_post_meta( $meta_value );
				}
			}

			return $result;
		}

		/**
		 * Massage by define a password - role map
		 *
		 * Input: [ "admin" => "1", "editor" => "2", author => "1"]
		 * Output: [ "1" => array('admin', 'author'), "2" => array('editor') ]
		 *
		 * @param $meta_value
		 *
		 * @return array
		 */
		public function massage_pw_for_roles_from_post_meta( $meta_value ) {
			$result = [];
			foreach ( $meta_value as $role => $pw ) {

				if ( "" === $pw ) {
					continue;
				}

				if ( ! array_key_exists( $pw, $result ) ) {
					$result[ $pw ] = [ $role ];
				}

				if ( ! in_array( $role, $result[ $pw ] ) ) {
					array_push( $result[ $pw ], $role );
				}
			}

			return $result;
		}


		public function get_protected_post_ids() {
			$role_key = PPW_Constants::POST_PROTECTION_ROLES;
			$results  = array_filter( $this->get_pw_meta(), function ( $value ) use ( $role_key ) {
				$meta_value          = ppw_free_fix_serialize_data( @unserialize( $value->meta_value ) );
				$is_valid_meta_value = is_array( $meta_value );
				if ( $is_valid_meta_value && $role_key === $value->meta_key ) {
					foreach ( $meta_value as $meta ) {
						return $meta !== '';
					}
				}

				return $is_valid_meta_value && count( $meta_value ) > 0;
			} );

			return array_unique(
				array_map( function ( $val ) {
					return $val->post_id;
				}, $results )
			);
		}

		/**
		 * @param $pwds
		 *
		 * @return array
		 */
		private function massage_role_pwd( $pwds ) {
			return array_map( function ( $v ) {
				natsort( $v );

				return implode( ',', $v );
			}, $pwds );
		}

		/**
		 * @param $cur
		 * @param $found
		 *
		 * @return bool
		 */
		private function compare_passwords( $cur, $found ) {
			$global_diff = $this->advance_array_diff( $cur['passwords']['global'], $found['passwords']['global'] );

			if ( ! empty( $global_diff ) ) {
				return true;
			}

			$current_roles = $this->massage_role_pwd( $cur['passwords']['role'] );
			$new_roles     = $this->massage_role_pwd( $found['passwords']['role'] );

			$role_diff = $this->advance_array_diff( $current_roles, $new_roles );

			return ! empty ( $role_diff );
		}

		/**
		 * @param $first
		 * @param $second
		 *
		 * @return array
		 */
		private function advance_array_diff( $first, $second ) {
			return array_merge( array_diff(
				$first,
				$second
			), array_diff(
				$second,
				$first
			) );
		}

		/**
		 * Valid permission of post ID.
		 *
		 * @param bool $required Required Password.
		 * @param int  $post_id  Post ID.
		 *
		 * @return bool True|False. True: Password is required so it will render form.
		 */
		public function is_valid_permission( $required, $post_id ) {
			// 1. Check page/post is protected.
			$result = $this->is_protected_content( $post_id );
			if ( false === $result ) {
				return $required;
			}

			// 2. Check password in cookie.
			$passwords = $result['passwords'];

			return false === $this->is_valid_cookie( $post_id, $passwords, PPW_Constants::COOKIE_NAME );
		}

		/**
		 * Check password is exist when user enter password in form.
		 *
		 * @param int    $post_id  Post ID.
		 * @param string $password Password which user enter.
		 */
		public function handle_after_enter_password_in_password_form( $post_id, $password ) {

			// Get current role of current user.
			$current_roles   = ppw_core_get_current_role();
			$is_pro_activate = apply_filters( PPW_Constants::HOOK_IS_PRO_ACTIVATE, false );
			if ( $is_pro_activate ) {
				$is_valid = apply_filters( PPW_Constants::HOOK_CHECK_PASSWORD_IS_VALID, false, $password, $post_id, $current_roles );
			} else {
				$is_valid = $this->is_valid_password( $password, $post_id, $current_roles );
			}

			do_action( 'ppw_redirect_after_enter_password', $is_valid );
		}

	}
}
