<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://passwordprotectwp.com
 * @since      1.0.0
 *
 * @package    Password_Protect_Page
 * @subpackage Password_Protect_Page/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Password_Protect_Page
 * @subpackage Password_Protect_Page/includes
 * @author     BWPS <hello@preventdirectaccess.com>
 */
class Password_Protect_Page {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      PPW_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PPW_VERSION' ) ) {
			$this->version = PPW_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'password-protect-page';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Password_Protect_Page_Loader. Orchestrates the hooks of the plugin.
	 * - Password_Protect_Page_i18n. Defines internationalization functionality.
	 * - Password_Protect_Page_Admin. Defines all hooks for the admin area.
	 * - Password_Protect_Page_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ppw-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ppw-i18n.php';

		/**
		 * The class responsible for plugin SDK
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'yme-plugin-update-checker/plugin-update-checker.php';

		/**
		 * Require Constants
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ppw-constants.php';

		/**
		 * Require Functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ppw-functions.php';

		/**
		 * Require Service Interfaces
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'core/class-ppw-service-interfaces.php';

		/**
		 * Require Options Services
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/services/class-ppw-options.php';

		/**
		 * Require Services Class
		 * TODO: need to rename for meaningful idea.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/services/class-ppw-passwords.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/services/class-ppw-assets.php';

		/**
		 * The class responsible for caching service
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/services/class-ppw-cache.php';

		/**
		 * The class responsible for settings
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/includes/class-ppw-settings.php';

		/**
		 * The class responsible for entire site services
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/services/class-ppw-entire-site.php';

		/**
		 * The class responsible for shortcode service
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/services/class-ppw-shortcode.php';

		/**
		 * The class responsible for API declaration
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ppw-api.php';

		/**
		 * The class responsible for core functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'core/class-ppw-functions.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ppw-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ppw-public.php';

		$this->loader = new PPW_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Password_Protect_Page_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new PPW_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new PPW_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_assets' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ppw_add_menu', 10 );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'ppw_free_add_custom_meta_box_to_edit_page' );
		$this->loader->add_action( 'login_form_ppw_postpass', $plugin_admin, 'ppw_handle_enter_password' );

		// Hook to handle default action WordPress which use our plugin.
		$this->loader->add_action( 'login_form_postpass', $plugin_admin, 'ppw_handle_enter_password_for_default_action' );

		$this->loader->add_action( 'template_redirect', $plugin_admin, 'ppw_render_form_entire_site' );
		$this->loader->add_action( 'ppw_redirect_after_enter_password', $plugin_admin, 'ppw_handle_redirect_after_enter_password' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'handle_admin_init' );

		$this->load_base();

		if ( ! is_pro_active_and_valid_license() ) {
			$this->loader->add_action( 'wp_ajax_ppw_free_set_password', $plugin_admin, 'ppw_free_set_password' );
			$this->loader->add_action( 'wp_ajax_ppw_free_update_general_settings', $plugin_admin, 'ppw_free_update_general_settings' );
			$this->loader->add_action( 'wp_ajax_ppw_free_update_entire_site_settings', $plugin_admin, 'ppw_free_update_entire_site_settings' );

			$this->loader->add_action( 'ppw_render_content_general', $plugin_admin, 'ppw_free_render_content_general', 10 );
			$this->loader->add_action( 'ppw_render_content_entire_site', $plugin_admin, 'ppw_free_render_content_entire_site', 11 );

			$this->loader->add_filter( 'post_password_required', $plugin_admin, 'ppw_handle_post_password_required', 10, 2 );
			// Testing only the new feature that applied for free only.
			$this->loader->add_shortcode( 'ppw-content-protect', $plugin_admin, 'handle_content_protect_short_code' );
		}
		$this->loader->add_action( 'ppw_render_content_shortcodes', $plugin_admin, 'ppw_free_render_content_shortcodes', 11 );
		$this->loader->add_action( PPW_Constants::HOOK_RESTRICT_CONTENT_AFTER_VALID_PWD, $plugin_admin, 'set_postpass_cookie_to_prevent_cache', 10, 2 );
		$this->loader->add_action( 'rest_api_init', $plugin_admin, 'rest_api_init', 10, 2 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new PPW_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_assets' );

		/**
		 * The hook to add the custom class to the post.
		 */
		$this->loader->add_filter( 'post_class', $plugin_public, 'ppw_post_class' );

		$this->loader->add_filter( 'the_content', $plugin_public, 'ppw_the_content', 99999 );

		/**
		 * The hook to render our password form
		 */
		$this->loader->add_filter( 'the_password_form', $plugin_public, 'ppw_the_password_form', 99999999 );

		// Register ppwp_content_protector shortcode with WordPress.
		PPW_Shortcode::get_instance();

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    PPW_Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Load base classes
	 */
	private function load_base() {
		$core_dir = PPW_DIR_PATH . 'core/base';
		require_once "$core_dir/class-ppw-module.php";
		require_once "$core_dir/class-ppw-background-task.php";
		require_once PPW_DIR_PATH . 'includes/services/class-ppw-migration.php';
		require_once "$core_dir/class-ppw-background-task-manager.php";
		require_once "$core_dir/class-ppw-data-migration-manager.php";

		require_once PPW_DIR_PATH . 'includes/services/class-ppw-migrations.php';
		require_once PPW_DIR_PATH . 'includes/services/class-ppw-migration-manager.php';
	}
}
