<?php
/**
 * FAQ permalink settings
 */
if ( ! class_exists( 'Lsvr_Permalink_Settings_FAQ' ) && class_exists( 'Lsvr_Permalink_Settings' ) ) {
    class Lsvr_Permalink_Settings_FAQ extends Lsvr_Permalink_Settings {

    	public function __construct() {

			parent::__construct( array(
				'id' => 'lsvr_faq_permalink_settings',
				'title' => esc_html__( 'LSVR FAQ', 'lsvr-faq' ),
				'option_id' => 'lsvr_faq_permalinks',
				'fields' => array(
					'lsvr_faq' => array(
						'type' => 'cpt',
						'label' => esc_html__( 'Archive Slug', 'lsvr-faq' ),
						'default' => 'faq',
					),
					'lsvr_faq_cat' => array(
						'type' => 'tax',
						'label' => esc_html__( 'Category Slug', 'lsvr-faq' ),
						'default' => 'faq-category',
					),
					'lsvr_faq_tag' => array(
						'type' => 'tax',
						'label' => esc_html__( 'Tag Slug', 'lsvr-faq' ),
						'default' => 'faq-tag',
					),
				),
			));

    	}

    }
}