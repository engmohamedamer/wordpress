<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.buildwps.com/
 * @since      1.0.0
 *
 * @package    Prevent_ur_pages
 * @subpackage Prevent_ur_pages/include
 */

/**
 *
 * Defines the Constants
 *
 * @package    Prevent_ur_pages
 * @subpackage Prevent_ur_pages/include
 * @author     Bwps <support@bwps.us>
 */

if ( ! class_exists( 'PPW_Constants' ) ) {
	/**
	 * Constants helper class
	 *
	 * Class PPW_Free_Constants
	 */
	class PPW_Constants {

		#region Hook
		const HOOK_IS_PRO_ACTIVATE = 'ppw_is_pro_activate';

		const HOOK_MESSAGE_ENTERING_WRONG_PASSWORD = 'ppwp_text_for_entering_wrong_password';

		const HOOK_MESSAGE_PASSWORD_FORM = 'ppwp_customize_password_form_message';

		const HOOK_CUSTOM_PASSWORD_FORM = 'ppwp_customize_password_form';

		const HOOK_DEFAULT_TAB = 'ppw_default_tab';

		const HOOK_ADD_NEW_TAB = 'ppw_add_new_tab';

		const HOOK_RENDER_CONTENT_FOR_TAB = 'ppw_render_content_';

		const HOOK_CUSTOM_TAB = 'ppw_custom_tab';

		const HOOK_COOKIE_EXPIRED = 'post_password_expires';

		const HOOK_CHECK_PASSWORD_BEFORE_RENDER_CONTENT = 'ppw_check_password_before_render_content';

		const HOOK_FUNCTION_HANDLE_META_BOX = 'ppw_function_handle_meta_box';

		const HOOK_META_BOX_POSITION = 'ppw_meta_box_position';

		const HOOK_CHECK_PASSWORD_IS_VALID = 'ppw_check_password_is_valid';

		const HOOK_BEFORE_RENDER_FORM_ENTIRE_SITE = 'ppw_before_render_form_entire_site';

		const HOOK_HIDE_DEFAULT_PW_WP_POSITION = 'ppw_hide_default_pw_wp_position';

		const HOOK_PLUGIN_INFO = 'ppw_plugin_info';

		const HOOK_CUSTOM_HEADER_FORM_ENTIRE_SITE = 'ppw_custom_header_form_entire_site';

		const HOOK_CUSTOM_TEXT_FEATURE_REMOVE_DATA = 'ppw_custom_text_feature_remove_data';

		const HOOK_POST_TYPES = 'ppw_post_types';

		const HOOK_MIGRATE_COMPLETE_MESSAGE = 'ppw_complete_message';

		const HOOK_PARAM_PASSWORD_SUCCESS = 'ppw_custom_param';

		const HOOK_SHORT_CODE_ATTRS = 'ppw_short_code_attributes';

		const HOOK_SUPPORTED_WHITELIST_ROLES = 'ppw_supported_white_list_roles';

		const HOOK_SUPPORTED_POST_TYPES = 'ppw_supported_post_types';

		const HOOK_SHORT_CODE_TEMPLATE = 'ppw_short_code_template';

		const HOOK_RESTRICT_CONTENT_ERROR_MESSAGE = 'ppw_restrict_content_custom_error_message';

		const HOOK_RESTRICT_CONTENT_BEFORE_CHECK_PWD = 'ppw_restrict_content_before_check_pw';

		const HOOK_RESTRICT_CONTENT_AFTER_VALID_PWD = 'ppw_restrict_content_after_valid_pw';

		const HOOK_SHORT_CODE_WHITELISTED_ROLES = 'ppw_restrict_content_whitelisted_roles';

		const HOOK_SHORT_CODE_ERROR_MESSAGE = 'ppw_restrict_content_error_message';

		const HOOK_SHORT_CODE_BEFORE_CHECK_PASSWORD = 'ppw_restrict_content_before_check_password';

		const HOOK_SHORT_CODE_AFTER_CHECK_PASSWORD = 'ppw_restrict_content_before_check_password';

		const HOOK_HANDLE_BEFORE_RENDER_WOO_PRODUCT = 'ppw_handle_before_render_woo_product';
		#endregion

		#region short code attribute
		const SHORT_CODE_FORM_HEADLINE = '[PPWP_FORM_HEADLINE]';

		const SHORT_CODE_FORM_INSTRUCT = '[PPWP_FORM_INSTRUCTIONS]';

		const SHORT_CODE_FORM_PLACEHOLDER = '[PPW_PLACEHOLDER]';

		const SHORT_CODE_FORM_AUTH = '[PPW_AUTH]';

		const SHORT_CODE_FORM_CURRENT_URL = '[PPW_CURRENT_URL]';

		const SHORT_CODE_FORM_ERROR_MESSAGE = '[PPW_ERROR_MESSAGE]';

		const SHORT_CODE_BUTTON = '[PPW_BUTTON_LABEL]';

		const SHORT_CODE_FORM_ID = '[PPW_FORM_ID]';

		const SHORT_CODE_FORM_CLASS = '[PPW_FORM_CLASS]';
		#endregion

		#region Message
		const DEFAULT_FORM_MESSAGE = 'This content is password protected. To view it please enter your password below:';

		const DEFAULT_WRONG_PASSWORD_MESSAGE = 'Please enter the correct password!';

		const BAD_REQUEST_MESSAGE = 'Our server cannot understand the data request!';

		const EMPTY_PASSWORD = 'Please fill out empty fields.';

		const DUPLICATE_PASSWORD = 'You can\'t create duplicate password. Please try again.';

		const SPACE_PASSWORD = 'Spaces not accepted in password. Please remove them and try again.';
		#endregion

		#region modules
		const MENU_NAME = 'wp_protect_password_options';

		const META_BOX_MODULE = 'meta-box';

		const ENTIRE_SITE_MODULE = 'entire-site';

		const GENERAL_SETTINGS_MODULE = 'general';

		const SHORTCODES_SETTINGS_MODULE = 'shortcodes';
		#endregion

		const COOKIE_NAME = 'wp-postpass-role_';

		const ENTIRE_SITE_FORM_NONCE = 'ppw_entire_site_form_nonce';

		const GENERAL_FORM_NONCE = 'ppw_general_form_nonce';

		const ENTIRE_SITE_OPTIONS = 'wp_protect_password_set_password_options';

		const GENERAL_OPTIONS = 'wp_protect_password_setting_options';

		const POST_PROTECTION_ROLES = 'post_protection_roles';

		const ENTIRE_SITE_COOKIE_NAME = 'pda_protect_password';

		const GLOBAL_PASSWORDS = 'wp_protect_password_multiple_passwords';

		const COOKIE_EXPIRED = 'wpp_password_cookie_expired';

		const REMOVE_DATA = 'wpp_remove_data';

		const MAX_COOKIE_EXPIRED = 365;

		const DOMAIN = 'password-protect-page';

		const WRONG_PASSWORD_PARAM = 'ppwp_enter_wrong_password';

		const PASSWORD_PARAM_NAME = 'ppwp';

		const PASSWORD_PARAM_VALUE = '1';

		const IS_PROTECT_ENTIRE_SITE = 'ppwp_apply_password_for_entire_site';

		const PASSWORD_ENTIRE_SITE = 'password_for_website';

		const SET_NEW_PASSWORD_ENTIRE_SITE = 'ppwp_set_new_password_for_entire_site';

		const META_BOX_NONCE = 'ppw_meta_box_nonce';

		const MIGRATED_DEFAULT_PW = 'migrated_default_pw';

		const MIGRATED_FREE_FLAG = 'migrated_free';

		const PRO_DIRECTORY = 'wp_protect_password/wp-protect-password.php';

		const DEV_PRO_DIRECTORY = 'password-protect-page-pro/wp-protect-password.php';

		const PPW_HOOK_SHORT_CODE_NAME = 'ppwp';

		const PPW_ERROR_MESSAGE_COLOR = '#dc3232';

		const WP_POST_PASS = 'wp-postpass_';

		const CUSTOM_POST_CLASS = 'ppwp-short-code-post';
	}
}
