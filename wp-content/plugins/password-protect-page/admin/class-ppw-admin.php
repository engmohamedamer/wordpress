<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://passwordprotectwp.com
 * @since      1.0.0
 *
 * @package    Password_Protect_Page
 * @subpackage Password_Protect_Page/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Password_Protect_Page
 * @subpackage Password_Protect_Page/admin
 * @author     BWPS <hello@preventdirectaccess.com>
 */
class PPW_Admin {

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
	 * @var PPW_Password_Services
	 * @since 1.2.2
	 */
	private $free_services;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name   = $plugin_name;
		$this->version       = $version;
		$this->free_services = new PPW_Password_Services();
	}

	/**
	 * Register the stylesheets and javascript for the admin area.
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
		if ( function_exists( 'get_current_screen' ) ) {
			$is_pro_activated = apply_filters( PPW_Constants::HOOK_IS_PRO_ACTIVATE, false );
			$screen           = get_current_screen();
			$assert_services  = new PPW_Asset_Services( $screen->id, $_GET );
			if ( ! $is_pro_activated ) {
				$assert_services->load_assets_for_entire_site_tab();
				$assert_services->load_assets_for_general_tab();
			}
			$assert_services->load_assets_for_shortcodes();
			$assert_services->load_css_hide_feature_set_password_wp();
			$assert_services->load_js_show_notice_deactivate_plugin();
		}
	}

	/**
	 * Add metabox to set password in page and post
	 */
	public function ppw_free_add_custom_meta_box_to_edit_page() {
		include PPW_DIR_PATH . 'includes/views/meta-box/view-ppw-meta-box.php';
	}

	/**
	 * Save password
	 */
	public function ppw_free_set_password() {
		$setting_keys = array( 'save_password', 'id_page_post', 'is_role_selected', 'ppwp_multiple_password' );
		if ( ppw_free_error_before_create_password( $_REQUEST, $setting_keys ) ) {
			wp_send_json(
				array(
					'is_error' => true,
					'message'  => PPW_Constants::BAD_REQUEST_MESSAGE,
				),
				400
			);
			wp_die();
		}

		$data_settings        = $_REQUEST["settings"]; // Don't need use wp_unslash(). We handled in the ppw_free_fix_serialize_data function
		$new_role_password    = $data_settings["save_password"];
		$id                   = $data_settings["id_page_post"];
		$role_selected        = $data_settings["is_role_selected"];
		$new_global_passwords = is_array( $data_settings["ppwp_multiple_password"] ) ? $data_settings["ppwp_multiple_password"] : array();

		$free_services          = new PPW_Password_Services();
		$current_roles_password = $free_services->create_new_password( $id, $role_selected, $new_global_passwords, $new_role_password );
		wp_send_json( $current_roles_password );
		wp_die();
	}

	/**
	 * Check when user enter password
	 */
	public function ppw_handle_enter_password() {
		if ( ! array_key_exists( 'post_password', $_POST ) ) {
			wp_safe_redirect( wp_get_referer() );
			exit();
		}

		// Get post_id from referer url if Post data is not exist post_id.
		$post_id = ppw_get_post_id_from_request();

		if ( empty( $post_id ) ) {
			wp_safe_redirect( wp_get_referer() );
			exit();
		}

		$password = wp_unslash( $_POST['post_password'] );

		$this->free_services->handle_after_enter_password_in_password_form( $post_id, $password );
	}

	/**
	 * This feature will support some user which use postpass and enable protection type of plugin.
	 */
	public function ppw_handle_enter_password_for_default_action() {
		if ( ! array_key_exists( 'post_password', $_POST ) ) {
			return;
		}

		// Get post id from request.
		$post_id = ppw_get_post_id_from_request();
		if ( empty( $post_id ) ) {
			return;
		}

		// Get post type to check post type selected in setting page.
		$post_type = get_post_type( $post_id );

		$password = wp_unslash( $_POST['post_password'] );

		if ( ! empty( $post_type ) && ppw_is_post_type_selected_in_setting( $post_type ) ) {
			$this->free_services->handle_after_enter_password_in_password_form( $post_id, $password );
		}
	}

	/**
	 * Handle redirect after enter password
	 *
	 * @param $is_valid
	 *
	 * @return mixed|void
	 */
	public function ppw_handle_redirect_after_enter_password( $is_valid ) {
		$free_service = new PPW_Password_Services();
		$free_service->handle_redirect_after_enter_password( $is_valid );
	}

	/**
	 * Add menu
	 */
	public function ppw_add_menu() {
		$setting_page = new PPW_Settings();
		add_menu_page( 'Protect Password Settings', 'Password Protect WordPress', 'administrator', PPW_Constants::MENU_NAME, array(
			$setting_page,
			'render_ui'
		), PPW_DIR_URL . 'admin/images/ppw-icon-20x20.png' );
		add_submenu_page( PPW_Constants::MENU_NAME, __( 'Settings', PPW_Constants::DOMAIN ), __( 'Settings', PPW_Constants::DOMAIN ), 'manage_options', PPW_Constants::MENU_NAME, '', 'dashicons-hidden' );
	}

	/**
	 * Render General tab
	 */
	public function ppw_free_render_content_general() {
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-general.php';
	}

	/**
	 * Render entire site tab
	 */
	public function ppw_free_render_content_entire_site() {
		include PPW_DIR_PATH . 'includes/views/entire-site/view-ppw-entire-site.php';
	}

	/**
	 * Update settings
	 */
	public function ppw_free_update_general_settings() {
		$setting_keys = array(
			PPW_Constants::COOKIE_EXPIRED,
			PPW_Constants::REMOVE_DATA,
		);
		if ( ppw_free_is_setting_data_invalid( $_REQUEST, $setting_keys ) ) {
			wp_send_json(
				array(
					'is_error' => true,
					'message'  => PPW_Constants::BAD_REQUEST_MESSAGE,
				),
				400
			);
			wp_die();
		}

		$data_settings = wp_unslash( $_REQUEST['settings'] );
		update_option( PPW_Constants::GENERAL_OPTIONS, wp_json_encode( $data_settings ), 'no' );
		wp_die( true );
	}

	public function ppw_free_update_entire_site_settings() {
		if ( ppw_free_is_entire_site_settings_data_invalid( $_REQUEST ) ) {
			wp_send_json(
				array(
					'is_error' => true,
					'message'  => PPW_Constants::BAD_REQUEST_MESSAGE,
				),
				400
			);
			wp_die();
		}

		$nonce = $_REQUEST['security_check'];
		if ( ! wp_verify_nonce( $nonce, PPW_Constants::ENTIRE_SITE_FORM_NONCE ) ) {
			wp_send_json(
				array(
					'is_error' => true,
					'message'  => PPW_Constants::BAD_REQUEST_MESSAGE,
				),
				400
			);
			wp_die();
		}
		$data_settings        = $_REQUEST['settings'];
		$entire_site_services = new PPW_Entire_Site_Services();
		$entire_site_services->handle_before_update_settings( $data_settings );
		wp_die( true );
	}

	/**
	 * Feature entire site
	 */
	public function ppw_render_form_entire_site() {
		$is_protect = ppw_core_get_setting_entire_site_type_bool( PPW_Constants::IS_PROTECT_ENTIRE_SITE );
		if ( ! $is_protect ) {
			return;
		}

		$is_render_form = apply_filters( PPW_Constants::HOOK_BEFORE_RENDER_FORM_ENTIRE_SITE, true );
		if ( ! $is_render_form ) {
			return;
		}

		$entire_site_service = new PPW_Entire_Site_Services();
		if ( $entire_site_service->validate_auth_cookie_entire_site() ) {
			return;
		}

		$password = ppw_core_get_setting_entire_site_type_string( PPW_Constants::PASSWORD_ENTIRE_SITE );
		if ( empty( $password ) ) {
			return;
		}

		$password_is_valid = $entire_site_service->entire_site_is_valid_password( $password );
		if ( $password_is_valid ) {
			$entire_site_service->entire_site_set_password_to_cookie( $password );
//			$free_cache = new PPW_Cache_Services();
//			$free_cache->clear_cache_super_cache();
			$entire_site_service->entire_site_redirect_after_enter_password();
			die();
		}

		do_action( PPW_Constants::HOOK_CUSTOM_HEADER_FORM_ENTIRE_SITE );
		include PPW_DIR_PATH . 'includes/views/entire-site/view-ppw-form-password.php';
		die();
	}

	/**
	 * Handle protected short code content.
	 *
	 * @return string
	 */
	public function handle_content_protect_short_code() {
		$content = <<<_end_
		<div>
			This feature only runs on free
		</div>
_end_;

		return $content;
	}

	/**
	 * Handle admin init
	 */
	public function handle_admin_init() {
		if ( is_pro_active_and_valid_license() || PPW_Options_Services::get_instance()->get_flag( PPW_Constants::MIGRATED_DEFAULT_PW ) ) {
			return;
		}
		global $migration_free_service;
		$migration_free_service->start_run();
	}

	/**
	 * Handle rest API
	 */
	public function rest_api_init() {
		$api = new PPW_Api();
		$api->register_rest_routes();
	}

	/**
	 * Render shortcodes content.
	 */
	public function ppw_free_render_content_shortcodes() {
		include PPW_DIR_PATH . 'includes/views/shortcode/view-ppw-shortcode-settings.php';
	}

	/**
	 * Set post pass cookie to prevent cache.
	 *
	 * @param object $post The post data.
	 * @param string $pass The password.
	 */
	public function set_postpass_cookie_to_prevent_cache( $post, $pass ) {
		$free_service = new PPW_Password_Services();
		$free_service->set_password_to_cookie( $pass . $post->ID, PPW_Constants::WP_POST_PASS );
	}

	/**
	 * Handle a post requires the user to supply a password.
	 *
	 * @param bool    $required Whether the user needs to supply a password. True if password has not been
	 *                          provided or is incorrect, false if password has been supplied or is not required.
	 * @param WP_Post $post     Post data.
	 *
	 * @return bool  A post requires the user to supply a password.
	 */
	public function ppw_handle_post_password_required( $required, $post ) {
		if ( empty( $post->ID ) ) {
			return $required;
		}

		return $this->free_services->is_valid_permission( $required, $post->ID );
	}
}
