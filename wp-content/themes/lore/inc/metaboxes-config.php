<?php

// Add Sidebar Settings to pages
if ( class_exists( 'Lsvr_Post_Metabox' ) ) {
	$lsvr_lore_page_sidebar_settings_metabox = new Lsvr_Post_Metabox(array(
		'id' => 'lsvr_lore_page_sidebar_settings',
		'wp_args' => array(
			'title' => __( 'Sidebar Settings', 'lore' ),
			'screen' => 'page',
		),
		'fields' => array(

			// Sidebar
			'lsvr_lore_page_sidebar' => array(
				'type' => 'select',
				'title' => esc_html__( 'Choose Sidebar To Display', 'lore' ),
				'description' => esc_html__( 'Sidebar will be displayed only if the selected page template supports sidebars. You can manage sidebar widgets under Appearance / Widgets.', 'lore' ),
				'choices' => lsvr_lore_get_sidebars(),
				'priority' => 10,
			),

		),
	));
}

?>