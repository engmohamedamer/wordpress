<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://passwordprotectwp.com
 * @since      1.0.0
 *
 * @package    Password_Protect_Page
 * @subpackage Password_Protect_Page/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Password_Protect_Page
 * @subpackage Password_Protect_Page/public
 * @author     BWPS <hello@preventdirectaccess.com>
 */
class PPW_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version     The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets and javascript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_assets() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Password_Protect_Page_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Password_Protect_Page_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	}

	/**
	 * Filter before render content.
	 *
	 * @param string $content Content of post/page.
	 *
	 * @return mixed
	 * @deprecated Because we only use post_password_required to show login form.
	 * @since      1.2.2 Deprecated for function, we will remove it after 2 release.
	 */
	public function ppw_filter_content( $content ) {
		if ( ! in_the_loop() ) {
			return $content;
		}

		$post = get_post();
		if ( is_null( $post ) ) {
			return $content;
		}

		$post_id         = $post->ID;
		$is_pro_activate = apply_filters( PPW_Constants::HOOK_IS_PRO_ACTIVATE, false );
		if ( $is_pro_activate ) {
			return apply_filters( PPW_Constants::HOOK_CHECK_PASSWORD_BEFORE_RENDER_CONTENT, $content, $post_id );
		}

		return $this->ppw_free_content_filter( $content, $post_id );
	}

	/**
	 * Filter content for free version
	 *
	 * @param array  $post_id Data from client.
	 * @param string $content Data from client.
	 *
	 * @return bool|string
	 * @deprecated
	 *
	 */
	private function ppw_free_content_filter( $content, $post_id ) {
		// 1. Check page/post is protected.
		$free_services = new PPW_Password_Services();
		$result        = $free_services->is_protected_content( $post_id );
		if ( false === $result ) {
			return $content;
		}

		// 2. Check password in cookie.
		$passwords = $result['passwords'];
		if ( $free_services->is_valid_cookie( $post_id, $passwords, PPW_Constants::COOKIE_NAME ) ) {
			return $content;
		}

		// 3. Form rendering.
		if ( $result['has_global_passwords'] || ( $result['has_role_passwords'] && $result['has_current_role_password'] ) ) {
			return ppw_core_render_login_form();
		}

		return '<p><strong>This page is protected. Please try again or contact the website owner.</strong></p>';
	}

	/**
	 * Post class
	 *
	 * @param array $classes Classes.
	 *
	 * @return array
	 */
	public function ppw_post_class( $classes ) {
		$classes[] = PPW_Constants::CUSTOM_POST_CLASS;

		return $classes;
	}

	/**
	 * Show custom login form which protected by PPW Plugin, it will replace default form of WordPress.
	 *
	 * @param string   $output The password form HTML output.
	 *
	 * @return string The password form HTML output.
	 *
	 * @global WP_Post $post   Post object
	 * @since 1.2.2 Init the_password_form
	 */
	public function ppw_the_password_form( $output ) {
		$post = $GLOBALS['post'];
		if ( empty( $post->ID ) || ! ppw_is_post_type_selected_in_setting( $post->post_type ) ) {
			return $output;
		}

		return ppw_core_render_login_form();
	}

	/**
	 * Only render text in all page diff post/page custom post type which it is not have post_id input.
	 * Check a site is post/page or custom post type
	 * Use regex to check it is our password form then render text.
	 *
	 * @param string $content Content of the post.
	 *
	 * @return string
	 */
	public function ppw_the_content( $content ) {
		if ( is_singular() ) {
			return $content;
		}

		$post_type = get_post_type();
		// Check post type is selected.
		if ( false === $post_type || ! ppw_is_post_type_selected_in_setting( $post_type ) ) {
			return $content;
		}

		// Check it is password form.
		if ( preg_match( '/<form.+(wp-login\.php\?action=ppw_postpass)/mi', $content )
		     && preg_match( '/name=.+post_password/mi', $content )
		     && ! preg_match( '/name=.+post_id/mi', $content ) ) {
			$content = '<em>[This is password-protected.]</em>';

			return apply_filters( 'the_ppw_password_message', $content );
		}

		return $content;
	}

}
