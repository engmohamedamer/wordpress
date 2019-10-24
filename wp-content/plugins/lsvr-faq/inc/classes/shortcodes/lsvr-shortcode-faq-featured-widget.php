<?php
/**
 * LSVR Featured FAQ Widget Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_FAQ_Featured_Widget' ) ) {
    class Lsvr_Shortcode_FAQ_Featured_Widget {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'post' => '',
                    'show_category' => 'true',
                    'show_content' => 'true',
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
            $class_arr = array( 'widget shortcode-widget lsvr_faq-featured-widget lsvr_faq-featured-widget--shortcode' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr_faq-featured-widget--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <?php the_widget( 'Lsvr_Widget_FAQ_Featured', array(
                'title' => $args['title'],
                'post' => $args['post'],
                'show_category' => $args['show_category'],
                'show_content' => $args['show_content'],
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
                    'label' => esc_html__( 'Title', 'lsvr-faq' ),
                    'description' => esc_html__( 'Title of this section.', 'lsvr-faq' ),
                    'default' => esc_html__( 'Featured FAQ', 'lsvr-faq' ),
                    'priority' => 10,
                ),

                // Post
                array(
                    'name' => 'post',
                    'type' => 'post',
                    'post_type' => 'lsvr_faq',
                    'label' => esc_html__( 'FAQ', 'lsvr-faq' ),
                    'description' => esc_html__( 'Choose FAQ to display.', 'lsvr-faq' ),
                    'default' => 'none',
                    'priority' => 20,
                ),

                // Display category
                array(
                    'name' => 'show_category',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Category', 'lsvr-faq' ),
                    'default' => true,
                    'priority' => 40,
                ),

                // Display content
                array(
                    'name' => 'show_content',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Content', 'lsvr-faq' ),
                    'description' => esc_html__( 'If this FAQ post has an excerpt, it will be displayed instead.', 'lsvr-faq' ),
                    'default' => true,
                    'priority' => 50,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Link Label', 'lsvr-faq' ),
                    'description' => esc_html__( 'Link to FAQ archive. Leave blank to hide.', 'lsvr-faq' ),
                    'default' => esc_html__( 'More FAQ', 'lsvr-faq' ),
                    'priority' => 60,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-faq' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-faq' ),
                    'priority' => 70,
                ),

            ), apply_filters( 'lsvr_faq_featured_widget_shortcode_atts', array() ) );
        }

    }
}
?>