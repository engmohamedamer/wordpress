<?php
/**
 * Pressville Events Elementor Widget
 */
if ( ! class_exists( 'Lsvr_Elementor_Widget_Pressville_Events' ) ) {
    class Lsvr_Elementor_Widget_Pressville_Events extends \Elementor\Widget_Base {

		public function get_name() {
			return 'lsvr_pressville_events';
		}

		public function get_title() {
			return esc_html__( 'Pressville Events', 'lsvr-3rd-party-toolkit' );
		}

		public function get_icon() {
			return 'fa fa-calendar';
		}

		public function get_categories() {
			return [ 'lsvr-pressville' ];
		}

		protected function _register_controls() {

			$this->start_controls_section(
				'content_section', array(
					'label' => esc_html__( 'Pressville Events', 'lsvr-3rd-party-toolkit' ),
				)
			);

			lsvr_3rd_party_toolkit_shortcode_atts_to_elementor_settings( $this, Lsvr_Shortcode_Pressville_Events::lsvr_shortcode_atts() );

			$this->end_controls_section();

		}

		protected function render() {

			lsvr_3rd_party_toolkit_elementor_settings_to_shortcode(
				new Lsvr_Shortcode_Pressville_Events,
				Lsvr_Shortcode_Pressville_Events::lsvr_shortcode_atts(),
				$this->get_settings_for_display()
			);

		}

    }
}
?>