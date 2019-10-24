<!-- SEARCH FORM : begin -->
<form class="c-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
	<div class="c-search-form__inner">

		<div class="c-search-form__input-holder">

			<input class="c-search-form__input" type="text" name="s"
				placeholder="<?php esc_html_e( 'Search this site', 'lore' ); ?>"
				value="<?php echo esc_attr( get_search_query() ); ?>">

			<button class="c-search-form__button" type="submit" title="<?php esc_html_e( 'Search', 'lore' ); ?>">
				<i class="c-search-form__button-icon"></i></button>

		</div>

	</div>
</form>
<!-- SEARCH FORM : end -->