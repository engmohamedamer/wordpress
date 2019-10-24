<?php

/**
 * Fired during plugin activation
 *
 * @link       https://passwordprotectwp.com
 * @since      1.0.0
 *
 * @package    Password_Protect_Page
 * @subpackage Password_Protect_Page/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Password_Protect_Page
 * @subpackage Password_Protect_Page/includes
 * @author     BWPS <hello@preventdirectaccess.com>
 */
class PPW_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( is_plugin_active( PPW_Constants::PRO_DIRECTORY ) ) {
			$installed_plugins = get_plugins();
			$version           = $installed_plugins[ PPW_Constants::PRO_DIRECTORY ]['Version'];
			if ( - 1 === version_compare( $version, '1.1.0' ) ) {
				wp_die( __( 'You need to <a target="_blank" rel="noreferrer noopener" href="https://passwordprotectwp.com/docs/ppwp-pro-free/">update our Pro to its latest version</a> for our Password Protect WordPress plugins to work properly. You <b>must NOT delete</b> the current Free version. Otherwise, you’ll lose all your current settings data.', 'password-protect-page' ) );
			}
		}
	}

}
