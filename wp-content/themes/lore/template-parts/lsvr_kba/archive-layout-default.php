<!-- POST ARCHIVE : begin -->
<div <?php lsvr_lore_the_kba_post_archive_class( 'lsvr_kba-post-archive--default' ); ?>>

	<!-- MAIN HEADER : begin -->
	<header class="main__header">
		<div class="main__header-inner">

			<?php // Breadcrumbs
			get_template_part( 'template-parts/breadcrumbs' ); ?>

			<h1 class="main__title">
				<?php echo apply_filters( 'lsvr_lore_kba_archive_title', lsvr_lore_get_kba_archive_title() ); ?>
			</h1>

		</div>
	</header>
	<!-- MAIN HEADER : end -->

	<?php if ( ! empty( term_description( get_queried_object_id(), 'lsvr_kba_cat' ) ) ) : ?>

		<!-- POST ARCHIVE DESCRIPTION : begin -->
		<div class="post-archive__description">

			<?php echo wpautop( term_description( get_queried_object_id(), 'lsvr_kba_cat' ) ); ?>

		</div>
		<!-- POST ARCHIVE DESCRIPTION : end -->

	<?php endif; ?>

	<?php $subcategories = lsvr_lore_get_kba_subcategories( get_queried_object_id() );
		if ( ! empty( $subcategories ) ) : ?>

		<!-- POST ARCHIVE SUBCATEGORIES : begin -->
		<div class="post-archive__subcategories-wrapper">
			<ul class="post-archive__subcategories">

				<?php foreach ( $subcategories as $subcategory ) : ?>

					<li class="post-archive__subcategory">
						<div class="post-archive__subcategory-inner">

							<div class="post-archive__subcategory-header">

								<?php if ( ! empty( lsvr_lore_get_kba_cat_icon( $subcategory->term_id ) ) ) : ?>

									<i class="post-archive__subcategory-icon <?php echo esc_attr( lsvr_lore_get_kba_cat_icon( $subcategory->term_id ) ); ?>"></i>

								<?php else : ?>

									<i class="post-archive__subcategory-icon post-archive__subcategory-icon--default"></i>

								<?php endif; ?>

								<a href="<?php echo esc_url( get_term_link( $subcategory ) ); ?>"
									class="post-archive__subcategory-link"><?php echo esc_html( $subcategory->name ); ?></a>

								<span class="post-archive__subcategory-count">
									<?php echo esc_html( sprintf( _n( '(%d Article)', '(%d Articles)', $subcategory->count, 'lore' ), $subcategory->count ) ); ?>
								</span>

							</div>

							<?php if ( ! empty( term_description( $subcategory->term_id, 'lsvr_kba_cat' ) ) ) : ?>

								<div class="post-archive__subcategory-description">

									<?php echo wpautop( term_description( $subcategory->term_id, 'lsvr_kba_cat' ) ); ?>

								</div>

							<?php endif; ?>

						</div>
					</li>

				<?php endforeach; ?>

			</ul>
		</div>
		<!-- POST ARCHIVE SUBCATEGORIES : end -->

	<?php endif; ?>

	<?php if ( have_posts() ) : ?>

		<p class="post-archive__count">
			<?php echo esc_html( sprintf( _n( '%d المواضيع', '%d المواضيع', $wp_query->found_posts, 'lore' ), $wp_query->found_posts ) ); ?>
		</p>

		<!-- POST ARCHIVE LIST : begin -->
		<div <?php lsvr_lore_the_kba_post_archive_list_class(); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<!-- POST : begin -->
				<article <?php post_class( 'post' ); ?>>
					<div class="post__inner">

						<?php if ( ! empty( get_post_format() ) ) : ?>

							<i class="post__icon c-lsvr_kba-format-icon c-lsvr_kba-format-icon--<?php echo esc_attr( get_post_format() ); ?>"></i>

						<?php else : ?>

							<i class="post__icon c-post-type-icon c-post-type-icon--lsvr_kba"></i>

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

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>

							<!-- POST CONTENT : begin -->
							<div class="post__content">

								<?php the_excerpt(); ?>

							</div>
							<!-- POST CONTENT : end -->

						<?php endif; ?>

						<?php if ( true === get_theme_mod( 'lsvr_kba_archive_date_enable', true ) ||
							( true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) && 'disable' !== get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) ) : ?>

							<!-- POST FOOTER : begin -->
							<footer class="post__footer">
								<div class="post__footer-inner">

									<?php if ( true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) ) : ?>

										<p class="post__rating">
											<?php get_template_part( 'template-parts/lsvr_kba/rating' ); ?>
										</p>

									<?php endif; ?>

									<?php if ( true === get_theme_mod( 'lsvr_kba_archive_date_enable', true ) ) : ?>

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
				<!-- POST : end -->

			<?php endwhile; ?>

		</div>
		<!-- POST ARCHIVE LIST : end -->

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php else : ?>

		<?php lsvr_lore_the_alert_message( esc_html__( 'There are no articles.', 'lore' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->
