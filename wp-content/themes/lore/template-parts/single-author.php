<?php if ( true === apply_filters( 'lsvr_lore_post_single_author_bio_enable', false ) &&
	! empty( get_the_author_meta( 'description' ) ) ) : ?>

	<!-- POST AUTHOR : begin -->
	<div class="post-author">
		<div class="post-author__inner">

			<p class="post-author__portrait">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
			</p>

			<div class="post-author__header">

				<h5 class="post-author__name">
					<?php echo esc_html( get_the_author() ); ?>
				</h5>

				<h6 class="post-author__badge"><?php echo esc_html__( 'Author', 'lore' ); ?></h6>

			</div>

			<?php if ( ! empty( get_the_author_meta( 'description' ) ) ) : ?>

				<div class="post-author__description">

					<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>

					<p class="post-author__more">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"
							class="post-author__more-link"><?php echo sprintf( esc_html( 'Articles by %s', 'lore' ), get_the_author() ); ?></a>
					</p>

				</div>

			<?php endif; ?>

		</div>
	</div>
	<!-- POST AUTHOR : end -->

<?php endif; ?>