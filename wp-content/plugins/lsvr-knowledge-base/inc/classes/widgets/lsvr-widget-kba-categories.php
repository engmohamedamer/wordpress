<?php
/**
 * LSVR KBA Categories widget
 *
 * Display list of lsvr_kba_cat tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_KBA_Categories' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_KBA_Categories extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_knowledge_base_kba_categories',
			'classname' => 'lsvr_kba-categories-widget',
			'title' => esc_html__( 'LSVR KB Categories', 'lsvr-knowledge-base' ),
			'description' => esc_html__( 'List of Knowledge Base categories', 'lsvr-knowledge-base' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-knowledge-base' ),
					'type' => 'text',
					'default' => esc_html__( 'Knowledge Base Categories', 'lsvr-knowledge-base' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {
        ?>

        <?php // Before widget content
        parent::before_widget_content( $args, $instance ); ?>

        <div class="widget__content">

			<ul class="root">
	        	<?php wp_list_categories(array(
					'title_li' => '',
					'taxonomy' => 'lsvr_kba_cat',
					'show_count' => false,
				)); ?>
			</ul>

        </div>

        <?php // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>