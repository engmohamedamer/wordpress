<?php
/**
 * LSVR Lore KB Category Widget Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Lore_KBA_Category_Widget' ) ) {
    class Lsvr_Shortcode_Lore_KBA_Category_Widget {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'category' => '',
                    'post_limit' => '',
                    'post_order' => '',
                    'id' => '',
                    'className' => '',
                    'editor_view' => false,
                ),
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Element class
            $class_arr = array( 'widget shortcode-widget lsvr-lore-kba-category-widget lsvr-lore-kba-category-widget--shortcode' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-lore-kba-category-widget--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <?php the_widget( 'Lsvr_Widget_Lore_KBA_Category', array(
                'category' => $args['category'],
                'post_limit' => $args['post_limit'],
                'post_order' => $args['post_order'],
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

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'lsvr_kba_cat',
                    'label' => esc_html__( 'Category', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Choose Knowledge Base category.', 'lsvr-lore-toolkit' ),
                    'priority' => 10,
                ),

                // Limit
                array(
                    'name' => 'post_limit',
                    'type' => 'select',
                    'label' => esc_html__( 'Article Limit', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Number of Knowledge Base posts to display.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-lore-toolkit' ) ) + range( 0, 20, 1 ),
                    'default' => 6,
                    'priority' => 30,
                ),

                // Post order
                array(
                    'name' => 'post_order',
                    'type' => 'select',
                    'label' => esc_html__( 'Article Order', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Order of Knowledge Base posts.', 'lsvr-lore-toolkit' ),
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lsvr-lore-toolkit' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-lore-toolkit' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-lore-toolkit' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-lore-toolkit' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-lore-toolkit' ),
                        'random' => esc_html__( 'Random', 'lsvr-lore-toolkit' ),
                        'rating' => esc_html__( 'By rating', 'lsvr-lore-toolkit' ),
                    ),
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

            ), apply_filters( 'lsvr_lore_kba_category_widget_shortcode_atts', array() ) );
        }

    }
}
?>