<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css"/>

</head>

<body <?php body_class(); ?>>

	<!-- WRAPPER : begin -->
	<div id="wrapper">

		<?php // Add custom code before Header
		do_action( 'lsvr_lore_header_before' ); ?>

		<!-- HEADER : begin -->
		<header id="header" <?php lsvr_lore_the_header_class(); ?>>
			<div class="header__bg" <?php lsvr_lore_the_header_background_image(); ?>>
				<?php lsvr_lore_the_header_overlay(); ?>
				<div class="header__inner">

					<?php // Add custom code at the top of Header
					do_action( 'lsvr_lore_header_top' ); ?>

					<!-- HEADER NAVBAR : begin -->
					<div class="header-navbar">
						<div class="lsvr-container">
							<div class="header-navbar__inner">

								<?php // Add custom code at the top of the Header navbar
								do_action( 'lsvr_lore_header_navbar_top' ); ?>

								<?php // Header branding
								get_template_part( 'template-parts/header/branding' ); ?>

								<?php // Add custom code after the Header branding
								do_action( 'lsvr_lore_header_branding_after' ); ?>

								<div class="header-navbar__navigation">

									<?php // Header menu
									get_template_part( 'template-parts/header/menu' ); ?>

									<?php // Header navbar search
									get_template_part( 'template-parts/header/navbar-search' ); ?> -->

									<?php // Header languages
									get_template_part( 'template-parts/header/languages' ); ?>

								</div>

								<button type="button" class="header-navbar__toggle">
									<i class="header-navbar__toggle-icon"></i>
								</button>

								<?php // Add custom code at the bottom of the Header navbar
								do_action( 'lsvr_lore_header_navbar_bottom' ); ?>

							</div>
						</div>
					</div>
					<!-- HEADER NAVBAR : end -->

					<?php // Add custom code after the Header navbar
					do_action( 'lsvr_lore_header_navbar_after' ); ?>

					<?php if ( true === get_theme_mod( 'header_search_enable', true ) ) : ?>

						<!-- HEADER SEARCH : begin -->
						<div class="header-search">
							<div class="lsvr-container">
								<div class="header-search__inner">

									<?php // Header search form
									get_template_part( 'template-parts/header/search-form' ); ?>

								</div>
							</div>
						</div>
						<!-- HEADER SEARCH : end -->

					<?php endif; ?>


				</div>
			</div>
		</header>

		<?php // Add custom code after Header
		do_action( 'lsvr_lore_header_after' ); ?>

		<!-- CORE : begin -->
		<div id="core" <?php lsvr_lore_core_class(); ?>>
			<div class="core__inner">
