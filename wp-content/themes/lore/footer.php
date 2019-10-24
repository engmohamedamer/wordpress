		</div>
	</div>
	<!-- CORE : end -->

	<?php // Add custom code before Footer
	do_action( 'lsvr_lore_footer_before' ); ?>

	<!-- FOOTER : begin -->
	<footer id="footer" <?php lsvr_lore_the_footer_class(); ?>>
		<div class="footer__inner">

			<?php // Add custom code at the top of the Footer
			do_action( 'lsvr_lore_footer_top' ); ?>


			<?php // Footer bottom
			get_template_part( 'template-parts/footer-bottom' ); ?>

			<?php // Add custom code at the bottom of the Footer
			do_action( 'lsvr_lore_footer_bottom' ); ?>

		</div>
	</footer>
	<!-- FOOTER : end -->

	<?php // Add custom code after Footer
	do_action( 'lsvr_lore_footer_after' ); ?>

</div>
<!-- WRAPPER : end -->

<?php wp_footer(); ?>

</body>
</html>
