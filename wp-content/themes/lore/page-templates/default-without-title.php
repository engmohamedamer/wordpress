<?php /* Template Name: Default w/o Title */
esc_html__( 'Default w/o Title', 'lore' ); ?>

<?php get_header(); ?>

<!-- CORE COLUMNS : begin -->
<div class="core__columns">
	<div class="core__columns-inner">
		<div class="lsvr-container">
			<div class="core__columns-bg">

				<!-- MAIN : begin -->
				<main id="main">
					<div class="main__inner">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<div <?php post_class(); ?>>

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