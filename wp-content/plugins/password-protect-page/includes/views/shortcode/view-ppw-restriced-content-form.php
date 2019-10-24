<div class="[PPW_FORM_CLASS]" id="[PPW_FORM_ID]">
	<form method="post" autocomplete="off" action="[PPW_CURRENT_URL]" target="_top" class="post-password-form ppw-form" data-submit="[PPW_AUTH]">
		<h3 class="ppw-headline">[PPWP_FORM_HEADLINE]</h3>
		<p class="ppw-description">[PPWP_FORM_INSTRUCTIONS]</p>
		<p class="ppw-input">
			<label>Password: <input placeholder="[PPW_PLACEHOLDER]" type="password" tabindex="1" name="[PPW_AUTH]" class="ppw-password-input" autocomplete="new-password">
			</label>
			<input class="ppw-page" type="hidden" value="[PPW_PAGE]" />
			<input name="submit" type="submit" class="ppw-submit" value="[PPW_BUTTON_LABEL]"/>
		</p>
		<p class="ppw-error" style="color: <?php echo esc_attr( PPW_Constants::PPW_ERROR_MESSAGE_COLOR ); ?>">
			[PPW_ERROR_MESSAGE]
		</p>
	</form>
</div>
