<?php $lsvr_lore_header_search_form_id = lsvr_lore_get_header_search_form_id(); ?>
<div class="heading">
	<h2>تعرف على</h2>
	<h1>طريقة العمل في وزارة العدل</h1>
	</div>
<!-- HEADER SEARCH FORM : begin -->
<form <?php lsvr_lore_the_header_search_form_class(); ?>
	id="header-search-form-<?php echo esc_attr( $lsvr_lore_header_search_form_id ); ?>"
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
	method="get">
	<div class="header-search-form__inner">

		<!-- HEADER SEARCH CONTENT : begin -->
		<div class="header-search-form__content">

			<!-- HEADER SEARCH INPUT WRAPPER : begin -->
			<div class="header-search-form__input-wrapper">

				<input class="header-search-form__input" type="text" name="s" autocomplete="off"
					placeholder="<?php echo esc_attr( get_theme_mod( 'header_search_input_placeholder', esc_html__( 'Search the Knowledge Base', 'lore' ) ) ); ?>"
					value="<?php echo esc_attr( get_search_query() ); ?>">
				<button class="header-search-form__submit" type="submit" title="<?php echo esc_attr( esc_html__( 'Search', 'lore' ) ); ?>">
					<i class="header-search-form__submit-icon icon-search"></i>
				</button>
				<?php if ( true === get_theme_mod( 'header_search_ajax_enable', true ) ) : ?>
					<div class="header-search-form__spinner c-spinner"></div>
				<?php endif; ?>

			</div>
			<!-- HEADER SEARCH INPUT WRAPPER : end -->

			<?php if ( true === get_theme_mod( 'header_search_ajax_enable', true ) || true === get_theme_mod( 'header_search_filter_enable', true ) ) : ?>

				<!-- HEADER SEARCH PANEL : begin -->
				<div class="header-search-form__panel">
					<div class="header-search-form__panel-inner">

						<?php if ( true === get_theme_mod( 'header_search_filter_enable', true ) ) : ?>

							<!-- HEADER SEARCH FILTER : begin -->
							<div class="header-search-form__filter">

								<?php if ( ! empty( get_theme_mod( 'header_search_filter_label', esc_html__( 'Search in:', 'lore' ) ) ) ) : ?>
									<span class="header-search-form__filter-title"><?php echo esc_html( get_theme_mod( 'header_search_filter_label', esc_html__( 'Search in:', 'lore' ) ) ); ?></span>
								<?php endif; ?>

								<label class="header-search-form__filter-label header-search-form__filter-label--active header-search-form__filter-label--any"
									for="header-search-filter-any-<?php echo esc_attr( $lsvr_lore_header_search_form_id ); ?>">
									<input type="checkbox" class="header-search-form__filter-checkbox header-search-form__filter-checkbox--any"
										id="header-search-filter-any-<?php echo esc_attr( $lsvr_lore_header_search_form_id ); ?>"
										name="search-filter[]"
										value="any"
										<?php if ( empty( lsvr_lore_get_active_search_filter() ) || in_array( 'any', lsvr_lore_get_active_search_filter() ) ) { echo ' checked="checked"'; } ?>>
										<?php esc_html_e( 'Everything', 'lore' ); ?>
								</label>

								<?php foreach ( apply_filters( 'lsvr_lore_header_search_filters', array() ) as $filter ) : ?>

									<label class="header-search-form__filter-label header-search-form__filter-label--<?php echo lsvr_lore_esc_css_class( $filter['post_type'] ); ?>"
										for="header-search-filter-<?php echo lsvr_lore_esc_css_class( $filter['post_type'] ); ?>-<?php echo esc_attr( $lsvr_lore_header_search_form_id ); ?>">
										<input type="checkbox" class="header-search-form__filter-checkbox"
											id="header-search-filter-<?php echo lsvr_lore_esc_css_class( $filter['post_type'] ); ?>-<?php echo esc_attr( $lsvr_lore_header_search_form_id ); ?>"
											name="search-filter[]"
											value="<?php echo esc_attr( $filter['post_type'] ); ?>"
											<?php if ( in_array( $filter['post_type'], lsvr_lore_get_active_search_filter() ) ) { echo ' checked="checked"'; } ?>>
											<?php echo esc_html( $filter['label'] ); ?>
									</label>

								<?php endforeach; ?>

							</div>
							<!-- HEADER SEARCH FILTER : end -->

						<?php endif; ?>

					</div>
				</div>
				<!-- HEADER SEARCH PANEL : end -->

			<?php endif; ?>

		</div>
		<!-- HEADER SEARCH CONTENT : end -->

		<?php if ( ! empty( get_theme_mod( 'header_search_keywords', '' ) ) ) : ?>

			<!-- HEADER SEARCH KEYWORDS : begin -->
			<div class="header-search-form__keywords">
				<div class="header-search-form__keywords-inner">

					<?php if ( ! empty( get_theme_mod( 'header_search_keywords_label', esc_html__( 'Suggested Search:', 'lore' ) ) ) ) : ?>
						<span class="header-search-form__keywords-label"><?php echo esc_html( get_theme_mod( 'header_search_keywords_label', esc_html__( 'Suggested Search:', 'lore' ) ) ); ?></span>
					<?php endif; ?>

					<?php $keywords = array_map( 'trim', explode( ',', get_theme_mod( 'header_search_keywords', '' ) ) );
					foreach ( $keywords as $keyword ) : ?>

						<a href="<?php echo esc_url( add_query_arg( 's', $keyword, home_url( '/' ) ) ); ?>"
							data-search-keyword="<?php echo esc_attr( $keyword ); ?>"><?php echo esc_html( $keyword ); ?></a><?php if ( $keyword !== end( $keywords ) ) { echo ' '; } ?>

					<?php endforeach; ?>

				</div>
			</div>
			<!-- HEADER SEARCH KEYWORDS : end -->

		<?php endif; ?>

	</div>
</form>
<!-- HEADER SEARCH FORM : end -->
