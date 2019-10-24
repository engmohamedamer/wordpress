<?php
/**
 * Plugin Name: LSVR Knowledge Base
 * Description: Adds Knowledge Base Article custom post type
 * Version: 1.1.0
 * Author: LSVRthemes
 * Author URI: http://themeforest.net/user/LSVRthemes/portfolio
 * Text Domain: lsvr-knowledge-base
 * Domain Path: /languages
 * License: http://themeforest.net/licenses
 * License URI: http://themeforest.net/licenses
*/

// Include additional functions and classes
require_once( 'inc/classes/lsvr-cpt.php' );
require_once( 'inc/classes/lsvr-cpt-kba.php' );
require_once( 'inc/classes/lsvr-permalink-settings.php' );
require_once( 'inc/classes/lsvr-permalink-settings-knowledge-base.php' );
require_once( 'inc/classes/lsvr-knowledge-base-kba-tree-walker.php' );
require_once( 'inc/core-functions.php' );
require_once( 'inc/blocks-config.php' );

// Load textdomain
load_plugin_textdomain( 'lsvr-knowledge-base', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );

// Register Notice CPT
if ( class_exists( 'Lsvr_CPT_KBA' ) ) {

	// Register CPT on plugin activation
	if ( ! function_exists( 'lsvr_knowledge_base_activate_register_kba_cpt' ) ) {
		function lsvr_knowledge_base_activate_register_kba_cpt() {
			$lsvr_kba_cpt = new Lsvr_CPT_KBA();
			$lsvr_kba_cpt->activate_cpt();
		}
	}
	register_activation_hook( __FILE__, 'lsvr_knowledge_base_activate_register_kba_cpt' );

	// Register CPT
	$lsvr_kba_cpt = new Lsvr_CPT_KBA();

}

// Add permalink settings
if ( class_exists( 'Lsvr_Permalink_Settings_Knowledge_Base' ) ) {
	$permalink_settings = new Lsvr_Permalink_Settings_Knowledge_Base();
}

// Register widgets
add_action( 'widgets_init', 'lsvr_knowledge_base_register_widgets' );
if ( ! function_exists( 'lsvr_knowledge_base_register_widgets' ) ) {
	function lsvr_knowledge_base_register_widgets() {

		// KBA categories
		require_once( 'inc/classes/widgets/lsvr-widget-kba-categories.php' );
		if ( class_exists( 'Lsvr_Widget_KBA_Categories' ) ) {
			register_widget( 'Lsvr_Widget_KBA_Categories' );
		}

		// KBA tree
		require_once( 'inc/classes/widgets/lsvr-widget-kba-tree.php' );
		if ( class_exists( 'Lsvr_Widget_KBA_Tree' ) ) {
			register_widget( 'Lsvr_Widget_KBA_Tree' );
		}

		// KBA list
		require_once( 'inc/classes/widgets/lsvr-widget-kba-list.php' );
		if ( class_exists( 'Lsvr_Widget_KBA_List' ) ) {
			register_widget( 'Lsvr_Widget_KBA_List' );
		}

		// KBA featured
		require_once( 'inc/classes/widgets/lsvr-widget-kba-featured.php' );
		if ( class_exists( 'Lsvr_Widget_KBA_Featured' ) ) {
			register_widget( 'Lsvr_Widget_KBA_Featured' );
		}

	}
}

// Register shortcodes
add_action( 'init', 'lsvr_knowledge_base_register_shortcodes' );
if ( ! function_exists( 'lsvr_knowledge_base_register_shortcodes' ) ) {
	function lsvr_knowledge_base_register_shortcodes() {

    	// KBA List Widget
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-kba-list-widget.php' );
		if ( class_exists( 'Lsvr_Shortcode_KBA_List_Widget' ) ) {
			add_shortcode( 'lsvr_kba_list_widget', array( 'Lsvr_Shortcode_KBA_List_Widget', 'shortcode' ) );
		}

    	// KBA Featured Widget
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-kba-featured-widget.php' );
		if ( class_exists( 'Lsvr_Shortcode_KBA_Featured_Widget' ) ) {
			add_shortcode( 'lsvr_kba_featured_widget', array( 'Lsvr_Shortcode_KBA_Featured_Widget', 'shortcode' ) );
		}

	}
}

?>