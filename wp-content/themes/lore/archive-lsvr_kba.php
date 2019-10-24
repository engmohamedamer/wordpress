<?php get_header(); ?>
<h1><?php  get_the_archive_title()
 ?></h1>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>
<?php // Archive
get_template_part( 'template-parts/lsvr_kba/archive-layout', apply_filters( 'lsvr_lore_kba_archive_layout', 'default' ) ); ?>

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>
