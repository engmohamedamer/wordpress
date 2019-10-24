<!-- POST ARCHIVE : begin -->
<div <?php lsvr_lore_the_kba_post_archive_class( 'lsvr_kba-post-archive--category-view' ); ?>>

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

	<?php if ( have_posts() && ! empty( lsvr_lore_get_kba_top_categories() ) ) : ?>

		<!-- CATEGORY LIST : begin -->
		<ul <?php lsvr_lore_the_kba_post_archive_list_class(); ?>>

			<?php foreach ( lsvr_lore_get_kba_top_categories() as $top_category ) : ?>

				<!-- CATEGORY : begin -->
				<li <?php lsvr_lore_the_kba_post_archive_grid_column_class(); ?>>
					<div class="post-archive__item-inner">

						<!-- CATEGORY HEADER : begin -->
						<div class="post-archive__item-header">

							<?php if ( ! empty( lsvr_lore_get_kba_cat_icon( $top_category->term_id ) ) ) : ?>

								<i class="post-archive__item-icon <?php echo esc_attr( lsvr_lore_get_kba_cat_icon( $top_category->term_id ) ); ?>"></i>

							<?php else : ?>

								<i class="post-archive__item-icon post-archive__item-icon--default"></i>

							<?php endif; ?>

							<h2 class="post-archive__item-title">
								<a href="<?php echo esc_url( get_term_link( $top_category ) ); ?>"
	                				class="post-archive__item-link"><?php echo esc_attr( $top_category->name ); ?></a>
            				</h2>

							<?php if ( ! empty( term_description( $top_category->term_id, 'lsvr_kba_cat' ) ) ) : ?>

								<div class="post-archive__item-description">

									<?php echo wpautop( term_description( $top_category->term_id, 'lsvr_kba_cat' ) ); ?>

								</div>

							<?php endif; ?>

						</div>
						<!-- CATEGORY HEADER : end -->

						<?php $subcategories = lsvr_lore_get_kba_subcategories( $top_category->term_id );
						if ( ! empty( $subcategories ) ) : ?>

							<!-- CATEGORY CHILDREN : begin -->
							<div class="post-archive__item-children-wrapper post-archive__item-children-wrapper--categories">

								<h6 class="post-archive__item-children-wrapper-title">
									<span class="post-archive__item-children-wrapper-title-inner">
										<?php echo esc_html( sprintf( _n( '%d Subcategory', '%d Subcategories', count( $subcategories ), 'lore' ), count( $subcategories ) ) ); ?>
									</span>
								</h6>

								<ul class="post-archive__item-children post-archive__item-children--categories">

									<?php foreach ( $subcategories as $subcategory ) : ?>

										<li class="post-archive__item-child post-archive__item-child--category">

											<?php if ( ! empty( lsvr_lore_get_kba_cat_icon( $subcategory->term_id ) ) ) : ?>

												<i class="post-archive__item-child-icon <?php echo esc_attr( lsvr_lore_get_kba_cat_icon( $subcategory->term_id ) ); ?>"></i>

											<?php else : ?>

												<i class="post-archive__item-child-icon post-archive__item-child-icon--default"></i>

											<?php endif; ?>

											<a href="<?php echo esc_url( get_term_link( $subcategory ) ); ?>"
	                							class="post-archive__item-child-link"><?php echo esc_html( $subcategory->name ); ?></a>

                							<span class="post-archive__item-child-count">
            									<?php echo esc_html( sprintf( _n( '%d Article', '%d Articles', $subcategory->count, 'lore' ), $subcategory->count ) ); ?>
                							</span>

										</li>

									<?php endforeach; ?>

								</ul>

							</div>
							<!-- CATEGORY CHILDREN : end -->

						<?php endif; ?>

						<?php $posts = lsvr_lore_get_kba_category_posts( $top_category->term_id );
						if ( ! empty( $posts ) ) : ?>

							<!-- CATEGORY CHILDREN : begin -->
							<div class="post-archive__item-children-wrapper post-archive__item-children-wrapper--posts">

								<h6 class="post-archive__item-children-wrapper-title">
									<span class="post-archive__item-children-wrapper-title-inner">
										<?php echo esc_html( sprintf( _n( '%d Article', '%d Articles', $top_category->count, 'lore' ), $top_category->count ) ); ?>
									</span>
								</h6>

								<ul class="post-archive__item-children post-archive__item-children--posts">

									<?php foreach ( $posts as $post ) : ?>

										<li class="post-archive__item-child post-archive__item-child--post">

											<?php if ( ! empty( get_post_format( $post->ID ) ) ) : ?>

												<i class="post-archive__item-child-icon c-lsvr_kba-format-icon c-lsvr_kba-format-icon--<?php echo esc_attr( get_post_format( $post->ID ) ); ?>"></i>

											<?php else : ?>

												<i class="post-archive__item-child-icon c-post-type-icon c-post-type-icon--lsvr_kba"></i>

											<?php endif; ?>

											<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"
	                							class="post-archive__item-child-link"><?php echo esc_html( $post->post_title ); ?></a>

										</li>

									<?php endforeach; ?>

								</ul>

								<?php if ( $top_category->count > count( $posts ) ) : ?>

									<p class="post-archive__item-more">
										<a href="<?php echo esc_url( get_term_link( $top_category ) ); ?>"
											class="post-archive__item-more-link"><?php esc_html_e( 'More Articles', 'lore' ); ?></a>
									</p>

								<?php endif; ?>

							</div>
							<!-- CATEGORY CHILDREN : end -->

						<?php endif; ?>

					</div>
				</li>
				<!-- CATEGORY : end -->

			<?php endforeach; ?>

		</ul>
		<!-- CATEGORY LIST : end -->

	<?php else : ?>

		<?php lsvr_lore_the_alert_message( esc_html__( 'There are no categories.', 'lore' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->
