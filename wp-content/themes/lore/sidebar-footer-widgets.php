<?php if ( is_active_sidebar( 'lsvr-lore-footer-widgets' ) ) : ?>

	<!-- FOOTER WIDGETS : begin -->
	<div class="footer-widgets">
		<div class="footer-widgets__inner">
			<div class="lsvr-container">
				<div <?php lsvr_lore_the_footer_widgets_list_class(); ?>>

					<?php dynamic_sidebar( 'lsvr-lore-footer-widgets' ); ?>

				</div>
			</div>
		</div>
	</div>
	<!-- FOOTER WIDGETS : end -->

<?php endif; ?>