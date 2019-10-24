<?php
$html_link = sprintf(
	'<a target="_blank" rel="noreferrer noopener" href="%s">lock parts of your content</a>',
	'https://passwordprotectwp.com/docs/password-protect-wordpress-content-sections/'
);
$desc      = sprintf(
	// translators: %s: Link to documentation.
	esc_html__( 'Use the following shortcode to %s. Set as many passwords as you’d like to.', 'password-protect-page' ),
	$html_link
);
$message = 'Great! You’ve successfully copied the shortcode to clipboard.';
?>
<div class="ppw_main_container" id="ppw_shortcodes_form">
	<table class="ppwp_settings_table" cellpadding="4">
		<tr>
			<td class="feature-input"><span class="feature-input"></span></td>
			<td>
				<p>
					<label><?php esc_html_e( 'Partial Content Protection', 'password-protect-page' ); ?></label>
					<?php echo wp_kses_post( $desc ); ?>
				</p>
				<div class="ppwp-shortcodes-wrap">
					<textarea id="ppwp-shortcode" class="ppw-shortcode-sample" cols="33" readonly>[ppwp id="" class="" passwords="password1 password2" whitelisted_roles="administrator, editor"]&#13;&#10;Your protected content&#13;&#10;[/ppwp]</textarea>
					<span id="pppw-copy-shortcode" class="button" onclick="ppwUtils.copy('ppwp-shortcode', '<?php echo esc_attr( $message, 'password-protect-page' ); ?>', '<?php echo esc_attr( PPW_PLUGIN_NAME ); ?>')">Copy</span>
				</div>
			</td>
		</tr>
	</table>
</div>
