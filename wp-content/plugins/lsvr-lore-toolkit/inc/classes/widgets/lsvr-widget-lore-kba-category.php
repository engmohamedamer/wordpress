<?php
/**
 * Lore KBA Category widget
 */
if ( ! class_exists( 'Lsvr_Widget_Lore_KBA_Category' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Lore_KBA_Category extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_lore_kba_category',
			'classname' => 'lsvr-lore-kba-category-widget',
			'title' => esc_html__( 'Lore KB Category', 'lsvr-lore-toolkit' ),
			'description' => esc_html__( 'KB category with articles', 'lsvr-lore-toolkit' ),
			'fields' => array(
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-lore-toolkit' ),
					'description' => esc_html__( 'Choose Knowledge Base category.', 'lsvr-lore-toolkit' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_kba_cat',
					'default_label' => esc_html__( 'None', 'lsvr-lore-toolkit' ),
				),
				'post_limit' => array(
					'label' => esc_html__( 'Article Limit:', 'lsvr-lore-toolkit' ),
					'description' => esc_html__( 'Number of Knowledge Base posts to display.', 'lsvr-lore-toolkit' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-lore-toolkit' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'post_order' => array(
					'label' => esc_html__( 'Article Order:', 'lsvr-lore-toolkit' ),
					'description' => esc_html__( 'Order of Knowledge Base posts.', 'lsvr-lore-toolkit' ),
					'type' => 'select',
					'choices' => array(
                        'default' => esc_html__( 'Default', 'lsvr-lore-toolkit' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-lore-toolkit' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-lore-toolkit' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-lore-toolkit' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-lore-toolkit' ),
                        'random' => esc_html__( 'Random', 'lsvr-lore-toolkit' ),
                        'rating' => esc_html__( 'By rating', 'lsvr-lore-toolkit' ),
					),
					'default' => 'default',
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Check if editor view
        $editor_view = ! empty( $instance['editor_view'] ) && ( true === $instance['editor_view'] || '1' === $instance['editor_view'] || 'true' === $instance['editor_view'] ) ? true : false;

		// Get post limit
		$post_limit = array_key_exists( 'post_limit', $instance ) && (int) $instance['post_limit'] > 0 ? (int) $instance['post_limit'] : 1000;

        // Get category
        if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {

        	$category = get_term( $instance['category'], 'lsvr_kba_cat' );
			$category_meta = get_option( 'lsvr_kba_cat_term_' . $instance['category'] . '_meta' );
			$category_icon = ! empty( $category_meta['icon'] ) ? $category_meta['icon'] : 'lsvr-lore-kba-category-widget__icon--default';

    	}

    	// Prepare query arguments
    	$query_args = array(
			'post_type' => 'lsvr_kba',
			'posts_per_page' => $post_limit,
			'suppress_filters' => false,
		);

    	// Category query
		if ( ! empty( $category ) ) {

			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'lsvr_kba_cat',
					'field' => 'term_id',
					'terms' => $instance['category'],
					'include_children' => false,
				),
			);

		}

		// Order query
		if ( ! empty( $instance['post_order'] ) && 'default' !== $instance['post_order'] ) {

			if ( 'date_desc' == $instance['post_order'] ) {
				$query_args['orderby'] = 'date';
				$query_args['order'] = 'DESC';
			}
			elseif ( 'date_asc' == $instance['post_order'] ) {
				$query_args['orderby'] = 'date';
				$query_args['order'] = 'ASC';
			}
			elseif ( 'title_asc' == $instance['post_order'] ) {
				$query_args['orderby'] = 'title';
				$query_args['order'] = 'ASC';
			}
			elseif ( 'title_desc' == $instance['post_order'] ) {
				$query_args['orderby'] = 'title';
				$query_args['order'] = 'DESC';
			}
			elseif ( 'random' == $instance['post_order'] ) {
				$query_args['orderby'] = 'rand';
			}

			elseif ( 'rating' == $instance['post_order'] ) {

				$rating_type = apply_filters( 'lsvr_knowledge_base_kba_rating_type', '' );
				if ( 'disable' !== $rating_type && ! empty( $rating_type ) ) {

					$query_args['order'] = 'DESC';
					$query_args['orderby'] = 'meta_value_num date';

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
        				),
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

	    	<?php if ( ! empty( $category ) ) : ?>

	    		<div class="lsvr-lore-kba-category-widget__header">

    				<i class="lsvr-lore-kba-category-widget__icon <?php echo esc_attr( $category_icon ); ?>"></i>

					<h3 class="lsvr-lore-kba-category-widget__title">
	    				<a href="<?php echo esc_url( get_term_link( $category ) ); ?>"
	    					class="lsvr-lore-kba-category-widget__title-link">
	    					<?php echo esc_html( $category->name ); ?>
    					</a>
					</h3>

				</div>

	    	<?php endif; ?>

			<?php if ( ! empty( $posts ) ) : ?>

				<ul class="lsvr-lore-kba-category-widget__list">

	        		<?php foreach ( $posts as $post ) : ?>

	        			<li class="lsvr-lore-kba-category-widget__item">
	        				<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"
	        					class="lsvr-lore-kba-category-widget__item-link">
	        					<?php echo esc_html( $post->post_title ); ?>
	        				</a>
        				</li>

	        		<?php endforeach; ?>

        		</ul>

        	<?php else : ?>

        		<p class="c-alert-message widget__no-results"><?php esc_html_e( 'There are no articles', 'lsvr-lore-toolkit' ); ?></p>

        	<?php endif; ?>

        </div>

        <?php // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>