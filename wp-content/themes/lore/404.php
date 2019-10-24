<?php get_header(); ?>

<!-- CORE COLUMNS : begin -->
<div class="core__columns core__columns--narrow">
	<div class="core__columns-inner">
		<div class="lsvr-container">
			<div class="core__columns-bg">

				<!-- MAIN : begin -->
				<main id="main">
					<div class="main__inner">

						<div <?php post_class( 'error-404-page' ); ?>>

							<!-- MAIN HEADER : begin -->
							<header class="main__header">
								<div class="main__header-inner">

									<h1 class="main__header-title">
										<?php esc_html_e( 'Page Not Found', 'lore' ); ?>
									</h1>

								</div>
							</header>
							<!-- MAIN HEADER : begin -->

							<!-- PAGE CONTENT : begin -->
							<div class="page__content">

								<?php // Add custom code after page content text
								do_action( 'lsvr_lore_404_page_text_before' ); ?>

								<?php lsvr_lore_the_alert_message( esc_html__( 'The server can\'t find the page you requested. The page has either been moved to a different location or deleted, or you may have mistyped the URL.', 'lore' ) ); ?>

								<?php // Add custom code after page content text
								do_action( 'lsvr_lore_404_page_text_after' ); ?>

							</div>
							<!-- PAGE CONTENT : end -->

						</div>

					</div>
				</main>
				<!-- MAIN : end -->

			</div>
		</div>
	</div>
</div>
<!-- CORE COLUMNS : end -->

<?php get_footer(); ?>