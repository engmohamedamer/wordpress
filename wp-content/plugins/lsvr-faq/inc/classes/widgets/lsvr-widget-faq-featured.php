<?php
/**
 * LSVR Featured FAQ widget
 *
 * Single lsvr_faq post
 */
if ( ! class_exists( 'Lsvr_Widget_FAQ_Featured' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_FAQ_Featured extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_faq_faq_featured',
			'classname' => 'lsvr_faq-featured-widget',
			'title' => esc_html__( 'LSVR Featured FAQ', 'lsvr-faq' ),
			'description' => esc_html__( 'Single FAQ post', 'lsvr-faq' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-faq' ),
					'type' => 'text',
					'default' => esc_html__( 'Featured FAQ', 'lsvr-faq' ),
				),
				'post' => array(
					'label' => esc_html__( 'FAQ:', 'lsvr-faq' ),
					'description' => esc_html__( 'Choose FAQ to display.', 'lsvr-faq' ),
					'type' => 'post',
					'post_type' => 'lsvr_faq',
					'default_label' => esc_html__( 'Random', 'lsvr-faq' ),
				),
				'show_content' => array(
					'label' => esc_html__( 'Display Content', 'lsvr-faq' ),
					'description' => esc_html__( 'If this FAQ post has an excerpt, it will be displayed instead.', 'lsvr-faq' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_category' => array(
					'label' => esc_html__( 'Display Category', 'lsvr-faq' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-faq' ),
					'description' => esc_html__( 'Link to FAQ post archive. Leave blank to hide.', 'lsvr-faq' ),
					'type' => 'text',
					'default' => esc_html__( 'More FAQ', 'lsvr-faq' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Show content
    	$show_content = ! empty( $instance['show_content'] ) && ( true === $instance['show_content'] || 'true' === $instance['show_content'] || '1' === $instance['show_content'] ) ? true : false;

    	// Show category
    	$show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

    	// Get random post
    	if ( empty( $instance['post'] ) || ( ! empty( $instance['post'] ) && 'none' === $instance['post'] ) ) {
    		$faq_post = get_posts( array(
    			'post_type' => 'lsvr_faq',
    			'orderby' => 'rand',
    			'posts_per_page' => '1'
			));
			$faq_post = ! empty( $faq_post[0] ) ? $faq_post[0] : '';
    	}

    	// Get post
    	else if ( ! empty( $instance['post'] ) ) {
    		$faq_post = get_post( $instance['post'] );
    	}

        ?>

        <?php // Before widget content
        parent::before_widget_content( $args, $instance ); ?>

        <div class="widget__content lsvr_faq-featured-widget__content">

        	<?php if ( ! empty( $faq_post ) ) : ?>

    			<div class="lsvr_faq-featured-widget__content-inner">

	    			<h4 class="lsvr_faq-featured-widget__title">
	    				<a href="<?php echo esc_url( get_permalink( $faq_post->ID ) ); ?>" class="lsvr_faq-featured-widget__title-link">
	    					<?php echo get_the_title( $faq_post->ID ); ?>
	    				</a>
	    			</h4>

					<?php // Content
					if ( true === $show_content && ( ! empty( $faq_post->post_excerpt ) || ! empty( $faq_post->post_content ) ) ) : ?>
						<div class="lsvr_faq-featured-widget__excerpt">

							<?php if ( ! empty( $faq_post->post_excerpt ) ) : ?>

								<?php echo wpautop( $faq_post->post_excerpt ); ?>

							<?php elseif ( ! empty( $faq_post->post_content ) ) : ?>

								<?php echo wpautop( $faq_post->post_content ); ?>

							<?php endif; ?>

						</div>
					<?php endif; ?>

					<?php // Category
					$terms = wp_get_post_terms( $faq_post->ID, 'lsvr_faq_cat' );
					$category_html = '';
					if ( ! empty( $terms ) ) {
						foreach ( $terms as $term ) {
							$category_html .= '<a href="' . esc_url( get_term_link( $term->term_id, 'lsvr_faq_cat' ) ) . '" class="lsvr_faq-featured-widget__category-link">' . $term->name . '</a>';
							$category_html .= $term !== end( $terms ) ? ', ' : '';
						}
					}
					if ( true === $show_category && ! empty( $category_html ) ) : ?>
						<p class="lsvr_faq-featured-widget__category">
							<?php echo sprintf( esc_html__( 'in %s', 'lsvr-faq' ), $category_html ); ?>
						</p>
					<?php endif; ?>

					<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>
					<p class="widget__more">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_faq' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
					</p>
					<?php endif; ?>

				</div>

        	<?php else : ?>
        		<p class="widget__no-results"><?php esc_html_e( 'There are no FAQ posts', 'lsvr-faq' ); ?></p>
        	<?php endif; ?>

        </div>

        <?php // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>