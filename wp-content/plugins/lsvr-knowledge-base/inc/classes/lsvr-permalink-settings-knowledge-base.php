<?php
/**
 * Knowledge Base permalink settings
 */
if ( ! class_exists( 'Lsvr_Permalink_Settings_Knowledge_Base' ) && class_exists( 'Lsvr_Permalink_Settings' ) ) {
    class Lsvr_Permalink_Settings_Knowledge_Base extends Lsvr_Permalink_Settings {

    	public function __construct() {

			parent::__construct( array(
				'id' => 'lsvr_knowledge_base_permalink_settings',
				'title' => esc_html__( 'LSVR Knowledge Base', 'lsvr-knowledge-base' ),
				'option_id' => 'lsvr_knowledge_base_permalinks',
				'fields' => array(
					'lsvr_kba' => array(
						'type' => 'cpt',
						'label' => esc_html__( 'Archive Slug', 'lsvr-knowledge-base' ),
						'default' => 'knowledge-base',
					),
					'lsvr_kba_cat' => array(
						'type' => 'tax',
						'label' => esc_html__( 'Category Slug', 'lsvr-knowledge-base' ),
						'default' => 'knowledge-base-category',
					),
					'lsvr_kba_tag' => array(
						'type' => 'tax',
						'label' => esc_html__( 'Tag Slug', 'lsvr-knowledge-base' ),
						'default' => 'knowledge-base-tag',
					),
				),
			));

    	}

    }
}