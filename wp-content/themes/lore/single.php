<?php get_header(); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>
<!-- POST SINGLE : begin -->
<div class="blog-post-page post-single blog-post-single">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<!-- POST : begin -->
		<article <?php post_class( 'post' ); ?>>
			<div class="post__inner">

				<!-- MAIN HEADER : begin -->
				<header class="main__header">
					<div class="main__header-inner">

						<?php // Breadcrumbs
						get_template_part( 'template-parts/breadcrumbs' ); ?>

						<h1 class="main__header-title">
							<?php the_title(); ?>
						</h1>

						<!-- POST DATE : begin -->
						<p class="post__date">

							<span class="post__date-published-wrapper">

								<time class="post__date-published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
									<?php echo get_the_date(); ?>
								</time>

								<?php if ( true === get_theme_mod( 'blog_single_author_name_enable', true ) ) : ?>
									<span class="post__date-author">
										<?php echo sprintf( esc_html__( 'by %s', 'lore' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="post__date-author-link" rel="author">' . get_the_author() . '</a>' ); ?>
									</span>
								<?php endif; ?>

							</span>

						</p>
						<!-- POST DATE : end -->

						<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'category' ) || comments_open() ) : ?>

							<!-- POST META : begin -->
							<p class="post__meta">

								<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'category' ) ) : ?>
									<span class="post__meta-item post__meta-item--categories">
										<?php lsvr_lore_the_post_terms( get_the_ID(), 'category', '%s', ', ' ); ?>
									</span>
								<?php endif; ?>

								<?php if ( comments_open() ) : ?>
									<span class="post__meta-item post__meta-item--comments">
										<a href="#comments" class="post__meta-item-link"><?php echo sprintf( esc_html( _n( '%s Comment', '%s Comments', lsvr_lore_get_post_comments_count(), 'lore' ) ), lsvr_lore_get_post_comments_count() ); ?></a>
									</span>
								<?php endif; ?>

							</p>
							<!-- POST META : end -->

						<?php endif; ?>

					</div>
				</header>
				<!-- MAIN HEADER : end -->

				<?php if ( has_post_thumbnail() ) : ?>

					<!-- POST THUMBNAIL : begin -->
					<p class="post__thumbnail">
						<?php the_post_thumbnail(); ?>
					</p>
					<!-- POST THUMBNAIL : end -->

				<?php endif; ?>

				<!-- POST CONTENT : begin -->
				<div class="post__content">
					<?php the_content(); ?>
				</div>
				<!-- POST CONTENT : end -->

				<?php // Add custom code before post footer
				do_action( 'lsvr_lore_blog_single_footer_before' ); ?>

				<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'post_tag' ) ) : ?>

					<!-- POST FOOTER : begin -->
					<footer class="post__footer">

						<!-- POST META : begin -->
						<p class="post__meta">

							<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'post_tag' ) ) : ?>
								<span class="post__meta-item post__meta-item--tags">
									<?php lsvr_lore_the_post_terms( get_the_ID(), 'post_tag', '%s', ', ' ); ?>
								</span>
							<?php endif; ?>

						</p>
						<!-- POST META : end -->

					</footer>
					<!-- POST FOOTER : end -->

				<?php endif; ?>

				<?php // Add custom code after post footer
				do_action( 'lsvr_lore_blog_single_footer_after' ); ?>

				<?php // Post author bio
				get_template_part( 'template-parts/single-author' ); ?>

				<?php // Post navigation
				get_template_part( 'template-parts/single-navigation' ); ?>

				<?php // Add custom code at post bottom
				do_action( 'lsvr_lore_blog_single_bottom' ); ?>

			</div>
		</article>
		<!-- POST : end -->

	    <?php // Post comments
	    comments_template(); ?>

	<?php endwhile; endif; ?>

</div>
<!-- POST SINGLE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>
