<?php
/**
 * LSVR KBA widget
 *
 * Display list of lsvr_kba posts
 */
if ( ! class_exists( 'Lsvr_Widget_KBA_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_KBA_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_knowledge_base_kba_list',
			'classname' => 'lsvr_kba-list-widget',
			'title' => esc_html__( 'LSVR KB Articles', 'lsvr-knowledge-base' ),
			'description' => esc_html__( 'List of KB posts', 'lsvr-knowledge-base' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-knowledge-base' ),
					'type' => 'text',
					'default' => esc_html__( 'Latest KB Articles', 'lsvr-knowledge-base' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-knowledge-base' ),
					'description' => esc_html__( 'Display Knowledge Base posts only from a certain category.', 'lsvr-knowledge-base' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_kba_cat',
					'default_label' => esc_html__( 'None', 'lsvr-knowledge-base' ),
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-knowledge-base' ),
					'description' => esc_html__( 'Number of Knowledge Base posts to display.', 'lsvr-knowledge-base' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-knowledge-base' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'order' => array(
					'label' => esc_html__( 'Order:', 'lsvr-knowledge-base' ),
					'description' => esc_html__( 'Order of Knowledge Base posts.', 'lsvr-knowledge-base' ),
					'type' => 'select',
					'choices' => array(
						'default' => esc_html__( 'Default', 'lsvr-knowledge-base' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-knowledge-base' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-knowledge-base' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-knowledge-base' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-knowledge-base' ),
                        'rating' => esc_html__( 'By rating', 'lsvr-knowledge-base' ),
                        'random' => esc_html__( 'Random', 'lsvr-knowledge-base' ),
					),
					'default' => 'default',
				),
				'show_icon' => array(
					'label' => esc_html__( 'Display Icon', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_date' => array(
					'label' => esc_html__( 'Display Date', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_category' => array(
					'label' => esc_html__( 'Display Category', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_rating' => array(
					'label' => esc_html__( 'Display Rating', 'lsvr-knowledge-base' ),
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

    	// Show icon
    	$show_icon = ! empty( $instance['show_icon'] ) && ( true === $instance['show_icon'] || 'true' === $instance['show_icon'] || '1' === $instance['show_icon'] ) ? true : false;

    	// Show date
    	$show_date = ! empty( $instance['show_date'] ) && ( true === $instance['show_date'] || 'true' === $instance['show_date'] || '1' === $instance['show_date'] ) ? true : false;

    	// Show category
    	$show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

    	// Show rating
    	$show_rating = ! empty( $instance['show_rating'] ) && ( true === $instance['show_rating'] || 'true' === $instance['show_rating'] || '1' === $instance['show_rating'] ) ? true : false;

		// Set posts limit
		$limit = array_key_exists( 'limit', $instance ) && (int) $instance[ 'limit' ] > 0 ? $instance[ 'limit' ] : 1000;

    	// Prepare query arguments
    	$query_args = array(
			'post_type' => 'lsvr_kba',
			'posts_per_page' => $limit,
			'suppress_filters' => false,
		);

    	// Category query
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'lsvr_kba_cat',
					'field' => 'term_id',
					'terms' => $instance['category'],
				),
			);
		}

		// Order query
		if ( ! empty( $instance['order'] ) && 'default' !== $instance['order'] ) {

			if ( 'date_desc' == $instance['order'] ) {
				$query_args['orderby'] = 'date';
				$query_args['order'] = 'DESC';
			}

			elseif ( 'date_asc' == $instance['order'] ) {
				$query_args['orderby'] = 'date';
				$query_args['order'] = 'ASC';
			}

			elseif ( 'title_asc' == $instance['order'] ) {
				$query_args['orderby'] = 'title';
				$query_args['order'] = 'ASC';
			}

			elseif ( 'title_desc' == $instance['order'] ) {
				$query_args['orderby'] = 'title';
				$query_args['order'] = 'DESC';
			}

			elseif ( 'random' == $instance['order'] ) {
				$query_args['orderby'] = 'rand';
			}

			elseif ( 'rating' == $instance['order'] ) {

				$rating_type = apply_filters( 'lsvr_knowledge_base_kba_rating_type', '' );
				if ( 'disable' !== $rating_type && ! empty( $rating_type ) ) {

					$query_args['order'] = 'DESC';
					$query_args['orderby'] = 'meta_value_num post_date';

					if ( 'both' === $rating_type || 'sum' === $rating_type ) {
						$meta_query_key = 'lsvr_kba_rating_sum';
					}
					else {
						$meta_query_key = 'lsvr_kba_likes';
					}

					$query_args[ 'meta_query' ] = array(
   						'relation' => 'OR',
      					array(
            				'key' => $meta_query_key,
            				'compare' => 'NOT EXISTS',
        				),
        				array(
            				'key' => $meta_query_key,
            				'compare' => 'EXISTS',
        				)
    				);

				}

			}

		}

		// Get posts
    	$posts = get_posts( $query_args );

        ?>

        <?php // Before widget content
        parent::before_widget_content( $args, $instance ); ?>

        <div class="widget__content">

        	<?php if ( ! empty( $posts ) ) : ?>

        		<ul class="lsvr_kba-list-widget__list">
	        		<?php foreach ( $posts as $post ) : ?>

	        			<li class="lsvr_kba-list-widget__item<?php echo is_singular( 'lsvr_kba' ) && $post->ID === get_the_ID() ? ' lsvr_kba-list-widget__item--current' : ''; ?><?php echo true === $show_rating && true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) ? ' lsvr_kba-list-widget__item--has-rating' : ''; ?><?php echo true === $show_icon ? ' lsvr_kba-list-widget__item--has-icon' : ''; ?>">
	        				<div class="lsvr_kba-list-widget__item-inner">

								<?php if ( true === $show_icon && ! empty( get_post_format( $post->ID ) ) ) : ?>

									<i class="lsvr_kba-list-widget__item-icon c-lsvr_kba-format-icon c-lsvr_kba-format-icon--<?php echo esc_attr( get_post_format( $post->ID ) ); ?>"></i>

								<?php elseif ( true === $show_icon ) : ?>

									<i class="lsvr_kba-list-widget__item-icon c-post-type-icon c-post-type-icon--lsvr_kba"></i>

								<?php endif; ?>

								<h4 class="lsvr_kba-list-widget__item-title">
									<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="lsvr_kba-list-widget__item-title-link">
										<?php echo esc_html( $post->post_title ); ?>
									</a>
								</h4>

								<?php if ( true === $show_date ) : ?>

									<p class="lsvr_kba-list-widget__item-date">
										<?php echo get_the_date( '', $post->ID ); ?>
									</p>

								<?php endif; ?>

								<?php // Category
								$terms = wp_get_post_terms( $post->ID, 'lsvr_kba_cat' );
								$category_html = '';
								if ( ! empty( $terms ) ) {
									foreach ( $terms as $term ) {
										$category_html .= '<a href="' . esc_url( get_term_link( $term->term_id, 'lsvr_kba_cat' ) ) . '" class="lsvr_kba-list-widget__item-category-link">' . $term->name . '</a>';
										$category_html .= $term !== end( $terms ) ? ', ' : '';
									}
								}
								if ( true === $show_category && ! empty( $category_html ) ) : ?>

									<p class="lsvr_kba-list-widget__item-category">
										<?php echo sprintf( esc_html__( 'in %s', 'lsvr-knowledge-base' ), $category_html ); ?>
									</p>

								<?php endif; ?>

								<?php if ( true === $show_rating && true === get_theme_mod( 'lsvr_kba_archive_rating_enable', true ) ) : ?>

									<p class="lsvr_kba-list-widget__item-rating">

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

							</div>
	        			</li>

	        		<?php endforeach; ?>
        		</ul>

				<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

					<p class="widget__more">

						<?php if ( ! empty( $instance['category'] ) && is_numeric( $instance['category'] ) ) : ?>

							<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'lsvr_kba_cat' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

						<?php else : ?>

							<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_kba' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

						<?php endif; ?>
					</p>

				<?php endif; ?>

        	<?php else : ?>

        		<p class="widget__no-results"><?php esc_html_e( 'There are no articles', 'lsvr-knowledge-base' ); ?></p>

        	<?php endif; ?>

        </div>

        <?php // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>