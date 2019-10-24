<form class="ppw_main_container" id="wp_protect_password_general_form">
	<input type="hidden" id="ppw_general_form_nonce"
	       value="<?php echo wp_create_nonce( PPW_Constants::GENERAL_FORM_NONCE ); ?>"/>
	<table class="ppwp_settings_table" cellpadding="4">
		<tr id="pda-password-protection">
			<td colspan="2">
				<h3><?php echo esc_html__( 'PASSWORD PROTECTION', PPW_Constants::DOMAIN ) ?></h3>
			</td>
		</tr>
		<?php
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-custom-column-permission.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-expired-cookie.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-whitelist-roles.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-auto-protect-child-page.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-protect-private-pages.php';
		?>
		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>
		<tr id="wpp-password-form">
			<td colspan="2">
				<h3><?php echo esc_html__( 'PASSWORD FORM', PPW_Constants::DOMAIN ) ?></h3>
			</td>
		</tr>
		<?php
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-form-message.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-error-message.php';
		?>
		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>
		<tr id="wpp-password-form">
			<td colspan="2">
				<h3><?php echo esc_html__( 'ADVANCED OPTIONS', PPW_Constants::DOMAIN ) ?></h3>
			</td>
		</tr>
		<?php
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-remove-search-engine.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-remove-data.php';
		?>
	</table>
	<?php
	submit_button();
	?>
	<table class="ppwp_settings_table" cellpadding="4">
		<?php
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-notices-cache.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-wp-super-cache.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-w3-total-cache.php';
		include PPW_DIR_PATH . 'includes/views/general/view-ppw-wp-fastest-cache.php';
		?>
	</table>
</form>
