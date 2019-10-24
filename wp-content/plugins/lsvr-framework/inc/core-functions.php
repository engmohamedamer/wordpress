<?php

// Get posts
if ( ! function_exists( 'lsvr_framework_get_posts' ) ) {
    function lsvr_framework_get_posts( $post_type = 'post' ) {

        $posts_parsed = array();

        if ( post_type_exists( $post_type ) ) {

            // Get posts
            $posts = get_posts(array(
                'post_type' => $post_type,
                'posts_per_page' => 1000,
                'orderby' => 'title',
                'order' => 'ASC',
            ));

            // Parse posts
            if ( ! empty( $posts ) ) {
                foreach ( $posts as $post ) {
                    $posts_parsed[ $post->ID ] = $post->post_title;
                }
            }

        }

        return ! empty( $posts_parsed ) ? $posts_parsed : array();

    }
}

// Get taxonomy terms
if ( ! function_exists( 'lsvr_framework_get_terms' ) ) {
	function lsvr_framework_get_terms( $taxonomy ) {

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

// Get menus
if ( ! function_exists( 'lsvr_framework_get_menus' ) ) {
	function lsvr_framework_get_menus() {

		$return = array();

		$menus = wp_get_nav_menus();
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				if ( ! empty( $menu->term_id ) && ! empty( $menu->name ) ) {
					$return[ $menu->term_id ] = $menu->name;
				}
			}
		}

		return $return;

	}
}

// Parse shortcode attributes
if ( ! function_exists( 'lsvr_framework_parse_shortcode_atts' ) ) {
    function lsvr_framework_parse_shortcode_atts( $atts = array() ) {

        foreach ( $atts as $key => $value ) {

            // Post
            if ( 'post' === $value['type'] && ! empty( $value['post_type'] ) ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 'none' => esc_html__( '---', 'lsvr-framework' ) ) + lsvr_framework_get_posts( $value['post_type'] );
            }

            // Tax
            if ( 'taxonomy' === $value['type'] && ! empty( $value['tax'] ) ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 0 => esc_html__( '---', 'lsvr-framework' ) ) + lsvr_framework_get_terms( $value['tax'] );
            }

            // Menu
            if ( 'menu' === $value['type'] ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 'none' => esc_html__( '---', 'lsvr-framework' ) ) + lsvr_framework_get_menus();
            }

        }

        return $atts;

    }
}

// Register shortcode block
if ( ! function_exists( 'lsvr_framework_register_shortcode_block' ) ) {
    function lsvr_framework_register_shortcode_block( $name, $params ) {

        if ( function_exists( 'register_block_type' ) ) {

            // Sort by priority
            usort( $params['attributes'], function( $a, $b ) {
                $a_priority = array_key_exists( 'priority', $a ) ? $a['priority'] : 0;
                $b_priority = array_key_exists( 'priority', $b ) ? $b['priority'] : 0;
                return $a_priority - $b_priority;
            });

            // Parse atts
            $shortcode_atts = lsvr_framework_parse_shortcode_atts( $params[ 'attributes' ] );

            // Prepare array for PHP registration
            $php_attributes = array();
            foreach ( $shortcode_atts as $attribute ) {

                $attribute_name = $attribute['name'];

                $php_attributes[ $attribute_name ] = array(
                    'type' => $attribute['type'] === 'checkbox' ? 'bool' : 'string',
                );

                if ( ! empty( $attribute['default'] ) ) {
                    $php_attributes[ $attribute_name ]['default'] = $attribute['default'];
                }

            }

            // Add className attribute
            $php_attributes['className'] = array(
                'type' => 'string',
            );

            // Prepare args
            $args = array(
                'attributes' => $php_attributes,
            );

            if ( ! empty( $params[ 'render_callback' ] ) ) {
                $args['render_callback'] = $params[ 'render_callback' ];
            }

            // Register block
            register_block_type( $name, $args );

        }

    }
}

// Register shortcode block JSON
if ( ! function_exists( 'lsvr_framework_register_shortcode_block_json' ) ) {
    function lsvr_framework_register_shortcode_block_json( $params = array() ) {

        // Sort by priority
        usort( $params['attributes'], function( $a, $b ) {
            $a_priority = array_key_exists( 'priority', $a ) ? $a['priority'] : 0;
            $b_priority = array_key_exists( 'priority', $b ) ? $b['priority'] : 0;
            return $a_priority - $b_priority;
        });

        // Parse params
        $shortcode_atts = lsvr_framework_parse_shortcode_atts( $params['attributes'] );

        $attributes = array();
        foreach ( $shortcode_atts as $attribute ) {

            // Parse selectbox and radio choices
            if ( 'select' === $attribute['type'] || 'radio' === $attribute['type'] ) {
                $parsed_choices = array();
                foreach ( $attribute['choices'] as $choice_key => $choice_value ) {
                    array_push( $parsed_choices, array(
                        'value' => $choice_key,
                        'label' => $choice_value,
                    ) );
                }
                $attribute['choices'] = $parsed_choices;
            }

            array_push( $attributes, $attribute );

        }

        $params['attributes'] = $attributes;

        return $params;

    }
}

?>