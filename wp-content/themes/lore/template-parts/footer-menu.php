<?php // Add custom code before footer menu
do_action( 'lsvr_lore_footer_menu_before' ); ?>

<?php if ( has_nav_menu( 'lsvr-lore-footer-menu' ) ) : ?>

	<!-- FOOTER MENU : begin -->
	<nav class="footer-menu">

	    <?php wp_nav_menu(
	        array(
	            'theme_location' => 'lsvr-lore-footer-menu',
				'container' => '',
				'menu_class' => 'footer-menu__list',
				'fallback_cb' => '',
				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth' => 1,
			)
		); ?>

	</nav>
	<!-- FOOTER MENU : end -->

<?php endif; ?>

<?php // Add custom code after footer menu
do_action( 'lsvr_lore_footer_menu_after' ); ?>