<?php /* Template Name: Wide w/o Title */
esc_html__( 'Wide w/o Title', 'lore' ); ?>

<?php get_header(); ?>

<!-- CORE COLUMNS : begin -->
<div class="core__columns core__columns--wide">
	<div class="core__columns-inner">
		<div class="lsvr-container">
			<div class="core__columns-bg">

				<!-- MAIN : begin -->
				<main id="main">
					<div class="main__inner">

					<div class="categories-list lsvr-grid">

						<div class="lsvr-grid__col lsvr-grid__col--span-6">
						<article class="category-info ">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/operations.svg" alt="" />
							<header class="info">
								<h1>
									كفاءة
									<span>العمليات</span>
								</h1>
								<p>الإرشادات اللازمة لضمان جودة كفاءة العمليات</p>
							</header>
							<a href="#" class="more"><i class="lsvr_kba-tree-widget__item-toggle-icon"></i></a>
						</article>
					</div><div class="lsvr-grid__col lsvr-grid__col--span-6">
					<article class="category-info ">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/governance.svg" alt="" />
						<header class="info">
							<h1>
								الحوكمة
								<span>الرقمية</span>
							</h1>
							<p>تعرف علي آليات التحول الرقمي والتقنيات المستخدمة </p>
						</header>
						<a href="#" class="more"><i class="lsvr_kba-tree-widget__item-toggle-icon"></i></a>
					</article>
				</div><div class="lsvr-grid__col lsvr-grid__col--span-6">
				<article class="category-info ">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/skills.svg" alt="" />
					<header class="info">
						<h1>
							تطوير
							<span>المهارات</span>
						</h1>
						<p>الارشادات المتبعة لتطوير مهارات الموظفين</p>
					</header>
					<a href="#" class="more"><i class="lsvr_kba-tree-widget__item-toggle-icon"></i></a>
				</article>
			</div><div class="lsvr-grid__col lsvr-grid__col--span-6">
			<article class="category-info ">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/journey.svg" alt="" />
				<header class="info">
					<h1>
						رحلة
						<span>المستخدم الرقمية</span>
					</h1>
					<p>تعرف علي الخطوات المتبعة لاجراء رحلة مستخدم رقمية </p>
				</header>
				<a href="#" class="more"><i class="lsvr_kba-tree-widget__item-toggle-icon"></i></a>
			</article>
		</div>

					</div>



						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<div <?php post_class(); ?>>

								<?php get_template_part( 'template-parts/page', 'content' ); ?>

							</div>

						<?php endwhile; endif; ?>

					</div>
				</main>
				<!-- MAIN : end -->

			</div>
		</div>
	</div>
</div>
<!-- CORE COLUMNS : end -->

<?php get_footer(); ?>
