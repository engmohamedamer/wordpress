<?php if ( true === apply_filters( 'lsvr_lore_post_single_navigation_enable', false ) &&
	( lsvr_lore_has_previous_post() || lsvr_lore_has_next_post() ) ) : ?>

	<!-- POST NAVIGATION : begin -->
	<div class="post-navigation">
		<ul class="post-navigation__list">

			<?php if ( lsvr_lore_has_previous_post() ) : ?>

				<!-- PREVIOUS POST : begin -->
				<li class="post-navigation__prev<?php if ( lsvr_lore_has_previous_post_thumb() ) { echo ' post-navigation__prev--has-thumb'; } ?>">
					<div class="post-navigation__prev-inner">

						<?php if ( lsvr_lore_has_previous_post_thumb() ) : ?>
							<a href="<?php echo esc_url( lsvr_lore_get_previous_post_url() ); ?>"
								class="post-navigation__thumb-link">
								<img class="post-navigation__thumb"
									src="<?php echo esc_url( lsvr_lore_get_previous_post_thumb_url() ); ?>"
									alt="<?php echo esc_attr( lsvr_lore_get_previous_post_title() ); ?>">
							</a>
						<?php endif; ?>

						<h6 class="post-navigation__title">
							<a href="<?php echo esc_url( lsvr_lore_get_previous_post_url() ); ?>"
								class="post-navigation__title-link">
								<?php esc_html_e( 'السابق', 'lore' ); ?>
							</a>
						</h6>

						<a href="<?php echo esc_url( lsvr_lore_get_previous_post_url() ); ?>"
							class="post-navigation__link">
							<?php echo esc_html( lsvr_lore_get_previous_post_title() ); ?>
						</a>

					</div>
				</li>
				<!-- PREVIOUS POST : end -->

			<?php endif; ?>

			<?php if ( lsvr_lore_has_next_post() ) : ?>

				<!-- NEXT POST : begin -->
				<li class="post-navigation__next<?php if ( lsvr_lore_has_next_post_thumb() ) { echo ' post-navigation__next--has-thumb'; } ?>">
					<div class="post-navigation__next-inner">

						<?php if ( lsvr_lore_has_next_post_thumb() ) : ?>
							<a href="<?php echo esc_url( lsvr_lore_get_next_post_url() ); ?>"
								class="post-navigation__thumb-link">
								<img class="post-navigation__thumb"
									src="<?php echo esc_url( lsvr_lore_get_next_post_thumb_url() ); ?>"
									alt="<?php echo esc_attr( lsvr_lore_get_next_post_title() ); ?>">
							</a>
						<?php endif; ?>

						<h6 class="post-navigation__title">
							<a href="<?php echo esc_url( lsvr_lore_get_next_post_url() ); ?>"
								class="post-navigation__title-link">
								<?php esc_html_e( 'التالي', 'lore' ); ?>
							</a>
						</h6>

						<a href="<?php echo esc_url( lsvr_lore_get_next_post_url() ); ?>"
							class="post-navigation__link">
							<?php echo esc_html( lsvr_lore_get_next_post_title() ); ?>
						</a>

					</div>
				</li>
				<!-- NEXT POST : end -->

			<?php endif; ?>

		</ul>
	</div>
	<!-- POST NAVIGATION : end -->

<?php endif; ?>
