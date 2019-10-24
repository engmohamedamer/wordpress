<?php
/**
 * Lore CTA widget
 */
if ( ! class_exists( 'Lsvr_Widget_Lore_CTA' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Lore_CTA extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_lore_cta',
			'classname' => 'lsvr-lore-cta-widget',
			'title' => esc_html__( 'Lore CTA', 'lsvr-lore-toolkit' ),
			'description' => esc_html__( 'Block with title, text and link.', 'lsvr-lore-toolkit' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-lore-toolkit' ),
					'type' => 'text',
					'default' => esc_html__( 'CTA', 'lsvr-lore-toolkit' ),
				),
				'text' => array(
					'label' => esc_html__( 'Text:', 'lsvr-lore-toolkit' ),
					'type' => 'textarea',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-lore-toolkit' ),
					'type' => 'text',
				),
				'more_link' => array(
					'label' => esc_html__( 'More Button Link:', 'lsvr-pressville-toolkit' ),
					'type' => 'text',
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Check if editor view
        $editor_view = ! empty( $instance['editor_view'] ) && ( true === $instance['editor_view'] || '1' === $instance['editor_view'] || 'true' === $instance['editor_view'] ) ? true : false;

        ?>

        <?php // Before widget content
        parent::before_widget_content( $args, $instance ); ?>

        <div class="widget__content">

			<?php if ( ! empty( $instance[ 'text' ] ) ) : ?>

				<div class="lsvr-lore-cta-widget__text">
					<?php echo wpautop( $instance[ 'text' ] ); ?>
				</div>

			<?php endif; ?>

			<?php if ( ! empty( $instance[ 'more_label' ] ) && ! empty( $instance[ 'more_link' ] ) ) : ?>

				<p class="lsvr-lore-cta-widget__more">
					<a href="<?php echo esc_url( $instance[ 'more_link' ] ); ?>"
						class="lsvr-lore-cta-widget__more-link c-button"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
				</p>

			<?php endif; ?>

        </div>

        <?php // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>