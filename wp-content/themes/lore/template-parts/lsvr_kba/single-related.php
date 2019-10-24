<?php if ( ( ! empty( get_post_meta( get_the_ID(), 'lsvr_kba_related_articles', true ) ) || true === get_theme_mod( 'lsvr_kba_single_related_enable', true ) )
	 && ! empty( lsvr_lore_get_kba_related( get_the_ID() ) ) ) : ?>

	<!-- POST RELATED : begin -->
	<div class="post-related">
		<div class="post-related__inner">

			<h6 class="post-related__title">
				<?php esc_html_e( 'Related Articles', 'lore' ); ?>
			</h6>

			<ul class="post-related__list">

				<?php foreach ( lsvr_lore_get_kba_related( get_the_ID(), get_theme_mod( 'lsvr_kba_single_related_limit', 5 ) ) as $post_id => $related_post ) : ?>

					<li class="post-related__item">

						<?php if ( ! empty( get_post_format( $post_id ) ) ) : ?>

							<i class="post-related__icon c-lsvr_kba-format-icon c-lsvr_kba-format-icon--<?php echo esc_attr( get_post_format( $post_id ) ); ?>"></i>

						<?php else : ?>

							<i class="post-related__icon c-post-type-icon c-post-type-icon--lsvr_kba"></i>

						<?php endif; ?>

						<a href="<?php echo esc_url( $related_post['url'] ); ?>" class="post-related__link">
							<?php echo esc_html( $related_post['post_title'] ); ?>
						</a>

						<?php include( locate_template( 'template-parts/lsvr_kba/rating.php', false, false ) ); ?>

					</li>

				<?php endforeach; ?>

			</ul>

		</div>
	</div>
	<!-- POST RELATED : begin -->

<?php endif; ?>
