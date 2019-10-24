<?php
/**
 * LSVR Lore Sitemap Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Lore_Sitemap' ) ) {
    class Lsvr_Shortcode_Lore_Sitemap {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'menu_id' => '',
                    'columns' => 3,
                    'enable_masonry' => false,
                    'cta_position' => 'disable',
                    'cta_title' => '',
                    'cta_text' => '',
                    'cta_more_label' => '',
                    'cta_more_link' => '',
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

            // Enable masonry
            $enable_masonry = true === $args['enable_masonry'] || '1' === $args['enable_masonry'] || 'true' === $args['enable_masonry'] ? true : false;

            // Element class
            $class_arr = array( 'lsvr-lore-sitemap' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-lore-sitemap--editor-view' );
            }
            if ( true === $enable_masonry ) {
                array_push( $class_arr, 'lsvr-lore-sitemap--masonry' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            // Count top level
            if ( ! empty( $args['menu_id'] ) ) {

                $top_level_count = count(
                    wp_list_filter(
                        wp_get_nav_menu_items( $args['menu_id'] ),
                        [ 'menu_item_parent' => 0 ]
                    )
                );

            }

            ob_start(); ?>

            <!-- LORE SITEMAP : begin -->
            <section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
                <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
                <div class="lsvr-lore-sitemap__inner">

                    <?php if ( ! empty( $args['title'] ) ) : ?>

                        <header class="lsvr-lore-sitemap__header">

                            <?php if ( ! empty( $args['title'] ) || ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) ) : ?>

                                <h5 class="lsvr-lore-sitemap__title">
                                    <?php echo wp_kses( $args['title'], array(
                                        'br' => array(),
                                        'strong' => array(),
                                    ) ); ?>
                                </h5>

                            <?php endif; ?>

                            <?php if ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) : ?>

                                <p class="lsvr-lore-sitemap__header-more">
                                    <a href="<?php echo esc_url( $args['more_link'] ); ?>"
                                        class="lsvr-lore-sitemap__header-more-link c-button"><?php echo esc_html( $args['more_label'] ); ?></a>
                                </p>

                            <?php endif; ?>

                        </header>

                    <?php endif; ?>

                    <div class="lsvr-lore-sitemap__content">

                        <?php if ( ! empty( $args['menu_id'] ) ) : ?>

                            <nav class="lsvr-lore-sitemap__nav lsvr-lore-sitemap__nav--masonry lsvr-lore-sitemap__nav--<?php echo ! empty( $args['columns'] ) ? esc_attr( $args['columns'] ) : 3; ?>-cols">

                                <?php wp_nav_menu(array(
                                    'menu' => $args['menu_id'],
                                    'container' => '',
                                    'menu_class' => 'lsvr-lore-sitemap__list',
                                    'fallback_cb' => '',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker' => new Lsvr_Lore_Sitemap_Walker,
                                    'top_level_count' => $top_level_count,
                                    'cta_position' => $args['cta_position'],
                                    'cta_title' => $args['cta_title'],
                                    'cta_text' => $args['cta_text'],
                                    'cta_more_label' => $args['cta_more_label'],
                                    'cta_more_link' => $args['cta_more_link'],
                                )); ?>

                            </nav>

                        <?php else : ?>

                            <p class="c-alert-message lsvr-lore-sitemap__message">
                                <?php esc_html_e( 'Please choose which menu will be used to create this sitemap.', 'lsvr-lore-toolkit' ); ?>
                            </p>

                        <?php endif; ?>

                    </div>

                    <?php if ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) : ?>

                        <footer class="lsvr-lore-sitemap__footer">

                            <p class="lsvr-lore-sitemap__footer-more">
                                <a href="<?php echo esc_url( $args['more_link'] ); ?>"
                                    class="lsvr-lore-sitemap__footer-more-link c-button"><?php echo esc_html( $args['more_label'] ); ?></a>
                            </p>

                        </footer>

                    <?php endif; ?>

                </div>
            </section>
            <!-- LORE SITEMAP : end -->

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
                    'description' => esc_html__( 'Title of this section.', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'Lorem ipsum', 'lsvr-lore-toolkit' ),
                    'priority' => 10,
                ),

                // Menu ID
                array(
                    'name' => 'menu_id',
                    'type' => 'menu',
                    'label' => esc_html__( 'Menu', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Choose which menu will be used to create the sitemap. You can manage menus under Appearance / Menus.', 'lsvr-lore-toolkit' ),
                    'priority' => 20,
                ),

                // Columns count
                array(
                    'name' => 'columns',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display this section.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 1 => 1 , 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 3,
                    'priority' => 30,
                ),

                // Enable masonry
                array(
                    'name' => 'enable_masonry',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Enable Masonry', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display this section using a masonry layout.', 'lsvr-lore-toolkit' ),
                    'default' => false,
                    'priority' => 40,
                ),

                // CTA
                array(
                    'name' => 'cta_position',
                    'type' => 'select',
                    'label' => esc_html__( 'CTA Position', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Set the position of the CTA block.', 'lsvr-lore-toolkit' ),
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lsvr-lore-toolkit' ),
                        'first' => esc_html__( 'First', 'lsvr-lore-toolkit' ),
                        'second' => esc_html__( 'Second', 'lsvr-lore-toolkit' ),
                        'third' => esc_html__( 'Third', 'lsvr-lore-toolkit' ),
                        'fourth' => esc_html__( 'Fourth', 'lsvr-lore-toolkit' ),
                        'last' => esc_html__( 'Last', 'lsvr-lore-toolkit' ),
                    ),
                    'default' => 'disable',
                    'priority' => 110,
                ),

                // CTA Title
                array(
                    'name' => 'cta_title',
                    'type' => 'text',
                    'label' => esc_html__( 'CTA Title', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'CTA', 'lsvr-lore-toolkit' ),
                    'priority' => 120,
                ),

                // CTA Text
                array(
                    'name' => 'cta_text',
                    'type' => 'textarea',
                    'label' => esc_html__( 'CTA Text', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'lsvr-lore-toolkit' ),
                    'priority' => 130,
                ),

                // CTA More Label
                array(
                    'name' => 'cta_more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'CTA More Button Label', 'lsvr-lore-toolkit' ),

                    'default' => esc_html__( 'Learn More', 'lsvr-lore-toolkit' ),
                    'priority' => 140,
                ),

                // CTA More Label
                array(
                    'name' => 'cta_more_link',
                    'type' => 'text',
                    'label' => esc_html__( 'CTA More Button Link', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'http://www.example.org', 'lsvr-lore-toolkit' ),
                    'priority' => 150,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'Learn More', 'lsvr-lore-toolkit' ),
                    'priority' => 210,
                ),

                // More link
                array(
                    'name' => 'more_link',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Link', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'http://www.example.org', 'lsvr-lore-toolkit' ),
                    'priority' => 220,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-lore-toolkit' ),
                    'priority' => 310,
                ),

            ), apply_filters( 'lsvr_lore_sitemap_shortcode_atts', array() ) );
        }

    }
}
?>