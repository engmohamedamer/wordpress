<?php get_header(); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<!-- POST SINGLE : begin -->
<div class="lsvr_faq-post-page post-single lsvr_faq-post-single">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<!-- POST : begin -->
		<article <?php post_class( 'post' ); ?>>
			<div class="post__inner">

				<!-- MAIN HEADER : begin -->
				<header class="main__header">
					<div class="main__header-inner">

						<?php // Breadcrumbs
						get_template_part( 'template-parts/breadcrumbs' ); ?>

						<h1 class="main__title">
							<?php the_title(); ?>
						</h1>

					</div>
				</header>
				<!-- MAIN HEADER : end -->

				<!-- POST CONTENT : begin -->
				<div class="post__content">
					<?php the_content(); ?>
				</div>
				<!-- POST CONTENT : end -->

				<?php // Add custom code before post footer
				do_action( 'lsvr_lore_faq_single_footer_before' ); ?>

				<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'lsvr_faq_cat' ) ||
					lsvr_lore_has_post_terms( get_the_ID(), 'lsvr_faq_tag' ) ) : ?>

					<!-- POST FOOTER : begin -->
					<footer class="post__footer">

						<!-- POST META : begin -->
						<p class="post__meta">

							<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'lsvr_faq_cat' ) ) : ?>
								<span class="post__meta-item post__meta-item--categories">
									<?php lsvr_lore_the_post_terms( get_the_ID(), 'lsvr_faq_cat', '%s', ', ' ); ?>
								</span>
							<?php endif; ?>

							<?php if ( lsvr_lore_has_post_terms( get_the_ID(), 'lsvr_faq_tag' ) ) : ?>
								<span class="post__meta-item post__meta-item--tags">
									<?php lsvr_lore_the_post_terms( get_the_ID(), 'lsvr_faq_tag', '%s', ', ' ); ?>
								</span>
							<?php endif; ?>

						</p>
						<!-- POST META : end -->

					</footer>
					<!-- POST FOOTER : end -->

				<?php endif; ?>

				<?php // Add custom code after post footer
				do_action( 'lsvr_lore_faq_single_footer_after' ); ?>

				<?php // Post navigation
				get_template_part( 'template-parts/single-navigation' ); ?>

				<?php // Add custom code at post bottom
				do_action( 'lsvr_lore_faq_single_bottom' ); ?>

			</div>
		</article>
		<!-- POST : end -->

	<?php endwhile; endif; ?>

</div>
<!-- POST SINGLE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>