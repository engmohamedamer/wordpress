					</div>
				</main>
				<!-- MAIN : end -->

				<?php if ( 'disable' !== apply_filters( 'lsvr_lore_sidebar_position', 'disable' ) ) : ?>
					</div>

					<?php if ( 'left' === apply_filters( 'lsvr_lore_sidebar_position', 'disable' ) ) : ?>
						<div class="core__columns-sidebar core__columns-sidebar--left lsvr-grid__col lsvr-grid__col--span-4 lsvr-grid__col--pull-8">
					<?php elseif ( 'right' === apply_filters( 'lsvr_lore_sidebar_position', 'disable' ) ) : ?>
						<div class="core__columns-sidebar core__columns-sidebar--right lsvr-grid__col lsvr-grid__col--span-4">
					<?php endif; ?>

						<?php // Sidebar
						get_sidebar(); ?>

					</div>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
<!-- CORE COLUMNS : end -->