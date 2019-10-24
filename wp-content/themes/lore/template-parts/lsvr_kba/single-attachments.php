<?php // Get post attachments
if ( lsvr_lore_has_kba_attachments( get_the_ID() ) && ! post_password_required( get_the_ID() ) ) : ?>

	<!-- POST ATTACHMENTS : begin -->
	<div class="post-attachments">

		<h4 class="post-attachments__title"><?php esc_html_e( 'Attachments', 'lore' ); ?></h4>

		<ul class="post-attachments__list">

			<?php foreach ( lsvr_lore_get_kba_attachments( get_the_ID() ) as $attachment ) : ?>

				<li class="post-attachments__item">
					<div class="post-attachments__item-inner">

						<i class="post-attachments__icon c-lsvr_kba-attachment-icon c-lsvr_kba-attachment-icon--<?php echo esc_attr( $attachment['extension'] ); ?><?php if ( ! empty( $attachment['filetype'] ) ) { echo ' lsvr_kba-attachment-icon--' . esc_attr( $attachment['filetype'] ); } ?>"></i>

						<a href="<?php echo esc_url( $attachment['url'] ); ?>"
							target="_blank"
							class="post-attachments__link">
							<?php if ( ! empty( $attachment['title'] ) ) {
								echo esc_html( $attachment['title'] );
							} else {
								echo esc_html( $attachment['filename'] );
							} ?>
						</a>

						<?php if ( ! empty( $attachment['filesize'] ) ) : ?>
							<span class="post-attachments__filesize"><?php echo esc_html( $attachment['filesize'] ); ?></span>
						<?php endif; ?>

						<?php if ( true === $attachment['external'] ) : ?>
							<span class="post-attachments__label"><?php esc_html_e( 'External', 'lore' ); ?></span>
						<?php endif; ?>

					</div>
				</li>

			<?php endforeach; ?>

		</ul>

	</div>
	<!-- POST ATTACHMENTS : end -->

<?php endif;  ?>