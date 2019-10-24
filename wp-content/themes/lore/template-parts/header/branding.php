<?php if ( has_custom_logo() ||
	( ! empty( get_bloginfo( 'name' ) ) && get_theme_mod( 'header_site_title_enable', true ) ) ||
	( ! empty( get_bloginfo( 'description' ) ) && get_theme_mod( 'header_site_tagline_enable', true ) ) ) : ?>

	<!-- HEADER BRANDING : begin -->
	<div class="header-branding<?php if ( has_custom_logo() ) { echo ' header-branding--has-logo'; } ?>">
		<div class="header-branding__inner">

			<?php if ( has_custom_logo() ) : ?>

				<!-- HEADER BRANDING : begin -->
				<div class="header-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo__link">
						<img src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>"
							class="header-logo__image"
							alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					</a>
				</div>
				<!-- HEADER BRANDING : end -->

			<?php endif; ?>

			<?php if ( ( ! empty( get_bloginfo( 'name' ) ) && get_theme_mod( 'header_site_title_enable', true ) ) ||
				( ! empty( get_bloginfo( 'description' ) ) && get_theme_mod( 'header_site_tagline_enable', true ) ) ) : ?>

			<?php endif; ?>

		</div>
	</div>
	<!-- HEADER BRANDING : end -->

<?php endif; ?>
