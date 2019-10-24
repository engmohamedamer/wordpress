<?php
/**
 * LSVR Lore Knowledge Base Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Lore_Knowledge_Base' ) ) {
    class Lsvr_Shortcode_Lore_Knowledge_Base {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'category' => 0,
                    'columns' => 3,
                    'enable_masonry' => false,
                    'post_limit' => '',
                    'post_order' => '',
                    'cta_position' => 'disable',
                    'cta_title' => '',
                    'cta_text' => '',
                    'cta_more_label' => '',
                    'cta_more_link' => '',
                    'more_label' => '',
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
            $class_arr = array( 'lsvr-lore-knowledge-base' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-lore-knowledge-base--editor-view' );
            }
            if ( true === $enable_masonry ) {
                array_push( $class_arr, 'lsvr-lore-knowledge-base--masonry' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            // Get category
            if ( ! empty( $args['category'] ) && is_numeric( $args['category'] ) && (int) $args['category'] > 0 ) {
                $category_id = (int) $args['category'];
            } else if ( ! empty( $args['category'] ) ) {
                $category_id = get_term_by( 'slug', $args['category'], 'lsvr_kba_cat', ARRAY_A );
                $category_id = ! empty( $category_id['term_taxonomy_id'] ) ? $category_id['term_taxonomy_id'] : false;
            } else {
                $category_id = false;
            }

            // Get top categories
            if ( empty( $category_id ) ) {

                $categories = get_terms( 'lsvr_kba_cat', array(
                    'parent' => 0,
                ));

            } else {

                $categories = wp_list_filter( get_terms( 'lsvr_kba_cat', array(
                    'child_of' => $category_id,
                    'pad_counts' => true,
                    )), array(
                        'parent' => $category_id,
                    )
                );
            }

            ob_start(); ?>

            <!-- LORE KNOWLEDGE BASE : begin -->
            <section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
                <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
                <div class="lsvr-lore-knowledge-base__inner">

                    <?php if ( ! empty( $args['title'] ) ) : ?>

                        <header class="lsvr-lore-knowledge-base__header">

                            <?php if ( ! empty( $args['title'] ) || ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) ) : ?>

                                <h5 class="lsvr-lore-knowledge-base__title">
                                    <?php echo wp_kses( $args['title'], array(
                                        'br' => array(),
                                        'strong' => array(),
                                    ) ); ?>
                                </h5>

                            <?php endif; ?>

                            <?php if ( ! empty( $args['more_label'] ) ) : ?>

                                <p class="lsvr-lore-knowledge-base__header-more">

                                    <?php if ( ! empty( $category_id ) ) : ?>

                                        <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_kba_cat' ) ); ?>"
                                            class="c-button lsvr-lore-knowledge-base__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                    <?php else : ?>

                                        <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_kba' ) ); ?>"
                                            class="c-button lsvr-lore-knowledge-base__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                    <?php endif; ?>

                               </p>

                            <?php endif; ?>

                        </header>

                    <?php endif; ?>

                    <div class="lsvr-lore-knowledge-base__content">

                        <?php if ( ! empty( $categories ) ) : ?>

                            <div class="lsvr-lore-knowledge-base__list lsvr-lore-knowledge-base__list--<?php echo ! empty( $args['columns'] ) ? esc_attr( $args['columns'] ) : 3; ?>-cols">

                                <?php $i = 0; $cta_added = false; foreach ( $categories as $category ) : ?>

                                    <?php // CTA as first, second, third and fourth
                                    if ( (
                                            ( 'first' === $args['cta_position'] && 0 === $i )
                                            || ( 'second' === $args['cta_position'] && 1 === $i )
                                            || ( 'third' === $args['cta_position'] && 2 === $i )
                                            || ( 'fourth' === $args['cta_position'] && 3 === $i )
                                        ) && false === $cta_added ) : ?>

                                        <?php the_widget( 'Lsvr_Widget_Lore_CTA', array(
                                            'title' => $args['cta_title'],
                                            'text' => $args['cta_text'],
                                            'more_label' => $args['cta_more_label'],
                                            'more_link' => $args['cta_more_link'],
                                            'editor_view' => $args['editor_view'],
                                        ), array(
                                            'before_widget' => '<div class="widget lsvr-lore-cta-widget"><div class="widget__inner">',
                                            'after_widget' => '</div></div>',
                                            'before_title' => '<h3 class="widget__title">',
                                            'after_title' => '</h3>',
                                        )); ?>

                                    <?php $cta_added = true; endif; ?>

                                    <?php // Category box
                                    the_widget( 'Lsvr_Widget_Lore_KBA_Category', array(
                                        'category' => $category->term_id,
                                        'post_limit' => $args['post_limit'],
                                        'post_order' => $args['post_order'],
                                        'editor_view' => $args['editor_view'],
                                    ), array(
                                        'before_widget' => '<div class="widget lsvr-lore-kba-category-widget"><div class="widget__inner">',
                                        'after_widget' => '</div></div>',
                                        'before_title' => '<h3 class="widget__title">',
                                        'after_title' => '</h3>',
                                    )); ?>

                                    <?php // CTA as last
                                    if ( ( 'last' === $args['cta_position'] && $category === end( $categories ) ) && false === $cta_added ) : ?>

                                        <?php the_widget( 'Lsvr_Widget_Lore_CTA', array(
                                            'title' => $args['cta_title'],
                                            'text' => $args['cta_text'],
                                            'more_label' => $args['cta_more_label'],
                                            'more_link' => $args['cta_more_link'],
                                            'editor_view' => $args['editor_view'],
                                        ), array(
                                            'before_widget' => '<div class="widget lsvr-lore-cta-widget"><div class="widget__inner">',
                                            'after_widget' => '</div></div>',
                                            'before_title' => '<h3 class="widget__title">',
                                            'after_title' => '</h3>',
                                        )); ?>

                                    <?php $cta_added = true; endif; ?>

                                <?php $i++ ;endforeach; ?>

                            </div>

                        <?php else : ?>

                            <p class="c-alert-message"><?php esc_html_e( 'There are no Knowledge Base categories to display.', 'lsvr-lore-toolkit' ); ?></p>

                        <?php endif; ?>

                    </div>

                    <?php if ( ! empty( $args['more_label'] ) ) : ?>

                        <footer class="lsvr-lore-knowledge-base__footer">

                            <p class="lsvr-lore-knowledge-base__header-more">

                                <?php if ( ! empty( $category_id ) ) : ?>

                                    <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_kba_cat' ) ); ?>"
                                        class="c-button lsvr-lore-knowledge-base__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                <?php else : ?>

                                    <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_kba' ) ); ?>"
                                        class="c-button lsvr-lore-knowledge-base__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                <?php endif; ?>

                           </p>

                        </footer>

                    <?php endif; ?>

                </div>
            </section>
            <!-- LORE KNOWLEDGE BASE : end -->

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
                    'default' => esc_html__( 'Selected Topics', 'lsvr-lore-toolkit' ),
                    'priority' => 10,
                ),

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'lsvr_kba_cat',
                    'label' => esc_html__( 'Category', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Choose the parent category or leave unset to display top categories.', 'lsvr-lore-toolkit' ),
                    'priority' => 20,
                ),

                // Post limit
                array(
                    'name' => 'post_limit',
                    'type' => 'select',
                    'label' => esc_html__( 'Article Limit', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Number of Knowledge Base posts to display per category.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-lore-toolkit' ) ) + range( 0, 20, 1 ),
                    'default' => 6,
                    'priority' => 50,
                ),

                // Post order
                array(
                    'name' => 'post_order',
                    'type' => 'select',
                    'label' => esc_html__( 'Article Order', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Order of Knowledge Base posts inside category.', 'lsvr-lore-toolkit' ),
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lsvr-lore-toolkit' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-lore-toolkit' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-lore-toolkit' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-lore-toolkit' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-lore-toolkit' ),
                        'random' => esc_html__( 'Random', 'lsvr-lore-toolkit' ),
                        'rating' => esc_html__( 'By rating', 'lsvr-lore-toolkit' ),
                    ),
                    'priority' => 60,
                ),

                // Columns count
                array(
                    'name' => 'columns',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display this section.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 1 => 1 , 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 3,
                    'priority' => 70,
                ),

                // Enable masonry
                array(
                    'name' => 'enable_masonry',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Enable Masonry', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display this section using a masonry layout. Please note that this option can affect the position of CTA.', 'lsvr-lore-toolkit' ),
                    'default' => false,
                    'priority' => 80,
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
                    'label' => esc_html__( 'CTA More Button Label', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'http://www.example.org', 'lsvr-lore-toolkit' ),
                    'priority' => 150,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'Go to Knowledge Base', 'lsvr-lore-toolkit' ),
                    'priority' => 210,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-lore-toolkit' ),
                    'priority' => 310,
                ),

            ), apply_filters( 'lsvr_lore_knowledge_base_shortcode_atts', array() ) );
        }

    }
}
?>