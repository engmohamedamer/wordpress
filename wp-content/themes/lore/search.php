<?php get_header(); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<!-- POST ARCHIVE : begin -->
<div class="general-post-archive author-post-archive">

	<!-- MAIN HEADER : begin -->
	<header class="main__header">
		<div class="main__header-inner">

			<h1 class="main__title">
				<?php echo apply_filters( 'lsvr_lore_search_results_title', sprintf( esc_html__( 'Search: %s', 'lore' ), get_search_query() ) ); ?>
			</h1>

		</div>
	</header>
	<!-- MAIN HEADER : end -->

	<?php if ( have_posts() ) : ?>

		<p class="post-archive__count">
			<?php echo esc_html( sprintf( _n( '%d result', '%d results', $wp_query->found_posts, 'lore' ), $wp_query->found_posts ) ); ?>
		</p>

		<!-- POST ARCHIVE LIST : begin -->
		<div class="post-archive__list">

			<?php while ( have_posts() ) : the_post(); ?>

				<article <?php post_class( 'post' ); ?>>
					<div class="post__inner">

						<?php if ( 'lsvr_kba' === get_post_type() && ! empty( get_post_format() ) ) : ?>

							<i class="post__icon c-lsvr_kba-format-icon c-lsvr_kba-format-icon--<?php echo esc_attr( get_post_format() ); ?>"></i>

						<?php else : ?>

							<i class="post__icon c-post-type-icon c-post-type-icon--<?php echo esc_attr( get_post_type() ); ?>"></i>

						<?php endif; ?>

						<!-- POST HEADER : begin -->
						<header class="post__header">
							<div class="post__header-inner">

								<!-- POST TITLE : begin -->
								<h2 class="post__title">
									<a href="<?php the_permalink(); ?>" class="post__title-link" rel="bookmark"><?php the_title(); ?></a>
								</h2>
								<!-- POST TITLE : end -->

							</div>
						</header>
						<!-- POST HEADER : end -->

						<?php if ( true === get_theme_mod( 'search_results_excerpt_enable', true ) && ! empty( $post->post_excerpt ) ) : ?>

							<!-- POST CONTENT : begin -->
							<div class="post__content">
								<?php the_excerpt(); ?>
							</div>
							<!-- POST CONTENT : end -->

						<?php endif; ?>

						<?php if ( ( 'lsvr_kba' === get_post_type() && true === get_theme_mod( 'lsvr_kba_archive_date_enable', true ) )
							|| ( 'lsvr_kba' === get_post_type() && true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) )
							|| 'post' === get_post_type() ) : ?>

							<!-- POST FOOTER : begin -->
							<footer class="post__footer">
								<div class="post__footer-inner">

									<?php if ( 'lsvr_kba' === get_post_type() && true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) ) : ?>

										<p class="post__rating">
											<?php get_template_part( 'template-parts/lsvr_kba/rating' ); ?>
										</p>

									<?php endif; ?>

									<?php if ( ( 'lsvr_kba' === get_post_type() && true === get_theme_mod( 'lsvr_kba_archive_date_enable', true ) )
										|| 'post' === get_post_type() ) : ?>

										<p class="post__date">
											<time class="post__date-published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
												<?php echo get_the_date(); ?>
											</time>
										</p>

									<?php endif; ?>

								</div>
							</footer>
							<!-- POST FOOTER : end -->

						<?php endif; ?>

					</div>
				</article>

			<?php endwhile; ?>

		</div>
		<!-- POST ARCHIVE LIST : end -->

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php else : ?>

		<?php lsvr_lore_the_alert_message( sprintf( esc_html__( 'Sorry, no results for %s.', 'lore' ), get_search_query() ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>