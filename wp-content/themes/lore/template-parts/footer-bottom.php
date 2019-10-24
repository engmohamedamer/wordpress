<?php if ( ! empty( get_theme_mod( 'footer_text', '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ) )
	|| true === get_theme_mod( 'footer_scroll_top_enable', true ) ) : ?>

	<div class="footer-bottom">
		<div class="lsvr-container">
			<div class="footer-bottom__inner">

				<?php if ( ! empty( get_theme_mod( 'footer_text', '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ) ) ) : ?>

					<!-- FOOTER TEXT : begin -->
					<div class="footer-text">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/footerlogo.svg" alt="" />
						<?php echo wpautop( wp_kses( get_theme_mod( 'footer_text', '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ), array(
							'a' => array(
								'href' => array(),
								'title' => array(),
								'target' => array(),
							),
							'em' => array(),
							'br' => array(),
							'strong' => array(),
							'p' => array(),
						))); ?>
					</div>
					<!-- FOOTER TEXT : end -->

				<?php endif; ?>

				<?php if ( true === get_theme_mod( 'footer_scroll_top_enable', true ) ) : ?>

					<a href="#top" class="footer-scroll-top">الذهاب للأعلي<i class="icon-chevron-up"></i></a>

				<?php endif; ?>

			</div>
		</div>
	</div>

<?php endif; ?>
