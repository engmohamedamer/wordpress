<?php
/**
 * LSVR KBA Featured Widget Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_KBA_Featured_Widget' ) ) {
    class Lsvr_Shortcode_KBA_Featured_Widget {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'post' => '',
                    'show_excerpt' => true,
                    'show_date' => true,
                    'show_rating' => true,
                    'show_category' => true,
                    'more_label' => '',
                    'id' => '',
                    'className' => '',
                    'editor_view' => false,
                ),
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Element class
            $class_arr = array( 'widget shortcode-widget lsvr_kba-featured-widget lsvr_kba-featured-widget--shortcode' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr_kba-featured-widget--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <?php the_widget( 'Lsvr_Widget_KBA_Featured', array(
                'title' => $args['title'],
                'post' => $args['post'],
                'show_excerpt' => $args['show_excerpt'],
                'show_date' => $args['show_date'],
                'show_rating' => $args['show_rating'],
                'show_category' => $args['show_category'],
                'more_label' => $args['more_label'],
                'editor_view' => $args['editor_view'],
            ), array(
                'before_widget' => '<div' . ( ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : '' ) . ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"><div class="widget__inner">',
                'after_widget' => '</div></div>',
                'before_title' => '<h3 class="widget__title">',
                'after_title' => '</h3>',
            )); ?>

            <?php return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Title
                array(
                    'name' => 'title',
                    'type' => 'text',
                    'label' => esc_html__( 'Title', 'lsvr-knowledge-base' ),
                    'description' => esc_html__( 'Title of this section.', 'lsvr-knowledge-base' ),
                    'default' => esc_html__( 'Latest KB Articles', 'lsvr-knowledge-base' ),
                    'priority' => 10,
                ),

                // Post
                array(
                    'name' => 'post',
                    'type' => 'post',
                    'post_type' => 'lsvr_kba',
                    'label' => esc_html__( 'Article', 'lsvr-knowledge-base' ),
                    'description' => esc_html__( 'Choose article to display.', 'lsvr-knowledge-base' ),
                    'default' => 'none',
                    'priority' => 20,
                ),

                // Display excerpt
                array(
                    'name' => 'show_excerpt',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Excerpt', 'lsvr-knowledge-base' ),
                    'default' => true,
                    'priority' => 60,
                ),

                // Display date
                array(
                    'name' => 'show_date',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Date', 'lsvr-knowledge-base' ),
                    'default' => true,
                    'priority' => 70,
                ),

                // Display rating
                array(
                    'name' => 'show_rating',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Rating', 'lsvr-knowledge-base' ),
                    'default' => true,
                    'priority' => 80,
                ),

                // Display category
                array(
                    'name' => 'show_category',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Category', 'lsvr-knowledge-base' ),
                    'default' => true,
                    'priority' => 90,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Link Label', 'lsvr-knowledge-base' ),
                    'description' => esc_html__( 'Link to Knowledge Base post archive. Leave blank to hide.', 'lsvr-knowledge-base' ),
                    'default' => esc_html__( 'More Articles', 'lsvr-knowledge-base' ),
                    'priority' => 110,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-knowledge-base' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-knowledge-base' ),
                    'priority' => 120,
                ),

            ), apply_filters( 'lsvr_kba_list_widget_shortcode_atts', array() ) );
        }

    }
}
?>