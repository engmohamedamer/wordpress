<?php get_header(); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<?php // Archive
get_template_part( 'template-parts/blog/archive-layout', apply_filters( 'lsvr_lore_blog_archive_layout', 'default' ) ); ?>

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>