<?php if ( 'disable' !== get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) : ?>

	<!-- POST RATING : begin -->
	<div class="post-rating post-rating--type-<?php echo esc_attr( get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ); ?>"
		data-post-id="<?php echo esc_attr( get_the_ID() ); ?>">
		<div class="post-rating__inner">

			<h4 class="post-rating__title">
				<?php esc_html_e( 'Was This Article Helpful?', 'lore' ); ?>
			</h4>

			<div class="post-rating__controls">

				<?php if ( 'likes' == get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) : ?>

					<button type="button" class="post-rating__button post-rating__button--like"
						aria-label="<?php esc_html_e( 'Like', 'lore' ); ?>"
						title="<?php echo esc_attr( sprintf( esc_html__( '%d likes', 'lore' ), lsvr_lore_get_kba_likes( get_the_ID() ) ) ); ?>">
						<?php echo esc_html( lsvr_lore_get_kba_likes_abb( get_the_ID() ) ); ?>
					</button>

				<?php elseif ( 'both' == get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) : ?>

					<button type="button" class="post-rating__button post-rating__button--like"
						aria-label="<?php esc_html_e( 'Like', 'lore' ); ?>"
						title="<?php echo esc_attr( sprintf( esc_html__( '%d likes', 'lore' ), lsvr_lore_get_kba_likes( get_the_ID() ) ) ); ?>">
						<?php echo esc_html( lsvr_lore_get_kba_likes_abb( get_the_ID() ) ); ?>
					</button>

					<button type="button" class="post-rating__button post-rating__button--dislike"
						aria-label="<?php esc_html_e( 'Dislike', 'lore' ); ?>"
						title="<?php echo esc_attr( sprintf( esc_html__( '%d dislikes', 'lore' ), lsvr_lore_get_kba_dislikes( get_the_ID() ) ) ); ?>">
						<?php echo esc_html( lsvr_lore_get_kba_dislikes_abb( get_the_ID() ) ); ?>
					</button>

				<?php elseif ( 'sum' == get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) : ?>

					<button type="button" class="post-rating__button post-rating__button--like"
						aria-label="<?php esc_html_e( 'Like', 'lore' ); ?>"></button>

					<span class="post-rating__sum">
						<?php echo esc_html( lsvr_lore_get_kba_rating_sum_abb( get_the_ID() ) ); ?>
					</span>

					<button type="button" class="post-rating__button post-rating__button--dislike"
						aria-label="<?php esc_html_e( 'Dislike', 'lore' ); ?>"></button>

				<?php endif; ?>

			</div>

		</div>
	</div>
	<!-- POST RATING : end -->

<?php endif; ?>