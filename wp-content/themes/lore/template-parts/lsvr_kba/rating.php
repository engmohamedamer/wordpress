<?php if ( 'disable' !== get_theme_mod( 'lsvr_kba_rating_enable', 'disable' )
	&& ( isset( $post_id ) || $post_id = get_the_ID() ) ) : ?>

	<?php if ( 'likes' == get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) : ?>

		<span class="c-post-rating">
			<span class="c-post-rating__likes"
				title="<?php echo esc_attr( sprintf( esc_html__( '%d likes', 'lore' ), lsvr_lore_get_kba_likes( $post_id ) ) ); ?>">
				<?php echo esc_html( lsvr_lore_get_kba_likes_abb( $post_id ) ); ?>
			</span>
		</span>

	<?php elseif ( 'both' == get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) : ?>

		<span class="c-post-rating">
			<span class="c-post-rating__likes"
				title="<?php echo esc_attr( sprintf( esc_html__( '%d likes', 'lore' ), lsvr_lore_get_kba_likes( $post_id ) ) ); ?>">
				<?php echo esc_html( lsvr_lore_get_kba_likes_abb( $post_id ) ); ?>
			</span>
			<span class="c-post-rating__dislikes"
				title="<?php echo esc_attr( sprintf( esc_html__( '%d dislikes', 'lore' ), lsvr_lore_get_kba_dislikes( $post_id ) ) ); ?>">
				<?php echo esc_html( lsvr_lore_get_kba_dislikes_abb( $post_id ) ); ?>
			</span>
		</span>

	<?php elseif ( 'sum' == get_theme_mod( 'lsvr_kba_rating_enable', 'disable' ) ) : ?>

		<span class="c-post-rating">
			<span class="c-post-rating__sum c-post-rating__sum--<?php echo (int) lsvr_lore_get_kba_rating_sum( $post_id ) >= 0 ? 'positive' : 'negative'; ?>">
				<?php echo esc_html( lsvr_lore_get_kba_rating_sum_abs_abb( $post_id ) ); ?>
			</span>
		</span>

	<?php endif; ?>

<?php endif; ?>