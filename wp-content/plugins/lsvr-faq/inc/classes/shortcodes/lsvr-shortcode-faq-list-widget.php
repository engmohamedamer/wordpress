<?php
/**
 * LSVR FAQ List Widget Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_FAQ_List_Widget' ) ) {
    class Lsvr_Shortcode_FAQ_List_Widget {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'category' => 0,
                    'limit' => 4,
                    'order' => 'default',
                    'show_category' => 'true',
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
            $class_arr = array( 'widget shortcode-widget lsvr_faq-list-widget lsvr_faq-list-widget--shortcode' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr_faq-list-widget--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <?php the_widget( 'Lsvr_Widget_FAQ_List', array(
                'title' => $args['title'],
                'category' => $args['category'],
                'limit' => $args['limit'],
                'order' => $args['order'],
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
                    'label' => esc_html__( 'Title', 'lsvr-faq' ),
                    'description' => esc_html__( 'Title of this section.', 'lsvr-faq' ),
                    'default' => esc_html__( 'Latest FAQ', 'lsvr-faq' ),
                    'priority' => 10,
                ),

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'lsvr_faq_cat',
                    'label' => esc_html__( 'Category', 'lsvr-faq' ),
                    'description' => esc_html__( 'Display FAQ posts from a specific category.', 'lsvr-faq' ),
                    'priority' => 20,
                ),

                // Limit
                array(
                    'name' => 'limit',
                    'type' => 'select',
                    'label' => esc_html__( 'Limit', 'lsvr-faq' ),
                    'description' => esc_html__( 'How many FAQ posts to display.', 'lsvr-faq' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-faq' ) ) + range( 0, 20, 1 ),
                    'default' => 4,
                    'priority' => 30,
                ),

                // Order
                array(
                    'name' => 'order',
                    'type' => 'select',
                    'label' => esc_html__( 'Order', 'lsvr-faq' ),
                    'description' => esc_html__( 'Order of FAQ posts.', 'lsvr-faq' ),
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lsvr-faq' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-faq' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-faq' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-faq' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-faq' ),
                        'random' => esc_html__( 'Random', 'lsvr-faq' ),
                    ),
                    'default' => 'default',
                    'priority' => 40,
                ),

                // Display category
                array(
                    'name' => 'show_category',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Category', 'lsvr-faq' ),
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

            ), apply_filters( 'lsvr_faq_list_widget_shortcode_atts', array() ) );
        }

    }
}
?>