<?php
/**
 * LSVR Lore Sidebar Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Lore_Sidebar' ) ) {
    class Lsvr_Shortcode_Lore_Sidebar {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'sidebar_id' => 'lsvr-lore-default-sidebar',
                    'columns' => 3,
                    'show_borders' => false,
                    'enable_masonry' => false,
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

            // Show borders
            $show_borders = true === $args['show_borders'] || '1' === $args['show_borders'] || 'true' === $args['show_borders'] ? true : false;

            // Enable masonry
            $enable_masonry = true === $args['enable_masonry'] || '1' === $args['enable_masonry'] || 'true' === $args['enable_masonry'] ? true : false;

            // Element class
            $class_arr = array( 'lsvr-lore-sidebar' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-lore-sidebar--editor-view' );
            }
            if ( true === $show_borders ) {
                array_push( $class_arr, 'lsvr-lore-sidebar--has-borders' );
            }
            if ( true === $enable_masonry ) {
                array_push( $class_arr, 'lsvr-lore-sidebar--masonry' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <!-- LORE SIDEBAR : begin -->
            <section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
                <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
                <div class="lsvr-container">
                    <div class="lsvr-lore-sidebar__inner">

                        <?php if ( ! empty( $args['title'] ) ) : ?>

                            <header class="lsvr-lore-sidebar__header">

                                <?php if ( ! empty( $args['title'] ) || ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) ) : ?>

                                    <h5 class="lsvr-lore-sidebar__title">
                                        <?php echo wp_kses( $args['title'], array(
                                            'br' => array(),
                                            'strong' => array(),
                                        ) ); ?>
                                    </h5>

                                <?php endif; ?>

                                <?php if ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) : ?>

                                    <p class="lsvr-lore-sidebar__header-more">
                                        <a href="<?php echo esc_url( $args['more_link'] ); ?>"
                                            class="lsvr-lore-sidebar__header-more-link c-button"><?php echo esc_html( $args['more_label'] ); ?></a>
                                    </p>

                                <?php endif; ?>

                            </header>

                        <?php endif; ?>

                        <?php if ( ! empty( $args['sidebar_id'] ) && is_active_sidebar( $args['sidebar_id'] ) ) : ?>

                            <div class="lsvr-lore-sidebar__list lsvr-lore-sidebar__list--<?php echo ! empty( $args['columns'] ) ? esc_attr( $args['columns'] ) : 3; ?>-cols">

                                <?php dynamic_sidebar( $args['sidebar_id'] ); ?>

                            </div>

                        <?php endif; ?>

                        <?php if ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) : ?>

                            <footer class="lsvr-lore-sidebar__footer">

                                <p class="lsvr-lore-sidebar__footer-more">
                                    <a href="<?php echo esc_url( $args['more_link'] ); ?>"
                                        class="lsvr-lore-sidebar__footer-more-link c-button"><?php echo esc_html( $args['more_label'] ); ?></a>
                                </p>

                            </footer>

                        <?php endif; ?>

                    </div>
                </div>
            </section>
            <!-- LORE SIDEBAR : end -->

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
                    'default' => esc_html__( 'Lorem ipsum', 'lsvr-lore-toolkit' ),
                    'priority' => 10,
                ),

                // Sidebar ID
                array(
                    'name' => 'sidebar_id',
                    'type' => 'select',
                    'label' => esc_html__( 'Sidebar', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Choose which sidebar will be used to create this section. You can manage custom sidebars under Customizer / Custom Sidebars and populate them with widgets under Appearance / Widgets.', 'lsvr-lore-toolkit' ),
                    'choices' => lsvr_lore_toolkit_get_sidebars(),
                    'default' => 'lsvr-lore-default-sidebar',
                    'priority' => 20,
                ),

                // Columns count
                array(
                    'name' => 'columns',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display this section.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 3,
                    'priority' => 30,
                ),

                // Borders
                array(
                    'name' => 'show_borders',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Show Borders', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display borders around each widget.', 'lsvr-lore-toolkit' ),
                    'default' => false,
                    'priority' => 40,
                ),

                // Enable masonry
                array(
                    'name' => 'enable_masonry',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Enable Masonry', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display this section using a masonry layout.', 'lsvr-lore-toolkit' ),
                    'default' => false,
                    'priority' => 50,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'Learn More', 'lsvr-lore-toolkit' ),
                    'priority' => 60,
                ),

                // More link
                array(
                    'name' => 'more_link',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Link', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'http://www.example.org', 'lsvr-lore-toolkit' ),
                    'priority' => 60,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-lore-toolkit' ),
                    'priority' => 110,
                ),

            ), apply_filters( 'lsvr_lore_sidebar_shortcode_atts', array() ) );
        }

    }
}
?>