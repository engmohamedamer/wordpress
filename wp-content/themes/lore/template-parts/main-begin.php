

<!-- CORE COLUMNS : begin -->
<div class="core__columns">
	<div class="core__columns-inner">
		<div class="lsvr-container">
			<div class="core__columns-bg">

				<?php if ( 'left' === apply_filters( 'lsvr_lore_sidebar_position', 'disable' ) ) : ?>
					<div class="lsvr-grid">
						<div class="core__columns-main core__columns-main--right lsvr-grid__col lsvr-grid__col--span-8 lsvr-grid__col--push-4">
				<?php elseif ( 'right' === apply_filters( 'lsvr_lore_sidebar_position', 'disable' ) ) : ?>
					<div class="lsvr-grid">
						<div class="core__columns-main core__columns-main--left lsvr-grid__col lsvr-grid__col--span-8">
				<?php endif; ?>

				<!-- MAIN : begin -->
				<main id="main">
					<div class="main__inner">
