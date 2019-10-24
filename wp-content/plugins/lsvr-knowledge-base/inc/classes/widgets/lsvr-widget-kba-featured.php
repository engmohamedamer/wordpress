<?php
/**
 * LSVR Featured KBA widget
 *
 * Single lsvr_kba post
 */
if ( ! class_exists( 'Lsvr_Widget_KBA_Featured' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_KBA_Featured extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_knowledge_base_kba_featured',
			'classname' => 'lsvr_kba-featured-widget',
			'title' => esc_html__( 'LSVR Featured KB Article', 'lsvr-knowledge-base' ),
			'description' => esc_html__( 'Single KB article', 'lsvr-knowledge-base' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-knowledge-base' ),
					'type' => 'text',
					'default' => esc_html__( 'Featured KB Article', 'lsvr-knowledge-base' ),
				),
				'post' => array(
					'label' => esc_html__( 'Article:', 'lsvr-knowledge-base' ),
					'description' => esc_html__( 'Choose KB article to display.', 'lsvr-knowledge-base' ),
					'type' => 'post',
					'post_type' => 'lsvr_kba',
					'default_label' => esc_html__( 'Random', 'lsvr-knowledge-base' ),
				),
				'show_excerpt' => array(
					'label' => esc_html__( 'Display Excerpt', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_date' => array(
					'label' => esc_html__( 'Display Date', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_rating' => array(
					'label' => esc_html__( 'Display Rating', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_category' => array(
					'label' => esc_html__( 'Display Category', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-knowledge-base' ),
					'description' => esc_html__( 'Link to Knowledge Base post archive. Leave blank to hide.', 'lsvr-knowledge-base' ),
					'type' => 'text',
					'default' => esc_html__( 'More Articles', 'lsvr-knowledge-base' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Show excerpt
    	$show_excerpt = ! empty( $instance['show_excerpt'] ) && ( true === $instance['show_excerpt'] || 'true' === $instance['show_excerpt'] || '1' === $instance['show_excerpt'] ) ? true : false;

    	// Show category
    	$show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

    	// Show date
    	$show_date = ! empty( $instance['show_date'] ) && ( true === $instance['show_date'] || 'true' === $instance['show_date'] || '1' === $instance['show_date'] ) ? true : false;

    	// Show rating
    	$show_rating = ! empty( $instance['show_rating'] ) && ( true === $instance['show_rating'] || 'true' === $instance['show_rating'] || '1' === $instance['show_rating'] ) ? true : false;

    	// Get random post
    	if ( empty( $instance['post'] ) || ( ! empty( $instance['post'] ) && 'none' === $instance['post'] ) ) {
    		$post = get_posts( array(
    			'post_type' => 'lsvr_kba',
    			'orderby' => 'rand',
    			'posts_per_page' => '1'
			));
			$post = ! empty( $post[0] ) ? $post[0] : '';
    	}

    	// Get post
    	else if ( ! empty( $instance['post'] ) ) {
    		$post = get_post( $instance['post'] );
    	}

        ?>

        <?php // Before widget content
        parent::before_widget_content( $args, $instance ); ?>

        <div class="widget__content lsvr_kba-featured-widget__content<?php echo true === $show_rating && true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) ? ' lsvr_kba-featured-widget__content--has-rating' : ''; ?>">

        	<?php if ( ! empty( $post ) ) : ?>

    			<div class="lsvr_kba-featured-widget__content-inner">

	    			<h4 class="lsvr_kba-featured-widget__title">
	    				<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="lsvr_kba-featured-widget__title-link">
	    					<?php echo get_the_title( $post->ID ); ?>
	    				</a>
	    			</h4>

					<?php if ( true === $show_date ) : ?>

						<p class="lsvr_kba-featured-widget__date">
							<?php echo get_the_date( '', $post->ID ); ?>
						</p>

					<?php endif; ?>

					<?php // Category
					$terms = wp_get_post_terms( $post->ID, 'lsvr_kba_cat' );
					$category_html = '';
					if ( ! empty( $terms ) ) {
						foreach ( $terms as $term ) {
							$category_html .= '<a href="' . esc_url( get_term_link( $term->term_id, 'lsvr_kba_cat' ) ) . '" class="lsvr_kba-featured-widget__category-link">' . $term->name . '</a>';
							$category_html .= $term !== end( $terms ) ? ', ' : '';
						}
					}
					if ( true === $show_category && ! empty( $category_html ) ) : ?>

						<p class="lsvr_kba-featured-widget__category">
							<?php echo sprintf( esc_html__( 'in %s', 'lsvr-knowledge-base' ), $category_html ); ?>
						</p>

					<?php endif; ?>

					<?php if ( true === $show_rating && true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) ) : ?>

						<p class="lsvr_kba-featured-widget__rating">

							<?php $rating = lsvr_knowledge_base_get_kba_rating( $post->ID ); ?>

							<?php if ( 'likes' == apply_filters( 'lsvr_knowledge_base_kba_rating_type', '' ) ) : ?>

								<span class="c-post-rating">
									<span class="c-post-rating__likes"
										title="<?php echo esc_attr( sprintf( esc_html__( '%d likes', 'lsvr-knowledge-base' ), $rating['likes'] ) ); ?>">
										<?php echo esc_html( $rating['likes_abb'] ); ?>
									</span>
								</span>

							<?php elseif ( 'both' == apply_filters( 'lsvr_knowledge_base_kba_rating_type', '' ) ) : ?>

								<span class="c-post-rating">
									<span class="c-post-rating__likes"
										title="<?php echo esc_attr( sprintf( esc_html__( '%d likes', 'lsvr-knowledge-base' ), $rating['likes'] ) ); ?>">
										<?php echo esc_html( $rating['likes_abb'] ); ?>
									</span>
									<span class="c-post-rating__dislikes"
										title="<?php echo esc_attr( sprintf( esc_html__( '%d dislikes', 'lsvr-knowledge-base' ), $rating['dislikes'] ) ); ?>">
										<?php echo esc_html( $rating['dislikes_abb'] ); ?>
									</span>
								</span>

							<?php elseif ( 'sum' == apply_filters( 'lsvr_knowledge_base_kba_rating_type', '' ) ) : ?>

								<span class="c-post-rating">
									<span class="c-post-rating__sum c-post-rating__sum--<?php echo (int) $rating['sum'] >= 0 ? 'positive' : 'negative'; ?>">
										<?php echo esc_html( $rating['sum_abs_abb'] ); ?>
									</span>
								</span>

							<?php endif; ?>

						</p>

					<?php endif; ?>

					<?php // Excerpt
					if ( true === $show_excerpt && ! empty( $post->post_excerpt ) ) : ?>
						<div class="lsvr_kba-featured-widget__excerpt">

							<?php echo wpautop( $post->post_excerpt ); ?>

						</div>
					<?php endif; ?>

					<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>
					<p class="widget__more">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_kba' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
					</p>
					<?php endif; ?>

				</div>

        	<?php else : ?>
        		<p class="widget__no-results"><?php esc_html_e( 'There are no Knowledge Base articles', 'lsvr-knowledge-base' ); ?></p>
        	<?php endif; ?>

        </div>

        <?php // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>