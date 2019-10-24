<?php
/**
 * LSVR Lore FAQ Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Lore_FAQ' ) ) {
    class Lsvr_Shortcode_Lore_FAQ {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'category' => 0,
                    'limit' => 6,
                    'order' => '',
                    'columns' => 2,
                    'show_category' => '',
                    'more_label' => '',
                    'id' => '',
                    'className' => '',
                    'editor_view' => false,
                ),
                $atts
            );

            // Prepare grid and cols classes
            $grid_class = 'lsvr-grid lsvr-grid--' . $args['columns'] . '-cols';
            $grid_class .= (int) $args['columns'] > 1 ? ' lsvr-grid--md-2-cols' : '';
            $col_class = 'lsvr-grid__col lsvr-grid__col--span-' . esc_attr( 12 / (int) $args['columns'] );
            $col_class .= (int) $args['columns'] > 1 ? ' lsvr-grid__col--md-span-6' : '';

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Enable category
            $enable_category = true === $args['show_category'] || '1' === $args['show_category'] || 'true' === $args['show_category'] ? true : false;

            // Element class
            $class_arr = array( 'lsvr-lore-faq' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-lore-faq--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }
            array_push( $class_arr, 'lsvr-lore-faq--' . (int) $args['columns'] . '-columns' );

            // Prepare query
            $limit = 0 === (int) $args['limit'] ? 1000 : (int) $args['limit'];
            $query_args = array(
                'posts_per_page' => $limit,
                'post_type' => 'lsvr_faq',
            );

            // Set order
            if ( ! empty( $args['order'] ) && 'default' !== $args['order'] ) {
                if ( 'date_desc' == $args['order'] ) {
                    $query_args['orderby'] = 'date';
                    $query_args['order'] = 'DESC';
                }
                elseif ( 'date_asc' == $args['order'] ) {
                    $query_args['orderby'] = 'date';
                    $query_args['order'] = 'ASC';
                }
                elseif ( 'title_asc' == $args['order'] ) {
                    $query_args['orderby'] = 'title';
                    $query_args['order'] = 'ASC';
                }
                elseif ( 'title_desc' == $args['order'] ) {
                    $query_args['orderby'] = 'title';
                    $query_args['order'] = 'DESC';
                }
                elseif ( 'random' == $args['order'] ) {
                    $query_args['orderby'] = 'rand';
                }
            }

            // Get category
            if ( ! empty( $args['category'] ) && is_numeric( $args['category'] ) && (int) $args['category'] > 0 ) {
                $category_id = (int) $args['category'];
            } else if ( ! empty( $args['category'] ) ) {
                $category_id = get_term_by( 'slug', $args['category'], 'lsvr_faq_cat', ARRAY_A );
                $category_id = ! empty( $category_id['term_taxonomy_id'] ) ? $category_id['term_taxonomy_id'] : false;
            } else {
                $category_id = false;
            }

            // Set category
            if ( ! empty( $category_id ) ) {
                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'lsvr_faq_cat',
                        'field' => 'ID',
                        'terms' => array( $category_id ),
                        'operator' => 'IN',
                    ),
                );
            }

            // Get posts
            $posts = get_posts( $query_args );

            // Get posts per olumns count
            $posts_per_column = count( $posts ) > 0 ? (int) ceil( count( $posts ) / (int) $args['columns'] ) : 0;

            ob_start(); ?>

            <!-- LORE FAQ : begin -->
            <section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
                <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
                <div class="lsvr-lore-faq__inner">
                    <div class="lsvr-container">
                        <div class="lsvr-lore-faq__content">

                            <?php if ( ! empty( $args['title'] ) ) : ?>
                                <header class="lsvr-lore-faq__header">

                                    <?php if ( ! empty( $args['title'] ) ) : ?>
                                        <h2 class="lsvr-lore-faq__title">
                                            <?php echo wp_kses( $args['title'], array(
                                                'br' => array(),
                                                'strong' => array(),
                                            ) ); ?>
                                        </h2>
                                    <?php endif; ?>

                                </header>
                            <?php endif; ?>

                            <?php if ( ! empty( $posts ) ) : ?>

                                <div class="lsvr-lore-faq__list">

                                    <?php if ( (int) $args['columns'] > 1 ) : ?>

                                        <div class="<?php echo esc_attr( $grid_class ); ?> lsvr-lore-faq__grid">
                                            <div class="<?php echo esc_attr( $col_class ); ?> lsvr-lore-faq__grid-col">

                                    <?php endif;  ?>

                                    <?php $i = 0; foreach ( $posts as $post ) : ?>

                                        <?php if ( $i === $posts_per_column ) : ?>

                                            </div>
                                            <div class="<?php echo esc_attr( $col_class ); ?> lsvr-lore-faq__grid-col">

                                        <?php $i = 0; endif; ?>

                                        <div class="lsvr-lore-faq__item">

                                            <article <?php post_class( 'lsvr-lore-faq__post', $post->ID ); ?>>
                                                <div class="lsvr-lore-faq__post-inner">

                                                    <header class="lsvr-lore-faq__post-header">
                                                        <h3 class="lsvr-lore-faq__post-title is-secondary-font">
                                                            <?php echo esc_html( $post->post_title ); ?>
                                                        </h3>
                                                    </header>

                                                    <div class="lsvr-lore-faq__post-content-wrapper">

                                                        <div class="lsvr-lore-faq__post-content">

                                                            <?php if ( ! empty( $post->post_excerpt ) ) : ?>

                                                                <?php echo wpautop( $post->post_excerpt ); ?>

                                                                <p class="lsvr-lore-faq__post-permalink">
                                                                   <a href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" class="lsvr-lore-faq__post-permalink-link">
                                                                        <?php esc_html_e( 'Read More', 'lsvr-lore-toolkit' ); ?>
                                                                    </a>
                                                                </p>

                                                            <?php else : ?>

                                                                <?php echo wpautop( apply_filters( 'the_content', $post->post_content ) ); ?>

                                                            <?php endif; ?>

                                                        </div>

                                                        <?php if ( ( true === $enable_category && ! empty( lsvr_lore_toolkit_has_post_terms( $post->ID, 'lsvr_faq_cat' ) ) ) || ( empty( $post->post_excerpt ) ) ) : ?>

                                                            <footer class="lsvr-lore-faq__post-footer">

                                                                <?php if ( true === $enable_category && ! empty( lsvr_lore_toolkit_has_post_terms( $post->ID, 'lsvr_faq_cat' ) ) ) : ?>

                                                                    <p class="lsvr-lore-faq__post-meta">
                                                                        <span class="lsvr-lore-faq__post-meta-category">
                                                                            <?php lsvr_lore_toolkit_the_post_terms( $post->ID, 'lsvr_faq_cat', esc_html__( 'in %s', 'lsvr-lore-toolkit' ) ); ?>
                                                                        </span>
                                                                    </p>

                                                                <?php endif; ?>

                                                                <?php if ( empty( $post->post_excerpt ) ) : ?>

                                                                    <p class="lsvr-lore-faq__post-footer-permalink">

                                                                       <a href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" class="lsvr-lore-faq__post-footer-permalink-link">
                                                                            <?php esc_html_e( 'Permalink', 'lsvr-lore-toolkit' ); ?>
                                                                        </a>
                                                                    </p>

                                                                <?php endif; ?>

                                                            </footer>

                                                        <?php endif; ?>

                                                    </div>

                                                </div>
                                            </article>

                                        </div>

                                    <?php $i++; endforeach; wp_reset_postdata(); ?>

                                    <?php if ( (int) $args['columns'] > 1 ) : ?>

                                            </div>
                                        </div>

                                    <?php endif;  ?>

                                </div>

                            <?php else : ?>

                                <p class="c-alert-message"><?php esc_html_e( 'There are no FAQ posts.', 'lsvr-lore-toolkit' ); ?></p>

                            <?php endif; ?>

                            <?php if ( ! empty( $args[ 'more_label' ] ) ) : ?>

                                <footer class="lsvr-lore-faq__footer">

                                    <p class="lsvr-lore-faq__more">

                                        <?php if ( ! empty( $category_id ) ) : ?>

                                            <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_faq_cat' ) ); ?>" class="c-button lsvr-lore-faq__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                        <?php else : ?>

                                            <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_faq' ) ); ?>" class="c-button lsvr-lore-faq__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                        <?php endif; ?>

                                    </p>

                                </footer>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- LORE FAQ : end -->

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
                    'default' => esc_html__( 'Latest FAQ', 'lsvr-lore-toolkit' ),
                    'priority' => 10,
                ),

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'lsvr_faq_cat',
                    'label' => esc_html__( 'Category', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display FAQ posts from a specific category.', 'lsvr-lore-toolkit' ),
                    'priority' => 20,
                ),

                // Limit
                array(
                    'name' => 'limit',
                    'type' => 'select',
                    'label' => esc_html__( 'Limit', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'How many FAQ posts should be displayed.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-lore-toolkit' ) ) + range( 0, 20, 1 ),
                    'default' => 6,
                    'priority' => 30,
                ),

                // Order
                array(
                    'name' => 'order',
                    'type' => 'select',
                    'label' => esc_html__( 'Order', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Order of FAQ posts.', 'lsvr-lore-toolkit' ),
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lsvr-lore-toolkit' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-lore-toolkit' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-lore-toolkit' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-lore-toolkit' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-lore-toolkit' ),
                        'random' => esc_html__( 'Random', 'lsvr-lore-toolkit' ),
                    ),
                    'default' => 'default',
                    'priority' => 40,
                ),

                // Columns count
                array(
                    'name' => 'columns',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display FAQ posts.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 2,
                    'priority' => 50,
                ),

                // Show category
                array(
                    'name' => 'show_category',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Category', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display FAQ post category.', 'lsvr-lore-toolkit' ),
                    'priority' => 80,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Link to FAQ post archive. Leave blank to hide.', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'More FAQ', 'lsvr-lore-toolkit' ),
                    'priority' => 200,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-lore-toolkit' ),
                    'priority' => 210,
                ),

            ), apply_filters( 'lsvr_lore_faq_shortcode_atts', array() ) );
        }

    }
}
?>