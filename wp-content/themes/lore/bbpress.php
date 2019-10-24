<?php get_header(); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<!-- POST ARCHIVE : begin -->
<div class="bbpress-page">

	<!-- MAIN HEADER : begin -->
	<header class="main__header">
		<div class="main__header-inner">

			<?php // Breadcrumbs
			get_template_part( 'template-parts/breadcrumbs' ); ?>

			<h1 class="main__title">

				<?php if ( is_post_type_archive( 'forum' ) ) : ?>

					<?php echo esc_html( lsvr_lore_get_bbpress_archive_title() ); ?>

				<?php else : ?>

					<?php the_title(); ?>

				<?php endif; ?>

			</h1>

		</div>
	</header>
	<!-- MAIN HEADER : end -->

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<!-- PAGE CONTENT : begin -->
		<div class="page__content">

			<?php the_content(); ?>

		</div>
		<!-- PAGE CONTENT : end -->

	<?php endwhile; endif; ?>

</div>
<!-- POST ARCHIVE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>