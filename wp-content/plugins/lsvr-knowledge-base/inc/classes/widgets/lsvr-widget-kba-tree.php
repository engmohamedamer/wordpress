<?php
/**
 * LSVR KBA widget
 *
 * Display tree of lsvr_kba posts in categories
 */
if ( ! class_exists( 'Lsvr_Widget_KBA_Tree' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_KBA_Tree extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_knowledge_base_kba_tree',
			'classname' => 'lsvr_kba-tree-widget',
			'title' => esc_html__( 'LSVR Knowledge Base', 'lsvr-knowledge-base' ),
			'description' => esc_html__( 'List of categorized KB posts', 'lsvr-knowledge-base' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-knowledge-base' ),
					'type' => 'text',
					'default' => esc_html__( 'Knowledge Base', 'lsvr-knowledge-base' ),
				),
				'post_order' => array(
					'label' => esc_html__( 'Articles Order:', 'lsvr-knowledge-base' ),
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
				'show_posts' => array(
					'label' => esc_html__( 'Display Articles', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_count' => array(
					'label' => esc_html__( 'Display Count', 'lsvr-knowledge-base' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Show posts
    	$show_posts = ! empty( $instance['show_posts'] ) && ( true === $instance['show_posts'] || 'true' === $instance['show_posts'] || '1' === $instance['show_posts'] ) ? true : false;

    	// Show count
    	$show_count = ! empty( $instance['show_count'] ) && ( true === $instance['show_count'] || 'true' === $instance['show_count'] || '1' === $instance['show_count'] ) ? true : false;

    	// Prepare category args
    	$query_args = array(
            'taxonomy' => 'lsvr_kba_cat',
            'show_count' => $show_count,
            'show_posts' => $show_posts,
			'title_li' => '',
            'show_option_none' => '<p class="c-alert-message">' . esc_html__( 'No categories', 'lsvr-knowledge-base' ) . '</p>',
            'walker' => new Lsvr_Knowledge_Base_KBA_Tree_Walker,
		);

    	// Determine category and ID of a current post
        $current_term_id = false;
        if ( is_singular( 'lsvr_kba' ) ) {

            global $post;

            $query_args['current_post_id'] = $post->ID;

            $post_terms = wp_get_post_terms( $post->ID, 'lsvr_kba_cat' );
            if ( is_array( $post_terms ) && count( $post_terms ) > 0 ) {

                $current_term = reset( $post_terms );
                if ( is_object( $current_term ) && property_exists( $current_term, 'term_id' ) ) {
                	$query_args['current_post_cat'] = $current_term->term_id;
                }

            }

        }

		// Set post order
		if ( true === $show_posts && ! empty( $instance['post_order'] ) && 'default' !== $instance['post_order'] ) {

			$query_args['post_query_args'] = array();

			if ( 'date_desc' == $instance['post_order'] ) {
				$query_args['post_query_args']['orderby'] = 'post_date';
				$query_args['post_query_args']['order'] = 'DESC';
			}

			elseif ( 'date_asc' == $instance['post_order'] ) {
				$query_args['post_query_args']['orderby'] = 'post_date';
				$query_args['post_query_args']['order'] = 'ASC';
			}

			elseif ( 'title_asc' == $instance['post_order'] ) {
				$query_args['post_query_args']['orderby'] = 'title';
				$query_args['post_query_args']['order'] = 'ASC';
			}

			elseif ( 'title_desc' == $instance['post_order'] ) {
				$query_args['post_query_args']['orderby'] = 'title';
				$query_args['post_query_args']['order'] = 'DESC';
			}

			elseif ( 'random' == $instance['post_order'] ) {
				$query_args['post_query_args']['orderby'] = 'rand';
			}

			elseif ( 'rating' == $instance['post_order'] ) {

				$rating_type = apply_filters( 'lsvr_knowledge_base_kba_rating_type', '' );
				if ( 'disable' !== $rating_type ) {

					$query_args['post_query_args']['orderby'] = 'meta_value_num post_date';
					$query_args['post_query_args']['order'] = 'DESC';

					if ( 'both' === $rating_type || 'sum' === $rating_type ) {
						$meta_query_key = 'lsvr_kba_rating_sum';
					}
					else {
						$meta_query_key = 'lsvr_kba_likes';
					}

					$query_args['post_query_args']['meta_query'] = array(
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

        ?>

        <?php // Before widget content
        parent::before_widget_content( $args, $instance ); ?>

        <div class="widget__content lsvr_kba-tree-widget__content">

    		<ul class="lsvr_kba-tree-widget__list lsvr_kba-tree-widget__list--level-0">

    			<?php wp_list_categories( $query_args ); ?>

    		</ul>

        </div>

        <?php // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>