<?php
/**
 * LSVR FAQ Categories widget
 *
 * Display list of lsvr_faq_cat tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_FAQ_Categories' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_FAQ_Categories extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_faq_faq_categories',
			'classname' => 'lsvr_faq-categories-widget',
			'title' => esc_html__( 'LSVR FAQ Categories', 'lsvr-faq' ),
			'description' => esc_html__( 'List of FAQ categories', 'lsvr-faq' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-faq' ),
					'type' => 'text',
					'default' => esc_html__( 'FAQ Categories', 'lsvr-faq' ),
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
					'taxonomy' => 'lsvr_faq_cat',
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