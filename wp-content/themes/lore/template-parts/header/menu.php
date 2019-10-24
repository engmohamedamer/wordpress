<?php if ( has_nav_menu( 'lsvr-lore-header-menu' ) ) : ?>

	<!-- HEADER MENU : begin -->
	<nav class="header-menu">

	    <?php wp_nav_menu(
	        array(
	            'theme_location' => 'lsvr-lore-header-menu',
				'container' => '',
				'menu_class' => 'header-menu__list',
				'fallback_cb' => '',
				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'walker' => new Lsvr_Lore_Header_Menu_Walker(),
				'depth' => 4,
			)
		); ?>
	</nav>
	<!-- HEADER MENU : end -->
	<img class="vision-logo" src="<?php echo get_template_directory_uri(); ?>/assets/imgs/2030.svg" alt="" />

<?php endif; ?>
