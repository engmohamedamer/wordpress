<?php if ( true === apply_filters( 'lsvr_lore_breadcrumbs_enable', true ) &&
	! empty( apply_filters( 'lsvr_lore_breadcrumbs', '' ) ) &&
	count( apply_filters( 'lsvr_lore_breadcrumbs', '' ) ) >= apply_filters( 'lsvr_lore_breadcrumbs_min_length', 2 ) ) : ?>

	<?php do_action( 'lsvr_lore_breadcrumbs_before' ); ?>

	<!-- BREADCRUMBS : begin -->
	<div class="breadcrumbs">
		<div class="breadcrumbs__inner">

			<?php do_action( 'lsvr_lore_breadcrumbs_top' ); ?>

			<ul class="breadcrumbs__list">
				<?php foreach ( apply_filters( 'lsvr_lore_breadcrumbs', '' ) as $breadcrumb ) : ?>
					<li class="breadcrumbs__item">
						<a href="<?php echo esc_url( $breadcrumb['url'] ); ?>" class="breadcrumbs__link"><?php echo esc_html( $breadcrumb['label'] ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>

			<?php do_action( 'lsvr_lore_breadcrumbs_bottom' ); ?>

		</div>
	</div>
	<!-- BREADCRUMBS : end -->

	<?php do_action( 'lsvr_lore_breadcrumbs_after' ); ?>

<?php endif; ?>