<?php if ( true === apply_filters( 'lsvr_lore_header_navbar_search_enable', false ) ) : ?>

	<!-- HEADER NAVBAR SEARCH : begin -->
	<div class="header-navbar-search">

		<div class="header-navbar-search__form">

			<?php // Header search form
			get_template_part( 'template-parts/header/search-form' ); ?>

		</div>

		<button type="button" class="header-navbar-search__toggle" aria-label="<?php esc_html_e( 'Search', 'lore' ); ?>">
			<i class="header-navbar-search__toggle-icon"></i>
		</button>

	</div>
	<!-- HEADER NAVBAR SEARCH : end -->

<?php endif; ?>