<?php /* Template Name: Wide */
esc_html__( 'Wide', 'lore' ); ?>

<?php get_header(); ?>

<!-- CORE COLUMNS : begin -->
<div class="core__columns core__columns--wide">
	<div class="core__columns-inner">
		<div class="lsvr-container">
			<div class="core__columns-bg">

				<!-- MAIN : begin -->
				<main id="main">
					<div class="main__inner">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<div <?php post_class(); ?>>

								<!-- MAIN HEADER : begin -->
								<header class="main__header">
									<div class="main__header-inner">

										<?php // Breadcrumbs
										get_template_part( 'template-parts/breadcrumbs' ); ?>

										<h1 class="main__header-title">
											<?php the_title(); ?>
										</h1>

									</div>
								</header>
								<!-- MAIN HEADER : begin -->

								<?php get_template_part( 'template-parts/page', 'content' ); ?>

							</div>

						<?php endwhile; endif; ?>

					</div>
				</main>
				<!-- MAIN : end -->

			</div>
		</div>
	</div>
</div>
<!-- CORE COLUMNS : end -->

<?php get_footer(); ?>