<?php
/**
 * LSVR KBA List Widget Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_KBA_List_Widget' ) ) {
    class Lsvr_Shortcode_KBA_List_Widget {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'category' => 0,
                    'limit' => 4,
                    'order' => 'default',
                    'show_icon' => true,
                    'show_date' => true,
                    'show_category' => true,
                    'show_rating' => true,
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
            $class_arr = array( 'widget shortcode-widget lsvr_kba-list-widget lsvr_kba-list-widget--shortcode' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr_kba-list-widget--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <?php the_widget( 'Lsvr_Widget_KBA_List', array(
                'title' => $args['title'],
                'category' => $args['category'],
                'limit' => $args['limit'],
                'order' => $args['order'],
                'show_icon' => $args['show_icon'],
                'show_date' => $args['show_date'],
                'show_category' => $args['show_category'],
                'show_rating' => $args['show_rating'],
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

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'lsvr_kba_cat',
                    'label' => esc_html__( 'Category', 'lsvr-knowledge-base' ),
                    'description' => esc_html__( 'Display Knowledge Base posts only from a certain category.', 'lsvr-knowledge-base' ),
                    'priority' => 20,
                ),

                // Limit
                array(
                    'name' => 'limit',
                    'type' => 'select',
                    'label' => esc_html__( 'Limit', 'lsvr-knowledge-base' ),
                    'description' => esc_html__( 'Number of Knowledge Base posts to display.', 'lsvr-knowledge-base' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-knowledge-base' ) ) + range( 0, 20, 1 ),
                    'default' => 4,
                    'priority' => 30,
                ),

                // Order
                array(
                    'name' => 'order',
                    'type' => 'select',
                    'label' => esc_html__( 'Order', 'lsvr-knowledge-base' ),
                    'description' => esc_html__( 'Order of Knowledge Base posts.', 'lsvr-knowledge-base' ),
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lsvr-knowledge-base' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-knowledge-base' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-knowledge-base' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-knowledge-base' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-knowledge-base' ),
                        'rating' => esc_html__( 'By rating', 'lsvr-knowledge-base' ),
                        'random' => esc_html__( 'Random', 'lsvr-knowledge-base' ),
                    ),
                    'default' => 'default',
                    'priority' => 40,
                ),

                // Display icon
                array(
                    'name' => 'show_icon',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Icon', 'lsvr-knowledge-base' ),
                    'default' => true,
                    'priority' => 50,
                ),

                // Display date
                array(
                    'name' => 'show_date',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Date', 'lsvr-knowledge-base' ),
                    'default' => true,
                    'priority' => 70,
                ),

                // Display category
                array(
                    'name' => 'show_category',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Category', 'lsvr-knowledge-base' ),
                    'default' => true,
                    'priority' => 80,
                ),

                // Display rating
                array(
                    'name' => 'show_rating',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Rating', 'lsvr-knowledge-base' ),
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