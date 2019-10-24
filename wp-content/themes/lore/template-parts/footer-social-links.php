<?php // Add custom code before footer social links
do_action( 'lsvr_lore_footer_social_links_before' ); ?>

<?php if ( true === lsvr_lore_has_footer_social_links() ) : ?>

	<!-- FOOTER SOCIAL LINKS : begin -->
	<div class="footer-social">
		<ul class="footer-social__list">

			<?php foreach ( lsvr_lore_get_social_links() as $social_link ) : ?>

				<?php if ( ! empty( $social_link['url'] ) && ! empty( $social_link['icon'] ) && ! empty( $social_link['name'] ) ) : ?>

					<li class="footer-social__item footer-social__item--<?php echo esc_attr( $social_link['name'] ); ?>">
						<a class="footer-social__item-link footer-social__item-link--<?php echo esc_attr( $social_link['name'] ); ?>" target="_blank"
							<?php if ( filter_var( $social_link['url'], FILTER_VALIDATE_EMAIL ) ) : ?>
								href="mailto:<?php echo esc_attr( $social_link['url'] ); ?>"
							<?php else : ?>
								href="<?php echo esc_url( $social_link['url'] ); ?>"
							<?php endif; ?>
							<?php if ( ! empty( $social_link['label'] ) ) { echo ' title="' . esc_attr( $social_link['label'] ) . '"'; } ?>>
							<i class="footer-social__icon <?php echo esc_attr( $social_link['icon'] ); ?>"></i>
						</a>
					</li>

				<?php endif; ?>

			<?php endforeach; ?>

		</ul>
	</div>
	<!-- FOOTER SOCIAL LINKS : end -->

<?php endif; ?>

<?php // Add custom code after footer social links
do_action( 'lsvr_lore_footer_social_links_after' ); ?>