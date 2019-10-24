<?php get_header(); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<?php // Archive
get_template_part( 'template-parts/lsvr_faq/archive-layout', apply_filters( 'lsvr_lore_faq_archive_layout', 'default' ) ); ?>

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>