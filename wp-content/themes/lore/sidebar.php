<?php if ( is_active_sidebar( apply_filters( 'lsvr_lore_sidebar_id', '' ) ) ) : ?>

	<!-- SIDEBAR : begin -->
	<aside id="sidebar">
		<div class="sidebar__inner">

			<?php dynamic_sidebar( apply_filters( 'lsvr_lore_sidebar_id', '' ) ); ?>

		</div>
	</aside>
	<!-- SIDEBAR : end -->

<?php endif; ?>
