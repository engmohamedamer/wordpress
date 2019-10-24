<?php
/**
 * LSVR Lore Posts Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Lore_Posts' ) ) {
    class Lsvr_Shortcode_Lore_Posts {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'category' => 0,
                    'limit' => 3,
                    'columns' => 3,
                    'show_date' => true,
                    'show_category' => true,
                    'show_excerpt' => true,
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

            // Enable date
            $show_date = true === $args['show_date'] || '1' === $args['show_date'] || 'true' === $args['show_date'] ? true : false;

            // Enable category
            $show_category = true === $args['show_category'] || '1' === $args['show_category'] || 'true' === $args['show_category'] ? true : false;

            // Enable excerpt
            $show_excerpt = true === $args['show_excerpt'] || '1' === $args['show_excerpt'] || 'true' === $args['show_excerpt'] ? true : false;

            // Get thumb size
            if ( (int) $args['columns'] > 2 ) {
                $thumb_size = 'medium';
            } else {
                $thumb_size = 'full';
            }

            // Element class
            $class_arr = array( 'lsvr-lore-posts' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-lore-posts--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            // Prepare query
            $limit = 0 === (int) $args['limit'] ? 1000 : (int) $args['limit'];
            $query_args = array(
                'posts_per_page' => $limit,
                'post_type' => 'post',
            );

            // Get category
            if ( ! empty( $args['category'] ) && is_numeric( $args['category'] ) && (int) $args['category'] > 0 ) {
                $category_id = (int) $args['category'];
            } else if ( ! empty( $args['category'] ) ) {
                $category_id = get_term_by( 'slug', $args['category'], 'category', ARRAY_A );
                $category_id = ! empty( $category_id['term_taxonomy_id'] ) ? $category_id['term_taxonomy_id'] : false;
            } else {
                $category_id = false;
            }

            // Set category
            if ( ! empty( $category_id ) ) {
                $query_args['category'] = $category_id;
            }

            // Get posts
            $posts = get_posts( $query_args );

            ob_start(); ?>

            <!-- LORE POSTS : begin -->
            <section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
                <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
                <div class="lsvr-lore-posts__inner">
                    <div class="lsvr-container">
                        <div class="lsvr-lore-posts__content">

                            <?php if ( ! empty( $args['title'] ) ) : ?>

                                <header class="lsvr-lore-posts__header">

                                    <h2 class="lsvr-lore-posts__title">
                                        <?php echo wp_kses( $args['title'], array(
                                            'br' => array(),
                                            'strong' => array(),
                                        ) ); ?>
                                    </h2>

                                </header>

                            <?php endif; ?>

                            <?php if ( ! empty( $posts ) ) : ?>

                                <div class="<?php echo esc_attr( $grid_class ); ?> lsvr-lore-posts__list">

                                    <?php foreach ( $posts as $post ) : ?>

                                        <div class="<?php echo esc_attr( $col_class ); ?> lsvr-lore-posts__item">

                                            <article <?php post_class( 'lsvr-lore-posts__post', $post->ID ); ?>>
                                                <div class="lsvr-lore-posts__post-inner">

                                                    <?php if ( has_post_thumbnail( $post->ID ) ) : ?>

                                                        <p class="lsvr-lore-posts__post-thumbnail">
                                                            <a href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>"
                                                                 class="lsvr-lore-posts__post-thumbnail-link">
                                                                <?php echo get_the_post_thumbnail( $post->ID, $thumb_size ); ?>
                                                            </a>
                                                        </p>

                                                    <?php endif; ?>

                                                    <header class="lsvr-lore-posts__post-header">

                                                        <?php if ( true === $show_date || true === $show_category ) : ?>

                                                            <p class="lsvr-lore-posts__post-meta">

                                                                <?php if ( true === $show_date ) : ?>

                                                                    <time class="lsvr-lore-posts__post-meta-date" datetime="<?php echo esc_attr( get_the_time( 'c', $post->ID  ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ), $post->ID ); ?></time>

                                                                <?php endif; ?>

                                                                <?php if ( true === $show_category && lsvr_lore_toolkit_has_post_terms( $post->ID, 'category') ) :?>

                                                                    <span class="lsvr-lore-posts__post-meta-categories">
                                                                        <?php lsvr_lore_toolkit_the_post_terms( $post->ID, 'category', esc_html__( 'in %s', 'lsvr-lore-toolkit' ) ); ?>
                                                                    </span>

                                                                <?php endif; ?>

                                                            </p>

                                                        <?php endif; ?>

                                                        <h3 class="lsvr-lore-posts__post-title">
                                                            <a href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>"
                                                                class="lsvr-lore-posts__post-title-link" rel="bookmark"><?php echo esc_html( $post->post_title ); ?></a>
                                                        </h3>

                                                    </header>

                                                    <?php if ( true === $show_excerpt && has_excerpt( $post->ID ) ) : ?>

                                                        <div class="lsvr-lore-posts__post-content">

                                                            <?php echo wpautop( get_the_excerpt( $post->ID ) ); ?>

                                                            <p class="lsvr-lore-posts__post-permalink">
                                                               <a href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>"
                                                                    class="lsvr-lore-posts__post-permalink-link">
                                                                    <?php esc_html_e( 'Read More', 'lsvr-lore-toolkit' ); ?>
                                                                </a>
                                                            </p>

                                                        </div>

                                                    <?php endif; ?>

                                                </div>
                                            </article>

                                        </div>

                                    <?php endforeach; wp_reset_postdata(); ?>

                                </div>

                            <?php else : ?>

                                <p class="c-alert-message"><?php esc_html_e( 'There are no posts', 'lsvr-lore-toolkit' ); ?></p>

                            <?php endif; ?>

                            <?php if ( ! empty( $args[ 'more_label' ] ) ) : ?>

                                <footer class="lsvr-lore-posts__footer">

                                    <p class="lsvr-lore-posts__more">

                                        <?php if ( ! empty( $category_id ) ) : ?>

                                            <a href="<?php echo esc_url( get_term_link( $category_id, 'category' ) ); ?>"
                                                class="c-button lsvr-lore-posts__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                        <?php else : ?>

                                            <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"
                                                class="c-button lsvr-lore-posts__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                        <?php endif; ?>

                                    </p>

                                </footer>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- LORE POSTS : end -->

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
                    'default' => esc_html__( 'Latest Blog Posts', 'lsvr-lore-toolkit' ),
                    'priority' => 10,
                ),

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'category',
                    'label' => esc_html__( 'Category', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display posts from a specific category.', 'lsvr-lore-toolkit' ),
                    'priority' => 20,
                ),

                // Limit
                array(
                    'name' => 'limit',
                    'type' => 'select',
                    'label' => esc_html__( 'Limit', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'How many posts should be displayed.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-lore-toolkit' ) ) + range( 0, 20, 1 ),
                    'default' => 3,
                    'priority' => 30,
                ),

                // Columns count
                array(
                    'name' => 'columns',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display posts.', 'lsvr-lore-toolkit' ),
                    'choices' => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 3,
                    'priority' => 40,
                ),

                // Show date
                array(
                    'name' => 'show_date',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Date', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display post date.', 'lsvr-lore-toolkit' ),
                    'default' => true,
                    'priority' => 70,
                ),

                // Show category
                array(
                    'name' => 'show_category',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Category', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display post category.', 'lsvr-lore-toolkit' ),
                    'default' => true,
                    'priority' => 80,
                ),

                // Show excerpt
                array(
                    'name' => 'show_excerpt',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Excerpt', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Display post excerpt.', 'lsvr-lore-toolkit' ),
                    'default' => true,
                    'priority' => 90,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Link to post archive. Leave blank to hide.', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'More Posts', 'lsvr-lore-toolkit' ),
                    'priority' => 200,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-lore-toolkit' ),
                    'priority' => 220,
                ),

            ), apply_filters( 'lsvr_lore_posts_shortcode_atts', array() ) );
        }

    }
}
?>