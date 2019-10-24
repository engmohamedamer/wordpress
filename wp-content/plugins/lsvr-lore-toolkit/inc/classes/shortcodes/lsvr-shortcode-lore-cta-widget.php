<?php
/**
 * LSVR Lore CTA Widget Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Lore_CTA_Widget' ) ) {
    class Lsvr_Shortcode_Lore_CTA_Widget {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'text' => '',
                    'more_label' => '',
                    'more_link' => '',
                    'id' => '',
                    'className' => '',
                    'editor_view' => false,
                ),
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Element class
            $class_arr = array( 'widget shortcode-widget lsvr-lore-cta-widget lsvr-lore-cta-widget--shortcode' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-lore-cta-widget--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <?php the_widget( 'Lsvr_Widget_Lore_CTA', array(
                'title' => $args['title'],
                'text' => $args['text'],
                'more_label' => $args['more_label'],
                'more_link' => $args['more_link'],
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
                    'label' => esc_html__( 'Title', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'CTA', 'lsvr-lore-toolkit' ),
                    'priority' => 10,
                ),

                // Text
                array(
                    'name' => 'text',
                    'type' => 'text',
                    'label' => esc_html__( 'Text', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'lsvr-lore-toolkit' ),
                    'priority' => 20,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'Learn More', 'lsvr-lore-toolkit' ),
                    'priority' => 30,
                ),

                // More link
                array(
                    'name' => 'more_link',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Link', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'http://www.example.org', 'lsvr-lore-toolkit' ),
                    'priority' => 40,
                ),
                // ID
                 array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-lore-toolkit' ),
                    'priority' => 200,
                ),

            ), apply_filters( 'lsvr_lore_cta_widget_shortcode_atts', array() ) );
        }

    }
}
?>