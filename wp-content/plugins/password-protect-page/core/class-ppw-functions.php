<?php

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/**
 * Get home URL
 *
 * @return string
 */
function ppw_core_get_home_url_with_ssl() {
	return is_ssl() ? home_url( '/', 'https' ) : home_url( '/' );
}

/**
 * Get current role
 *
 * @return array
 */
function ppw_core_get_current_role() {
	if ( ! is_user_logged_in() ) {
		return array();
	}

	$current_user = wp_get_current_user();
	if ( is_multisite() && is_super_admin( $current_user->ID ) ) {
		return array( 'administrator' );
	}

	return $current_user->roles;
}

/**
 * Get settings
 *
 * @param $name_settings
 * @param $blog_id
 *
 * @return mixed
 */
function ppw_core_get_settings( $name_settings, $blog_id = false ) {
	$settings       = ! $blog_id ? get_option( PPW_Constants::GENERAL_OPTIONS, false ) : get_blog_option( $blog_id, PPW_Constants::GENERAL_OPTIONS, false );
	$default_result = null;
	if ( ! $settings ) {
		return $default_result;
	}

	$options = json_decode( $settings );
	if ( ! isset( $options->$name_settings ) ) {
		return $default_result;
	}

	return $options->$name_settings;
}

/**
 * Get settings entire site
 *
 * @param $name_settings
 *
 * @return mixed
 */
function ppw_core_get_settings_entire_site( $name_settings ) {
	$settings       = get_option( PPW_Constants::ENTIRE_SITE_OPTIONS, false );
	$default_result = null;
	$options        = ppw_free_fix_serialize_data( $settings, false );
	if ( empty( $options ) || ! isset( $options[ $name_settings ] ) ) {
		return $default_result;
	}

	return $options[ $name_settings ];
}

/**
 * Get setting type is bool
 *
 * @param $name_settings
 * @param $blog_id
 *
 * @return bool
 */
function ppw_core_get_setting_type_bool( $name_settings, $blog_id = false ) {
	$setting = ppw_core_get_settings( $name_settings, $blog_id );

	return 'true' === $setting || '1' === $setting;
}

/**
 * Get setting type is string
 *
 * @param string $name_settings The setting name.
 *
 * @return string
 */
function ppw_core_get_setting_type_string( $name_settings ) {
	$setting = ppw_core_get_settings( $name_settings );

	return is_string( $setting ) ? $setting : '';
}

/**
 * Get setting type is array
 *
 * @param $name_settings
 *
 * @return array
 */
function ppw_core_get_setting_type_array( $name_settings ) {
	$setting = ppw_core_get_settings( $name_settings );

	return ! is_array( $setting ) ? array() : $setting;
}

/**
 * Get setting entire site type is bool
 *
 * @param $name_settings
 *
 * @return bool
 */
function ppw_core_get_setting_entire_site_type_bool( $name_settings ) {
	return 'true' === ppw_core_get_settings_entire_site( $name_settings );
}

/**
 * Get setting entire site type is string
 *
 * @param $name_settings
 *
 * @return string
 */
function ppw_core_get_setting_entire_site_type_string( $name_settings ) {
	$setting = ppw_core_get_settings_entire_site( $name_settings );

	return is_string( $setting ) ? $setting : '';
}

/**
 * Get setting entire site type is array
 *
 * @param $name_settings
 *
 * @return array
 */
function ppw_core_get_setting_entire_site_type_array( $name_settings ) {
	$setting = ppw_core_get_settings_entire_site( $name_settings );

	return ! is_array( $setting ) ? array() : $setting;
}

function ppw_core_get_query_param() {
	$current_url = ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$query_str   = parse_url( $current_url, PHP_URL_QUERY );
	parse_str( $query_str, $query_params );

	return $query_params;
}

/**
 * Render form login
 *
 * @return mixed
 */
function ppw_core_render_login_form() {
	global $post;
	$post_id        = $post->ID;
	$query_params   = ppw_core_get_query_param();
	$wrong_password = array_key_exists( PPW_Constants::WRONG_PASSWORD_PARAM, $query_params ) && 'true' === $query_params[ PPW_Constants::WRONG_PASSWORD_PARAM ];
	$wrong_message  = $wrong_password ? '<p style="color: #dc3232;" class="ppwp-wrong-pw-error">' . __( apply_filters( PPW_Constants::HOOK_MESSAGE_ENTERING_WRONG_PASSWORD, PPW_Constants::DEFAULT_WRONG_PASSWORD_MESSAGE ) ) . '</p>' : '';

	$label           = 'pwbox-' . ( empty( $post_id ) ? rand() : $post_id );
	$form_message    = apply_filters( PPW_Constants::HOOK_MESSAGE_PASSWORD_FORM, PPW_Constants::DEFAULT_FORM_MESSAGE );
	$default_element = '<p>' . __( $form_message ) . '</p>
						<p>
							<label for="' . $label . '">' . __( 'Password:' ) . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form' ) . '" />
						</p>' .
	                   $wrong_message;

	$form_content = apply_filters( PPW_Constants::HOOK_CUSTOM_PASSWORD_FORM, $default_element, $post_id, $wrong_message );
	$script = '
		<script>
	        function ppwShowPassword(postId) {
	            const ppwBox = jQuery(\'#pwbox-\' + postId);
	            if (jQuery(\'#ppw_\' + postId).prop(\'checked\')) {
	                ppwBox.attr({"type": \'text\',});
	            } else {
	                ppwBox.attr({"type": \'password\',});
	            }
	        }
		</script>
		';
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=ppw_postpass', 'login_post' ) ) . '" class="post-password-form" method="post">'
	          . $form_content
	          . '<input type="hidden" name="post_id" value="' . $post_id . '" />'
	          . '</form>'
	          . $script;

	return $output;
}

/**
 * Get all post types
 *
 * @param string $output Value to output
 *
 * @return array Array Post types
 *
 */
function ppw_core_get_all_post_types( $output = 'objects' ) {
	$args       = array(
		'public' => true,
	);
	$post_types = get_post_types( $args, $output );
	unset( $post_types['attachment'] );

	return $post_types;
}

/**
 * Get unit time
 *
 * @param $password_cookie_expired
 *
 * @return int
 */
function ppw_core_get_unit_time( $password_cookie_expired ) {
	$time_die = explode( " ", $password_cookie_expired );
	$unit     = 0;
	if ( count( $time_die ) === 2 ) {
		if ( $time_die[1] === "minutes" ) {
			$unit = 60;
		} else if ( $time_die[1] === "hours" ) {
			$unit = 3600;
		} else if ( $time_die[1] === "days" ) {
			$unit = 86400;
		}
	}

	return $unit;
}

/**
 * Get all posts password protected by WordPress
 *
 * @return mixed
 */
function ppw_core_get_posts_password_protected_by_wp() {
	$posts_type = apply_filters( PPW_Constants::HOOK_POST_TYPES, array( 'page', 'post' ) );

	return get_posts( array(
		'post_status'  => 'publish',
		'post_type'    => $posts_type,
		'numberposts'  => - 1,
		'has_password' => true,
	) );
}

/**
 * Check Pro version activated and license valid
 *
 * @return bool
 */
function is_pro_active_and_valid_license() {
	if ( ! is_plugin_active( PPW_Constants::PRO_DIRECTORY ) && ! is_plugin_active( PPW_Constants::DEV_PRO_DIRECTORY ) ) {
		return false;
	}
	$license_key      = get_option( 'wp_protect_password_license_key', '' );
	$is_valid_license = get_option( 'wp_protect_password_licensed' );

	return ! empty( $license_key ) && ( '1' === $is_valid_license || true === $is_valid_license );
}

/**
 *
 * @param $cookie_expired
 *
 * @return bool
 */
function ppw_core_validate_cookie_expiry( $cookie_expired ) {
	$cookie_expired_array = explode( ' ', $cookie_expired );
	if ( 2 !== count( $cookie_expired_array ) ) {
		return true;
	}

	$value = $cookie_expired_array[0];
	if ( ! intval( $value ) ) {
		return true;
	}

	$int_val = intval( $value );
	if ( $int_val <= 0 ) {
		return true;
	}

	$unit       = $cookie_expired_array[1];
	$max_cookie = 365;
	switch ( $unit ) {
		case 'days':
			return $int_val > $max_cookie;
		case 'hours':
			return $int_val > $max_cookie * 24;
		case 'minutes':
			return $int_val > $max_cookie * 24 * 60;
		default:
			return true;
	}
}

/**
 * Get param in url
 *
 * @param $url
 *
 * @return mixed
 */
function ppw_core_get_param_in_url( $url ) {
	$query_str = parse_url( $url, PHP_URL_QUERY );
	parse_str( $query_str, $query_params );

	return $query_params;
}

/**
 * Clean data in post meta
 *
 * @param $meta_key
 * @param bool $blog_prefix
 *
 * @return mixed
 */
function ppw_core_delete_data_in_post_meta_by_meta_key( $meta_key, $blog_prefix = false ) {
	global $wpdb;
	$table_post_meta = ! $blog_prefix ? $wpdb->prefix . 'postmeta' : $blog_prefix . 'postmeta';

	return $wpdb->delete( $table_post_meta, array(
		'meta_key' => $meta_key,
	) );
}
