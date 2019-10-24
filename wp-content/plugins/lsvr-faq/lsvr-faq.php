<?php
/**
 * Plugin Name: LSVR FAQ
 * Description: Adds FAQ custom post type
 * Version: 1.2.0
 * Author: LSVRthemes
 * Author URI: http://themeforest.net/user/LSVRthemes/portfolio
 * Text Domain: lsvr-faq
 * Domain Path: /languages
 * License: http://themeforest.net/licenses
 * License URI: http://themeforest.net/licenses
*/

// Include additional functions and classes
require_once( 'inc/classes/lsvr-cpt.php' );
require_once( 'inc/classes/lsvr-cpt-faq.php' );
require_once( 'inc/classes/lsvr-permalink-settings.php' );
require_once( 'inc/classes/lsvr-permalink-settings-faq.php' );
require_once( 'inc/core-functions.php' );
require_once( 'inc/blocks-config.php' );

// Load textdomain
load_plugin_textdomain( 'lsvr-faq', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );

// Register FAQ CPT
if ( class_exists( 'Lsvr_CPT_FAQ' ) ) {

	// Register CPT on plugin activation
	if ( ! function_exists( 'lsvr_faq_activate_register_faq_cpt' ) ) {
		function lsvr_faq_activate_register_faq_cpt() {
			$lsvr_faq_cpt = new Lsvr_CPT_FAQ();
			$lsvr_faq_cpt->activate_cpt();
		}
	}
	register_activation_hook( __FILE__, 'lsvr_faq_activate_register_faq_cpt' );

	// Register CPT
	$lsvr_faq_cpt = new Lsvr_CPT_FAQ();

}

// Add permalink settings
if ( class_exists( 'Lsvr_Permalink_Settings_Faq' ) ) {
	$permalink_settings = new Lsvr_Permalink_Settings_Faq();
}

// Register widgets
add_action( 'widgets_init', 'lsvr_faq_register_widgets' );
if ( ! function_exists( 'lsvr_faq_register_widgets' ) ) {
	function lsvr_faq_register_widgets() {

		// FAQ list
		require_once( 'inc/classes/widgets/lsvr-widget-faq-list.php' );
		if ( class_exists( 'Lsvr_Widget_FAQ_List' ) ) {
			register_widget( 'Lsvr_Widget_FAQ_List' );
		}

		// Featured FAQ
		require_once( 'inc/classes/widgets/lsvr-widget-faq-featured.php' );
		if ( class_exists( 'Lsvr_Widget_FAQ_Featured' ) ) {
			register_widget( 'Lsvr_Widget_FAQ_Featured' );
		}

		// FAQ categories
		require_once( 'inc/classes/widgets/lsvr-widget-faq-categories.php' );
		if ( class_exists( 'Lsvr_Widget_FAQ_Categories' ) ) {
			register_widget( 'Lsvr_Widget_FAQ_Categories' );
		}

	}
}

// Register shortcodes
add_action( 'init', 'lsvr_faq_register_shortcodes' );
if ( ! function_exists( 'lsvr_faq_register_shortcodes' ) ) {
	function lsvr_faq_register_shortcodes() {

    	// FAQ List Widget
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-faq-list-widget.php' );
		if ( class_exists( 'Lsvr_Shortcode_FAQ_List_Widget' ) ) {
			add_shortcode( 'lsvr_faq_list_widget', array( 'Lsvr_Shortcode_FAQ_List_Widget', 'shortcode' ) );
		}

    	// Featured FAQ Widget
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-faq-featured-widget.php' );
		if ( class_exists( 'Lsvr_Shortcode_FAQ_Featured_Widget' ) ) {
			add_shortcode( 'lsvr_faq_featured_widget', array( 'Lsvr_Shortcode_FAQ_Featured_Widget', 'shortcode' ) );
		}

	}
}

?>