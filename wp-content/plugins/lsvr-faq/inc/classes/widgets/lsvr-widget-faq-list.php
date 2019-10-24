<?php
/**
 * LSVR FAQ widget
 *
 * Display list of lsvr_faq posts
 */
if ( ! class_exists( 'Lsvr_Widget_FAQ_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_FAQ_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_faq_faq_list',
			'classname' => 'lsvr_faq-list-widget',
			'title' => esc_html__( 'LSVR FAQ', 'lsvr-faq' ),
			'description' => esc_html__( 'List of FAQ posts', 'lsvr-faq' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-faq' ),
					'type' => 'text',
					'default' => esc_html__( 'FAQ', 'lsvr-faq' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-faq' ),
					'description' => esc_html__( 'Display FAQ posts only from a certain category.', 'lsvr-faq' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_faq_cat',
					'default_label' => esc_html__( 'None', 'lsvr-faq' ),
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-faq' ),
					'description' => esc_html__( 'Number of FAQ posts to display.', 'lsvr-faq' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-faq' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'order' => array(
					'label' => esc_html__( 'Order:', 'lsvr-faq' ),
					'description' => esc_html__( 'Order of FAQ posts.', 'lsvr-faq' ),
					'type' => 'select',
					'choices' => array(
						'default' => esc_html__( 'Default', 'lsvr-faq' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-faq' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-faq' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-faq' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-faq' ),
                        'random' => esc_html__( 'Random', 'lsvr-faq' ),
					),
					'default' => 'default',
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

    	// Show category
    	$show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

		// Set posts limit
		$limit = array_key_exists( 'limit', $instance ) && (int) $instance[ 'limit' ] > 0 ? $instance[ 'limit' ] : 1000;

    	// Get FAQ posts
    	$query_args = array(
    		'limit' => $limit,
		);
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['category'] = $instance['category'];
		}
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
		}
    	$posts = lsvr_faq_get( $query_args );

        ?>

        <?php // Before widget content
        parent::before_widget_content( $args, $instance ); ?>

        <div class="widget__content">

        	<?php if ( ! empty( $posts ) ) : ?>

        		<ul class="lsvr_faq-list-widget__list">
	        		<?php foreach ( $posts as $faq_id => $faq_post ) : ?>

						<?php $faq_post = $faq_post['post']; ?>

	        			<li class="lsvr_faq-list-widget__item<?php echo is_singular( 'lsvr_faq' ) && $faq_post->ID === get_the_ID() ? ' lsvr_faq-list-widget__item--current' : ''; ?>">
	        				<div class="lsvr_faq-list-widget__item-inner">

								<h4 class="lsvr_faq-list-widget__item-title">
									<a href="<?php echo esc_url( get_permalink( $faq_id ) ); ?>" class="lsvr_faq-list-widget__item-title-link">
										<?php echo esc_html( $faq_post->post_title ); ?>
									</a>
								</h4>

								<?php // Category
								$terms = wp_get_post_terms( $faq_post->ID, 'lsvr_faq_cat' );
								$category_html = '';
								if ( ! empty( $terms ) ) {
									foreach ( $terms as $term ) {
										$category_html .= '<a href="' . esc_url( get_term_link( $term->term_id, 'lsvr_faq_cat' ) ) . '" class="lsvr_faq-list-widget__item-category-link">' . $term->name . '</a>';
										$category_html .= $term !== end( $terms ) ? ', ' : '';
									}
								}
								if ( true === $show_category && ! empty( $category_html ) ) : ?>
									<p class="lsvr_faq-list-widget__item-category">
										<?php echo sprintf( esc_html__( 'in %s', 'lsvr-faq' ), $category_html ); ?>
									</p>
								<?php endif; ?>

							</div>
	        			</li>

	        		<?php endforeach; ?>
        		</ul>

				<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>
				<p class="widget__more">
					<?php if ( ! empty( $instance['category'] ) && is_numeric( $instance['category'] ) ) : ?>
						<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'lsvr_faq_cat' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
					<?php else : ?>
						<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_faq' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
					<?php endif; ?>
				</p>
				<?php endif; ?>

        	<?php else : ?>
        		<p class="widget__no-results"><?php esc_html_e( 'There are no FAQ', 'lsvr-faq' ); ?></p>
        	<?php endif; ?>

        </div>

        <?php // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>