<?php
/**
 * Plugin Name: LSVR Lore Theme Toolkit
 * Description: Adds theme-specific functionality
 * Version: 1.2.0
 * Author: LSVRthemes
 * Author URI: http://themeforest.net/user/LSVRthemes/portfolio
 * Text Domain: lsvr-lore-toolkit
 * Domain Path: /languages
 * License: http://themeforest.net/licenses
 * License URI: http://themeforest.net/licenses
*/

// Include additional functions and classes
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( 'inc/classes/lsvr-lore-sitemap-walker.php' );
require_once( 'inc/core-functions.php' );
require_once( 'inc/frontend-functions.php' );
require_once( 'inc/blocks-config.php' );

// Load textdomain
load_plugin_textdomain( 'lsvr-lore-toolkit', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );

// Register widgets
add_action( 'widgets_init', 'lsvr_lore_toolkit_register_widgets' );
if ( ! function_exists( 'lsvr_lore_toolkit_register_widgets' ) ) {
	function lsvr_lore_toolkit_register_widgets() {

		// CTA
		require_once( 'inc/classes/widgets/lsvr-widget-lore-cta.php' );
		if ( class_exists( 'Lsvr_Widget_Lore_CTA' ) ) {
			register_widget( 'Lsvr_Widget_Lore_CTA' );
		}

		// KB Category
		require_once( 'inc/classes/widgets/lsvr-widget-lore-kba-category.php' );
		if ( class_exists( 'Lsvr_Widget_Lore_KBA_Category' ) ) {
			register_widget( 'Lsvr_Widget_Lore_KBA_Category' );
		}

	}
}

// Register shortcodes
add_action( 'init', 'lsvr_lore_toolkit_register_shortcodes' );
if ( ! function_exists( 'lsvr_lore_toolkit_register_shortcodes' ) ) {
	function lsvr_lore_toolkit_register_shortcodes() {

    	// CTA Widget
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-lore-cta-widget.php' );
		if ( class_exists( 'Lsvr_Shortcode_Lore_CTA_Widget' ) ) {
			add_shortcode( 'lsvr_lore_cta_widget', array( 'Lsvr_Shortcode_Lore_CTA_Widget', 'shortcode' ) );
		}

    	// FAQ
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-lore-faq.php' );
		if ( class_exists( 'Lsvr_Shortcode_Lore_FAQ' ) ) {
			add_shortcode( 'lsvr_lore_faq', array( 'Lsvr_Shortcode_Lore_FAQ', 'shortcode' ) );
		}

    	// KB Category
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-lore-kba-category-widget.php' );
		if ( class_exists( 'Lsvr_Shortcode_Lore_KBA_Category_Widget' ) ) {
			add_shortcode( 'lsvr_lore_kba_category_widget', array( 'Lsvr_Shortcode_Lore_KBA_Category_Widget', 'shortcode' ) );
		}

    	// Knowledge Base
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-lore-knowledge-base.php' );
		if ( class_exists( 'Lsvr_Shortcode_Lore_Knowledge_Base' ) ) {
			add_shortcode( 'lsvr_lore_knowledge_base', array( 'Lsvr_Shortcode_Lore_Knowledge_Base', 'shortcode' ) );
		}

    	// Posts
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-lore-posts.php' );
		if ( class_exists( 'Lsvr_Shortcode_Lore_Posts' ) ) {
			add_shortcode( 'lsvr_lore_posts', array( 'Lsvr_Shortcode_Lore_Posts', 'shortcode' ) );
		}

    	// Sidebar
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-lore-sidebar.php' );
		if ( class_exists( 'Lsvr_Shortcode_Lore_Sidebar' ) ) {
			add_shortcode( 'lsvr_lore_sidebar', array( 'Lsvr_Shortcode_Lore_Sidebar', 'shortcode' ) );
		}

    	// Sitemap
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-lore-sitemap.php' );
		if ( class_exists( 'Lsvr_Shortcode_Lore_Sitemap' ) ) {
			add_shortcode( 'lsvr_lore_sitemap', array( 'Lsvr_Shortcode_Lore_Sitemap', 'shortcode' ) );
		}

    	// Table of contents
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-lore-toc.php' );
		if ( class_exists( 'Lsvr_Shortcode_Lore_TOC' ) ) {
			add_shortcode( 'lsvr_lore_toc', array( 'Lsvr_Shortcode_Lore_TOC', 'shortcode' ) );
		}

	}
}

?>