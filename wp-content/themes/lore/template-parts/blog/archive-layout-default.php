<!-- POST ARCHIVE : begin -->
<div <?php lsvr_lore_the_blog_post_archive_class( 'blog-post-archive--default' ); ?>>

	<!-- MAIN HEADER : begin -->
	<header class="main__header">
		<div class="main__header-inner">

			<?php // Breadcrumbs
			get_template_part( 'template-parts/breadcrumbs' ); ?>

			<h1 class="main__header-title">
				<?php echo apply_filters( 'lsvr_lore_blog_archive_title', lsvr_lore_get_blog_archive_title() ); ?>
			</h1>

		</div>
	</header>
	<!-- MAIN HEADER : end -->

	<?php if ( have_posts() ) : ?>

		<!-- POST ARCHIVE LIST : begin -->
		<div <?php lsvr_lore_the_blog_post_archive_list_class(); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<!-- POST : begin -->
				<article <?php post_class( 'post' ); ?>>
					<div class="post__inner">

						<?php if ( has_post_thumbnail() ) : ?>

							<!-- POST THUMBNAIL : begin -->
							<p class="post__thumbnail">
								<a href="<?php the_permalink(); ?>" class="post__thumbnail-link"><?php the_post_thumbnail(); ?></a>
							</p>
							<!-- POST THUMBNAIL : end -->

						<?php endif; ?>

						<!-- POST HEADER : begin -->
						<header class="post__header">
							<div class="post__header-inner">

								<!-- POST TITLE : begin -->
								<h2 class="post__header-title">
									<a href="<?php the_permalink(); ?>" class="post__header-link" rel="bookmark"><?php the_title(); ?></a>
								</h2>
								<!-- POST TITLE : end -->

								<?php if ( ( lsvr_lore_has_post_terms( get_the_ID(), 'category' ) && true === get_theme_mod( 'blog_archive_categories_enable', true ) )
									|| ( lsvr_lore_has_post_terms( get_the_ID(), 'post_tag' ) && true == get_theme_mod( 'blog_archive_tags_enable', true ) )
									|| ( lsvr_lore_has_post_comments( get_the_ID() ) && true === get_theme_mod( 'blog_archive_comments_enable', true ) ) ) : ?>

									<!-- POST META : begin -->
									<p class="post__meta">

										<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'category' ) && true === get_theme_mod( 'blog_archive_categories_enable', true ) ) : ?>
											<span class="post__meta-item post__meta-item--categories">
												<?php lsvr_lore_the_post_terms( get_the_ID(), 'category', '%s', ', ' ); ?>
											</span>
										<?php endif; ?>

										<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'post_tag' ) && true == get_theme_mod( 'blog_archive_tags_enable', true ) ) : ?>
											<span class="post__meta-item post__meta-item--tags">
												<?php lsvr_lore_the_post_terms( get_the_ID(), 'post_tag', '%s', ', ' ); ?>
											</span>
										<?php endif; ?>

										<?php if ( lsvr_lore_has_post_comments( get_the_ID() ) && true === get_theme_mod( 'blog_archive_comments_enable', true ) ) : ?>
											<span class="post__meta-item post__meta-item--comments">
												<a href="<?php the_permalink(); ?>#comments"
													class="post__meta-item-link"><?php echo sprintf( esc_html( _n( '%s Comment', '%s Comments', lsvr_lore_get_post_comments_count(), 'lore' ) ), lsvr_lore_get_post_comments_count() ); ?></a>
											</span>
										<?php endif; ?>

									</p>
									<!-- POST META : end -->

								<?php endif; ?>

							</div>
						</header>
						<!-- POST HEADER : end -->

						<!-- POST CONTENT : begin -->
						<div class="post__content">

							<?php if ( ! empty( $post->post_excerpt ) ) : ?>

								<?php the_excerpt(); ?>

							<?php else : ?>

								<?php the_content(); ?>

							<?php endif; ?>

						</div>
						<!-- POST CONTENT : end -->

						<!-- POST FOOTER : begin -->
						<footer class="post__footer">
							<div class="post__footer-inner">

								<!-- POST DATE : begin -->
								<p class="post__date">

									<time class="post__date-published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
										<?php echo get_the_date(); ?>
									</time>

									<?php if ( true === get_theme_mod( 'blog_archive_author_name_enable', true ) ) : ?>
										<span class="post__date-author">
											<?php echo sprintf( esc_html__( 'by %s', 'lore' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="post__date-author-link" rel="author">' . get_the_author() . '</a>' ); ?>
										</span>
									<?php endif; ?>

								</p>
								<!-- POST DATE : end -->

								<!-- POST PERMALINK : begin -->
								<p class="post__permalink">
									<a href="<?php the_permalink(); ?>" class="post__permalink-link c-button" rel="bookmark">
										<?php esc_html_e( 'Read More', 'lore' ); ?>
									</a>
								</p>
								<!-- POST PERMALINK : end -->

							</div>
						</footer>
						<!-- POST FOOTER : end -->

					</div>
				</article>
				<!-- POST : end -->

			<?php endwhile; ?>

		</div>
		<!-- POST ARCHIVE LIST : end -->

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php else : ?>

		<?php lsvr_lore_the_alert_message( esc_html__( 'There are no posts', 'lore' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->