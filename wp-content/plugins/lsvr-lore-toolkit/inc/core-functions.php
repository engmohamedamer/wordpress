<?php

// Has post terms
if ( ! function_exists( 'lsvr_lore_toolkit_has_post_terms' ) ) {
    function lsvr_lore_toolkit_has_post_terms( $post_id, $taxonomy ) {

        $terms = wp_get_post_terms( $post_id, $taxonomy );
        return ! empty( $terms ) ? true : false;

    }
}

// Get taxonomy terms
if ( ! function_exists( 'lsvr_lore_toolkit_get_terms' ) ) {
	function lsvr_lore_toolkit_get_terms( $taxonomy ) {

		$terms_parsed = array();

        if ( taxonomy_exists( $taxonomy ) ) {

        	// Get terms
            $tax_terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'orderby' => 'name',
                'hide_empty' => true,
            ));

            // Parse terms
            if ( ! empty( $tax_terms ) ) {
            	foreach ( $tax_terms as $term ) {
            		$terms_parsed[ $term->term_id ] = $term->name;
            	}
            }

        }

        return ! empty( $terms_parsed ) ? $terms_parsed : array();

    }
}

// Get custom sidebars
if ( ! function_exists( 'lsvr_lore_toolkit_get_custom_sidebars' ) ) {
    function lsvr_lore_toolkit_get_custom_sidebars() {

        $return = array();

        $custom_sidebars = get_theme_mod( 'custom_sidebars' );
        if ( ! empty( $custom_sidebars ) && '{' === substr( $custom_sidebars, 0, 1 ) ) {

            $custom_sidebars = (array) json_decode( $custom_sidebars );
            if ( ! empty( $custom_sidebars['sidebars'] ) ) {
                $custom_sidebars = $custom_sidebars['sidebars'];
                foreach ( $custom_sidebars as $sidebar ) {
                    $sidebar = (array) $sidebar;
                    if ( ! empty( $sidebar['id'] ) ) {

                        $sidebar_label = ! empty( $sidebar['label'] ) ? $sidebar['label'] : sprintf( esc_html__( 'Custom Sidebar %d', 'lsvr-lore-toolkit' ), (int) $sidebar['id'] );
                        $return[ 'lsvr-lore-custom-sidebar-' . $sidebar['id'] ] = $sidebar_label;

                    }
                }
            }

        }

        return $return;

    }
}

// Get sidebars
if ( ! function_exists( 'lsvr_lore_toolkit_get_sidebars' ) ) {
    function lsvr_lore_toolkit_get_sidebars() {

        $sidebar_list = array(
            'lsvr-lore-default-sidebar' => esc_html__( 'Default Sidebar', 'lsvr-lore-toolkit' ),
        );
        $custom_sidebars = lsvr_lore_toolkit_get_custom_sidebars();
        if ( ! empty( $custom_sidebars ) ) {
            $sidebar_list = array_merge( $sidebar_list, $custom_sidebars );
        }

        return $sidebar_list;

    }
}

?>