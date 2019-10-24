<!-- POST ARCHIVE : begin -->
<div <?php lsvr_lore_the_faq_post_archive_class( 'lsvr_faq-post-archive--default' ); ?>>

	<!-- MAIN HEADER : begin -->
	<header class="main__header">
		<div class="main__header-inner">

			<?php // Breadcrumbs
			get_template_part( 'template-parts/breadcrumbs' ); ?>

			<h1 class="main__title">
				<?php echo apply_filters( 'lsvr_lore_faq_archive_title', lsvr_lore_get_faq_archive_title() ); ?>
			</h1>

		</div>
	</header>
	<!-- MAIN HEADER : end -->

	<?php if ( have_posts() ) : ?>

		<!-- POST ARCHIVE LIST : begin -->
		<div <?php lsvr_lore_the_faq_post_archive_list_class(); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<!-- POST : begin -->
				<article <?php post_class( 'post' ); ?>>
					<div class="post__inner">

						<!-- POST HEADER : begin -->
						<header class="post__header">
							<div class="post__header-inner">

								<!-- POST TITLE : begin -->
								<h2 class="post__title">
									<?php the_title(); ?>
								</h2>
								<!-- POST TITLE : end -->

							</div>
						</header>
						<!-- POST HEADER : end -->

						<!-- POST CONTENT WRAPPER : begin -->
						<div class="post__content-wrapper">

							<!-- POST CONTENT : begin -->
							<div class="post__content">

								<?php if ( ! empty( $post->post_excerpt ) ) : ?>

									<?php the_excerpt(); ?>

									<!-- POST PERMALINK : begin -->
									<p class="post__permalink">
										<a href="<?php the_permalink(); ?>" class="post__permalink-link" rel="bookmark">
											<?php esc_html_e( 'Read More', 'lore' ); ?>
										</a>
									</p>
									<!-- POST PERMALINK : end -->

								<?php else : ?>

									<?php the_content(); ?>

								<?php endif; ?>

							</div>
							<!-- POST CONTENT : end -->

							<?php if ( ( lsvr_lore_has_post_terms( get_the_ID(), 'lsvr_faq_cat' ) && true === get_theme_mod( 'lsvr_faq_archive_category_enable', true ) )
								|| ( empty( $post->post_excerpt ) && true === get_theme_mod( 'lsvr_faq_archive_permalink_enable', true ) ) ) : ?>

								<!-- POST FOOTER : begin -->
								<footer class="post__footer">

									<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'lsvr_faq_cat' ) && true === get_theme_mod( 'lsvr_faq_archive_category_enable', true ) ) : ?>

										<!-- POST META : begin -->
										<p class="post__meta">
											<span class="post__meta-category">
												<?php lsvr_lore_the_post_terms( get_the_ID(), 'lsvr_faq_cat', esc_html__( 'in %s', 'lore' ) ); ?>
											</span>
										</p>
										<!-- POST META : end -->

									<?php endif; ?>

									<?php if ( empty( $post->post_excerpt ) && true === get_theme_mod( 'lsvr_faq_archive_permalink_enable', true ) ) : ?>

										<!-- POST PERMALINK : begin -->
										<p class="post__footer-permalink">
											<a href="<?php the_permalink(); ?>" class="post__footer-permalink-link" rel="bookmark"><?php esc_html_e( 'Permalink', 'lore' ); ?></a>
										</p>
										<!-- POST PERMALINK : end -->

									<?php endif; ?>

								</footer>
								<!-- POST FOOTER : end -->

							<?php endif; ?>

						</div>
						<!-- POST CONTENT WRAPPER : end -->

					</div>
				</article>
				<!-- POST : end -->

			<?php endwhile; ?>

		</div>
		<!-- POST ARCHIVE LIST : end -->

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php else : ?>

		<?php lsvr_lore_the_alert_message( esc_html__( 'There are no FAQ', 'lore' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->